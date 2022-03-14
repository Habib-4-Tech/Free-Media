<?php

$dbhost = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "free";

if (!$connection = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname)) {
    header('Location: error.php');
    die();
}
?>