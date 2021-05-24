<?php
$connect = mysqli_connect('localhost', 'root', 'root', 'demo-v1');

mysqli_query($connect,"ALTER TABLE `users` AUTO_INCREMENT = 1");
mysqli_query($connect,"ALTER TABLE `products` AUTO_INCREMENT = 1");
mysqli_query($connect,"ALTER TABLE `comments` AUTO_INCREMENT = 1");
?>