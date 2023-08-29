<?php 
include 'connect.php';
$idc = $_POST['idc'];

$query = pg_query($conn, "SELECT * FROM cartcus JOIN items ON cart_items_id = items_id WHERE cart_id = '$idc'");
$p = pg_fetch_object($query);

$cartId = $p->cart_id;
$cartitemsId = $p->cart_items_id;
$cartcusId = $p->cart_cus_id;
$cartjml = $p->cart_jumlah;
$cartotal = $p->cart_jumlah * $p->items_price;
$today = date('Y-m-d');

// Periksa apakah query berhasil
if ($query) {
    $sql = "BEGIN;
            UPDATE items SET items_stock = items_stock - '$cartjml' WHERE items_id = '$cartitemsId';
            INSERT INTO riwayatbeli (riwayat_id, riwayat_items_id, riwayat_cus_id, riwayat_jumlah, riwayat_tgl, riwayat_total) VALUES ('$cartId', '$cartitemsId', '$cartcusId', '$cartjml', '$today', '$cartotal');
            COMMIT; -- Mengcommit transaksi 
            ";
    $hasil = pg_query($conn, $sql);
    if ($hasil) {
        $sql = "DELETE FROM cartcus WHERE cart_id = '$idc'";
		$delete = pg_query($conn, $sql);
        header('Location:Keranjang.php');
    }
}else
echo 'gagal';


?>
