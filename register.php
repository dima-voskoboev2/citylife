<?php
session_start();
require ('config/connect.php');

if ($_SESSION['user']) {
  header ('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Регистрация - Жизнь города</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>

  <!-- header -->
  <?php require ('components/header.php'); ?>
  <!-- / header -->

  <div class="container pt-5">
    <h2 class="mb-4">Регистрация</h2>

    <p style="color: red;">
      <?php if ($_SESSION['message']) { echo $_SESSION['message']; } unset ($_SESSION['message']); ?>
    </p>

    <form action="/functions/f_register.php" method="POST">
      <div class="form-group">
        <label>Имя</label>
        <input type="text" name="username" class="form-control" placeholder="Введите ваше имя" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" placeholder="Введите email" required>
      </div>
      <div class="form-group">
        <label>Пароль</label>
        <input type="password" name="password" class="form-control" placeholder="Введите пароль" required>
      </div>
      <div class="form-group">
        <label>Повтор пароля</label>
        <input type="password" name="password_confirm" class="form-control" placeholder="Повторите пароль" required>
      </div>
      <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>
  </div><BR>
 

<?php require('components/footer.php'); ?>
</body>

</html>