<?php include './inc/header.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php
$cat = new Brand();
if (!isset($_GET['id_brand']) || $_GET['id_brand'] == NULL) {
    echo "<script> window.location = 'brandlist.php' </script>";
} else {
    $id_brand = $_GET['id_brand']; // Lấy catid trên host

}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $name_brand = $_POST['name_brand'];
    $update_brand = $cat->update_brand($name_brand, $id_brand); // hàm check catName khi submit lên
}

?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Sửa thương hiệu</h2>
        </div>
        <?php
            if (isset($update_brand)) {
                echo $update_brand;
            }
            ?>
        <div class="card-body">

            <?php
            $get_brand_name = $cat->getcatbyid($id_brand);
            if ($get_brand_name) {
                while ($result = $get_brand_name->fetch_assoc()) {


            ?>
            <form action="" method="POST" enctype="multipart/form-dazta">

                <div class="form-group">
                    <label for="">Tên thương hiệu</label>
                    <input type="text" name="name_brand" class="form-control" required
                        value="<?php echo $result['name_brand'] ?>">
                </div>

                <button type="submit" class="btn btn-dark" name="submit">Sửa thương hiệu</button>
            </form>

            <?php
                }
            }

            ?>
        </div>

    </div>

</div>
<?php include './inc/footer.php'; ?>