<?php 
include('db.php');
require_once("useful.php");
session_start();
LoginCheck();
$user_type=$_SESSION['USER_DATA']['STATUS'];
 $user_tag = $_SESSION['USER_DATA']['ID'];

 $N_title=$N_blog_tag=$N_blog_tag=$C_text='';
$N_Link='';
$priv = $_SESSION['USER_DATA']['PRIV'];

?>

<?php
  if($priv!=1)
  {
    header("Location: error.php");
  }
?>

<?php 


  

if (isset($_GET['Post_id']))
{
$Post_id=$_GET['Post_id'];


$sql= "Select Title,Text, blog_tag,User_Tag,Date,Link  FROM post where Post_id= $Post_id";


$result = mysqli_query($connection, $sql);

$result = mysqli_fetch_assoc($result);

$N_Link=  $result['Link'];

$N_title= $result['Title'];


$N_text= $result['Text'];

$N_blog_tag = $result['blog_tag'];


$N_blogger= $result['User_Tag'];

$N_date= $result['Date'];



$sql= "Select User_Tag,Text  FROM comments where Post_id=$Post_id  ORDER BY date ASC ";

$result = mysqli_query($connection, $sql);



}






mysqli_close($connection);
?>







<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
 
    <title>Details1re</title>
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
            background-image: url('g1.jpg');
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
  <b>
   <div class="container" style="background-color:rgba(206, 79, 51, 0.7);">
   <h1 align="center" style="font-family:  Copperplate, Papyrus, fantasy;background-color:#CE4F33;">World of <?= $N_blog_tag?> </H1> </b>

     
        <div class="card" style="background-color:rgba(206, 79, 51, 0.5);">
        <div class="card-body" style="background-color:rgba(206, 79, 51, 0.5);">
        
        
           
            <div class="row mb-3" style="background-color:rgba(206, 79, 51, 0.5);">
                
                <h2><b><?= $N_title?><b></h2> </b>
            
                <b> <p> Posted by <?= $N_blogger?> </a> on <?= $N_date ?> </b> 

          <right>
            <form action="visit_blogger.php" method="post">

            <button type="submit" class="button" name="submit" >Visit Blogger</button>
          </right>
            <input type="text" class="form-control" id="blogger_tag"  name="blogger_tag" value='<?= $N_blogger?>' hidden >
             </form>
                
            </div>

        
                    <?php
                    if($N_Link!=NULL)
                    {
                        ?>
                        <div class="mb-3" style="background-color:rgba(206, 79, 51, 0.5);">
                        <img src="<?= $N_Link?>" style="width:500px;height:400px" >
                    </div>
                        <?php

                    }
                    ?>
            <br>

            <div class="mb-3" style="background-color:rgba(206, 79, 51, 0.5);">
            <h4> <?= $N_text?></h4>  
            </div>
            <div class="mb-3" style="background-color:rgba(206, 79, 51, 0.5);">
            <h4><b> Comments:<b></h4>
            </div>
            <?php
         foreach ($result as $key => $value) {
             ?>

            <div class="mb-3" style="background-color:rgba(206, 79, 51, 0.5);">

             <?php echo "<h5>". $value['User_Tag']." : ".  $value['Text']."</h5>";?>
             </div>
        <br>
         <?php
         }
         ?>
    
        <form action="createcomment.php" method="post" class="needs-validation"    enctype="multipart/form-data">
            <div class="mb-3" style="background-color:rgba(206, 79, 51, 0.5);">
           
            <textarea class="form-control" id="exampleFormControlTextarea1" name="text" rows="2" required></textarea>  <button type="submit" class="btn btn-primary" name="submit">Post comment</button>
            <div class="valid-feedback" style="background-color:rgba(206, 79, 51, 0.5);"><b>Valid.</b></div>

        
              <div class="invalid-feedback" style="background-color:rgba(206, 79, 51, 0.5);"><b>Please fill out this field.</b></div>

             
            </div>
            <input type="number" class="form-control" id="post_id"  name="Post_id" value='<?= $Post_id?>' hidden >
            <input type="text" class="form-control" id="user_tag"  name="user_tag" value='<?= $user_tag?>' hidden >


        </form>
 
 
        </div>
      <!--  </div>-->
     </div>
   
 
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
 
   
  </body>
</html>
















