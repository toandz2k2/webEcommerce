<?php
include_once('lib/database.php');
include_once('helpers/format.php');

spl_autoload_register(function ($className) {
    include_once "classes/" . $className . ".php";
});

$db = new Database();
$fm = new Format();
$cat = new category();
$cart = new cart();
$user = new Users();
$product = new Product();
$brand= new Brand(); 
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <div class="algintd" style="padding:5px">
                        <h2>Danh Mục</h2>
                    </div>
                    <div class="panel-group category-products" id="accordian">
                        <?php
                        $get_cat_new = $cat->get_cat_new();
                        if ($get_cat_new) {
                            while ($result = $get_cat_new->fetch_assoc()) {
                        ?>

                        <!--category-productsr-->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="productbycat.php?catid=<?php echo $result['id_cat'] ?>"><?php echo $result['name_cat'] ?></a></h4>
                            </div>
                        </div>

                        <?php
                            }
                        }
                        ?>
                    </div>
                    <!--/category-products-->

                    <div class="brands_products">
                        <!--brands_products-->
                        <h2>Thương Hiệu</h2>
                        <div class="brands-name">
                        <?php
                        $get_brand_new = $brand->get_brand_new();
                        if ($get_brand_new) {
                            while ($result = $get_brand_new->fetch_assoc()) {
                        ?>
                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="productbybrand.php?brandid=<?php echo $result['id_brand'] ?>"><?php echo $result['name_brand'] ?></a>
                                </li>

                            </ul>
                            <?php
                            }}
                            ?>
                        </div>
                    </div>
                    <!--/brands_products-->

                    <div class="price-range">
                        <!--price-range-->
                        <h2>Phạm Vi Giá</h2>
                        <div class="well text-center">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="10000000"
                                data-slider-step="5" data-slider-value="[0,10000000]" id="sl2" /><br />
                            <b class="pull-left">0 VNĐ</b> <b class="pull-right">10.000.000 VNĐ</b>
                        </div>
                    </div>
                    <!--/price-range-->

                    <div class="shipping text-center">
                        <!--shipping-->
                        <img src="./images/home/shipping.jpg" alt="" />
                    </div>
                    <!--/shipping-->
                </div>
            </div>