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
			<h3> <?php echo $d->admin_user?></h3>
			<div class="box">
				<form action="" method="POST">
					<label>Nama Lengkap</label>
					<input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_nama ?>" required>
                    <label>Username</label>
					<input type="text" name="user" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_user?>" required>
					<label>No. Telp</label>
					<input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo $d->admin_nomor?>" required>
					<label>Email</label>
					<input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>" required>
					<label>Alamat</label>
					<input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_alamat?>" required>
					<input type="submit" name="submit" value="Ubah Profil" class="btn">
				</form>
				<?php 
					if(isset($_POST['submit'])){

						$nama 	= ucwords($_POST['nama']);
						$user 	= $_POST['user'];
						$hp 	= $_POST['hp'];
						$email 	= $_POST['email'];
						$alamat = ucwords($_POST['alamat']);

						$update = pg_query($conn, "UPDATE dataadmin SET 
										admin_nama = '".$nama."',
										admin_user = '".$user."',
										admin_nomor = '".$hp."',
										admin_email = '".$email."',
										admin_alamat = '".$alamat."'
										WHERE admin_id = ".$d->admin_id);
						if($update){
							echo '<script>alert("Ubah data berhasil")</script>';
							echo '<script>window.location="profileadmin.php"</script>';
						}else{
							echo 'gagal '.pg_last_error($conn);
						}

					}
				?>
			</div>

			<h3>Ubah Password</h3>
			<div class="box">
				<form action="" method="POST">
					<input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
					<input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
					<input type="submit" name="ubah_password" value="Ubah Password" class="btn">
				</form>
				<?php 
					if(isset($_POST['ubah_password'])){

						$pass1 	= $_POST['pass1'];
						$pass2 	= $_POST['pass2'];

						if($pass2 != $pass1){
							echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
						}else{
                            $salt = '$5$' . base64_encode(random_bytes(16)) . '$'; // generate salt
                            $encrypted_password = crypt($pass1, $salt); // encrypt password

							$u_pass = pg_query($conn, "UPDATE loginadmin SET 
										passcode = '".$encrypted_password."'
										 WHERE username = '".$_SESSION['username']."' ");
							if($u_pass){
								echo '<script>alert("Ubah data berhasil")</script>';
								echo '<script>window.location="profileadmin.php"</script>';
							}else{
								echo 'gagal '.pg_last_error($conn);
							}
						}

					}
				?>
			</div>
		</div>
	</div>

	<!-- footer -->
	
</body>
</html>