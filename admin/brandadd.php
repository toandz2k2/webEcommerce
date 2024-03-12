<?php include './inc/header.php'; ?>
<?php include '../classes/brand.php';  ?>
<?php
// gọi class category
$brand = new Brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $name_brand = $_POST['name_brand'];
    $insert_brand = $brand->insert_brand($name_brand); // hàm check catName khi submit lên
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Thêm thương hiệu</h2>
        </div>
        <?php
            if (isset($insert_brand)) {
                echo $insert_brand;
            }
            ?>
        <div class="card-body">
            <form action="brandadd.php" method="POST" enctype="multipart/form-dazta">

                <div class="form-group">
                    <label for="">Tên thương hiệu</label>
                    <input type="text" name="name_brand" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-dark" name="submit">Thêm thương hiệu</button>
            </form>
        </div>
    </div>

</div>
<?php include './inc/footer.php'; ?>