<?php include './inc/header.php'; ?>
<?php include '../classes/category.php'; ?>
<?php
$cat = new Category();
if (!isset($_GET['id_cat']) || $_GET['id_cat'] == NULL) {
    echo "<script> window.location = 'catlist.php' </script>";
} else {
    $id_cat = $_GET['id_cat']; // Lấy catid trên host

}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $name_cat = $_POST['name_cat'];
    $update_cat = $cat->update_category($name_cat, $id_cat); // hàm check catName khi submit lên
}

?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Sửa danh mục</h2>
        </div>
        <?php
        if (isset($update_cat)) {
            echo $update_cat;
        }
        ?>
        <div class="card-body">

            <?php
            $get_cat_name = $cat->getcatbyid($id_cat);
            if ($get_cat_name) {
                while ($result = $get_cat_name->fetch_assoc()) {


            ?>
                    <form action="" method="POST" enctype="multipart/form-dazta">

                        <div class="form-group">
                            <label for="">Tên danh mục</label>
                            <input type="text" name="name_cat" class="form-control" required value="<?php echo $result['name_cat'] ?>">
                        </div>

                        <button type="submit" class="btn btn-dark" name="submit">Sửa danh mục</button>
                    </form>

            <?php
                }
            }

            ?>
        </div>

    </div>

</div>
<?php include './inc/footer.php'; ?>