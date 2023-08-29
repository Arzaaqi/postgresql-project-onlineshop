<?php

include 'connect.php';

if (isset($_GET['idp'])) {
	$id = $_GET['idp'];

	$produk = pg_query($conn, "SELECT image FROM itemspic WHERE items_id = $id ");
	$p = pg_fetch_object($produk);
	unlink('./Produk/' . $p->image);

	$deleteQuery = "DELETE FROM itemspic WHERE items_id = $id";
	$result = pg_query($conn, $deleteQuery);

	if ($result) {
		// Baris-baris di tabel itemspic yang merujuk ke item yang akan dihapus telah dihapus
		
		// Lanjutkan dengan penghapusan pada tabel items
		$deleteQuery = "DELETE FROM items WHERE items_id = $id";
		$result = pg_query($conn, $deleteQuery);
	
		if ($result) {
			header('Location: data-produk.php');
		} else { 
			echo "Gagal menghapus item.";
		}
	} else {
		echo "Gagal menghapus referensi kunci asing pada tabel itemspic.";
	}
	
}
?>