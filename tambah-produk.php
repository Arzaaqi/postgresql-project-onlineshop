<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] != true) {
	header('Location: loginadmin.php');
	exit;
}
$sql = "SELECT * FROM dataadmin WHERE admin_user = '" . $_SESSION['user'] . "' ";
$query = pg_query($conn, $sql);
$user = pg_fetch_object($query);
$d = $user->admin_id;

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wear</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
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
				<li><a href="keluar.php">Keluar</a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3><a href="data-produk.php" class="kembali-link">Kembali</a></h3>
			
			<div class="box">
			<h3>Tambah Data Produk</h3><br>
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
					<input type="text" name="harga" class="input-control" placeholder="Harga" required>
					<input type="number" name="stock" class="input-control" placeholder="Stock" required>
					<input type="file" name="gambar" class="input-control" required>
					<textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br>
					<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php
				if (isset($_POST['submit'])) {

					// print_r($_FILES['gambar']);
					// menampung inputan dari form
					$nama 		= $_POST['nama'];
					$harga 		= $_POST['harga'];
					$deskripsi 	= $_POST['deskripsi'];
					$stock	 	= $_POST['stock'];

					// menampung data file yang diupload
					$imageName = $_FILES["gambar"]["name"];
					$imageSize = $_FILES["gambar"]["size"];
					$tmpName = $_FILES["gambar"]["tmp_name"];

					// Image validation
					$validImageExtension = ['jpg', 'jpeg', 'png'];
					$imageExtension = explode('.', $imageName);
					$imageExtension = strtolower(end($imageExtension));


					// validasi format file
					if (!in_array($imageExtension, $validImageExtension)) {
						echo
						"
						<script>
						  alert('Invalid Image Extension');
						</script>
						";
					} elseif ($imageSize > 1200000) {
						echo
						"
						<script>
						  alert('Image Size Is Too Large');
						</script>
						";
					} else {
						// jika format file sesuai dengan yang ada di dalam array tipe diizinkan
						// proses upload file sekaligus insert ke database

						$insert = pg_query($conn, "INSERT INTO items (items_name, items_describe, items_price, items_stock, items_admin) VALUES (
										'" . $nama . "',
										'" . $deskripsi . "',
										'" . $harga . "',
										'" . $stock . "',
										'" . $d . "') ");
						$sql = "SELECT * FROM items WHERE items_name = '" . $nama . "' AND items_admin = $d";
						$query = pg_query($conn, $sql);
						$user = pg_fetch_row($query);
						$d = $user[0];
						$newImageName = $nama . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
						$newImageName .= '.' . $imageExtension;
						move_uploaded_file($tmpName, './Produk/' . $newImageName);
						$sql = pg_query($conn, "INSERT INTO itemspic (picture_nama, items_id, image) VALUES (
															'" . $nama . "',
															'" . $d . "',
															'" . $newImageName . "'	
											)");

						if ($insert && $sql) {
							echo '<script>alert("Tambah data berhasil")</script>';
							echo '<script>window.location="data-produk.php"</script>';
						} else {
							echo 'gagal ' . pg_last_error($conn);
						}
					}
				}
				?>
			</div>
		</div>
	</div>

	<!-- footer -->
	<script>
		CKEDITOR.replace('deskripsi');
	</script>
</body>

</html>