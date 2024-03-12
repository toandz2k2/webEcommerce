<?php

use LDAP\Result;

include('./inc/header.php');
include('../classes/category.php');
include('../classes/product.php');
include('../classes/brand.php');
include_once('../helpers/format.php');
?>
<?php
$fm = new Format();
$product = new Product();
if (isset($_GET['delid'])) {
    $id_product = $_GET['delid']; // Lấy delid trên host
    $del_product = $product->del_product($id_product);
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Danh sách sản phẩm</h2>
        </div>
        <div class="card-body">
            <form action="productlist.php" method="POST">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th class="bg-dark border border-dark">STT</th>
                                <th class="bg-dark border border-dark">Mã SP</th>
                                <th class="bg-dark border border-dark">Tên SP</th>
                                <th class="bg-dark border border-dark">Ảnh</th>
                                <th class="bg-dark border border-dark">Danh mục</th>
                                <th class="bg-dark border border-dark">Thương hiệu</th>
                                <th class="bg-dark border border-dark">Số lượng</th>
                                <th class="bg-dark border border-dark">Mô tả</th>
                                <th class="bg-dark border border-dark">Loại SP</th>
                                <th class="bg-dark border border-dark">Giá</th>
                                <th class="bg-dark border border-dark">Sửa</th>
                                <th class="bg-dark border border-dark">Xoá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $productlist = $product->show_product();
                            if ($productlist) {
                                $stt = 0;
                                while ($result = $productlist->fetch_assoc()) {
                                    $stt++;
                            ?>
                            <tr>
                                <td><?php echo $stt; ?></td>
                                <td><?php echo $result['id_product'] ?></td>
                                <td><?php echo $result['name_product'] ?></td>
                                <td><img src="uploadss/<?php echo $result['image'] ?>" width="80px"> </td>
                                <td><?php echo $result['name_cat'] ?></td>
                                <td><?php echo $result['name_brand'] ?></td>
                                <td><?php echo $result['quantity_product'] ?></td>
                                <td><?php echo $fm->textShorten($result['desc_product'],30)  ?></td>
                                <td>
                                    <?php
                                    if($result['type']==0){
                                        echo"Mới";
                                    }elseif($result['type']==1){
                                        echo"Nổi bật";
                                    }elseif($result['type']==2){
                                        echo"Yêu thích";
                                    }else
                                    {
                                        echo"Thường";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $result['price'] ?></td>
                                <td>
                                    <a href="productedit.php?id_product=<?php echo $result['id_product'] ?>">Sửa</a>
                                </td>
                                <td>
                                    <a onclick="return deleteProduct('<?php echo $result['name_product'] ?>')"
                                        href="productlist.php?delid=<?php echo $result['id_product']; ?>">Xóa</a>
                                </td>

                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <?php include './inc/footer.php'; ?>
    <script>
    function deleteProduct(name_product) {
        return confirm('Bạn có chắc muốn xóa sản phẩm: ' + name_product + ' này?');
    }
    </script>