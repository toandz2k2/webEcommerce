<?php
require('inc/header.php');
?>
<?php
if (isset($_GET['id_order'])) {
    $id_order = $_GET['id_order']; // Lấy delid trên host
    $del_cart = $cart->del_order_cart($id_order);
}

?>
<?php
$fm = new Format();
$cart = new Cart();
if (isset($_GET['confirmid'])) {
    $id = $_GET['confirmid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $shiftid_confirmid = $cart->shiftid_confirmid($id, $time, $price);
}
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Thanh toán</li>
            </ol>
        </div>
        <!--/breadcrums-->
        <?php
        if (isset($del_cart)) {
            echo $del_cart;
        }
        ?>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">

                <thead>
                    <tr class="cart_menu">
                        <td>STT</td>
                        <td class="image">Ảnh</td>
                        <td class="name_product">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="date">Ngày mua</td>
                        <td class="total">Tổng thanh toán</td>
                        <td class="status">Tình trạng</td>
                        <td>Xoá</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $id_customer = Session::get('id_customer');
                    $get_cart_order = $cart->get_cart_order($id_customer);
                    if ($get_cart_order) {
                        $i = 0;
                        $subtotal = 0;
                        while ($result = $get_cart_order->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td>
                                    <img src="admin/uploadss/<?php echo $result['image'] ?>" style="height:80px ;" alt="">
                                </td>
                                <td class="cart_description">
                                    <h4><a href=""><?php echo $result['name_product'] ?></a></h4>
                                    <p>Web ID: <?php echo $result['id'] ?></p>
                                </td>
                                <td class="cart_price">
                                    <p><?php echo $fm->format_currency($result['price']) . " VNĐ" ?></p>
                                </td>
                                <td class="cart_quantity">
                                    <?php echo $result['quantity'] ?>

                                </td>
                                <td> <?php echo $fm->formatDate($result['date']) ?></td>
                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        <?php
                                        $total = $result['price'] * $result['quantity'];
                                        echo $fm->format_currency($total) . " VNĐ";
                                        ?>
                                    </p>
                                </td>
                                <td>
                                    <?php
                                    if ($result['status'] == 0) {
                                        echo "Đang xử lý";
                                    } elseif ($result['status'] == 1) {
                                    ?>
                                        <a href="?confirmid=<?php echo $id_customer ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date'] ?>" style="color: var(--bg-primary);">Đã xử lý</a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="?confirmid=<?php echo $id_customer ?>&price=<?php echo $fm->format_currency($result['price']) . " VNĐ"; ?>&time=<?php echo $result['date'] ?>" style="color: var(--bg-primary);">Đã nhận</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <?php
                                if ($result['status'] == '0') {
                                ?>
                                    <td><?php echo 'N/A' ?></td>
                                <?php
                                } elseif ($result['status'] == '1') {
                                ?>
                                    <td><?php echo 'N/A' ?></td>
                                <?php
                                } else {
                                ?>
                                    <td class="cart_delete">
                                    <div style="padding-top:25px;"><a onclick="return deleteProduct('<?php echo $result['name_product'] ?>')" class="cart_quantity_delete" href="?id_cart=<?php echo $result['id_cart'] ?>"><i class="fa fa-times"></i></a></div>
                                    </td>
                                <?php
                                }
                                ?>

                            </tr>
                    <?php

                        }
                    }

                    ?>


                </tbody>
            </table>
        </div>

    </div>
</section>
<script>
    function deleteProduct(name_product) {
        return confirm('Bạn có chắc muốn xóa sản phẩm: ' + name_product + ' này?');
    }
</script>
<!--/#cart_items-->
<?php
require('inc/footer.php');
?>