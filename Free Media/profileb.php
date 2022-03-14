
<?php
session_start();

include('db.php');
require_once("useful.php");

LoginCheck();

$user_tag = $_SESSION['USER_DATA']['ID'];
$N_Link=NULL;

?>

<?php

$sql="Select *  from user_data where User_Tag= "."'$user_tag' ";
$result = mysqli_query($connection, $sql);


$result = mysqli_fetch_assoc($result);


$name= $result['Name'];
$email= $result['Email'];
$Country= $result['Country'];
$gender=$result['gender'];

$age= $result['age'];
$N_Link=$result['pic'];

$sql="Select count(Post_id) as total from post where User_Tag='$user_tag'";
$result = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($result);
$total=$result['total'];




?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Blogger's Home Page</title>

    <style>

sup{
color:#FF0000;
}

    .error {
        color: #FF0000;
    }


    body{
        font-family:  Copperplate, Papyrus, fantasy;
        background-color:#CE4F33;
        background-image: url('g2.jpg');
        background-repeat: repeat-x ;
        background-color:#0099ff;
         background-size: cover;
    }
    .button {
border: none;
color: black;
border-radius: 2px;
padding: 5px 7px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 12px;
margin: 4px 2px;
cursor: pointer;
}


</style>




</head>
<body>

<?php 
include './navb.php';
?>



<h1> Blogger's home page</h1>



<div class="container" style="background-color:rgba(206, 79, 51, 0.7);">
<?php
                    if($N_Link!=NULL)
                    {
                        ?>
                        <div class="mb-3" style="background-color:rgba(206, 79, 51, 0.5);"  >
                        <img src="<?= $N_Link?>" style="width:400px;height:250px" >
                    </div>
                        <?php

                    }
                    ?>
                    <br>

        <div class="card" style="background-color:rgba(206, 79, 51, 0.5);">
        <div class="card-body" style="background-color:rgba(206, 79, 51, 0.5);">
      
        <table>
         <tr> <td> <h3> User Tag : </td><td> </td><td> <?= $user_tag?></td></h3></tr>
         <tr> <td> <h3> Name : </td><td> </td><td> <?= $name?></td></h3></tr>
         <tr> <td> <h3> Email  : </td><td> </td><td> <?= $email?></td></h3></tr>
         <tr> <td> <h3> Country : </td> <td></td><td> <?= $Country?></td></h3></tr>
         <tr> <td> <h3> Gender : </td> <td></td><td> <?= $gender?></td></h3></tr>
         <tr> <td> <h3> Age  : </td> <td></td><td> <?= $age?></td></h3></tr>
         <tr> <td> <h3> Total Number of Blogs : </td><td> </td><td> <?= $total?></td></h3></tr>
           
           <table>
        
           <div class="mb-3" style="background-color:rgba(206, 79, 51, 0.5);"> 
          
          
           <form action="propic.php" method="post" class="needs-validation"  novalidate  enctype="multipart/form-data">

           <div class="mb-3" style="background-color:rgba(206, 79, 51, 0.5);">
              <button type="submit" class="btn btn-primary" name="submit">Add/Update Profile Pic  </button> 
            <input class="form-control" type="file" name="pfiles[]" id="formFileMultiple" required>
            </div>
            <input type="text" class="form-control" id="user_tag"  name="user_tag" value='<?= $user_tag?>' hidden >
            </form>
                </div>

        
         
  
 
        </div>
    
     </div>
   
 
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
 
   
  </body>
</html>