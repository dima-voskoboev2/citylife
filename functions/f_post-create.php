<?php
session_start();
require ('../config/connect.php');

$id = $_SESSION['user']['id'];
$username = $_SESSION['user']['username'];
$description = $_POST['description'];

	if ($_FILES['image']['name'] != '') 
	{
		$url = 'post_images/'.time().'-'.$_FILES['image']['name'];

	}
$date = date('Y-m-d H:i:s');
$namepost = $_POST['namepost'];

if ($description != '' && $namepost != '' && $_FILES != '') {
	
	if ($_FILES['image']['name'] != '')
	{
		if (!move_uploaded_file($_FILES['image']['tmp_name'], '../'.$url)) {
			$_SESSION['message'] = 'Ошибка при загрузке файла';
			header ('Location: ../user-post-create.php');
			die();
		}
	}

    mysqli_query($connect, "INSERT INTO `impression` (`id_user`,`username`, `name`, `description`, `image`, `date`) VALUES ('$id', '$username', '$namepost','$description', '$url', '$date')");
    $_SESSION['message'] = 'Впечатление успешно добавлен!';
    header ('Location: ../user-post-create.php');
} else {
    header ('Location: ../user-post-create.php');
}
?>