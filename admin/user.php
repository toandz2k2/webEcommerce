<?php

use LDAP\Result;

include('./inc/header.php');
include('../classes/category.php');
include('../classes/customer.php');
include('../classes/brand.php');
include_once('../helpers/format.php');
?>
<?php
$fm = new Format();
$cs = new Customer();
if (isset($_GET['delid'])) {
    $id_customer = $_GET['delid']; // Lấy delid trên host
    $del_customer = $cs->del_customer($id_customer);
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Danh sách tài khoản</h2>
        </div>
        <div class="card-body">
            <form action="productlist.php" method="POST">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th class="bg-dark border border-dark">STT</th>
                                <th class="bg-dark border border-dark">ID</th>
                                <th class="bg-dark border border-dark">Tên tài khoản</th>
                                <th class="bg-dark border border-dark">Địa chỉ</th>
                                <th class="bg-dark border border-dark">ZipCode</th>
                                <th class="bg-dark border border-dark">Số điện thoại</th>
                                <th class="bg-dark border border-dark">Email</th>
                                <th class="bg-dark border border-dark">Password</th>
                                <th class="bg-dark border border-dark">Sửa</th>
                                <th class="bg-dark border border-dark">Xoá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $show_customer_admin = $cs->show_customer_admin($id_customer);
                            if ($show_customer_admin) {
                                $stt = 0;
                                while ($result = $show_customer_admin->fetch_assoc()) {
                                    $stt++;
                            ?>
                            <tr>
                                <td><?php echo $stt; ?></td>
                                <td><?php echo $result['id_customer'] ?></td>
                                <td><?php echo $result['name'] ?></td>
                                <td><?php echo $result['address'].', '. $result['city'].', '. $result['country'] ?></td>
                                <td><?php echo $result['zipcode'] ?></td>
                                <td><?php echo $result['phone'] ?></td>
                                <td><?php echo $result['email'] ?></td>
                                <td><?php echo $result['password'] ?></td>
                                <td>
                                    <a href="user.php?id_customer=<?php echo $result['id_customer'] ?>">Sửa</a>
                                </td>
                                <td>
                                    <a onclick="return deleteProduct('<?php echo $result['name_product'] ?>')"
                                        href="user.php?delid=<?php echo $result['id_customer']; ?>">Xóa</a>
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