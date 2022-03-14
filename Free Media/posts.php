<?php 
include('db.php');
require_once("useful.php");
session_start();
LoginCheck();
$z='';
$tag= '';

 $user_tag = $_SESSION['USER_DATA']['ID'];
 $sql="insert into dyn(category, User_Tag) Values  ('Sports','$user_tag');";
 $result = mysqli_query($connection, $sql);
?>




<?php
$x=$_SESSION['USER_DATA']['STATUS'];

  if($x=='reader'||$x=='blogger')
  {
    header("Location: notallowed.php");
  }
?>






<?php


if (isset($_POST['submit']))
    {
        $tag= $_POST['blog_tag'];
        $z=1;
    }

    ?>

<?php
    if($z!=1)
    {
        $sql = "SELECT Post_id,Title,Text,Date, User_Tag,blog_tag FROM post";
        $result = mysqli_query($connection, $sql);
    }
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports</title>

    <style>

        body{
            font-family:  Copperplate, Papyrus, fantasy;
            background-color:#CE4F33;
            background-image: url('g1.jpg');
            background-repeat: repeat-x ;
            background-color:#0099ff;
             background-size: cover;
        }
        </style>
<?php include('beautify.php');?>
</head>
<body>


<?php 
include './nava.php';
?>
<div class="container" style="background-color:rgba(206, 79, 51, 0.7);">


<div class="card" style="background-color:rgba(206, 79, 51, 0.5);">
        <div class="card-body" style="background-color:rgba(206, 79, 51, 0.5);">
        <form action="posts.php" method="post" class="needs-validation"  novalidate   enctype="multipart/form-data">
            <!-- select community -->
            <div class="row mb-3" style="background-color:rgba(206, 79, 51, 0.5);">
                <div class="col-sm-8" style="background-color:rgba(206, 79, 51, 0.5);">
                    <label for="comm" class="form-label">Filter using blog type:  . </label>
                    <select class="form-select" id="blog_tag" name="blog_tag" aria-label="Default select example">
                   
                   
 
                            <option  value="Sports"> Sports </option>";

                            <option  value="Business"> Business </option>";

                            <option  value="Fashion">Fashion </option>";
                            <option  value="Music"> Music </option>";
                            <option  value="Fitness"> Fitness </option>";
                            <option  value="Food"> Food</option>";
                            <option  value="Politics"> Politics </option>";
                            <option  value="Science"> Science </option>";
                            <option  value="IT"> IT </option>";
                            <option  value="Gaming"> Gaming </option>";

                        
                
               
                   
                    </select>

                    <button type="submit" class="btn btn-primary" name="submit">Apply</button>
                </div>
            </div>


<?php
if($z==1)
{
$sql = "SELECT * FROM post where blog_tag='$tag'";
$result = mysqli_query($connection, $sql);
}
?>
  




    <div class="card" style="background-color:rgba(206, 79, 51, 0.5);">
        
<table border="1" cellspacing="0" cellpadding="0" style="margin:auto">
    <tr style="text-align:center">
        <td colspan="9"> <b>Posts</b></td>

    </tr>

    <tr>
        <th>Post ID</th>
        <th>Title</th>
        <th>Text</th>
        <th>Blogger</th>
        <th>Date Posted</th>
        <th>Blog Type</th>
        <th>Action</th>

    </tr>

    <?php
    foreach ($result as $key => $value) {
        

    ?>
        <tr>
            <td><?= $value['Post_id'] ?></td>
            <td><?= $value['Title'] ?></td>
            <td><?= $value['Text'] ?></td>
            <td><?= $value['User_Tag'] ?></td>

            <td><?= $value['Date'] ?></td>
            <td><?= $value['blog_tag'] ?></td>

            <td> 
                
            <form action="post_del.php" method="post">

            <button type="submit" class="button" name="submit" >Delete</button>
          </right>
            <input type="text" class="form-control" id="Post_id"  name="Post_id" value='<?= $value['Post_id']?>' hidden >
             </form>
    </td>
        </tr>

        

   <?php
    }
?>
</div>





</body>
</html>


















