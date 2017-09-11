<?php
// Закрываем сессию при нажатии на Выйти
if ($_GET["login"] == 2) {
    session_start();
    session_unset($_SESSION['user']);
    $_SESSION = [];
    header('Location: index.php');
};
?>
