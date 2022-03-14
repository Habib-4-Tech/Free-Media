<?php
session_start();

include('db.php');



$id = $Password = $User = $x = "";

$idErr = $PasswordErr = "";

 $FlagError= 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    if (empty($_POST["id"])) {
      $idErr ="User Tag is required";
       $FlagError=1;

    } else {
        $id = test_input($_POST["id"]);

        $sql = "select * from user_data where User_Tag = '$id'";
        $result = mysqli_query($connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {

            $User = mysqli_fetch_assoc($result);
            $x= $User['Type'];
            if ($User['User_Tag'] != $id) {
                $idErr = "User Tag doesn't Match";
                $FlagError=1;
            }
        } else {
            $idErr =  "User Tag is not Matched";
            $FlagError=1;
        }
    }

    // Password Verify
    if (empty($_POST["password"])) {
        $PasswordErr = "password is required";
        $FlagError=1;

    } else {
        $Password = test_input($_POST["password"]);

        if ($User['Password'] != $Password) {
            $PasswordErr = "Password is not Matched";
            $FlagError=1;
        }
    }


   

    if ($FlagError==0) {


        if (isset($_POST['submit'])) {

            $_SESSION['USER_DATA'] = [
                'ID' => $User['User_Tag'],
                'NAME' => $User['Name'],
                'STATUS' => $User['Type'],
                'PRIV' => $User['priv'],
            ];

            if (isset($_POST['remember_me'])) {

                $cookie_name = "USER_COOKIE";
                $cookie_value = [
                    'ID' => $User['User_Tag'],
                    'NAME' => $User['Name'],
                    'STATUS' => $User['Type'],

                ];
                setcookie($cookie_name, json_encode($cookie_value), time() + (24* 60 * 60), "/"); 
                setcookie('User_Tag', $User['User_Tag'], time() + (24* 60 * 60), "/"); 

            }


            


            mysqli_close($connection);
            if ($x == 'blogger') {
                header("Location: profileb.php");
                die;
            } elseif ($x =='reader' ) {
                header("Location: profiler.php");
                die;
            }
            elseif ($x =='admin' ) {
                header("Location: profilea.php");
                die;
            } else {
                header("Location: notfound.php");
                die;
            }
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            background-image: url('index0.jpg');
            background-repeat: repeat-x ;
            background-color:#0099ff;
             background-size: cover;
        }



    </style>
</head>

<body>
    <div style="width: 500px; height: 350px; margin: auto;  text-align: center;">
        <B>
        <form action="login.php" method="post">
            <h1>Login </h1>
            <div style="width: 300px; height: 300px; margin: auto;  text-align: left; padding:20px; background-color:rgba(	206, 79, 51, 0.5);">
                <label>User ID</label><br>
               

                <input type="text" name="id" value=" <?php if(isset($_COOKIE['User_Tag'])) { echo $_COOKIE['User_Tag']; } ?>"><br>
                <span> * <?php echo $idErr ?></span><br>
                
                <label>Password</label><br>
                <input type="password" name="password"><br>
                <span> * <?php echo $PasswordErr ?></span><br>


                <input type="checkbox" name="remember_me" value="yes">
                <label>Remember Me</label><br><br><br>
                <hr>

                <input type="submit" name="submit" value="Login">
               
            </div>

        </form>

    </div>
    </B>
</body>

</html>