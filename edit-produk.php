<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] != true) {
	header('Location: loginadmin.php');
	exit;
}
$produk = pg_query($conn, "SELECT * FROM items JOIN itemspic on items.items_id = itemspic.items_id WHERE items.items_id = '" . $_GET['id'] . "' ");
if (pg_num_rows($produk) == 0) {
	echo '<script>window.location="data-produk.php"</script>';
}
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
				<li><a href="keluaradmin.php">Keluar</a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3><a href="data-produk.php" class="kembali-link">Kembali</a></h3>
			<div class="box">
				<h3>Edit Data Produk</h3><br>
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->items_name ?>" required>
					<input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->items_price ?>" required>
					<input type="number" name="stock" class="input-control" placeholder="Stock" value="<?php echo $p->items_stock ?>" required>
					<img src="/Produk/<?php echo $p->image ?>" width="100px">
					<input type="hidden" name="foto" value="<?php echo $p->image ?>">
					<input type="file" name="gambar" class="input-control">
					<textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->items_describe ?></textarea><br>
					<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php
				if (isset($_POST['submit'])) {

					// data inputan dari form
					$nama 		= $_POST['nama'];
					$harga 		= $_POST['harga'];
					$stock 		= $_POST['stock'];
					$deskripsi 	= $_POST['deskripsi'];
					$foto 	 	= $_POST['foto'];

					// data gambar yang baru
					$imageName = $_FILES["gambar"]["name"];
					$imageSize = $_FILES["gambar"]["size"];
					$tmpName = $_FILES["gambar"]["tmp_name"];

					$validImageExtension = ['jpg', 'jpeg', 'png'];
					$imageExtension = explode('.', $imageName);
					$imageExtension = strtolower(end($imageExtension));

					if ($imageName != '') {
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
							unlink('./Produk/' . $foto);
							$newImageName = $nama . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
							$newImageName .= '.' . $imageExtension;
							move_uploaded_file($tmpName, './Produk/' . $newImageName);
							$namagambar = $newImageName;
						}
					} else {
						// jika admin tidak ganti gambar
						$namagambar = $foto;
					}
					// query update data produk
					$sql = "BEGIN;
       				 	UPDATE items SET 
        				items_name = '" . $nama . "',
        				items_describe = '" . $deskripsi . "',
        				items_price = '" . $harga . "',
        				items_stock = '" . $stock . "'
        				WHERE items_id = " . $p->items_id . ";

				        UPDATE itemspic SET 
        				picture_nama = '" . $nama . "',
        				image = '" . $namagambar . "'
        				WHERE picture_id = " . $p->picture_id . ";

				        COMMIT;";

					$update = pg_query($conn, $sql);
					if ($update) {
						echo '<script>alert("Ubah data berhasil")</script>';
						echo '<script>window.location="data-produk.php"</script>';
					} else {
						echo 'gagal ' . pg_last_error($conn);
					}
				}
				?>
			</div>
		</div>
	</div>


	<script>
		CKEDITOR.replace('deskripsi');
	</script>
</body>

</html>