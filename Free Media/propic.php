<?php
session_start();

include('db.php');
require_once("useful.php");

LoginCheck();



if(isset($_POST['submit']) && isset($_FILES['pfiles']))
{

    $user_tag=$_POST['user_tag'];

    $pfiles=$_FILES['pfiles'];

    if( count($pfiles['name'])!=0){
      
     
      for($i=0;$i<1;$i++)
      {
          $target_file=$pfiles['tmp_name'][$i];
          $file_type = $pfiles['type'][$i];
          
          if($file_type != "image/jpg" 
          && $file_type != "image/png" 
          && $file_type != "image/jpeg" 
          && $file_type != "image/gif" 
         ) 
          {
              echo "<h1>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</h1>";
              echo "<div><p>You are uploading <strong>$file_type </strong>file</p></div>";

          }
          else{
              $file_name=$pfiles['name'][$i];
              $file_url='./media/'.$file_name;
              move_uploaded_file($target_file,$file_url);
              
              $sql= " UPDATE user_data SET pic = '$file_url' WHERE User_Tag='$user_tag'";
              $result = mysqli_query($connection, $sql);
              
          }
          
      }

    
 


}
}
else{
    echo "Empty";
}

?>

<?php
$user_type=$_SESSION['USER_DATA']['STATUS'];

if ($user_type == 'blogger') {
    header("Location: profileb.php");
   
} elseif ($user_type =='reader' ) {
    header("Location: profiler.php");
    
}
elseif ($user_type =='admin' ) {
    header("Location: profilea.php");
    
}

?>