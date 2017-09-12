<?php
// Закрываем сессию при нажатии на Выйти
session_start();
session_unset($_SESSION['user']);
$_SESSION = [];
header('Location: index.php');
?>
