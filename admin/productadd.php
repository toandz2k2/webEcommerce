<?php include 'inc/header.php'; ?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/product.php';  ?>
<?php include '../classes/brand.php';  ?>
<?php

// gọi class product
$product = new Product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $insert_product = $product->insert_product($_POST, $_FILES); // hàm check khi submit lên
}
?>
<div class="giay">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <?php
        if (isset($insert_product)) {
            echo $insert_product;
        }
        ?>
        <div class="block">
            <form action="productadd.php" method="POST" enctype="multipart/form-data">
                <table class="form">
                    <div class="form-group" style="padding: 0 200px 0 30px;">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" name="name_product" class="form-control" required placeholder="Nhập tên sản phẩm...">
                    </div>

                    <div class="form-group" style="padding: 0 200px 0 30px;">
                        <label for="">Số lượng sản phẩm</label>
                        <input type="text" name="quantity_product" class="form-control" required placeholder="Số lượng sản phẩm...">
                    </div>
                    <div class="form-group" style="padding: 0 200px 0 30px;">
                        <label for="">Danh mục sản phẩm</label>
                        <select class="form-control" name="category">
                            <option>Chọn danh mục</option>
                            <?php
                            $cat = new Category();
                            $brandlist = $cat->show_category();
                            if ($brandlist) {
                                while ($result = $brandlist->fetch_assoc()) {
                            ?>
                                    <option value=" <?php echo $result['id_cat'] ?> "> <?php echo $result['name_cat'] ?>
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
                                    <option value=" <?php echo $result['id_brand'] ?> "> <?php echo $result['name_brand'] ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="padding: 0 200px 0 30px;">
                        <label for="">Mô tả</label>
                        <textarea name="desc_product" class="form-control"></textarea>
                    </div>
                    <div class="form-group" style="padding: 0 200px 0 30px;">
                        <label for="">Loại sản phẩm</label>
                        <select class="form-control" name="type">
                            <option>Chọn</option>
                            <option value="0">Mới</option>
                            <option value="1">Nổi bật</option>
                            <option value="2">Yêu thích</option>
                            <option value="3">Thường</option>
                        </select>
                    </div>
                    <div class="form-group" style="padding: 0 200px 0 30px;">
                        <label for="">Giá</label>
                        <input type="text" name="price" class="form-control" required placeholder="Nhập giá sản phẩm...">
                    </div>
                    <div class="form-group" style="padding: 0 200px 0 30px;">
                        <label for="">Tải ảnh</label>
                        <input type="file" name="image" required>
                    </div>

                    <div class="form-froup" style="padding: 0 200px 0 400px;">
                        <button type="submit" class="btn btn-dark" name="submit">Thêm sản phẩm</button>
                    </div>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="https://cdn.tiny.cloud/1/4j3bcxxi46597f39xhjamjcfo93itvsj8ciu8e4u7t6hd56v/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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