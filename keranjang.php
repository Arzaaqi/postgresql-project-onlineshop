<?php
include 'connect.php';
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
	header('Location: loginuser.php');
	exit;
}
$sql = "SELECT * FROM datacus WHERE customer_username = '" . $_SESSION['username'] . "' ";
$query = pg_query($conn, $sql);
$user = pg_fetch_object($query);

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wear</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

</head>

<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="main.php">Wear</a></h1>
			<ul>
				<li><a href="main.php">Dashboard</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>
				<li><a href="profile.php">Profil</a></li>
				<li><a href="keluar.php">Keluar</a></li>
			</ul>
		</div>
	</header>
	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Keranjang</h3>
			<div class="box">
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Nama Produk</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th width="150px">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$produk = pg_query($conn, "SELECT * FROM cartcus JOIN items ON cartcus.cart_items_id = items.items_id WHERE cart_cus_id = $user->customer_id ");
						if (pg_num_rows($produk) > 0) {
							while ($row = pg_fetch_array($produk)) {
						?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $row['items_name'] ?></td>
									<td>Rp. <span id="harga-<?php echo $row['cart_items_id']; ?>"><?php echo $row['items_price'] * $row['cart_jumlah'] * 1000; ?></span></td>
									<td>
										<button class="decrement-button" onclick="decrement(<?php echo $row['cart_items_id']; ?>); updateHarga(<?php echo $row['cart_items_id']; ?>)">-</button>
										<input type="number" class="num" name="jumlah" id="Inputcart-<?php echo $row['cart_items_id']; ?>" value="<?php echo $row['cart_jumlah']; ?>" min="1" max="<?php echo $row['items_stock']; ?>" oninput="updateHarga(<?php echo $row['cart_items_id']; ?>)">
										<button class="increment-button" onclick="increment(<?php echo $row['cart_items_id']; ?>); updateHarga(<?php echo $row['cart_items_id']; ?>)">+</button>
									</td>

									<script>
										function increment(productId) {
											var inputElement = document.getElementById("Inputcart-" + productId);
											var currentValue = parseInt(inputElement.value);
											var maxValue = parseInt(inputElement.max);

											if (currentValue < maxValue) {
												currentValue++;
											}
											inputElement.value = currentValue;
											updateCartJumlah(productId, currentValue);
										}

										function decrement(productId) {
											var inputElement = document.getElementById("Inputcart-" + productId);
											var currentValue = parseInt(inputElement.value);
											var minValue = parseInt(inputElement.min);

											if (currentValue > minValue) {
												currentValue--;
											}
											inputElement.value = currentValue;
											updateCartJumlah(productId, currentValue);

										}

										function updateHarga(productId) {
											var harga = <?php echo $row['items_price']; ?>;
											var jumlah = parseInt(document.getElementById("Inputcart-" + productId).value);
											var totalHarga = harga * jumlah * 1000;

											document.getElementById("harga-" + productId).innerText = totalHarga;
										}

										function updateCartJumlah(productId, newJumlah) {
											var cartid = <?php echo $row['cart_id']; ?>;
											var xhttp = new XMLHttpRequest();
											xhttp.onreadystatechange = function() {
												if (this.readyState == 4 && this.status == 200) {
													// Update success
												}
											};
											xhttp.open("GET", "update_cart_jumlah.php?cartItemId=" + productId + "&newJumlah=" + newJumlah + "&cartid=" + cartid, true);
											xhttp.send();
										}
									</script>


									<td>
										<div class="tomb">
											<a class="tombol" href="proses-hapuscart.php?idc=<?php echo $row['cart_id']; ?>" onclick="return confirm('Yakin ingin hapus ?')">Hapus</a>
											<a class="tombolb" href="notabeli.php?idb=<?php echo $row['cart_id']; ?>" onclick="return confirm('Yakin ingin Beli ?')">Beli</a>
										</div>
									</td>
								</tr>
							<?php }
						} else { ?>
							<tr>
								<td colspan="7">Keranjang Kosong<br><a href="main.php" class="belanja">Lanjutkan Belanja</a></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
</body>

</html>