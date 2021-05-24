<?php
session_start();
require ('../config/connect.php');

unset ($_SESSION['user']);
session_destroy();

header ('Location: ../index.php');
?>