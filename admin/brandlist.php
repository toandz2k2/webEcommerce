<?php
include('./inc/header.php');
include('../classes/brand.php')
?>
<?php
$brand = new Brand();
if (isset($_GET['delid'])) {
    $id_brand = $_GET['delid']; // Lấy delid trên host
    $del_brand = $brand->del_brand($id_brand);
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Danh sách thương hiệu</h2>
        </div>
        <?php
            if (isset($del_brand)) {
                echo $del_brand;
            }
            ?>
        <div class="card-body">
            <form action="catlist.php" method="POST">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th class="bg-dark border border-dark">STT</th>
                                <th class="bg-dark border border-dark">Mã thương hiệu</th>
                                <th class="bg-dark border border-dark">Tên thương hiệu</th>
                                <th class="bg-dark border border-dark">Sửa</th>
                                <th class="bg-dark border border-dark">Xoá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $show_brand = $brand->show_brand();
                            $stt = 0;
                            if ($show_brand) {
                                while ($result = $show_brand->fetch_assoc()) {
                                    $stt++;
                            ?>
                            <tr>
                                <td><?php echo $stt; ?></td>
                                <td><?php echo $result['id_brand'] ?></td>
                                <td><?php echo $result['name_brand'] ?></td>
                                <td>
                                    <a href="brandedit.php?id_brand=<?php echo $result['id_brand'] ?>">Sửa</a>
                                </td>
                                <td>
                                    <a onclick="return deleteProduct('<?php echo $result['name_brand'] ?>')"
                                        href="brandlist.php?delid=<?php echo $result['id_brand']; ?>">Xóa</a>
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
    function deleteProduct(name_brand) {
        return confirm('Bạn có chắc muốn xóa thương hiệu: ' + name_brand + ' này?');
    }
    </script>