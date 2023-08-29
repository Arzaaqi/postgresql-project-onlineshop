<?php
session_start();
include 'connect.php';

$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT * FROM logincus WHERE username = '$username'";
$result = pg_query($conn, $sql);


if (pg_num_rows($result) > 0) {
    $user = pg_fetch_assoc($result);

    if ($user && hash_equals($user['passcode'], crypt($password, $user['passcode']))) {
        // Jika password cocok, berikan akses ke halaman yang diinginkan
        $d = pg_fetch_row($result);
        $_SESSION['login'] = true;  
        $_SESSION['username'] = $username;
        header( "location: main.php");
    } else {
        // Jika password tidak cocok, berikan pesan error
        header("Location: loginuser.php?pwerror=true");
    }
} else {
    echo "User tidak ditemukan!";
    header("Location: loginuser.php?error=true");
}

// Tutup koneksi ke database
pg_close($conn);
?>