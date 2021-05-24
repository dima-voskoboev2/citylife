<?php
session_start();
require ('../config/connect.php');

$id = $_GET['id'];

if (isset($_POST['no'])) {
    mysqli_query($connect, "UPDATE `impression` SET `status` = '2' WHERE `impression`.`id` = '$id'");
    header ('Location: ../user-posts.php');
}

if (isset($_POST['yes'])) {
    mysqli_query($connect, "UPDATE `impression` SET `status` = '1' WHERE `impression`.`id` = '$id'");
    header ('Location: ../user-posts.php');
}

if (isset($_POST['del'])) {
    mysqli_query($connect, "DELETE FROM `impression` WHERE `impression`.`id` = '$id'");
    header ('Location: ../user-posts.php');
}

?>