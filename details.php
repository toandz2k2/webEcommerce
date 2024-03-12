<?php
require('inc/header.php');
require('inc/sliderleft.php');

?>
<?php
if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
    echo "<script> window.location = '404.php' </script>";
} else {
    $proid = $_GET['proid']; // Lấy id_product trên host

}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $login_check = Session::get('customer_login');
    if ($login_check == false) {
        header('Location:login.php');
    } else {
        $quantity = $_POST['quantity'];
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $add_to_cart = $cart->add_to_cart($quantity, $proid); // hàm check khi submit lên
    }
}
?>
<div class="col-sm-9 padding-right">

    <div class="product-details">
        <?php
        $get_product_details = $product->get_product_details($proid);
        if ($get_product_details) {
            while ($result_details = $get_product_details->fetch_assoc()) {
        ?>
                <!--product-details-->
                <div class="col-sm-5">
                    <div class="view-product">
                        <a href=""><img style="border-color:var(--bg-primary);" src="admin/uploadss/<?php echo $result_details['image'] ?>" alt="" /></a>
                        
                    </div>
                </div>

                <div class="col-sm-7">
                    <div class="product-information">
                        <!--/product-information-->
                        <a href=""><img src="images/product-details/new.jpg" class="newarrival" alt="" /></a>
                        <h2><?php echo $result_details['name_product'] ?></h2>
                        <img src="images/product-details/rating.png" alt="" />
                        <div class="form_detail">
                            <span style="color: var(--bg-primary);font-size: 30px;"><?php echo $fm->format_currency($result_details['price'])." VNĐ" ?></span>
                            <form action="" method="POST">
                                <label>Số lượng: </label>
                                <input style="border: 1px solid #dededc;color: #696763;font-family: 'Roboto', sans-serif; font-size: 20px; font-weight: 700; height: 33px; outline: medium none; text-align: center; width: 50px;" type="text" name="quantity" value="1" min="1" />
                                <input type="submit" class="btn btn-fefault cart" name="submit" value="Thêm vào giỏ">

                            </form>
                            <?php
                            if (isset($add_to_cart)) {
                                echo "<span style='color:var(--bg-primary);'> Sản phẩm này đã có trong giỏ hàng</span>";
                            }
                            ?>
                        </div>
                        <p><b>Tình trạng:</b> Còn hàng</p>
                        <p><b>Sản phẩm:</b> <?php
                                            if ($result_details['type'] == 0) {
                                                echo "Mới";
                                            } elseif ($result_details['type'] == 1) {
                                                echo "Nổi bật";
                                            } elseif ($result_details['type'] == 2) {
                                                echo "Yêu thích";
                                            } else {
                                                echo "Thường";
                                            }
                                            ?>
                        </p>
                        <p><b>Thương hiệu: </b><?php echo $result_details['name_brand'] ?></p>
                        <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
                    </div>
                    <!--/product-information-->
                </div>
        <?php
            }
        }
        ?>
    </div>


    <!--/product-details-->

    <div class="category-tab shop-details-tab">
        <!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#details" data-toggle="tab">Chi tiết sản phẩm</a></li>
                <li><a href="#reviews" data-toggle="tab">Nhận xét</a></li>
            </ul>
        </div>
        <div class="tab-content">

            <?php
            $get_product_details = $product->get_product_details($proid);
            if ($get_product_details) {
                while ($result_details = $get_product_details->fetch_assoc()) {
            ?>
                    <div class="tab-pane fade active in" id="details">
                        <p><?php echo $result_details['desc_product'] ?></p>
                    </div>
            <?php
                }
            }
            ?>
            <div class="tab-pane fade" id="reviews">
                <div class="col-sm-12">
                    <ul>
                        <li><a href=""><i class="fa fa-user"></i>Thanh Trúc</a></li>
                        <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                        <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                    </ul>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <p><b>Write Your Review</b></p>

                    <form action="#">
                        <span>
                            <input type="text" placeholder="Tên của bạn" />
                            <input type="email" placeholder="Email của bạn" />
                        </span>
                        <textarea name=""></textarea>
                        <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                        <button type="button" class="btn btn-default pull-right">
                            Gửi bình luận
                        </button>
                    </form>
                </div>
            </div>


        </div>
    </div>
    <!--/category-tab-->

    <div class="recommended_items">
        <!--recommended_items-->
        <div class="aligntd" style="padding: 5px;">
            <h2 class="title text-center">Đề Xuất</h2>
        </div>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <?php $product_recoment = $product->getproduct_recoment();
                    if ($product_recoment) {
                        while ($result = $product_recoment->fetch_assoc()) {
                    ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="details.php?proid=<?php echo $result['id_product'] ?>"><img src="admin/uploadss/<?php echo $result['image'] ?>" alt="" /></a>
                                            <h2><?php echo $fm->format_currency($result['price'])." VNĐ" ?></h2>
                                            <p><?php echo $result['name_product'] ?></p>
                                            <a href="cart.php?cartid=<?php echo $result['id_product'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào
                                                giỏ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } ?>
                </div>
                <div class="item">
                    <?php $product_recoment = $product->getproduct_recoment();
                    if ($product_recoment) {
                        while ($result = $product_recoment->fetch_assoc()) {
                    ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="details.php?proid=<?php echo $result['id_product'] ?>"><img src="admin/uploadss/<?php echo $result['image'] ?>" alt="" /></a>
                                            <h2><?php echo $fm->format_currency($result['price'])." VNĐ"?></h2>
                                            <p><?php echo $result['name_product'] ?></p>
                                            <a href="cart.php?cartid=<?php echo $result['id_product'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào
                                                giỏ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } ?>
                </div>
            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    <!--/recommended_items-->

</div>
</div>
</div>
</section>
<?php
require('inc/footer.php');
?>