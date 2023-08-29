<?php 
	session_start();
	if(isset($_SESSION['status_login'])){
        unset($_SESSION['status_login']);
    }
	echo '<script>window.location="loginadmin.php"</script>';
?>