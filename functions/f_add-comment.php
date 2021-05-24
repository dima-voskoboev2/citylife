<?php
session_start();
require ('../config/connect.php');

$id_product = $_GET['id_product'];
$id = $_SESSION['user']['id'];
$username = $_SESSION['user']['username'];
$description = $_POST['description'];

$date = date('Y-m-d H:i:s');

if ($description != '') {
    mysqli_query($connect, "INSERT INTO `comments` (`id_product`, `id_user`, `username`, `description`, `date`) VALUES ('$id_product', '$id', '$username', '$description', '$date')");
    header ('Location: ../index.php');
} else {
    header ('Location: ../index.php');
}
?>