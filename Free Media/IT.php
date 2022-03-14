<?php 
include('db.php');
require_once("useful.php");
session_start();
LoginCheck();

 $user_tag = $_SESSION['USER_DATA']['ID'];
 $user_type=$_SESSION['USER_DATA']['STATUS'];

 $sql="insert into dyn(category, User_Tag) Values  ('IT','$user_tag');";
 $result = mysqli_query($connection, $sql);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music</title>

    <style>
        .gg{
    width: 60%
}

        body{
            font-family:  Copperplate, Papyrus, fantasy;
            background-color:#CE4F33;
            background-image: url('g1.jpg');
            background-repeat: repeat-x ;
            background-color:#0099ff;
             background-size: cover;
        }
        </style>

</head>
<body>
<?php 

if ($user_type == 'blogger') {
    include './navb.php';
    
} elseif ($user_type =='reader' ) {
    
    include './navr.php';
}
elseif ($user_type =='admin' )
{
    include './nava.php';
}

?>

<div class="container" style="background-color:rgba(206, 79, 51, 0.7);">
   <h1 align="center" style="font-family:  Copperplate, Papyrus, fantasy;background-color:#CE4F33;">World of IT </H1> </div>




<?php

$sql = "SELECT Post_id,Title,Text,Date, User_Tag FROM post where blog_tag='IT' order by Date DESC" ;
$result = mysqli_query($connection, $sql);

?>
   
   <center>
<div class="gg">
 



    <center>

    <?php
    foreach ($result as $key => $value) {

    ?>
    <div class='gg'>
<div class="card mb-5" align="center" style="background-color:rgba(206, 79, 51, 0.5);">
        <div class="card-body" align="center" style="background-color:rgba(206, 79, 51, 0.5);">
        
        
           
            <div class="row mb-4" align="center" style="background-color:rgba(206, 79, 51, 0.5);">
                
                <h4 align="center"><?=  $value['Title']?></h4> 
    </div>
    <div class="card-body" style="background-color:rgba(206, 79, 51, 0.5);">
        
            <p> Posted by <?= $value['User_Tag']?>  on <?= $value['Date'] ?>  
    </div>

            <a href="details1.php?Post_id=<?= $value['Post_id'] ?> "><button class="button">Read full blog</button></a>
    

    </div>
    </div>
    </div>

    <?php
    }
    ?>

    </center>

    </div>

</div>





</body>
</html>


















