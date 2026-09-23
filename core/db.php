<?php
include_once(__DIR__ . '/../vendor/autoload.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('Asia/Ho_Chi_Minh');

class LOCNGUYEN_SIEUTHICODE
{
    private $ketnoi = null;

    function connect()
    {
        if ($this->ketnoi instanceof mysqli) {
            return;
        }

        $this->ketnoi = mysqli_connect(
            'localhost',
            'trumrobl_haomundev',
            'trumrobl_haomundev',
            'trumrobl_haomundev'
        );

        if (!$this->ketnoi) {
            die('Error => DATABASE');
        }

        mysqli_query($this->ketnoi, "SET NAMES 'utf8'");
    }

    function dis_connect()
    {
        if ($this->ketnoi instanceof mysqli) {
            mysqli_close($this->ketnoi);
            $this->ketnoi = null;
        }
    }

    public function get_id_insert()
    {
        $this->connect();
        return mysqli_insert_id($this->ketnoi);
    }

    function getUser($username)
    {
        $this->connect();
        $username = mysqli_real_escape_string($this->ketnoi, $username);
        $row = $this->ketnoi->query("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' LIMIT 1");
        return $row ? $row->fetch_array() : null;
    }

    /**
     * ✅ FIX: site() không còn warning khi key không tồn tại
     * Nếu không có key -> trả '' (rỗng) thay vì crash.
     */
    function site($data)
    {
        $this->connect();
        $data = mysqli_real_escape_string($this->ketnoi, $data);

        $result = $this->ketnoi->query("SELECT `value` FROM `options` WHERE `key` = '{$data}' LIMIT 1");
        if (!$result) {
            return '';
        }

        $row = $result->fetch_assoc();
        return $row['value'] ?? '';
    }

    function query($sql)
    {
        $this->connect();
        return $this->ketnoi->query($sql);
    }

    function cong($table, $data, $sotien, $where)
    {
        $this->connect();
        $table = mysqli_real_escape_string($this->ketnoi, $table);
        $data  = mysqli_real_escape_string($this->ketnoi, $data);
        $sotien = (float)$sotien;

        return $this->ketnoi->query("UPDATE `{$table}` SET `{$data}` = `{$data}` + '{$sotien}' WHERE {$where}");
    }

    function tru($table, $data, $sotien, $where)
    {
        $this->connect();
        $table = mysqli_real_escape_string($this->ketnoi, $table);
        $data  = mysqli_real_escape_string($this->ketnoi, $data);
        $sotien = (float)$sotien;

        return $this->ketnoi->query("UPDATE `{$table}` SET `{$data}` = `{$data}` - '{$sotien}' WHERE {$where}");
    }

    function insert($table, $data)
    {
        $this->connect();
        $field_list = '';
        $value_list = '';

        foreach ($data as $key => $value) {
            $field_list .= ",`{$key}`";
            $value_list .= ",'" . mysqli_real_escape_string($this->ketnoi, (string)$value) . "'";
        }

        $sql = 'INSERT INTO `' . $table . '`(' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ')';
        return mysqli_query($this->ketnoi, $sql);
    }

    function update($table, $data, $where)
    {
        $this->connect();
        $sql = '';

        foreach ($data as $key => $value) {
            $sql .= "`{$key}` = '" . mysqli_real_escape_string($this->ketnoi, (string)$value) . "',";
        }

        $sql = 'UPDATE `' . $table . '` SET ' . trim($sql, ',') . ' WHERE ' . $where;
        return mysqli_query($this->ketnoi, $sql);
    }

    function update_value($table, $data, $where, $value1)
    {
        $this->connect();
        $sql = '';

        foreach ($data as $key => $value) {
            $sql .= "`{$key}` = '" . mysqli_real_escape_string($this->ketnoi, (string)$value) . "',";
        }

        $value1 = (int)$value1;
        $sql = 'UPDATE `' . $table . '` SET ' . trim($sql, ',') . ' WHERE ' . $where . ' LIMIT ' . $value1;
        return mysqli_query($this->ketnoi, $sql);
    }

    function remove($table, $where)
    {
        $this->connect();
        $sql = "DELETE FROM `{$table}` WHERE {$where}";
        return mysqli_query($this->ketnoi, $sql);
    }

    function get_list($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);

        if (!$result) {
            // ✅ đừng die text (nó làm output -> hỏng header)
            return [];
        }

        $return = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $return[] = $row;
        }
        mysqli_free_result($result);
        return $return;
    }

    function get_row($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);

        if (!$result) {
            return false;
        }

        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $row ?: false;
    }

    function num_rows($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);

        if (!$result) {
            return 0;
        }

        $row = mysqli_num_rows($result);
        mysqli_free_result($result);
        return (int)$row;
    }
}

/** ======================
 *  LOAD USER SESSION
 *  ====================== */
$LOCNGUYEN_SIEUTHICODE = new LOCNGUYEN_SIEUTHICODE();

$my_username = false;
$my_level = null;
$my_money = 0;
$getUser = null;

if (!empty($_SESSION['username'])) {
    $u = mysqli_real_escape_string(mysqli_connect('localhost', 'trumrobl_haomundev', 'trumrobl_haomundev', 'trumrobl_haomundev'), $_SESSION['username']);
    // ^ trick nhỏ để escape nếu connect chưa init, nhưng không cần thiết nếu bạn muốn bỏ.
    // Bạn có thể bỏ dòng này nếu muốn.

    $getUser = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_users` WHERE `username` = '" . $_SESSION['username'] . "' AND `banned` = 0 LIMIT 1");

    if (!$getUser) {
        // ✅ KHÔNG session_start lại
        session_destroy();

        // ✅ Tránh header nếu đã output (an toàn)
        if (!headers_sent()) {
            header('Location: /');
        } else {
            echo '<script>location.href="/";</script>';
        }
        exit;
    }

    $my_username = true;
    $my_money = (int)$getUser['coin'];
    $my_level = $getUser['role'];

    if ($my_money < 0) {
        $LOCNGUYEN_SIEUTHICODE->update("tbl_users", ['banned' => 1], "username = '" . $_SESSION['username'] . "'");
        session_destroy();
        if (!headers_sent()) {
            header('Location: /');
        } else {
            echo '<script>location.href="/";</script>';
        }
        exit;
    }
}

/** ======================
 *  AUTH HELPERS
 *  ====================== */
function CheckLogin()
{
    global $my_username;
    if ($my_username !== true) {
        die('<script type="text/javascript">setTimeout(function(){ location.href = "/" }, 0);</script>');
    }
}

function CheckAdmin()
{
    global $my_level;
    if ((string)$my_level !== '1') {
        die('<script type="text/javascript">setTimeout(function(){ location.href = "/" }, 0);</script>');
    }
}