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
  if($user_type=='admin')
  {
    header("Location: notallowed.php");
  }
?>


<?php
  if($priv!=1)
  {
    header("Location: error.php");
  }
?>



<?php
$curr_password = $Conf_password = $Password = "";

$FlagError=0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    if (empty($_POST["c_password"])) {
        echo "Current password is required";
        $FlagError= 1;

    } else {
        $curr_password = test_input($_POST["c_password"]);

        $sql = "select * from user_data where User_Tag  = '$user_tag '";
        $result = mysqli_query($connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {

            $User = mysqli_fetch_assoc($result);

            if ($User['Password'] != $curr_password) {
               echo "Current Password is not Matched";
               $FlagError= 1;
            }
        }
    }
 

    if (empty($_POST["password"])) {
        echo "New Password is required";
        $FlagError = 1;
      } else {
        $Password = test_input($_POST["password"]);
        if (!(preg_match('/^[A-Za-z0-9\!@#$%^&*()]{8,20}$/', $Password) &&  
          preg_match('/[A-Z]/',  $Password) &&
          preg_match('/[0-9]/', $Password)&& 
          preg_match('/[a-z]/',  $Password)&& 
          preg_match('/[!@#$%^&*()]/',  $Password)
          
          )) 
    {
        echo "Invalid password";
        $FlagError = 1;
    }
    else{}
      }
  //}

    if (empty($_POST["conf_password"])) {
       
        $FlagError= 1;
    } else {
        $Conf_password = test_input($_POST["conf_password"]);
        if ($Password != $Conf_password) {
            echo "Confirm Password Incorrect";
            $FlagError= 1;
        }
    }


   

    if (  $FlagError ==0) {





        $sql = "UPDATE user_data SET Password = '$Password' WHERE User_Tag= '$user_tag' ";

        if (mysqli_query($connection, $sql)) {

            echo "<h3>Passwordhas been update  in database successfully.";

           
            mysqli_close($connection);


            if ($user_type == 'blogger') {
                header("Location: profileb.php");
                die;
            } elseif ($user_type =='reader' ) {
                header("Location: profiler.php");
                die;
            }
        

          
        } else {

            echo "ERROR! Password wasn't Updated successfully <br>" . mysqli_error($connection);

            
            mysqli_close($connection);

            header("Location:changePass.php");
            die;
        }
    }



   
  





}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>















<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
 
    <title>Change Password</title>
    <style>

    sup{
  color:#FF0000;
}

        .error {
            color: #FF0000;
        }

        .gg{
    width: 40%
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

<center>

<div class="gg">

<div class="container" style="background-color:rgba(206, 79, 51, 0.7);">
   <h1 align="center" style="font-family:  Copperplate, Papyrus, fantasy;background-color:#CE4F33;">Change Password</H1> </div>


<form action="changepass.php" method="post" class="needs-validation"     enctype="multipart/form-data">
    


    <div class="mb-3" style="background-color:rgba(206, 79, 51, 0.5);">
            <label for="c_password" class="form-label">Current password</label> 
            <input type="password" class="form-control" id="c_password"  name="c_password" required>
            <div class="valid-feedback" style="background-color:rgba(206, 79, 51, 0.5);">Valid.</div>
              <div class="invalid-feedback" style="background-color:rgba(206, 79, 51, 0.5);">Please fill out this field.</div>
            </div>


            <div class="mb-3" style="background-color:rgba(206, 79, 51, 0.5);">
            <label for="password" class="form-label">New Password</label> 
            <input type="password" class="form-control" id="password"  name="password" required>
            <div class="valid-feedback" style="background-color:rgba(206, 79, 51, 0.5);">Valid.</div>
              <div class="invalid-feedback" style="background-color:rgba(206, 79, 51, 0.5);">Please fill out this field.</div>
            </div>

            <div class="mb-3" style="background-color:rgba(206, 79, 51, 0.5);">
            <label for="conf_password" class="form-label">Retype Password</label> 
            <input type="password" class="form-control" id="conf_password"  name="conf_password" required>
            <div class="valid-feedback" style="background-color:rgba(206, 79, 51, 0.5);">Valid.</div>
              <div class="invalid-feedback" style="background-color:rgba(206, 79, 51, 0.5);">Please fill out this field.</div>
            </div>






    

            <button type="submit" class="btn btn-primary" name="submit">Change</button>

</form>
</center>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
 
</body>
</html>
