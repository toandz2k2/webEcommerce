<?php
include('./inc/header.php');
include('../classes/category.php')
?>
<?php
$cat = new Category();
if (isset($_GET['delid'])) {
    $id_cat = $_GET['delid']; // Lấy delid trên host
    $del_cat = $cat->del_category($id_cat);
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Danh sách danh mục</h2>
        </div>
        <?php
            if (isset($del_cat)) {
                echo $del_cat;
            }
            ?>
        <div class="card-body">
            <form action="catlist.php" method="POST">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th class="bg-dark border border-dark">STT</th>
                                <th class="bg-dark border border-dark">Mã danh mục</th>
                                <th class="bg-dark border border-dark">Tên danh mục</th>
                                <th class="bg-dark border border-dark">Sửa</th>
                                <th class="bg-dark border border-dark">Xoá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $show_cat = $cat->show_category();
                            $stt = 0;
                            if ($show_cat) {
                                while ($result = $show_cat->fetch_assoc()) {
                                    $stt++;
                            ?>
                            <tr>
                                <td><?php echo $stt; ?></td>
                                <td><?php echo $result['id_cat'] ?></td>
                                <td><?php echo $result['name_cat'] ?></td>
                                <td>
                                    <a href="catedit.php?id_cat=<?php echo $result['id_cat'] ?>">Sửa</a>
                                </td>
                                <td>
                                    <a onclick="return deleteProduct('<?php echo $result['name_cat'] ?>')"
                                        href="catlist.php?delid=<?php echo $result['id_cat']; ?>">Xóa</a>
                                </td>
                            </tr>
                            <?php
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <?php include './inc/footer.php'; ?>
    <script>
    function deleteProduct(name_cat) {
        return confirm('Bạn có chắc muốn xóa danh mục: ' + name_cat + ' này?');
    }
    </script>