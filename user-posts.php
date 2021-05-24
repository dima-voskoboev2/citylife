<?php
session_start();
require ('config/connect.php');

$user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `users`"));


$cards = mysqli_query($connect, "SELECT * FROM `impression` WHERE `id_user` = '{$_SESSION['user']['id']}' ORDER BY `status` ASC");

if (!$_SESSION['user']) {
  header ('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Мои впечатления - Жизнь города</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>

  <!-- header -->
  <?php require ('components/header.php'); ?>
  <!-- / header -->

  <div class="container pt-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
      <h2>Мои впечатления</h2>
      <?php if ($user['status'] == 0) { ?>
        <a href="/user-post-create.php" class="btn btn-primary" role="button">Создать впечатление</a>
      <?php  } ?>
    </div>
    
	
    <div class="list-group">      
      <!-- post -->
      <?php while ($card = mysqli_fetch_assoc($cards)) { ?>
        <div class="d-flex mb-3">
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex">
			<?php if ($card['image'] != "") { ?>
              <div style="width: 150px; height: 100px;">
                <img src="/<?php echo $card['image']; ?>" style="width: 150px; height: 150px; object-fit: cover;" alt="image">
              </div>
			  <?php } else {?>
			  <img src="/assets/images/not-available.png" alt="image" style="height: 110px;">
			   <?php } ?>
			   
			   
			   
              <div class="px-3 py-2">
                
				<b><p class="mb-1"><?php echo $card['name']; ?></p></b>
                <p class="mb-1"><?php echo $card['description']; ?></p>
				<p class="mb-1"><small class="text-muted"><?php echo $card['date']; ?></small></p>
                <?php require ('config/user-posts_status.php'); ?>
              </div>
				  <form action="/functions/f_post-mod-user.php?id=<?php echo $card['id']; ?>" method="POST">
					<button type="submit" name="del" role="button" class="btn btn-danger">Удалить</button>
				  </form>
            </div>
		
 
     
		
          </a>
        </div>
      <?php } ?>
      <!-- /post -->
    </div>
  </div>
  </div></div>


<?php require('components/footer.php'); ?>
</body>

</html>