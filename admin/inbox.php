<?php
include_once('./inc/header.php');
include('../classes/category.php');
include('../classes/product.php');
include('../classes/brand.php');
include_once('../helpers/format.php');
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
$fm = new Format();
$cart = new Cart();
if (isset($_GET['shiftid'])) {
    $id = $_GET['shiftid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $shiftid = $cart->shiftid($id, $time, $price);
   
}
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $del_shiftid = $cart->del_shiftid($id, $time, $price);
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Danh sách đơn hàng</h2>
        </div>
        <div class="card-body">
            <?php
            if (isset($shiftid)) {
                echo $shiftid;
            }
            ?>
            <?php
            if (isset($del_shiftid)) {
                echo $del_shiftid;
            }
            ?>
            <form action="productlist.php" method="POST">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th class="bg-dark border border-dark">STT</th>
                                <th class="bg-dark border border-dark">Tên SP</th>
                                <th class="bg-dark border border-dark">Tên Khách Hàng</th>
                                <th class="bg-dark border border-dark">Số Lượng</th>
                                <th class="bg-dark border border-dark">Đơn Giá</th>
                                <th class="bg-dark border border-dark">Ảnh</th>
                                <th class="bg-dark border border-dark">Ngày mua</th>
                                <th class="bg-dark border border-dark">Địa Chỉ</th>
                                <th class="bg-dark border border-dark">Tình trạng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cart = new Cart();
                            $get_inbox_cart = $cart->get_inbox_cart();
                            if ($get_inbox_cart) {
                                $stt = 0;
                                while ($result = $get_inbox_cart->fetch_assoc()) {
                                    $stt++;
                            ?>
                                    <tr>
                                        <td><?php echo $stt; ?></td>
                                        <td><?php echo $result['name_product'] ?></td>
                                        <td><?php echo $result['name'] ?> </td>
                                        <td><?php echo $result['quantity'] ?></td>
                                        <td><?php echo $result['price'] ?></td>
                                        <td><img src="uploadss/<?php echo $result['image'] ?>" width="80px"> </td>
                                        <td><?php echo $fm->formatDate($result['date']) ?></td>
                                        <td><a href="customer.php?customerid=<?php echo $result['id_customer'] ?>">Xem Thêm</a></td>
                                        <td>
                                            <?php
                                            if ($result['status'] == 0) {
                                            ?>
                                                <a href="?shiftid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date'] ?>">Đang xử lý</a>
                                            <?php
                                            }elseif($result['status'] == 1){
                                                ?>
                                                    <a href="?shiftid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date'] ?>" style="color: #fd980e;">Đã xử lý</a>
                                                <?php
                                            }else {
                                            ?>
                                                <a href="?delid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date'] ?>" style="color: #fd980e;">Xoá</a>
                                            <?php
                                            }
                                            ?>
                                        </td>


                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <?php include './inc/footer.php'; ?>
    <script>
        function deleteProduct(name_product) {
            return confirm('Bạn có chắc muốn xóa sản phẩm: ' + name_product + ' này?');
        }
    </script>