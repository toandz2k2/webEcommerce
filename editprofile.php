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
$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    $update_customer = $cs->update_customer($_POST, $id); // hàm check khi submit lên
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
                    <form action="" method="post">
                        <div class="row mt-3">
                            <?php
                            if(isset($update_customer)){
                                echo $update_customer;
                            }
                            ?>
                            <?php
                            $id = Session::get('customer_id');
                            $get_custommer = $cs->show_customer($id);
                            if ($get_custommer) {
                                while ($result = $get_custommer->fetch_assoc()) {
                            ?>
                                    <div class="col-md-12"><label class="labels">Tên tài khoản</label><input type="text" class="form-control" value="<?php echo $result['name'] ?>"></div>
                                    <div class="col-md-12"><label class="labels">Địa chỉ</label><input type="text" class="form-control" value="<?php echo $result['address'] ?>"></div>
                                    <div class="col-md-12"><label class="labels">Thành Phố</label><input type="text" class="form-control" value="<?php echo $result['city'] ?>"></div>
                                    <div class="col-md-12"><label class="labels">Nước</label><input type="text" class="form-control" value="<?php echo $result['country'] ?>"></div>
                                    <div class="col-md-12"><label class="labels">Zipcode</label><input type="text" class="form-control" value="<?php echo $result['zipcode'] ?>"></div>
                                    <div class="col-md-12"><label class="labels">Số điện thoại</label><input type="text" class="form-control" value="<?php echo $result['phone'] ?>"></div>
                                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" value="<?php echo $result['email'] ?>"></div>
                                    <a href="editprofile.php">
                                        <div class="mt-5 text-center"><input type="text" class="btn btn-primary profile-button" name="save" value="Cập Nhật"></div>
                                    </a>
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