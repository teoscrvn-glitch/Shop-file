<div class="container mt20" style="margin-top: 80px;">
    <div class="box-home all">
        <section class="login">
            <div class="container">
                <div class="content-login">
                    <h3>ĐẶT LẠI MẬT KHẨU</h3>
                    <div class="login-child">
                        <form class="mt-4" id="reset_sieuthicode">
                            <input type="email" name="email" placeholder="Địa chỉ email của bạn">
                            <input type="number" name="otp" placeholder="OTP">
                            <input type="password" name="pass" placeholder="Mật khẩu mới">
                            <input type="password" name="repass" placeholder="Nhập lại mật khẩu">
                            <?php if ($LOCNGUYEN_SIEUTHICODE->site('status_captcha') == 1) : ?>
                                <center>
                                    <div class="g-recaptcha" data-sitekey="<?= $LOCNGUYEN_SIEUTHICODE->site('site_key') ?>"></div>
                                </center>
                            <?php endif ?>
                            <button class="btn btn-create" type="submit">XÁC NHẬN KHÔI PHỤC</button>
                        </form>
                        <button class="btn btn-danger" onclick="location.href='index.php?action=login'">ĐĂNG NHẬP</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="dist/js/sieuthicode.js?v=<?= time() ?>"></script>