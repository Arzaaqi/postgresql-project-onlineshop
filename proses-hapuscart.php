<?php 
	include 'connect.php';

    if(isset($_GET['idc'])) {
		$idc = $_GET['idc'];
	
		$sql = "DELETE FROM cartcus WHERE cart_id = '$idc'";
		$delete = pg_query($conn, $sql);
	
		if($delete) {
			header('Location: keranjang.php');
		} else {
			echo 'Gagal menghapus data';
		}
	}
?>