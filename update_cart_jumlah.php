<?php
// Koneksi ke database
include 'connect.php';

$cartItemId = $_GET['cartItemId'];
$newJumlah = $_GET['newJumlah'];
$cartId = $_GET['cartid'];
// Lakukan validasi atau sanitasi data jika diperlukan

// Update cart_jumlah dalam database
$updateQuery = "UPDATE cartcus SET cart_jumlah = '".$newJumlah."' WHERE cart_id = $cartId";
$result = pg_query($conn, $updateQuery);

if ($result) {
  echo "Cart jumlah berhasil diperbarui.";
} else {
  echo "Gagal memperbarui cart jumlah.";
}
?>
