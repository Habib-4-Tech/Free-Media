<?php 
include('db.php');
require_once("useful.php");
session_start();
LoginCheck();

 $user_tag = $_SESSION['USER_DATA']['ID'];

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My posts</title>
    <style>
    .button {
  border: none;
  color: white;
  border-radius: 2px;
  padding: 5px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  margin: 4px 2px;
  cursor: pointer;
  background-color: #CE4F33;
  
}
.gg{
    width: 50%
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
include './navb.php';
?>

<div class="container" style="background-color:rgba(206, 79, 51, 0.7);">
   <h1 align="center" style="font-family:  Copperplate, Papyrus, fantasy;background-color:#CE4F33;"> My posts </H1> 

    </div>


<?php

$sql = "SELECT * FROM post where User_Tag= '$user_tag'";

$result = mysqli_query($connection, $sql);

?>
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
            <a href="update.php?Post_id=<?= $value['Post_id'] ?> "><button class="button">Edit</button> </a> <br>
            <form action="user_delete.php" method="post">

            <button type="submit" class="button" name="submit" >Delete</button>
          </right>
            <input type="text" class="form-control" id="Post_id"  name="Post_id" value='<?= $value['Post_id']?>' hidden >
             </form>


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