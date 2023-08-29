<?php
session_start();
include 'connect.php';
// Memeriksa apakah tombol "submit" telah diklik

if (isset($_POST['submit'])) {

    // Mendapatkan nilai yang dikirim melalui form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nomor = $_POST['nomor'];
    $alamat = $_POST['alamat'];
    $username = strtolower(stripslashes($_POST['username']));
    $password = $_POST['password'];
    $password2 = $_POST['password2'];



    if ($password !== $password2) {
        header("Location: regisuser.php?passalah=true");
    } else {
        $salt = '$5$' . base64_encode(random_bytes(16)) . '$'; // generate salt
        $encrypted_password = crypt($password, $salt); // encrypt password

        $sql = "BEGIN;
                INSERT INTO logincus (username, passcode) VALUES ('$username', '$encrypted_password');
                INSERT INTO datacus (customer_nama, customer_email, customer_nomor, customer_username, customer_alamat) VALUES ('$nama', '$email', '$nomor', '$username', '$alamat');

                COMMIT; -- Mengcommit transaksi 
                ";
        $result = pg_exec($conn, $sql);

        if ($result) {
            $_SESSION['login'] = true;  
            $_SESSION['username'] = $username;
            header( "location: main.php");
        } else {
            echo "Gagal menambahkan user!";
        }

        pg_close($conn);
    }
}
