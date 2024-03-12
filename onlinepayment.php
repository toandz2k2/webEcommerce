<?php
require('inc/header.php');

?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
	$id_customer = Session::get('id_customer');
	echo $id_customer;
	$insert_order = $cart->insert_order($id_customer);
	$delcart = $cart->del_all_data_cart();
	header('location:succsess.php');
}
?>
<?php
if (isset($_GET['id_cart'])) {
	$id_cart = $_GET['id_cart']; // Lấy delid trên host
	$del_cart = $cart->del_product_cart($id_cart);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$id_cart = $_POST['id_cart'];
	$quantity = $_POST['quantity'];
	// LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
	$update_quantity_cart = $cart->update_quantity_cart($quantity, $id_cart); // hàm check khi submit lên
	if ($quantity <= 0) {
		$del_cart = $cart->del_product_cart($id_cart);
	}
}
?>

<form action="" method="POST">
	<div class="col-sm-9 padding-right">
		<div class="algintd" style="padding:5px">
			<h2 class="title text-center">Thanh toán</h2>
		</div>
	</div>
	<div class="container rounded bg-white mt-5 mb-5">
		<div class="row" style="padding-left: 300px;">
			<div class="col-md-5 border-right">
				<div class="p-3 py-5">
					<form action="" method="POST">
						<div class="row mt-3">
							<?php
							if (isset($update_customer)) {
								echo $update_customer;
							}
							?>
							<?php
							$id_customer = Session::get('id_customer');
							$get_custommer = $cs->show_customer($id_customer);
							if ($get_custommer) {
								while ($result = $get_custommer->fetch_assoc()) {
							?>
							
									<div class="col-md-12"><label class="labels">Tên tài khoản</label><input type="text" name="name" class="form-control" value="<?php echo $result['name'] ?>"></div>
									<div class="col-md-12"><label class="labels">Địa chỉ</label><input type="text" name="address" class="form-control" value="<?php echo $result['address'] ?>"></div>
									<div class="col-md-12"><label class="labels">Thành Phố</label><input type="text" name="city" class="form-control" value="<?php echo $result['city'] ?>"></div>
									<div class="col-md-12"><label class="labels">Nước</label><input type="text" name="country" class="form-control" value="<?php echo $result['country'] ?>"></div>
									<div class="col-md-12"><label class="labels">Zipcode</label><input type="text" name="zipcode" class="form-control" value="<?php echo $result['zipcode'] ?>"></div>
									<div class="col-md-12"><label class="labels">Số điện thoại</label><input type="text" name="phone" class="form-control" value="<?php echo $result['phone'] ?>"></div>
									<div class="col-md-12"><label class="labels">Email</label><input type="text" name="email" class="form-control" value="<?php echo $result['email'] ?>"></div>
									<div class="mt-5 text-center"><input type="submit" class="btn btn-primary profile-button" name="save" value="Cập Nhật"></div>
							<?php
								}
							}
							?>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class=""> </div>
	<section id="cart_items">
		<div class="container">
			<!--/breadcrums-->
			<?php
			if (isset($update_quantity_cart)) {
				echo $update_quantity_cart;
			}
			?>
			<?php
			if (isset($del_cart)) {
				echo $del_cart;
			}
			?>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">

					<thead>
						<tr class="cart_menu">
							<td class="image">Ảnh</td>
							<td class="name_product">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng thanh toán</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
						$get_product_cart = $cart->get_product_cart();
						if ($get_product_cart) {
							$subtotal = 0;
							while ($result = $get_product_cart->fetch_assoc()) {
						?>
								<tr>
									<td class="">
										<a href=""><img src="admin/uploadss/<?php echo $result['image'] ?>" style="height:80px ;" alt=""></a>
									</td>
									<td class="cart_description">
										<h4><a href=""><?php echo $result['name_product'] ?></a></h4>
										<p>Web ID: <?php echo $result['id_cart'] ?></p>
									</td>
									<td class="cart_price">
										<p><?php echo $fm->format_currency($result['price'])." VNĐ" ?></p>
									</td>
									<td class="cart_quantity">
										<form action="" method="post">
											<div class="cart_quantity_button">
												<input class="cart_quantity_input" type="hidden" name="id_cart" value="<?php echo $result['id_cart'] ?>" style="width:50px" />
												<input class="cart_quantity_input" type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>" style="width:50px" />&ensp;
												<input style="background: var(--bg-primary); border-radius: 0; color: #ffffff; border: none; padding: 5px 15px;" type="submit" name="submit" value="Cập Nhật" style="height: 29px;">
											</div>
										</form>
									</td>
									<td class="cart_total">
										<p class="cart_total_price">
											<?php
											$total = $result['price'] * $result['quantity'];
											echo $fm->format_currency($total)." VNĐ";
											?>
										</p>
									</td>
									<td class="cart_delete">
									<div style="padding-top:25px;"><a onclick="return deleteProduct('<?php echo $result['name_product'] ?>')" class="cart_quantity_delete" href="?id_cart=<?php echo $result['id_cart'] ?>"><i class="fa fa-times"></i></a></div>
									</td>
								</tr>
						<?php
								$subtotal += $total;
							}
						}

						?>

						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<?php
									$check_cart = $cart->check_cart();
									if ($check_cart) {

									?>
										<tr>
											<td>Tổng thanh toán</td>
											<td>
												<?php
												echo $fm->format_currency($subtotal)." VNĐ";
												Session::set('sum', $subtotal);
												?>
											</td>
										</tr>
										<tr>
											<td>VAT</td>
											<td>10%</td>
										</tr>
										<tr class="shipping-cost">
											<td>Phí ship</td>
											<td>Free</td>
										</tr>
										<tr>
											<td>Thanh toán</td>
											<td><span>
													<?php
													$vat = $subtotal * 0.1;
													$stotal = $subtotal + $vat;
													echo $fm->format_currency($stotal)." VNĐ";
													?>
												</span></td>
										</tr>
									<?php
									} else {
										echo "<span style='color:var(--bg-primary)'>Giỏ hàng của bạn trống!</span>";
									}
									?>
								</table>
							</td>
						</tr>

					</tbody>
				</table>
			</div>
			<div class="payment-options">
                <form action="congthanhtoan_vnpay.php" method="post">
                <div class="left">
                    <input type="hidden" name="total_congthanhtoan" value="<?php echo $stotal ?>">
					<button class="btn btn-default check_out" name="redirect" id="redirect" style="float:right; margin-right:50px ;">Thanh toán VNPay</button>
				</div>
                </form>
                <form action="congthanhtoan_momo.php" method="post">
                <div class="left">
                    <input type="hidden" name="total_congthanhtoan" value="<?php echo $stotal ?>">
					<button class="btn btn-default check_out" name="captureWallet" style="float:right; margin-right:50px ;">Thanh toán QR MoMo</button>
				</div>
                </form>
                <div class="left">
					<a class="btn btn-default check_out" href="?orderid=order" style="float:right; margin-right:50px ;">Tài khoản ngân hàng</a>
				</div>
			</div>


		</div>
	</section>
</form>

<?php
require('inc/footer.php');
?>