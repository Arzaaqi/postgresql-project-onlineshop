<?php
session_start();
$passerror = isset($_GET['passalah']) ? $_GET['passalah'] : false;
?>

<!DOCTYPE html>
<html>

<head>
    <title>
        Daftar
    </title>
    <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
    <link rel="stylesheet" href="daftar.css">
</head>

<body class="body">
    <div class="form">
        <h2 class="login">Daftar</h2>
        <form method="post" action="regisuseraksi.php">
            <table>
                <tr>
                    <div class="txt_daftar">
                        <input type="text" name="nama" placeholder="Nama Lengkap" required />
                    </div>
                    <div class="txt_daftar">
                        <input type="email" name="email" placeholder="Email" required />
                    </div>
                    <div class="txt_daftar">
                        <input type="text" name="nomor" placeholder="No. Telp" required />
                    </div>
                    <div class="txt_daftar">
                        <input type="text" name="alamat" placeholder="Alamat" required />
                    </div>
                    <div class="txt_daftar">
                        <input type="text" name="username" placeholder="Username" required />
                    </div>
                    <div class="txt_daftar">
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <div class="txt_daftar">
                        <input type="password" name="password2" placeholder="Konfirmasi Password" required />
                    </div>
                    <label style="<?php echo $passerror ? 'display:flex;' : 'display:none;' ?>">
                        <p class="error">
                            Konfirmasi Password Salah
                        </p>
                    </label>
                </tr>
            </table>
            <div class="button_border">
                <input type="submit" name="submit" value="Submit" href="main.php" class="button">
            </div>
            <div class="daftar">
                Sudah Punya Akun?
                <a href="loginuser.php" class="a">Login</a>
            </div>
            </table>
        </form>
    </div>
</body>

</html>