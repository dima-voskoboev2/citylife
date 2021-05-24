<?php
session_start();
require ('config/connect.php');

// Разблокирован - 0
// Заблокирован - 1

$users = mysqli_query($connect, "SELECT * FROM `users`"); 

if (!$_SESSION['user']['flag'] == 1) {
  header ('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Список пользователей - Жизнь города</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>

  <!-- header -->
  <?php require ('components/header.php'); ?>
  <!-- / header -->

  <div class="container pt-5">
    <h2 class="mb-4">Список пользователей</h2>

    <table class="table">
      <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Кол-во впечатлений</th>
        <th>Действия</th>
      </tr>
      <?php while ($user = mysqli_fetch_assoc($users)) { ?>
      <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `impression` WHERE `id_user` = '{$user['id']}'")); ?></td>
        <td>
          <?php if ($user['status'] == 0 && $user['flag'] == 0) { ?>
            <form action="/functions/f_user-mod.php?id=<?php echo $user['id']; ?>" method="POST">
              <button type="submit" name="ban" role="button" class="btn btn-danger">Заблокировать</button>
            </form>
          <?php } if ($user['status'] != 0 && $user['flag'] == 0) { ?>
            <form action="/functions/f_user-mod.php?id=<?php echo $user['id']; ?>" method="POST">
              <button type="submit" name="unban" role="button" class="btn btn-success">Разблокировать</button>
            </form>
          <?php } ?>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>
 </div></div>


<?php require('components/footer.php'); ?>
</body>

</html>