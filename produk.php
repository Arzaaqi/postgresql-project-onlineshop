<?php 

	include 'connect.php';
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

	<!-- search -->
	<div class="search">
		<div class="container">
			<form action="produk.php">
				<input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
		</div>
	</div>

	<!-- new product -->
	<div class="section">
		<div class="container">
			<h3>Produk Terkait</h3>
			<div class="box">
				<?php
					if($_GET['search'] == ''){	
						header('Location:main.php');
					}
					if($_GET['search'] != ''){
						$d = $_GET['search'];
						$e = strtolower($d);
						$h = ucfirst($e);
						$f = ucfirst($d);
						$g = ucwords($d);
						$sql = "SELECT * FROM items JOIN itemspic ON items.items_id = itemspic.items_id WHERE items_name LIKE '%$d%' OR items_name LIKE '%$h%' OR items_name LIKE '%$e%' OR items_name LIKE '%$f%' ORDER BY items.items_id DESC";

					}

					$produk = pg_query($conn, $sql);
					if(pg_num_rows($produk) > 0){
						while($p = pg_fetch_array($produk)){
				?>	
					<a href="detail-produk.php?id=<?php echo $p['0'] ?>">
						<div class="col-4">
							<div class="mainbox">
							<img src="produk/<?php echo $p['image'] ?>">
							</div>
							<p class="nama"><?php echo substr($p['1'], 0, 23);
							 if(strlen($p['1']) > 23){
								echo '...';
							 }
							?></p>
							<p class="harga">Rp<?php echo ($p['3']) ?></p>
						</div>
					</a>
				<?php }}else{ ?>
					<p>Produk tidak ada</p>
				<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>