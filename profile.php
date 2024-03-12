<?php
require('inc/header.php');
require('inc/sliderleft.php');

?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>
<?php

$id_customer = Session::get('id_customer');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    $update_customer = $cs->update_customer($_POST, $id_customer); // hàm check khi submit lên
}
?>
<div class="col-sm-9 padding-right">
    <div class="algintd" style="padding:5px">
        <h2 class="title text-center">Thông tin tài khoản</h2>
    </div>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <form action="" method="POST">
                        <div class="row mt-3">
                            <?php
                            if (isset($update_customer)) {
                                echo $update_customer;
                            }
                            ?>
                            <?php
                            $id_customer = Session::get('id_customer');
                            $get_custommer = $cs->show_customer($id_customer);
                            if ($get_custommer) {
                                while ($result = $get_custommer->fetch_assoc()) {
                            ?>
                                    <div class="col-md-12"><label class="labels">Tên tài khoản</label><input type="text" name="name" class="form-control" value="<?php echo $result['name'] ?>"></div>
                                    <div class="col-md-12"><label class="labels">Địa chỉ</label><input type="text" name="address" class="form-control" value="<?php echo $result['address'] ?>"></div>
                                    <div class="col-md-12"><label class="labels">Thành Phố</label><input type="text" name="city" class="form-control" value="<?php echo $result['city'] ?>"></div>
                                    <div class="col-md-12"><label class="labels">Nước</label><input type="text" name="country" class="form-control" value="<?php echo $result['country'] ?>"></div>
                                    <div class="col-md-12"><label class="labels">Zipcode</label><input type="text" name="zipcode" class="form-control" value="<?php echo $result['zipcode'] ?>"></div>
                                    <div class="col-md-12"><label class="labels">Số điện thoại</label><input type="text" name="phone" class="form-control" value="<?php echo $result['phone'] ?>"></div>
                                    <div class="col-md-12"><label class="labels">Email</label><input type="text" name="email" class="form-control" value="<?php echo $result['email'] ?>"></div>
                                    <div class="mt-5 text-center"><input type="submit" class="btn btn-primary profile-button" name="save" value="Cập Nhật"></div>
                            <?php
                                }
                            }
                            ?>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</div>
</div>
</div>
</section>
<?php
require('inc/footer.php');
?>