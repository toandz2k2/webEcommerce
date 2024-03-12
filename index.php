<?php
require('inc/header.php');
require('inc/slider.php');
require_once('inc/sliderleft.php');
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $add_to_cart = $cart->add_to_cart($quantity, $proid); // hàm check khi submit lên
}
?>
<div class="col-sm-9 padding-right">
    <div class="features_items">
        <!--features_items-->
        <div class="algintd" style="padding:5px">
            <h2 class="title text-center">Sản Phẩm</h2>
        </div>

        <?php
        $product_feathere3 = $product->getproduct_feathered3();
        if ($product_feathere3) {
            while ($result = $product_feathere3->fetch_assoc()) {
        ?>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="details.php?proid=<?php echo $result['id_product'] ?>"><img style="height: 230px;" src="admin/uploadss/<?php echo $result['image'] ?>" alt="" /></a>
                                <h2><?php echo $fm->format_currency($result['price']) . " VNĐ" ?></h2>
                                <p><?php echo $result['name_product'] ?></p>
                                <form action=" " method="POST">
                                    <a href="details.php?proid=<?php echo $result['id_product'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                                </form>

                            </div>

                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li>
                                    <a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-plus-square"></i>So sánh</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
    <!--features_items-->


    <div class="category-tab">
        <!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#new" data-toggle="tab">Mới</a>
                </li>
                <li><a href="#outstand" data-toggle="tab">Nổi bật</a></li>
                <li><a href="#favourite" data-toggle="tab">Yêu thích</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="new">
                <?php $product_feathere = $product->getproduct_feathered();
                if ($product_feathere) {
                    while ($result = $product_feathere->fetch_assoc()) {
                ?>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="details.php?proid=<?php echo $result['id_product'] ?>"><img src="admin/uploadss/<?php echo $result['image'] ?>" alt="" /></a>
                                        <h2 style="font-size: 20px !important;"><?php echo $fm->format_currency($result['price']) . " VNĐ" ?></h2>
                                        <p><?php echo $result['name_product'] ?></p>
                                        <a href="details.php?proid=<?php echo $result['id_product'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào
                                            giỏ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } ?>
            </div>

            <div class="tab-pane fade" id="outstand">
                <?php $product_feathere1 = $product->getproduct_feathered1();
                if ($product_feathere1) {
                    while ($result = $product_feathere1->fetch_assoc()) {
                ?>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="details.php?proid=<?php echo $result['id_product'] ?>"><img src="admin/uploadss/<?php echo $result['image'] ?>" alt="" /></a>
                                        <h2 style="font-size: 20px !important;"><?php echo $fm->format_currency($result['price']) . " VNĐ" ?></h2>
                                        <p><?php echo $result['name_product'] ?></p>
                                        <a href="details.php?proid=<?php echo $result['id_product'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào
                                            giỏ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } ?>
            </div>

            <div class="tab-pane fade" id="favourite">
                <?php $product_feathere2 = $product->getproduct_feathered2();
                if ($product_feathere2) {
                    while ($result = $product_feathere2->fetch_assoc()) {
                ?>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="details.php?proid=<?php echo $result['id_product'] ?>"><img  src="admin/uploadss/<?php echo $result['image'] ?>" alt="" /></a>
                                        <h2 style="font-size: 20px !important;"><?php echo $fm->format_currency($result['price']) . " VNĐ" ?></h2>
                                        <p><?php echo $result['name_product'] ?></p>
                                        <a href="details.php?proid=<?php echo $result['id_product'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào
                                            giỏ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                }
                ?>
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
                                            <a href="details.php?proid=<?php echo $result['id_product'] ?>"><img style="height: 230px;" src="admin/uploadss/<?php echo $result['image'] ?>" alt="" /></a>
                                            <h2><?php echo $fm->format_currency($result['price']) . " VNĐ" ?></h2>
                                            <p><?php echo $result['name_product'] ?></p>
                                            <a href="details.php?proid=<?php echo $result['id_product'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào
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
                                            <a href="details.php?proid=<?php echo $result['id_product'] ?>"><img style="height: 230px;" src="admin/uploadss/<?php echo $result['image'] ?>" alt="" /></a>
                                            <h2><?php echo $fm->format_currency($result['price']) . " VNĐ" ?></h2>
                                            <p><?php echo $result['name_product'] ?></p>
                                            <a href="details.php?proid=<?php echo $result['id_product'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào
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