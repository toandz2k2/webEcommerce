<?php
include 'inc/header.php'; ?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/product.php';  ?>
<?php include '../classes/brand.php';  ?>
<?php

// gọi class product
$product = new Product();
if (!isset($_GET['id_product']) || $_GET['id_product'] == NULL) {
    echo "<script> window.location = 'productlist.php' </script>";
} else {
    $id_product = $_GET['id_product']; // Lấy id_product trên host

}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $update_product = $product->update_product($_POST, $_FILES, $id_product); // hàm check khi submit lên
}
?>
<div class="giay">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <?php
        if (isset($update_product)) {
            echo $update_product;
        }
        ?>
        <div class="block">
            <?php
            $get_product_by_id = $product->getproductbyid($id_product);
            if ($get_product_by_id) {
                while ($result_product = $get_product_by_id->fetch_assoc()) {

            ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table class="form">
                            <div class="form-group" style="padding: 0 200px 0 30px;">
                                <label for="">Tên sản phẩm</label>
                                <input type="text" name="name_product" class="form-control" value="<?php echo $result_product['name_product'] ?>">
                            </div>

                            <div class="form-group" style="padding: 0 200px 0 30px;">
                                <label for="">Số lượng sản phẩm</label>
                                <input type="text" name="quantity_product" class="form-control" value="<?php echo $result_product['quantity_product'] ?>">
                            </div>
                            <div class="form-group" style="padding: 0 200px 0 30px;">
                                <label for="">Danh mục sản phẩm</label>
                                <select class="form-control" name="category">
                                    <option>Chọn danh mục</option>
                                    <?php
                                    $cat = new Category();
                                    $catlist = $cat->show_category();
                                    if ($catlist) {
                                        while ($result = $catlist->fetch_assoc()) {

                                    ?>
                                            <option <?php
                                                    if ($result['id_cat'] == $result_product['id_cat']) {
                                                        echo "selected";
                                                    }
                                                    ?> value=" <?php echo $result['id_cat'] ?> ">
                                                <?php echo $result['name_cat'] ?>
                                            </option>

                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" style="padding: 0 200px 0 30px;">
                                <label for="">Danh mục thương hiệu</label>
                                <select class="form-control" name="brand">
                                    <option>Chọn thương hiệu</option>
                                    <?php
                                    $brand = new Brand();
                                    $brandlist = $brand->show_brand();
                                    if ($brandlist) {
                                        while ($result = $brandlist->fetch_assoc()) {

                                    ?>
                                            <option <?php
                                                    if ($result['id_brand'] == $result_product['id_brand']) {
                                                        echo "selected";
                                                    }
                                                    ?> value=" <?php echo $result['id_brand'] ?> ">
                                                <?php echo $result['name_brand'] ?>
                                            </option>

                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" style="padding: 0 200px 0 30px;">
                                <label for="">Mô tả</label>
                                <textarea name="desc_product" class="form-control"><?php echo $result_product['desc_product'] ?></textarea>
                            </div>
                            <div class="form-group" style="padding: 0 200px 0 30px;">
                                <label for="">Loại sản phẩm</label>
                                <select class="form-control" name="type">
                                    <option>Chọn</option>
                                    <?php
                                    if ($result_product['type'] == 0) {
                                    ?>
                                        <option selected value="0">Mới</option>
                                        <option value="1">Nổi bật</option>
                                        <option value="2">Yêu thích</option>
                                        <option value="3">Thường</option>
                                    <?php
                                    } elseif ($result_product['type'] == 1) {
                                    ?>
                                        <option value="0">Mới</option>
                                        <option selected value="1">Nổi bật</option>
                                        <option value="2">Yêu thích</option>
                                        <option value="3">Thường</option>
                                    <?php
                                    } elseif ($result_product['type'] == 2) {
                                    ?>
                                        <option value="0">Mới</option>
                                        <option value="1">Nổi bật</option>
                                        <option selected value="2">Yêu thích</option>
                                        <option value="3">Thường</option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="0">Mới</option>
                                        <option value="1">Nổi bật</option>
                                        <option value="2">Yêu thích</option>
                                        <option selected value="3">Thường</option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" style="padding: 0 200px 0 30px;">
                                <label for="">Giá</label>
                                <input type="text" name="price" class="form-control" value="<?php echo $result_product['price'] ?>">
                            </div>
                            <div class="form-group" style="padding: 0 200px 0 30px;">
                                <label for="">Tải ảnh</label>
                                <img src="uploadss/<?php echo $result_product['image'] ?>" width="80px">
                                <input name="image" type="file" />
                            </div>

                            <div class="form-froup" style="padding: 0 200px 0 400px;">
                                <button type="submit" class="btn btn-dark" name="submit">Cập nhật</button>
                            </div>
                        </table>
                    </form>
            <?php
                }
            } ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->

<script src="https://cdn.tiny.cloud/1/4j3bcxxi46597f39xhjamjcfo93itvsj8ciu8e4u7t6hd56v/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>