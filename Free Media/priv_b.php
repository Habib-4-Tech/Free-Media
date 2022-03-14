<?php
include('db.php');
require_once("useful.php");
session_start();
LoginCheck();


if (isset($_POST['submit']))
{
   
    $user_tag=$_POST['blogger_tag']; 

    $sql=" Select * from user_data where `User_Tag` = '$user_tag'; ";
   $result= mysqli_query($connection, $sql);
   $result=mysqli_fetch_assoc($result);
   $priv= $result['priv'];
   
   if( $priv==1)
   {

    $sql="UPDATE `user_data` SET `priv` = '0' WHERE `user_data`.`User_Tag` = '$user_tag';";
    if (mysqli_query($connection, $sql)) {
        header('Location: bloggers.php' );

    } else {
     mysqli_error($connection);
    }
    }
   if($priv==0) 
   {
    $sql="UPDATE `user_data` SET `priv` = '1' WHERE `user_data`.`User_Tag` = '$user_tag';";
    if (mysqli_query($connection, $sql)) {
        header('Location: bloggers.php' );

    } else {
     mysqli_error($connection);
    }

}
}

mysqli_close($connection);
?>
