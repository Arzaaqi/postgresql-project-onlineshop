<?php
session_start();
include 'connect.php';

$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT * FROM loginadmin WHERE username = '$username'";
$result = pg_query($conn, $sql);


if (pg_num_rows($result) > 0) {
    $user = pg_fetch_assoc($result);

    if ($user && hash_equals($user['passcode'], crypt($password, $user['passcode']))) {
        // Jika password cocok, berikan akses ke halaman yang diinginkan
        $d = pg_fetch_row($result);
        $_SESSION['status_login'] = true;  
        $_SESSION['user'] = $username;
        header( "location: dashboard.php");
    } else {
        // Jika password tidak cocok, berikan pesan error
        header("Location: loginadmin.php?pwerror=true");
    }
} else {
    echo "User tidak ditemukan!";
    header("Location: loginadmin.php?error=true");
}

// Tutup koneksi ke database
pg_close($conn);
?>