<?php
require('inc/header.php');
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check) {
    header('Location:index.php');
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $insert_customer = $cs->insert_customer($_POST); // hàm check khi submit lên
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $login_customer = $cs->login_customer($_POST); // hàm check khi submit lên
}

?>
<!-- login google -->

    <section id="form" style="margin-top:60px ;">
        <!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <!--login form-->
                        <h2>Đăng nhập vào tài khoản của bạn</h2>
                        <?php
                        if (isset($login_customer)) {
                            echo $login_customer;
                        }
                        ?>
                        <form action="" method="POST">
                            <input type="email" name="email" placeholder="Tên tài khoản" />
                            <input type="password" name="password" placeholder="Mật khẩu" />
                            <span>
                                <input type="checkbox" class="checkbox">
                                Giữ cho tôi luôn đăng nhập
                            </span>
                            <button type="login" name="login" class="btn btn-default">Đăng Nhập</button>
                        </form>
                        <hr>
                        <a href="#" class="btn btn-google btn-user btn-block" style="font-size: 1.8rem; border-radius: 10rem; padding: 0.75rem 1rem; color: #fff; background-color: #ea4335; border-color: #fff;">
                            <i class="fa fa-google-plus"></i> Đăng nhập bằng Google
                        </a>
                        <a href="index.php" class="btn btn-facebook btn-user btn-block" style="font-size: 1.8rem; border-radius: 10rem; padding: 0.75rem 1rem; color: #fff; background-color: #3b5998; border-color: #fff;">
                            <i class="fa fa-facebook"></i> Đăng nhập bằng Facebook
                        </a>
                    </div>
                    <!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">Hoặc</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form">
                        <!--sign up form-->
                        <h2>Đăng kí người dùng mới</h2>
                        <?php
                        if (isset($insert_customer)) {
                            echo $insert_customer;
                        }
                        ?>
                        <form action="" method="POST">
                            <table>
                                <tr>
                                    <td>
                                        <div>
                                            <input type="text" name="name" placeholder="Tên tài khoản">
                                        </div>
                                        <div>
                                            <input type="text" name="address" placeholder="Địa chỉ">
                                        </div>
                                        <div>
                                            <input type="text" name="city" placeholder="Thành phố">
                                        </div>
                                        <div>
                                            <input type="text" name="country" placeholder="Quốc gia">
                                        </div>

                                    </td>
                                    <td>
                                        <div>
                                            <input type="text" name="zipcode" placeholder="Mã bưu chính">
                                        </div>
                                        <div>
                                            <input type="text" name="phone" placeholder="Số điện thoại">
                                        </div>
                                        <div>
                                            <input type="email" name="email" placeholder="Email" />
                                        </div>
                                        <div>
                                            <input type="password" name="password" placeholder="Mật khẩu" />
                                        </div>

                                    </td>

                                </tr>
                            </table>
                            <button type="submit" name="submit" class="btn btn-default">Đăng Kí</button>

                        </form>
                    </div>
                    <!--/sign up form-->
                </div>
            </div>
        </div>
    </section>
    <!--/form-->
    <?php
    require('inc/footer.php');
    ?>