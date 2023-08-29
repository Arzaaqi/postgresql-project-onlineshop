<?php
session_start();
include 'connect.php';

$uploadDir = 'E:\Kuliah 2023\Pemrograman Web\phpUAS\Produk';
$nrp = $_SESSION['nrp'];


if(isset($_FILES["image"]["name"])){
    $id = $nrp;
    $name = $_POST["name"];
    $imageName = $_FILES["image"]["name"];
    $imageSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    // Image validation
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $imageName);
    $imageExtension = strtolower(end($imageExtension));
    if (!in_array($imageExtension, $validImageExtension)){
      echo
      "
      <script>
        alert('Invalid Image Extension');
        document.location.href = '../main.php';
      </script>
      ";
    }
    elseif ($imageSize > 1200000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
        document.location.href = '../main.php';
      </script>
      ";
    }
    else{
      $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
      $newImageName .= '.' . $imageExtension;
      $query = "UPDATE upload SET image = '$newImageName' WHERE id = $nrp";
      pg_query($conn, $query);
      move_uploaded_file($tmpName, 'upload/foto/' . $newImageName);
      echo
      "
      <script>
      document.location.href = '../main.php';
      </script>
      ";
    }
  }

pg_close($conn);
?>