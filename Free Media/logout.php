<?php
session_start();


if (isset($_SESSION['USER_DATA'])) {

    unset($_SESSION['USER_DATA']);
}

header("Location:login.php");
?>