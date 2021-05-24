<?php
session_start();
require ('../config/connect.php');

$id = $_GET['id'];

if (isset($_POST['ban'])) {
    mysqli_query($connect, "UPDATE `users` SET `status` = '1' WHERE `users`.`id` = '$id'");
    header ('Location: ../admin-user-list.php');
}

if (isset($_POST['unban'])) {
    mysqli_query($connect, "UPDATE `users` SET `status` = '0' WHERE `users`.`id` = '$id'");
    header ('Location: ../admin-user-list.php');
}
?>