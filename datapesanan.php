<?php 
	session_start();
	include 'connect.php';
	if(!isset($_SESSION['status_login'])||$_SESSION['status_login'] != true){
		header('Location: loginadmin.php');
		exit;
	}
    $sql="SELECT * FROM dataadmin WHERE admin_user = '".$_SESSION['user']."' ";
	$query = pg_query($conn, $sql);
	$d = pg_fetch_object($query);
    $p = $d->admin_id
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
			<h3>Data Pesanan</h3>
			<div class="box">
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Nama Produk</th>
							<th>Jumlah</th>
							<th>Total Bayar</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							$produk = pg_query($conn, "SELECT * FROM riwayatbeli JOIN items on riwayat_items_id = items.items_id WHERE items_admin = $p ORDER BY items.items_id ASC");
							if(pg_num_rows($produk) > 0){
							while($row = pg_fetch_array($produk)){
						?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row['items_name'] ?></td>
							<td><?php echo $row['riwayat_jumlah'] ?></td>
							<td>Rp. <span><?php echo number_format($row['riwayat_total'] * 1000)?></span></td>
							<td>
								<a class="tombol" href="lihatpesan.php?idr=<?php echo $row['riwayat_id'] ?>">Lihat Detail</a>
							</td>
						</tr>
						<?php }}else{ ?>
							<tr>
								<td colspan="7">Tidak ada data</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</body>
</html>