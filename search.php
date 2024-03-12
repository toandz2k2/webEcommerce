<?php
require('inc/header.php');
?>
<?php
require('inc/sliderleft.php');
?>

<div class="col-sm-9 padding-right">
    <div class="features_items">
        <!--features_items-->
        <div class="algintd" style="padding:5px">
            <h2 class="title text-center">Sản Phẩm</h2>
        </div>
        <?php
        $search_product = $product->search_product($key);
        if ($search_product) {
            while ($result = $search_product->fetch_assoc()) {
        ?>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="details.php?proid=<?php echo $result['id_product'] ?>">
                                    <img style="height: 230px;" src="admin/uploadss/<?php echo $result['image'] ?>" alt="" /></a>
                                <h2><?php echo $fm->format_currency($result['price']) . " VNĐ" ?></h2>
                                <p><?php echo $result['name_product'] ?></p>
                                <a href="details.php?proid=<?php echo $result['id_product'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
                                    vào giỏ</a>
                            </div>

                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href=""><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                <li><a href=""><i class="fa fa-plus-square"></i>So sánh</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>

        <ul class="pagination">
            <?php
            $get_all_product = $product->get_all_product();
            $product_count = mysqli_num_rows($get_all_product);
            $product_button = $product_count / 6;
            $i = 1;
            for ($i = 1; $i < $product_button; $i++) {
                echo '<li class=""> <a href="search.php?trang=' . $i . '">' . $i . '</a></li>';
            }
            echo '<li><a href="">&raquo;</a></li>';
            ?>

        </ul>
    </div>
    <!--features_items-->
</div>
</div>
</div>
</section>
<?php
require('inc/footer.php');
?>