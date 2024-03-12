<?php
require('inc/header.php');
?>
<?php
require('inc/sliderleft.php');
?>
<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script> window.location = '404.php' </script>";
} else {
    $catid = $_GET['catid']; // Lấy catid trên host

}
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
//     $name_cat = $_POST['name_cat'];
//     $update_cat = $cat->update_category($name_cat, $id_cat); // hàm check catName khi submit lên
// }

?>
<div class="col-sm-9 padding-right">
    <div class="features_items">
        <!--features_items-->
        <div class="algintd" style="padding:5px">
            <h2 class="title text-center">Sản Phẩm</h2>
        </div>
        <?php
        $product_by_cat = $cat->get_product_by_cat($catid);
        if ($product_by_cat) {
            while ($result = $product_by_cat->fetch_assoc()) {
        ?>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="details.php?proid=<?php echo $result['id_product'] ?>"><img src="admin/uploadss/<?php echo $result['image'] ?>" alt="" /></a>
                                <h2><?php echo $fm->format_currency($result['price']) . " VNĐ" ?></h2>
                                <p><?php echo $result['name_product'] ?></p>
                                <a href="details.php?proid=<?php echo $result['id_product']?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
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

    </div>
    <!--features_items-->
</div>
</div>
</div>
</section>
<?php
require('inc/footer.php');
?>