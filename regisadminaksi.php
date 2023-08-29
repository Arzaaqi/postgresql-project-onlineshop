<?php
session_start();
include 'connect.php';
// Memeriksa apakah tombol "submit" telah diklik

if (isset($_POST['submit'])) {

    // Mendapatkan nilai yang dikirim melalui form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nomor = $_POST['nomor'];
    $username = strtolower(stripslashes($_POST['username']));
    $password = $_POST['password'];
    $password2 = $_POST['password2'];



    if ($password !== $password2) {
        header("Location: daftar.php?passalah=true");
    } else {
        $salt = '$5$' . base64_encode(random_bytes(16)) . '$'; // generate salt
        $encrypted_password = crypt($password, $salt); // encrypt password

        $sql = "BEGIN;
                INSERT INTO loginadmin (username, passcode) VALUES ('$username', '$encrypted_password');
                INSERT INTO dataadmin (admin_nama, admin_email, admin_nomor, admin_user) VALUES ('$nama', '$email', '$nomor', '$username');

                COMMIT; -- Mengcommit transaksi 
                ";
        $result = pg_exec($conn, $sql);

        if ($result) {
            echo "User berhasil ditambahkan!";
            header("refresh:5;url=regisadmin.php");
        } else {
            echo "Gagal menambahkan user!";
        }

        pg_close($conn);
    }
}
