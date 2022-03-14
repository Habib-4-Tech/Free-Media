<?php
include('db.php');
require_once("useful.php");
session_start();
LoginCheck();


if (isset($_POST['submit']))
{
    $C_text=$_POST['text'];
    $Post_id=$_POST['Post_id'];
    $user_tag=$_POST['user_tag'];


    $C_text = mysqli_real_escape_string($connection, $C_text);

    $sql="INSERT INTO comments( Text,Post_id,User_Tag)values('$C_text', $Post_id,'$user_tag')";
    if (mysqli_query($connection, $sql)) {
        echo "<h3>Your Comment has been posted.</h3>";

    } else {
        echo "ERROR! Comment wasn't posted please try again <br>" . mysqli_error($connection);
    }
   
    header('Location: details1.php?Post_id='.$Post_id );

}


mysqli_close($connection);
?>
