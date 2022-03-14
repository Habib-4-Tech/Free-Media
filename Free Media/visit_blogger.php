<?php 
include('db.php');
require_once("useful.php");
session_start();
LoginCheck();

 $user_tag = $_SESSION['USER_DATA']['ID'];
 $user_type=$_SESSION['USER_DATA']['STATUS'];
 $N_Link=NULL;
?>
<?php

if (isset($_POST['blogger_tag']))
{

$blogger_tag=$_POST['blogger_tag'];

$sql="Select *  from user_data where User_Tag='$blogger_tag' ";



$result = mysqli_query($connection, $sql);

    if (mysqli_query($connection, $sql)) {
     
    } else {
        echo "ERROR! <br>" . mysqli_error($connection);
    }




$result = mysqli_fetch_assoc($result);


$Name= $result['Name'];


$Email= $result['Email'];

$Country= $result['Country'];
$Age= $result['age'];
$Gender= $result ['gender'];

$N_Link=$result ['pic'];

$sql="Select count(Post_id) as total from post where User_Tag='$blogger_tag'";
$result = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($result);
$total=$result['total'];

}

else{

    header('Location: ground.php?Post_id='.$Post_id );


}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Blogger</title>

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


<h1> Blogger's Profile</h1>



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
         <tr> <td> <h3> User Tag : </td><td> </td><td> <?= $blogger_tag?></td></h3></tr>
         <tr> <td> <h3> Name : </td><td> </td><td> <?= $Name?></td></h3></tr>
         <tr> <td> <h3> Email  : </td><td> </td><td> <?= $Email?></td></h3></tr>
         <tr> <td> <h3> Country : </td> <td></td><td> <?= $Country?></td></h3></tr>
         <tr> <td> <h3> Gender : </td> <td></td><td> <?= $Gender?></td></h3></tr>
         <tr> <td> <h3> Age  : </td> <td></td><td> <?= $Age?></td></h3></tr>
         <tr> <td> <h3> Total Number of Blogs : </td><td> </td><td> <?= $total?></td></h3></tr>
           
           <table>
        
           
    
     </div>
    
</body>
</html>