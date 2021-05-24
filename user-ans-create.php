<?php
session_start();
require('config/connect.php');

// Статус 0 - Комментарий на модерации
// Статус 1 - Комментарий одобрен
// Статус 2 - Комментарий отклонен

$user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `users`"));

// БД продукты с фильрацией по убыванию (по новизне)
$impression = mysqli_query($connect, "SELECT * FROM `impression` WHERE `status` = 1 ORDER BY `id` DESC");
?>


<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Создание запроса - Жизнь города</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>

  <!-- header -->
  <?php require('components/header.php'); ?>
  <!-- / header -->

  <div class="container pt-5">
    <?php if ($_SESSION['user'] && $user['status'] == 0) { ?>
      <h2 class="mb-4">Создание запроса</h2>

      <p style="color: green;"><?php if ($_SESSION['message']) { echo $_SESSION['message']; } unset($_SESSION['message']); ?></p>
	  <p>Уважаемые граждане! В целях оперативного рассмотрения ваших обращений просим максимально точно изложить суть вопроса и имеющиеся факты.</p>

      <form action="/functions/f_post-create.php" method="POST" enctype="multipart/form-data">
        <div class="custom-file form-group">
          <input type="file" name="image" class="custom-file-input" accept="image/jpeg, image/jpg, image/png" >
          <label class="custom-file-label">Выберите изображение</label>
        </div>
        <div class="mt-3 form-group">
          <input maxlength="100" size="40" name="namepost" class="form-control" cols="30" rows="3" placeholder="Введите заголовок" required></input>
        </div>
        <div class="mt-3 form-group">
          <textarea  maxlength="2000" name="description" class="form-control" cols="30" rows="3" placeholder="Введите текст" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Создать запрос</button>
      </form>
    <?php } ?><BR><BR><BR><BR><BR><BR>

  </div></div>


<?php require('components/footer.php'); ?>
</body>

</html>