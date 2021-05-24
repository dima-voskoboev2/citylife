<?php
session_start();
require ('../config/connect.php');

$email = $_POST['email'];
$password = $_POST['password'];

$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

if (mysqli_num_rows($check_user) > 0) {
    $user = mysqli_fetch_assoc($check_user);

    $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['username'],
        'email' => $user['email'],
        'password' => $user['password'],
        'flag' => $user['flag'],
        'status' => $user['status']
    ];

    if (!$_SESSION['user']['status'] == 0) {
    $_SESSION['message'] = "Вы заблокированый пользователь!";
    header ('Location: ../login.php');
    unset ($_SESSION['user']);
    die();
    }

    header ('Location: ../index.php');
} else {
    $_SESSION['message'] = "Ошибка авторизации!";
    header ('Location: ../login.php');
}
?>