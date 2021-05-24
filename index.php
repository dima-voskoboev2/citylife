<?php
session_start();
require('config/connect.php');

// Статус 0 - Комментарий на модерации
// Статус 1 - Комментарий одобрен
// Статус 2 - Комментарий отклонен

$user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `users`"));

// БД продукты с фильрацией по убыванию (по новизне)
$impression = mysqli_query($connect, "SELECT * FROM `impression` WHERE `status` = 1 ORDER BY `id` DESC LIMIT 2");
?>


<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Жизнь города - информационная система</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  
</head>

<body>
  <!-- header -->
  <?php require('components/header.php'); ?>
  <!-- / header -->
	<div id="slider"><img src=""></div>
	<a href="/user-post-create.php"><img src="/assets/images/pngegg.png" style="position: absolute; top: 310px; left: 1377px;width: 180px;height:80px;"/></a>

	<div class="container pt-5">

	<h2 class="mt-5 mb-4">Возможности</h2>
	<div class="columns">
	  <ul class="price">
		<li class="header">Предложение по улучшению города</li>
		<li><img src="/assets/images/pngtree.jpg" width="200" height="200"/></li>
		<li>Ответ в течение 24 часов</li>
		<li>Ответ поступит на почту/чат</li>
		<li>Одновременно до 25 улучшений</li>
		<li class="grey"><a href="#" class="buttons2">Предложить улучшение</a></li>
	  </ul>
	</div>

	<div class="columns">
	  <ul class="price">
		<li class="header">Сообщить о проблеме/задать вопрос</li>
		<li><img src="/assets/images/problem.jpg" width="200" height="200"/></li>
		<li>Ответ в течение 24 часов</li>
		<li>Ответ поступит на почту/чат</li>
		<li>Одновременно до 10 вопросов</li>
		<li class="grey"><a href="#" class="buttons2">Задать вопрос</a></li>
	  </ul>
	</div>

	<div class="columns">
	  <ul class="price">
		<li class="header">Вызвать экстренную службу</li>
		<li><img src="/assets/images/83817.jpg" width="200" height="200"/></li>
		<li>Помощь моментально</li>
		<li>Ответ сообщением сразу</li>
		<li>Одновременно до 3-х служб</li>
		<li class="grey"><a href="#" class="buttons2">Вызвать ЭС</a></li>
	  </ul>
	</div>

	<h2 class="mt-5 mb-4">Последние впечатления</h2>

    <div>
    <?php while ($product = mysqli_fetch_assoc($impression)) { ?>
      <div class="card mb-5">
        <div class="card-body">
		          <div class="d-flex justify-content-between">
            <h4 class="card-title"><?php echo $product['name']; ?></h4>
            <span class="text-muted"><?php echo $product['date']; ?></span>
          </div>
		  <p class="card-text py-3"><?php echo $product['description']; ?></p>
		  
		  <?php if ($product['image'] != "") { ?>
          <div style="height: 350px;"><img src="/<?php echo $product['image']; ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="image"></div>
          <?php } ?>


		   
          <div class="comments mt-3">
			<?php if ($_SESSION['user'] && $user['status'] == 0) { ?>
			<button class="collapsible">Комментарии</button>
			<div class="contents">
				<div class="card">
					<div class="card-body">
					  <form action="/functions/f_add-comment.php?id_product=<?php echo $product['id']; ?>" method="POST">
						<div class="form-group">
						  <textarea name="description" cols="30" rows="3" class="form-control" placeholder="Введите комментарий" required></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Оставить комментарий</button>
					  </form>
					</div>
				  </div>

				<?php $comments = mysqli_query($connect, "SELECT * FROM `comments` WHERE `id_product` = '{$product['id']}' ORDER BY `date` DESC"); while ($comment = mysqli_fetch_assoc($comments)) { ?>
				  <div class="card mt-3">
					<div class="card-body py-2 px-3">
					  <blockquote class="blockquote mb-0" style="font-size: 16px;">
						<p class="mb-2"><?php echo $comment['description']; ?></p>
						<footer class="blockquote-footer">
						  <cite title="Source Title"><?php echo $comment['username']; ?> (<?php echo $comment['date']; ?>)</cite>
						</footer>
					  </blockquote>
					</div>
				  </div>
				<?php } ?>
			</div>
            <?php } ?>

          </div>
        </div>
    </div>
    <?php } ?>
 </div></div>


<?php require('components/footer.php'); ?>

</body>
<script>
	var images = ['main.png', 'main2.png', 'main3.png'];

	var slider = document.querySelector('#slider');
	var img = slider.querySelector('img');

	var i = 1;
	img.src = 'assets/images/' + images[0];

	window.setInterval(function() {
		
		img.src = 'assets/images/' + images[i];
		
		i++;
		
		if (i == images.length) {
			i = 0;
		}
	}, 5000);


	var coll = document.getElementsByClassName("collapsible");
	var is;

	for (is = 0; is < coll.length; is++) {
		coll[is].addEventListener("click", function() {
			this.classList.toggle("active");
			var contents = this.nextElementSibling;
			if (contents.style.display === "block") {
				contents.style.display = "none";
			} else {
				contents.style.display = "block";
			}
		});
	}
</script>

</html>