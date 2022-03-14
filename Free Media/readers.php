<?php 
include('db.php');
require_once("useful.php");
session_start();
LoginCheck();

 $user_tag = $_SESSION['USER_DATA']['ID'];

?>

<?php
$x=$_SESSION['USER_DATA']['STATUS'];

  if($x=='reader'||$x=='blogger')
  {
    header("Location: notallowed.php");
  }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Readers</title>
    <style>

        body{
           
            background-color:#CE4F33;
            background-image: url('g1.jpg');
            background-repeat: repeat-x ;
            background-color:#0099ff;
             background-size: cover;
        }
            table, th, td {
         border: 3px solid black;
         padding: 5px
        }


        </style>
</head>
<body>
    


<?php 
include './nava.php';
?>

<?php

$sql = "SELECT * FROM user_data where Type='reader'";
$result = mysqli_query($connection, $sql);

?>
 <div class="card" style="background-color:rgba(206, 79, 51, 0.5);">
        <div class="card-body" style="background-color:rgba(206, 79, 51, 0.5);">
<table border="1" cellspacing="0" cellpadding="0" style="margin:auto">
    <tr style="text-align:center">
        <td colspan="9"> <b>Readers</b></td>

    </tr>

    <tr>
        <th>User_Tag</th>
        <th>Name</th>
        <th>Email</th>
        <th>Country</th>
        <th>Date of Birth</th>
        <th>Age</th>
        <th> Gender</th>
        <th> Privilege</th>
        <th> Action</th>


    </tr>
    <?php
    foreach ($result as $key => $value) {
      
    ?>
        <tr>
            <td><?= $value['User_Tag'] ?></td>
            <td><?= $value['Name'] ?></td>
            <td><?= $value['Email'] ?></td>
            <td><?= $value['Country'] ?></td>

            <td><?= $value['DateOfBirth'] ?></td>
            <td><?= $value['age'] ?></td>
            <td><?= $value['gender'] ?></td>
            <td><?= $value['priv'] ?></td>

            <td> 
                
            <form action="priv_r.php" method="post">

            <button type="submit" class="button" name="submit" >Change Privilege</button>
          </right>
            <input type="text" class="form-control" id="reader_tag"  name="reader_tag" value='<?= $value['User_Tag']?>' hidden >
             </form>
    </td>
        </tr>

        

   <?php
    }
?>




</div>
</div>
</div>






</body>
</html>