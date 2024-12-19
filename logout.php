<?php
session_start();

include "path.php";

unset($_SESSION['id_user']);
unset($_SESSION['login']);
unset($_SESSION['admin']);


header('location: ' . BASE_URL);
?>