<?php
require('inc/header.php');
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>
<h1>ORDER BY PRODUCT</h1>
<?php
require('inc/footer.php');
?>