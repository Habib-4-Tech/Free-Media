<?php


require("db.php");

function LoginCheck(){
    // if the session uid not set then go to login page 
    if (isset($_SESSION['USER_DATA']))  {
      
     
  }
  else{
    echo "Not logged in";
    header("Location: login.php");

  }
  }

  ?>


  
