<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] != true) {
    header('Location: loginadmin.php');
    exit;
}
$produk = pg_query($conn, "SELECT * FROM riwayatbeli JOIN items on riwayat_items_id = items_id WHERE riwayat_id = '" . $_GET['idr'] . "' ");
$customer = pg_query($conn, "SELECT * FROM riwayatbeli JOIN datacus on riwayat_cus_id = customer_id WHERE riwayat_id = '" . $_GET['idr'] . "' ");
if (pg_num_rows($produk) == 0) {
    echo '<script>window.location="data-pesanan.php"</script>';
}
$p = pg_fetch_object($produk);
$q = pg_fetch_object($customer);
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
            <h3><a href="datapesanan.php" class="kembali-link">Kembali</a></h3>
            <div class="box">
                <div class="detail-pesanan">
                    <h2>Detail Pesanan</h2>
                    <div class="info-pesanan">
                        <table class="nama">
                           <tr>
                            <td><strong>ID Pesanan</strong></td>
                            <td><strong>:</strong></td>
                            <td><?php echo $p->riwayat_id?></td>
                           </tr> <tr>
                            <td><strong>Tanggal Pesanan</strong></td>
                            <td><strong>:</strong></td>
                            <td><?php echo $p->riwayat_tgl?></td>
                           </tr> <tr>
                            <td><p><strong>Nama Pembeli</strong></td>
                            <td><p><strong>:</strong></td>
                            <td><?php echo $q->customer_nama?></td>
                           </tr> <tr>
                            <td><strong>Alamat Pengiriman</strong></td>
                            <td><p><strong>:</strong></td>
                            <td><?php echo $q->customer_alamat?></td>
                        </table>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $p->items_name?></td>
                                <td><?php echo $p->riwayat_jumlah?></td>
                                <td>Rp. <?php echo number_format($p->items_price * 1000);?></td>
                                <td>Rp. <?php echo number_format($p->riwayat_jumlah * $p->items_price * 1000);?> </td>
                            </tr>

                            </tr>
                            <!-- Tambahkan baris sesuai detail pesanan -->
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>


    <script>
        CKEDITOR.replace('deskripsi');
    </script>
</body>

</html>