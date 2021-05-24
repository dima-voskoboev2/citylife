<?php
session_start();
require ('config/connect.php');

$impression = mysqli_query($connect, "SELECT * FROM `impression` ORDER BY `status` ASC");

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
  <title>Список впечатлений - Жизнь города</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
	

  <!-- header -->
  <?php require ('components/header.php'); ?>
  <!-- / header -->

  <div class="container pt-5">
    <h2 class="mb-4">Список впечатлений</h2>

    <table class="table">
      <tr>
        <th>ID</th>
        <th>Опубликовал</th>
        <th>Изображение</th>
		<th>Заголовок</th>
        <th>Содержание</th>
        <th>Статус</th>
        <th>Модерация</th>

      </tr>
      <?php while ($product = mysqli_fetch_assoc($impression)) { ?>
      <tr>
        <td><?php echo $product['id']; ?></td>
        <td><?php echo $product['username']; ?></td>
        <td>
			<?php if ($product['image'] != "") { ?>
          <img id="myImg" src="/<?php echo $product['image']; ?>" alt="image" style="height: 80px;">
		  <?php } else {?>
		  <img src="/assets/images/not-available.png" alt="image" style="height: 80px;">
		   <?php } ?>
		   

	<!-- The Modal -->
	<div id="myModal" class="modal">
	  <span class="close2">×</span>
	  <img class="modal-content" id="img01">
	  <div id="caption"></div>
	</div>
		   
        </td>
		<td><?php echo $product['name']; ?></td>
   
   <div id="zatemnenie">
      <div id="okno">
        <?php echo $product['description']; ?><br>
        <a href="#" class="close">Закрыть окно</a>
      </div>
    </div>   
   
   
		
		
		<td><a href='#zatemnenie'Style='float:right;color: #212529;'>
        <?php echo mb_strimwidth($product['description'], 0, 100, "..."); ?></a></td>
		
        <td><?php require ('config/admin-post-list_status.php'); ?></td>
        <td>
            <div class="box" style="display: flex">
			<?php if ($product['status'] == 1) { ?>
              <form action="/functions/f_post-mod.php?id=<?php echo $product['id']; ?>" method="POST">
                <button type="submit" name="no" role="button" class="btn btn-danger">Отклонить</button>
              </form>
			  <?php } if ($product['status'] == 2) { ?>
              <form action="/functions/f_post-mod.php?id=<?php echo $product['id']; ?>" method="POST">
                <button type="submit" name="yes" role="button" class="btn btn-success">Одобрить</button>
              </form>
			  <?php } ?>


			<?php if ($product['status'] == 0) { ?>
              <form action="/functions/f_post-mod.php?id=<?php echo $product['id']; ?>" method="POST">
                <button type="submit" name="no" role="button" class="btn btn-danger">Отклонить</button>
              </form>
              <form action="/functions/f_post-mod.php?id=<?php echo $product['id']; ?>" method="POST">
                <button type="submit" name="yes" role="button" class="btn btn-success">Одобрить</button>
              </form>
			  <?php } ?>
            </div>
			<BR>
		  <form action="/functions/f_post-mod.php?id=<?php echo $product['id']; ?>" method="POST">
                <button type="submit" name="del" role="button" class="btn btn-danger">Удалить</button>
		  </form>
	
        </td>
		
      </tr>
    <?php } ?>
    </table>
  </div>
 </div></div>


<?php require('components/footer.php'); ?>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close2")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
</script>

</body>

</html>