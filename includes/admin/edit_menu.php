<?php
CheckLogin();
CheckAdmin();
if (isset($_GET['id']) && $getUser['role'] == '1') {
    $row = $LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `tbl_menu` WHERE `id`='".xss($_GET['id'])."'");
    if (!$row) die('<script>alert("Không tồn tại!");location.href="/";</script>');
} else die('<script>alert("Không tồn tại!");location.href="/";</script>');

if (isset($_POST['editMenu']) && $getUser['role'] == '1') {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1)
        die('<script>alert("Web demo!");history.back();</script>');
    $isUpdate = $LOCNGUYEN_SIEUTHICODE->update("tbl_menu", [
        'stt'=>xss($_POST['stt']),
        'name'=>xss($_POST['name']),
        'slug'=>xss(create_slug($_POST['name'])),
        'noidung'=>base64_encode($_POST['noidung']),
        'status'=>xss($_POST['status'])
    ], " `id`='".$row['id']."' ");
    if($isUpdate) die('<script>alert("Lưu thành công!");location.href="";</script>');
    else die('<script>alert("Lưu thất bại!");history.back();</script>');
}
?>

<style>
body{
    margin:0;
    font-family:Segoe UI, sans-serif;
    background:linear-gradient(135deg,#dcdcdc,#bfbfbf);
}

/* container full width */
.wrapper{
    width:100%;
    padding:40px;
    box-sizing:border-box;
}

/* card */
.card{
    width:100%;
    background:#f5f5f5;
    border-radius:18px;
    padding:40px;
    box-shadow:0 15px 40px rgba(0,0,0,0.15);
}

/* title */
.card-title{
    font-size:28px;
    font-weight:600;
    margin-bottom:30px;
    color:#333;
}

/* grid layout */
.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:25px;
}

.full{
    grid-column:1 / -1;
}

/* inputs */
label{
    font-weight:600;
    color:#444;
    margin-bottom:8px;
    display:block;
}

.form-control, textarea, select{
    width:100%;
    padding:14px;
    border-radius:10px;
    border:1px solid #ccc;
    background:#fff;
    font-size:15px;
    transition:0.3s;
}

.form-control:focus, textarea:focus, select:focus{
    border:1px solid #888;
    box-shadow:0 0 0 3px rgba(0,0,0,0.08);
    outline:none;
}

textarea{min-height:160px;}

/* button */
.btn-submit{
    margin-top:30px;
    padding:15px;
    width:100%;
    border:none;
    border-radius:12px;
    font-weight:600;
    font-size:16px;
    background:#333;
    color:#fff;
    cursor:pointer;
    transition:0.3s;
}

.btn-submit:hover{
    background:#111;
    transform:translateY(-2px);
}

/* responsive */
@media(max-width:768px){
    .form-grid{
        grid-template-columns:1fr;
    }
    .wrapper{
        padding:20px;
    }
}
</style>

<div class="wrapper">
<form method="POST">
<div class="card">

<div class="card-title">Chỉnh Sửa Menu</div>

<div class="form-grid">

<div>
<label>Số Thứ Tự</label>
<input name="stt" type="text" value="<?= $row['stt'] ?>" class="form-control" required>
</div>

<div>
<label>Tên Menu</label>
<input name="name" type="text" value="<?= $row['name'] ?>" class="form-control" required>
</div>

<div class="full">
<label>Chức Năng</label>
<textarea name="noidung"><?= base64_decode($row['noidung']) ?></textarea>
</div>

<div>
<label>Trạng Thái</label>
<select name="status">
<option value="1" <?= $row['status']=='1'?'selected':'' ?>>Hiển thị</option>
<option value="0" <?= $row['status']=='0'?'selected':'' ?>>Ẩn</option>
</select>
</div>

<div class="full">
<button type="submit" name="editMenu" class="btn-submit">CẬP NHẬT MENU</button>
</div>

</div>

</div>
</form>
</div>

<script>
CKEDITOR.replace("noidung",{uiColor:"#f5f5f5"});
</script>