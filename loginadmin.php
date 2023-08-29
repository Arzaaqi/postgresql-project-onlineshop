<?php
session_start();
$error = isset($_GET['error']) ? $_GET['error'] : false;
$pwerror = isset($_GET['pwerror']) ? $_GET['pwerror'] : false;
?>

<html>

<head>
    <title>
        Login Admin
    </title>
    <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <div class="container">
        <div class="wrapper">
        <div class="title"><span>Masuk Admin</span></div>
        <form method="post" action="loginadminaksi.php">
            <label style="<?php echo $error ? 'display:flex;' : 'display:none;' ?> margin: 0px;">
                <div class="text">
                    Username Tidak Ditemukan
                </div>
            </label>
            <label style="<?php echo $pwerror ? 'display:flex;' : 'display:none;' ?> margin: 0px;">
                <p class="text">
                    Password Salah
                </p>
            </label>
            <div class="row">
                <i class="fas fa-user"></i>
                <input placeholder="Username" vtype="text" name="username" required />
            </div>
            
            <div class="row">
                <i class="fas fa-lock"></i>
                <input placeholder="Password" type="password" name="password" required />
            </div>
            
            <div class="row button">
            <input type="submit" name="login" value="Login" class="button" />
            </div>
            
            <div class="signup-link">Belum Punya Akun?
                <a href="regisadmin.php">Daftar</a>
            </div>
        </form>
        </div>
    </div>

</body>

</html>