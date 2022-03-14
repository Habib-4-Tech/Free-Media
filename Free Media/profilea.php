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


?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Admin Profile</title>
    <?php
    include('beautify.php'); ?>
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
font-size: 18px;
margin: 4px 2px;
cursor: pointer;
}


</style>




</head>









<body>



<?php include './nava.php'; ?>


    

<h1> Admin's home page</h1>


<div class="container" style="background-color:rgba(206, 79, 51, 0.7);">
         
                    
                   

        <div class="card" style="background-color:rgba(206, 79, 51, 0.5);">
        <div class="card-body" style="background-color:rgba(206, 79, 51, 0.5);">
      
        <table>
         <tr> <td> <h3> User Tag : </td><td> </td><td> <?= $user_tag?></td></h3></tr>
         <tr> <td> <h3> Name : </td><td> </td><td> <?= $name?></td></h3></tr>
         <tr> <td> <h3> Email  : </td><td> </td><td> <?= $email?></td></h3></tr>
         <tr> <td> <h3> Country : </td> <td></td><td> <?= $Country?></td></h3></tr>
         <tr> <td> <h3> Gender : </td> <td></td><td> <?= $gender?></td></h3></tr>
         <tr> <td> <h3> Age  : </td> <td></td><td> <?= $age?></td></h3></tr>
           
           <table>
        
           <div class="mb-3" style="background-color:rgba(206, 79, 51, 0.5);"> 
          
          
          


             <a href="bloggers.php"> <button class="button "> Manage Bloggers</button></a></h3>   
             <a href="readers.php"> <button class="button "> Manage Readers</button></a></h3>  
             <a href="posts.php"> <button class="button "> Manage Posts</button></a></h3>  




        
         
  
 
        </div>
    
     </div>
   
 
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
 
   
  </body>
</html>