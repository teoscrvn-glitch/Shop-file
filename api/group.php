<?php
require_once("../core/db.php");
require_once("../core/helpers.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(!isset($_GET['id']) || empty($_GET['id'])){
        die(json_encode(array('status' => false, 'msg' => 'Thiếu tham số')));
    }
    $id = xss(preg_replace('/\D/', '', $_GET['id']));
    $data = array();
    foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT `id`,`name`,`cate_id`,`link_down`,`status`,`create_date`,`update_date` FROM `tbl_groups_hack` WHERE `id`='$id'") as $row) {
        $groups = array(); // Tạo một mảng để lưu trữ danh sách groups
        foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_package_hack` WHERE `groups_id` = '" . $row['id'] . "'") as $group) {
            $count = $LOCNGUYEN_SIEUTHICODE->num_rows("SELECT * FROM `tbl_license` WHERE `package_id`='".$group['id']."' AND `status`='1'");
            if($count === false){
                $group['count'] =0;
            }else{
                $group['count'] = $count; 
            }
            $groups[] = $group; // Thêm group vào danh sách groups
        }
        $row['list_package'] = $groups; // Gán danh sách groups cho key 'list_groups' trong row
        $data[] = $row; // Thêm row vào danh sách data
    }
    
    // Trả về kết quả dưới dạng JSON
    echo json_encode(array(
        "data" => $data
    ));
} else {
    die(json_encode(array('message' => "The requested resource does not support http method 'POST'.")));
}
