<?php include './inc/header.php'; ?>
<?php include '../classes/category.php';  ?>
<?php
// gọi class category
$cat = new Category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $name_cat = $_POST['name_cat'];
    $insert_cat = $cat->insert_category($name_cat); // hàm check catName khi submit lên
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Thêm danh mục</h2>
        </div>
        <?php
            if (isset($insert_cat)) {
                echo $insert_cat;
            }
            ?>
        <div class="card-body">
            <form action="catadd.php" method="POST" enctype="multipart/form-dazta">

                <div class="form-group">
                    <label for="">Tên danh mục</label>
                    <input type="text" name="name_cat" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-dark" name="submit">Thêm danh mục</button>
            </form>
        </div>
    </div>

</div>
<?php include './inc/footer.php'; ?>