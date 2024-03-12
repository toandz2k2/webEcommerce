<?php
include('lib/session.php');
Session::init();
?>
<?php
include_once('lib/database.php');
include_once('helpers/format.php');

spl_autoload_register(function ($className) {
    include_once "classes/" . $className . ".php";
});

$db = new Database();
$fm = new Format();
$cat = new category();
$cart = new cart();
$user = new Users();
$product = new Product();
$cs = new Customer();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | NT-FASHION</title>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +84 965882491</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> nangvipvp02@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="https://www.facebook.com/tavannang02/"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li><a href="https://www.youtube.com/channel/UCGs4fIRLyrOa3GBW6lJa_Gw"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="https://www.instagram.com/yukis.nangs/"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li><a href="https://twitter.com/TVnNng3"><i class="fa fa-twitter"></i></a></li>
                                <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.php"><img src="images/home/logo.png" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    VN
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">US</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    VNĐ
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <?php
                                $login_check = Session::get('id_customer');
                                if ($login_check == false) {
                                    echo '';
                                } else {
                                    echo '<li><a href="profile.php"><i class="fa fa-user"></i> Tài Khoản</a></li>';
                                }
                                ?>
                                <?php
                                $login_check = Session::get('id_customer');
                                if ($login_check == false) {
                                    echo '';
                                } else {
                                    echo '<li><a href="#"><i class="fa fa-heart"></i> Yêu thích</a></li>';
                                }
                                ?>
                                <?php
                                $id_customer = Session::get('id_customer');
                                $check_order = $cart->check_order($id_customer);
                                if ($check_order == true) {
                                    echo '<li><a href="orderdetail.php"><i class="fa fa-star"></i> Đơn mua</a></li>';
                                } else {
                                    echo '';
                                }
                                ?>
                                <li><a href="cart.php"><i class="fa fa-shopping-cart"></i>
                                        <?php
                                        $check_cart = $cart->check_cart();
                                        if ($check_cart) {
                                            $sum = Session::get("sum");
                                            echo "<span style='color:var(--bg-primary)'>$sum VNĐ</span>";
                                        } else {
                                            echo "<span style='color:var(--bg-primary)'>0 VNĐ</span>";
                                        }
                                        ?>
                                    </a>
                                </li>
                                <?php
                                if (isset($_GET['id_customer'])) {
                                    $delcart = $cart->del_all_data_cart();
                                    Session::destroy();
                                }
                                ?>
                                <?php
                                $login_check = Session::get('customer_login');
                                if ($login_check == false) {
                                    echo "<li><a href='login.php'><i class='fa fa-lock'></i> Đăng Nhập</a></li>";
                                } else {
                                    echo '<li><a href="?id_customer=' . Session::get('id_customer') . '"><i class="fa fa-lock"></i> Đăng Xuất</a></li>';
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="index.php" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="product.php">Sản phẩm</i></a>

                                </li>
                                <li class="dropdown"><a href="blog.php">Tin Tức</i></a>

                                </li>
                                <li><a href="404.php">404</a></li>
                                <li><a href="contact-us.php">Liên Hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">

                        <?php
                        if (isset($_GET['search'])) {
                            $key = $_GET['search_product'];
                            $search_product = $product->search_product($key);
                        }
                        ?>
                        <form action="search.php?quanly=search" method="GET">
                            <div class="search_box">
                                <input class="search_input" type="text" name="search_product" placeholder="Tìm Kiếm" />
                                <button href="" class="search_button" name="search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->