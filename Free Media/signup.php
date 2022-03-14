<?php

include('db.php');
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth="true";
$mail->SMTPSecure="tls";
$mail->Port = "587";
$mail->Username= "free.media.xyz@gmail.com";
$mail->Password= "whileloop007";










// Variable
$Name = $id = $Email = $Password = $Conf_password = $type = $Country=$dob=$gender="";

// Error
$NameErr = $idErr = $EmailErr = $PasswordErr = $Conf_passwordErr = $typeErr = $CountryErr= $doberr=$genderErr= "";
$flag_error = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    // Name validation
    if (empty($_POST['name'])) {
        $NameErr = "Name is required!";
        $flag_error = 1; echo "error found 19";
    } else {
        $Name = test_input($_POST["name"]);

        $namelen = strlen($Name);
        if ($namelen < 4 || $namelen > 30) {
            $NameErr = "Name must be between 4 and 30 characters!";
            $flag_error = 1; echo "error found 26";
        }
        // check if name only contains letters and whitespace
        elseif (!preg_match("/^([a-zA-Z-'\.]+\s[a-zA-Z-']+(\s[a-zA-Z-']+)?)$/", $Name)) {
            if (preg_match("/^([a-zA-Z-'\.]+)$/", $Name)) {
                $NameErr = "Last Name required!";
                $flag_error = 1; echo "error found 32";
            } else {
                $NameErr = "Only letters and white space allowed!";
                $flag_error = 1; echo "error found 35";
            }
        }
    }


    // Student ID validation
    if (empty($_POST["id"])) {
        $idErr = "User Tag is required!";
        $flag_error = 1; echo "error found 44";
    } else {
        $id = test_input($_POST["id"]);

        $sql = "select User_Tag from user_data where User_Tag = '$id'";
        $result = mysqli_query($connection, $sql);

        $Idlen = strlen($id);
        if ($Idlen < 8 || $Idlen > 20) {
            $idErr = "User Tag must be between 8 and 20 characters!";
            $flag_error = 1; echo "error found 54";
        } elseif (!preg_match('/[A-Z]/', $id)) {
            $idErr = "User Tag  must contain at least 1 uppercase leter!";
            $flag_error = 1; echo "error found 57";
        } elseif (!preg_match('/[a-z]/', $id)) {
            $idErr = "User Tag  must contain at least 1 lowercase leter!";
            $flag_error = 1; echo "error found 60";
        } elseif (!preg_match('/[!@#$%^&*()]/', $id)) {
            $idErr = "User Tag  must contain a special charecter!";
            $flag_error = 1; echo "error found 63";
        }

        if ($result && mysqli_num_rows($result) > 0) {


            $db_id = mysqli_fetch_assoc($result);
            if ($db_id['User_Tag'] == $id) {
                $idErr = "This User Tag  Already Exists!!! Please use a unique User Tag!";
                $flag_error = 1; echo "error found 72";
            }
        }
    }

    // Email validation
    if (empty($_POST["email"])) {
        $EmailErr = "Email is required!";
        $flag_error = 1; echo "error found 80";
    } else {
        $Email = test_input($_POST["email"]);
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $EmailErr = "Invalid email format!";
            $flag_error = 1; echo "error found 85";
        }
    }

    // Password validation
    if (empty($_POST["Password"])) {
        $PasswordErr = "password is required!";
        $flag_error = 1; echo "error found 92";
    } else {
        $Password = test_input($_POST["Password"]);
        $passlen = strlen($Password);
        if ($passlen < 8 || $passlen > 20) {
            $PasswordErr = "Password must be between 8 and 20 characters!";
            $flag_error = 1; echo "error found 98";
        } elseif (!preg_match('/[A-Z]/', $Password)) {
            $PasswordErr = "Password must contain at least 1 uppercase leter!";
            $flag_error = 1; echo "error found 101";
        } elseif (!preg_match('/[a-z]/', $Password)) {
            $PasswordErr = "Password must contain at least 1 lowercase leter!";
            $flag_error = 1;  echo "error found 104";
        } elseif (!preg_match('/[0-9]/', $Password)) {
            $PasswordErr = "Password must contain at least 1 digit!";
            $flag_error = 1; echo "error found 107";
        } elseif (!preg_match('/[!@#$%^&*()]/', $Password)) {
            $PasswordErr = "Password must contain any special charecter!";
            $flag_error = 1; echo "error found 110";
        }
    }

    if (empty($_POST["conf_password"])) {
        $Conf_passwordErr = "Confirm your Password!";
        $flag_error = 1; echo "error found 116";
    } else {
        $Conf_password = test_input($_POST["conf_password"]);
        if ($Password != $Conf_password) {
            $Conf_passwordErr = "Confirm Password Incorrect!";
            $flag_error = 1; echo "error found 121";
        }
    }



    
    

   if (empty($_POST["gender"])) {
        $genderErr = "Gender is required!";
        $flag_error = 1; echo "error found 132";
      } 
        else {
            $gender = test_input($_POST["gender"]);
          }
      



      if (empty($_POST["type"])) {
        $genderErr = "User Type is required";
        $flag_error = 1; echo "error found 143";
      } 
        else {
            $type = test_input($_POST["type"]);
          }
       
    

      if (empty($_POST["dob"])) {
        $doberr = "Date of birth is required";
        $flag_error = 1; echo "error found 153";
      } else {
        $dob = test_input($_POST["dob"]);
    
    
    $currentDate = date("y-m-d");
    
    
    $age = date_diff(date_create($dob), date_create($currentDate));
    
    $age =$age->format("%y");
         
      }


      if (empty($_POST["Country"])) {
        $CountryErr = "Country is required";
        $flag_error = 1; echo "error found 170";
    } else {
        $Country = test_input($_POST["Country"]);
       
    }





    if ($flag_error==0) {

            echo "GGWP";
            // Performing insert query execution
            $sql = "INSERT INTO user_data(User_Tag,Name, Password,Email, Country,Type,DateOfBirth,age,gender) VALUES ('$id','$Name ','$Password','$Email','$Country','$type','$dob','$age','$gender')";
            
            if (mysqli_query($connection, $sql)) {
                echo "<h3>data stored in database successfully.";
            } else {
                echo "ERROR! data isn't stored successfully <br>" . mysqli_error($connection);
            }
           
            // Close connection
            mysqli_close($connection);

            $Body="Dear ".$Name.",

Congratulations! You have successfully completed the SignUp procedure to join Free Media. We whole heartedly thank you for becoming a part of Free Media.";

            $mail->Subject="Welcome to Free Media.";
            $mail->setFrom("free.media.xyz@gmail.com");
            $mail->Body = $Body ;
            $mail->addAddress($Email);
            if($mail->Send())
                            {
            header("Location: login.php");
	
                 }
      else
            {
	    echo "Not sent";
             }
         $mail->smtpClose();
    
          
            die;
        
    }
    
    if ($flag_error==1)
    {
        echo "Not GGWP";
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















<!DOCTYPE html>
<html>
<head>
    <style>

        .gg{
          background-color:#0099ff;
           color:black;
            padding:25px;
          width: 100%;
        }
sup{
  color:#FF0000;
}

        .error {
            color: #FF0000;
        }


        body{
            font-family:  Copperplate, Papyrus, fantasy;
            background-color:#CE4F33;
            background-image: url('index0.jpg');
            background-repeat: repeat-x ;
            background-color:#0099ff;
             background-size: cover;


        }
    </style>

<title>SignUP</title>
</head>
<body>
<b>

<div style="width: 500px; height: 650px; margin: auto; border: 10px solid black; text-align: center; background-color:rgba(	206, 79, 51, 0.5);">
<h3> Create Account </h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">





    <label for="id">User Tag : <sup>*</sup></label>
    <input type="text" name="id" id= "id"  placeholder=" User tag must be unique" size=30 >
    <span class="error"> <?php echo $idErr;?></span>
    <br>

    <br>
    <label for="name">Name : <sup>*</sup></label>
    <input type="text" name="name" id= "name"  placeholder="Your full name" size=30 >
    <span class="error"> <?php echo $NameErr;?></span>

    <br>

    <br>
    <label for="email">Email :<sup>*</sup></label>
    <input size="30" type="email" id="email" name="email" value="" maxlength="30" placeholder="Required and must be valid email" min="10"  >
    <span class="error"> <?php echo $EmailErr;?></span>
  <br>
    <br>
    <label for="password">Password :<sup>*</sup></label>
    <input size=30  type="password" id="Password" name="Password" value="" maxlength="16" placeholder="Required and must be of length 8 to 20" min="8"   >
    <span class="error"> <?php echo $PasswordErr;?></span>
  <br><br>

  
  <label for="password"> Confirm Password :<sup>*</sup></label>
    <input size=30  type="password" id="conf_password" name="conf_password" value="" maxlength="16" placeholder="Required and must be of length 8 to 20" min="8"   >
    <span class="error"> <?php echo $PasswordErr;?></span>
  <br><br>


    <label >User Type:<sup>*</sup></label>
    <select name="type" id="type">
                    <option value="blogger">Blogger</option>
                    <option value="reader">Reader</option>
                </select>
    <span class="error"> <?php echo $typeErr;?></span>
  <br><br>

   
    <label for="Country">Country :<sup>*</sup></label>
    <input type="text" id="Country" name="Country" size=30  >
    <span class="error"> <?php echo $CountryErr;?></span>
  <br><br>

 
    <label for="dob">Date of Birth :<sup>*</sup></label>
    <input type="date" name="dob" id ="dob"  >
    <span class="error"> <?php echo $doberr;?></span>
  <br><br>
    

    <label >Gender:<sup>*</sup></label>
    <input type="radio" id="male" name="gender" value="male"   >
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="female">
    <label for="female">Female</label>
    <span class="error"> <?php echo $genderErr;?></span>
  <br><br>
    <br>
    

    

    <button type="submit" name="submit"  id="submit" value="submit">Sign Up</button>
    </b>
</form>

            
    </div>


</body>
</html>

