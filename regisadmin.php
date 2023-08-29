<?php
session_start();
$passerror = isset($_GET['passalah']) ? $_GET['passalah'] : false;
?>

<!DOCTYPE html>
<html>

<head>
    <title>
        Daftar Admin
    </title>
    <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
    <link rel="stylesheet" href="daftar.css">
</head>

<body class="body">
    <div class="form">
        <form method="post" action="regisadminaksi.php">
            <h2 class="login">Daftar Admin</h2>
            <table>
                <tr>
                    <div class="txt_daftar">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Nama" required />
                    </div>
                    <div class="txt_daftar">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="ex: andi@gmail.com" required />
                    </div>
                    <div class="txt_daftar">
                        <label>Nomor Telepon</label>
                        <input type="text" name="nomor" placeholder="ex: 083240329232" required />
                    </div>
                    <div class="txt_daftar">
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Username" required />
                    </div>
                    <div class="txt_daftar">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <div class="txt_daftar">
                        <label>Konfirmasi Password</label>
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
                <a href="loginadmin.php" class="a">Login</a>
            </div>
            </table>
        </form>
    </div>
</body>

</html>