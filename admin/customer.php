<?php include './inc/header.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../classes/customer.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
$cs = new Customer();
if (!isset($_GET['customerid']) || $_GET['customerid'] == NULL) {
    echo "<script> window.location = 'inbox.php' </script>";
} else {
    $id_customer = $_GET['customerid']; // Lấy catid trên host

}


?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Thông tin khách hàng</h2>
        </div>
       
        <div class="card-body">

            <?php
            $get_customer = $cs->show_customer($id_customer);
            if ($get_customer) {
                while ($result = $get_customer->fetch_assoc()) {


            ?>
            <form action="" method="POST" enctype="multipart/form-dazta">

                <div class="form-group">
                    <label for="">Tên khách hàng</label>
                    <input readonly="readonly" type="text" name="name" class="form-control" required
                        value="<?php echo $result['name'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Địa chỉ</label>
                    <input readonly="readonly" type="text" name="address" class="form-control" required
                        value="<?php echo $result['address'] ?>, <?php echo $result['city'] ?>, <?php echo $result['country'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Zipcode</label>
                    <input readonly="readonly" type="text" name="zipcode" class="form-control" required
                        value="<?php echo $result['zipcode'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input readonly="readonly" type="text" name="phone" class="form-control" required
                        value="<?php echo $result['phone'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input readonly="readonly" type="text" name="email" class="form-control" required
                        value="<?php echo $result['email'] ?>">
                </div>
            </form>

            <?php
                }
            }

            ?>
        </div>

    </div>

</div>
<?php include './inc/footer.php'; ?>