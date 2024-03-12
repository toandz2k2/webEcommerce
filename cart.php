<?php
require('inc/header.php');
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>
<?php
if (isset($_GET['id_cart'])) {
    $id_cart = $_GET['id_cart']; // Lấy delid trên host
    $del_cart = $cart->del_product_cart($id_cart);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id_cart = $_POST['id_cart'];
    $quantity = $_POST['quantity'];
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $update_quantity_cart = $cart->update_quantity_cart($quantity, $id_cart); // hàm check khi submit lên
    if ($quantity <= 0) {
        $del_cart = $cart->del_product_cart($id_cart);
    }
}
?>
<?php
if (!isset($_GET['id'])) {
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
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
        if (isset($update_quantity_cart)) {
            echo $update_quantity_cart;
        }
        ?>
        <?php
        if (isset($del_cart)) {
            echo $del_cart;
        }
        ?>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">

                <thead>
                    <tr class="cart_menu">
                        <td class="image">Ảnh</td>
                        <td class="name_product">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng thanh toán</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_product_cart = $cart->get_product_cart();
                    if ($get_product_cart) {
                        $subtotal = 0;
                        while ($result = $get_product_cart->fetch_assoc()) {
                    ?>
                            <tr>
                                <td class="">
                                    <a href=""><img src="admin/uploadss/<?php echo $result['image'] ?>" style="height:80px ;" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href=""><?php echo $result['name_product'] ?></a></h4>
                                    <p>Web ID: <?php echo $result['id_cart'] ?></p>
                                </td>
                                <td class="cart_price">
                                    <p><?php echo $fm->format_currency($result['price'])." VNĐ" ?></p>
                                </td>
                                <td class="cart_quantity">
                                    <form action="" method="post">
                                        <div class="cart_quantity_button">
                                            <input class="cart_quantity_input" type="hidden" name="id_cart" value="<?php echo $result['id_cart'] ?>" style="width:50px" />
                                            <input class="cart_quantity_input" type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>" style="width:50px" />&ensp;
                                            <input style="background: var(--bg-primary); border-radius: 0; color: #ffffff; border: none; padding: 5px 15px;" type="submit" name="submit" value="Cập Nhật" style="height: 29px;">
                                        </div>
                                    </form>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        <?php
                                        $total = $result['price'] * $result['quantity'];
                                         echo $fm->format_currency($total)." VNĐ";
                                        ?>
                                    </p>
                                </td>
                                <td class="cart_delete">
                                    <div style="padding-top:25px;"><a onclick="return deleteProduct('<?php echo $result['name_product'] ?>')" class="cart_quantity_delete" href="?id_cart=<?php echo $result['id_cart'] ?>"><i class="fa fa-times"></i></a></div>
                                </td>
                            </tr>
                    <?php
                            $subtotal += $total;
                        }
                    }

                    ?>

                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <?php
                                $check_cart = $cart->check_cart();
                                if ($check_cart) {

                                ?>
                                    <tr>
                                        <td>Tổng thanh toán</td>
                                        <td>
                                            <?php
                                            echo $fm->format_currency($subtotal)." VNĐ";
                                            Session::set('sum', $subtotal);
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>VAT</td>
                                        <td>10%</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td>Phí ship</td>
                                        <td>Free</td>
                                    </tr>
                                    <tr>
                                        <td>Thanh toán</td>
                                        <td><span>
                                                <?php
                                                $vat = $subtotal * 0.1;
                                                $stotal = $subtotal + $vat;
                                                echo $fm->format_currency($stotal)." VNĐ";
                                                ?>
                                            </span></td>
                                    </tr>
                                <?php
                                } else {
                                    echo "<span style='color:var(--bg-primary)'>Giỏ hàng của bạn trống!</span>";
                                }
                                ?>
                            </table>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="payment-options">
            
            <div class="left">
                <a class="btn btn-default check_out" href="offlinepayment.php" style="float:right; margin-right:50px ;">Thanh toán Offline</a>
            </div>
            <div class="left">
                    <a class="btn btn-default check_out" href="onlinepayment.php" style="float:right; margin-right:50px ;">Thanh toán Online</a>
                </div>
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