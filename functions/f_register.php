<?php
session_start();
require ('../config/connect.php');

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ($username != '' && $email != '' && $password != ''&& $password_confirm != '') {
    $check_email = mysqli_query($connect, "SELECT * FROM `users`");
    while ($user = mysqli_fetch_assoc($check_email)) {
        if ($user['email'] === $email) {
            $_SESSION['message'] = 'Данная почта уже зарегистрировна!';
            header ('Location: ../register.php');
            die();
        }
    }

    if ($password != $password_confirm) {
        $_SESSION['message'] = 'Пароли не совпадают!';
        header ('Location: ../register.php');
        die();
    }

    mysqli_query($connect, "INSERT INTO `users` (`username`, `email`, `password`) VALUES ('$username', '$email', '$password')");
    $_SESSION['message'] = 'Регистрация прошла успешно!';
    header ('Location: ../login.php');
} else {
    header ('Location: ../register.php');
}
?>