<?php
include 'connect.php';
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
	header('Location: loginuser.php');
	exit;
}
$sql = "SELECT * FROM datacus WHERE customer_username = '" . $_SESSION['username'] . "' ";
$query = pg_query($conn, $sql);
$d = pg_fetch_object($query);

$kontak = pg_query($conn, "SELECT * FROM items JOIN dataadmin on items.items_admin = dataadmin.admin_id WHERE items.items_id = '" . $_GET['id'] . "'");
$a = pg_fetch_object($kontak);

$produk = pg_query($conn, "SELECT * FROM items JOIN itemspic on items.items_id = itemspic.items_id WHERE items.items_id = '" . $_GET['id'] . "' ");
$p = pg_fetch_object($produk);
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



	<!-- product detail -->
	<div class="section">
		<div class="container">
			<h3><a href="main.php" class="kembali-link">Kembali</a></h3>
			<div class="box">
				<h3>Detail Produk</h3>
				<div class="col-2">
					<div class="image-container">
						<img class="zoomable-image" alt="Foto" src="produk/<?php echo $p->image ?>">
					</div>
				</div>
				<div class="col-2">
					<h2><?php echo $p->items_name ?></h2>
					<h3>Rp. <?php echo $p->items_price ?></h3>
					<p>Deskripsi :<br>
						<?php echo $p->items_describe ?>
					</p>
					<p>Toko : <br>
						<?php echo $a->admin_user ?>
					</p>
					<div class="input-container">
						<p> Atur Jumlah : <br>
							<button class="decrement-button" onclick="decrement()">-</button>
							<input type="number" class="num" name="jumlah" id="myInput" value="1" min="1" max="<?php echo $p->items_stock ?>">
							<button class="increment-button" onclick="increment()">+</button>
							stock : <?php echo $p->items_stock ?>

						</p>
					</div>

					<?php
					if ($p->items_stock > 0) { ?>
						<div class="beli" id="saveButton">
							<input type="hidden" id="itemsId" name="custId" value="<?php echo $p->items_id ?>">
							<input type="hidden" id="custId" name="custId" value="<?php echo $d->customer_id ?>">
							<button class="a">Masukkan Keranjang</button>
						</div>
					<?php
					} else { ?>
						<div class="belihabis">
							<p class="habis">Barang Habis</p>
						</div>

					<?php
					}
					?>

				</div>
			</div>
		</div>
	</div>
	<script src="script.js"></script>
</body>

</html>