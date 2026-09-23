<?php
CheckLogin();
CheckAdmin();
?>
<?php
if (isset($_POST['SaveSettings'])) {
    if ($LOCNGUYEN_SIEUTHICODE->site('status_demo') == 1) {
        die('<script type="text/javascript">if(!alert("Đây là trang web demo bạn không thể thực hiện chức năng này !")){window.history.back().location.reload();}</script>');
    }
    if (check_img('logo_light') == true) {
        $rand = random('0123456789QWERTYUIOPASDGHJKLZXCVBNM', 3);
        $uploads_dir = './upload/theme/logo_light_' . $rand . '.png';
        $tmp_name = $_FILES['logo_light']['tmp_name'];
        $addlogo = move_uploaded_file($tmp_name, $uploads_dir);
        if ($addlogo) {
            $LOCNGUYEN_SIEUTHICODE->update('options', [
                'value'  => 'upload/theme/logo_light_' . $rand . '.png'
            ], " `key` = 'logo' ");
        }
    }
    if (check_img('banner') == true) {
        $rand = random('0123456789QWERTYUIOPASDGHJKLZXCVBNM', 3);
        $uploads_dir = './upload/theme/banner_' . $rand . '.png';
        $tmp_name = $_FILES['banner']['tmp_name'];
        $addlogo = move_uploaded_file($tmp_name, $uploads_dir);
        if ($addlogo) {
            $LOCNGUYEN_SIEUTHICODE->update('options', [
                'value'  => 'upload/theme/banner_' . $rand . '.png'
            ], " `key` = 'banner' ");
        }
    }
    if (check_img('footer') == true) {
        $rand = random('0123456789QWERTYUIOPASDGHJKLZXCVBNM', 3);
        $uploads_dir = './upload/theme/footer_' . $rand . '.png';
        $tmp_name = $_FILES['footer']['tmp_name'];
        $addlogo = move_uploaded_file($tmp_name, $uploads_dir);
        if ($addlogo) {
            $LOCNGUYEN_SIEUTHICODE->update('options', [
                'value'  => 'upload/theme/footer_' . $rand . '.png'
            ], " `key` = 'footer' ");
        }
    }


    if (check_img('favicon') == true) {
        $rand = random('0123456789QWERTYUIOPASDGHJKLZXCVBNM', 3);
        $uploads_dir = './upload/theme/favicon_' . $rand . '.png';
        $tmp_name = $_FILES['favicon']['tmp_name'];
        $addlogo = move_uploaded_file($tmp_name, $uploads_dir);
        if ($addlogo) {
            $LOCNGUYEN_SIEUTHICODE->update('options', [
                'value'  => 'upload/theme/favicon_' . $rand . '.png'
            ], " `key` = 'favicon' ");
        }
    }
    

    if (check_img('cursor_default') == true) {
        if ($LOCNGUYEN_SIEUTHICODE->site('status_imgur') == 1) {
            $image_source = file_get_contents($_FILES['cursor_default']['tmp_name']);
            $client_id = $LOCNGUYEN_SIEUTHICODE->site('client_id_imgur');
            $response = upload_imgur($client_id, $image_source);
            $responseArr = json_decode($response);
            $url_image = $responseArr->data->link;
            $LOCNGUYEN_SIEUTHICODE->update('options', [
                'value'  => $url_image
            ], " `key` = 'cursor_default' ");
        } else {
            $rand = random('0123456789QWERTYUIOPASDGHJKLZXCVBNM', 4);
            $uploads_dir_image = 'upload/theme/btn_' . $rand . '.png';
            $uploads_dir_image2 = './upload/theme/btn_' . $rand . '.png';
            $tmp_name = $_FILES['cursor_default']['tmp_name'];
            $addlogo = move_uploaded_file($tmp_name, $uploads_dir_image2);
            if ($addlogo) {
                $LOCNGUYEN_SIEUTHICODE->update('options', [
                    'value'  => $uploads_dir_image
                ], " `key` = 'cursor_default' ");
            }
        }
    }

    if (check_img('cursor_hover') == true) {
        if ($LOCNGUYEN_SIEUTHICODE->site('status_imgur') == 1) {
            $image_source = file_get_contents($_FILES['cursor_hover']['tmp_name']);
            $client_id = $LOCNGUYEN_SIEUTHICODE->site('client_id_imgur');
            $response = upload_imgur($client_id, $image_source);
            $responseArr = json_decode($response);
            $url_image = $responseArr->data->link;
            $LOCNGUYEN_SIEUTHICODE->update('options', [
                'value'  => $url_image
            ], " `key` = 'cursor_hover' ");
        } else {
            $rand = random('0123456789QWERTYUIOPASDGHJKLZXCVBNM', 4);
            $uploads_dir_image = 'upload/theme/btn_' . $rand . '.png';
            $uploads_dir_image2 = './upload/theme/btn_' . $rand . '.png';
            $tmp_name = $_FILES['cursor_hover']['tmp_name'];
            $addlogo = move_uploaded_file($tmp_name, $uploads_dir_image2);
            if ($addlogo) {
                $LOCNGUYEN_SIEUTHICODE->update('options', [
                    'value'  => $uploads_dir_image
                ], " `key` = 'cursor_hover' ");
            }
        }
    }


    die('<script type="text/javascript">if(!alert("Lưu thành công !")){window.history.back().location.reload();}</script>');
} ?>

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <form action="" method="POST" enctype="multipart/form-data">

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label for="matkhau">Logo website:</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" type="file" name="logo_light" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <img width="300px" src="<?= $LOCNGUYEN_SIEUTHICODE->site('logo') ?>" />
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label for="matkhau">Favicon:</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" name="favicon" type="file" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <img width="100px" src="<?= $LOCNGUYEN_SIEUTHICODE->site('favicon') ?>" />
                                    </div>
                                </div>
                               
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label for="matkhau">Con trỏ thường:</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" name="cursor_default" type="file" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <img width="50px" src="<?= $LOCNGUYEN_SIEUTHICODE->site('cursor_default') ?>" />
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label for="matkhau">Con trỏ hover:</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" name="cursor_hover" type="file" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <img width="50px" src="<?= $LOCNGUYEN_SIEUTHICODE->site('cursor_hover') ?>" />
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label for="matkhau">Banner:</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" name="banner" type="file" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <img width="200px" src="<?= $LOCNGUYEN_SIEUTHICODE->site('banner') ?>" />
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label for="matkhau">Footer:</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" name="footer" type="file" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <img width="200px" src="<?= $LOCNGUYEN_SIEUTHICODE->site('footer') ?>" />
                                    </div>
                                </div>

                                <button type="submit" name="SaveSettings" class="btn btn-primary">LƯU NGAY</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>