<?php
require_once("../core/db.php");
require_once("../core/helpers.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $data = array();
    foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT * FROM `tbl_category_hack`") as $row) {
        $groups = array(); // Tạo một mảng để lưu trữ danh sách groups
        foreach ($LOCNGUYEN_SIEUTHICODE->get_list("SELECT `id`,`name`,`cate_id`,`link_down`,`status`,`create_date`,`update_date` FROM `tbl_groups_hack` WHERE `cate_id` = '" . $row['id'] . "'") as $group) {
            $groups[] = $group; // Thêm group vào danh sách groups
        }
        $row['list_groups'] = $groups; // Gán danh sách groups cho key 'list_groups' trong row
        $data[] = $row; // Thêm row vào danh sách data
    }
    
    // Trả về kết quả dưới dạng JSON
    echo json_encode(array(
        "data" => $data
    ));
} else {
    die(json_encode(array('message' => "The requested resource does not support http method 'POST'.")));
}
