<?php
$host = "localhost";
$user = "postgres";
$password = "tes";
$dbname = "tokodb";

$conn = pg_connect("host=localhost port=5432 dbname=$dbname user=$user password=$password");
if(!$conn){
    die("Koneksi gagal");
}
else

?>

