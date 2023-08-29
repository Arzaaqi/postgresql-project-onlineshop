<?php
include 'connect.php';

$nilai = $_POST['nilai'];
$items = $_POST['items'];
$custid = $_POST['cust'];
$today = date('Y-m-d');


$query = "INSERT INTO cartcus (cart_items_id, cart_cus_id, cart_jumlah, cart_tgl) VALUES ('$items','$custid','$nilai', '$today')
         ON CONFLICT (cart_items_id, cart_cus_id) DO UPDATE
          SET cart_jumlah = cartcus.cart_jumlah + EXCLUDED.cart_jumlah";
$result = pg_query($conn, $query);



// Periksa apakah query berhasil
if ($result) {
    echo 'berhasil';
}
?>
