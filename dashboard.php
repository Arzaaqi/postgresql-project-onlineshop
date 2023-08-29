<?php
session_start();

include 'connect.php';

if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] != true) {
	header('Location: loginadmin.php');
	exit;
}

$sql="SELECT * FROM dataadmin WHERE admin_user = '".$_SESSION['user']."' ";
$query = pg_query($conn, $sql);
$d = pg_fetch_object($query);

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
			<h1><a href="dashboard.php">Wear</a></h1>
			<ul>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li><a href="profileadmin.php">Profil</a></li>
				<li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="datapesanan.php">Data Pesanan</a></li>
				<li><a href="keluaradmin.php">Keluar</a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Produk Anda</h3>
			<div class="box">
				<?php
				$produk = pg_query($conn, "SELECT * FROM items JOIN itemspic on items.items_id = itemspic.items_id WHERE items.items_admin = '" . $d->admin_id . "' ");
				if (pg_num_rows($produk) > 0) {
					while ($p = pg_fetch_array($produk)) {
				?>
						<div class="col-4">
							<div class="mainbox">
								<img src="produk/<?php echo $p['image'] ?>">
							</div>
							<p class="nama"><?php echo substr($p['1'], 0, 30) ?></p>
							<p class="harga">Rp. <?php echo ($p['3']) ?></p>
						</div>
						</a>
					<?php }
				} else { ?>
					<p>Produk tidak ada</p>
				<?php } ?>
			</div>
		</div>

</body>

</html>