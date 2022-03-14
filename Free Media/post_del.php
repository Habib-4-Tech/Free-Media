<?php
include('db.php');
require_once("useful.php");
session_start();
LoginCheck();


if (isset($_POST['submit']))
{

    $id=$_POST['Post_id'];
    echo $id;

    $sql= "Delete from comments where Post_id=$id";
    $result= mysqli_query($connection, $sql);
    $sql= "Delete from post where Post_id=$id";

    $result= mysqli_query($connection, $sql);
    echo mysqli_error($connection);
}
    
    header('Location: posts.php' );

?>