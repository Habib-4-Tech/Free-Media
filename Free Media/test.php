<?php
session_start();

include('db.php');


// Variable
$id = $Password = $User = "";

// Error
$idErr = $PasswordErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    if (empty($_POST["id"])) {
        $idErr = "ID is required";
    } else {
        $id = test_input($_POST["id"]);

        $sql = "select id,u_id,password,name,u_type from user where u_id = '$id'";
        $result = mysqli_query($connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {

            $User = mysqli_fetch_assoc($result);

            if ($User['u_id'] != $id) {
                $idErr = "ID is not Matched";
            }
        } else {
            $idErr = "ID is not Matched";
        }
    }

    // Password Verify
    if (empty($_POST["password"])) {
        $PasswordErr = "password is required";
    } else {
        $Password = test_input($_POST["password"]);

        if ($User['password'] != $Password) {
            $PasswordErr = "Password is not Matched";
        }
    }


    // insert to database

    if ($idErr == "" && $PasswordErr == "") {


        if (isset($_POST['submit'])) {

            $_SESSION['USER_DATA'] = [

                'T_ID' => $User['id'],
                'ID' => $User['u_id'],
                'NAME' => $User['name'],
                'STATUS' => $User['u_type'],
            ];

            if (isset($_POST['remember_me'])) {

                $cookie_name = "USER_COOKIE";
                $cookie_value = [

                    'T_ID' => $User['id'],
                    'ID' => $User['u_id'],
                    'NAME' => $User['name'],
                    'STATUS' => $User['u_type'],
                ];
                setcookie($cookie_name, json_encode($cookie_value), time() + (3600 * 30), "/"); // 3600 = 1 hour

            }


            mysqli_close($connection);
            if ($User['u_type'] == 'admin') {
                header("Location: AdminHome.php");
                die;
            } elseif ($User['u_type'] == 'user') {
                header("Location: UserHome.php");
                die;
            } else {
                header("Location: register.php");
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
        span {
            color: red;
        }
    </style>
</head>

<body>
    <div style="width: 500px; height: 350px; margin: auto; border: 1px solid black; text-align: center;">

        <form action="login.php" method="post">
            <h1>Login to Your Account</h1>
            <div style="width: 200px; height: 180px; margin: auto; border: 1px solid black; text-align: left; padding:20px">
                <label>User ID</label><br>
                <input type="text" name="id" value="<?= $id ?>">
                <span> * <?php echo $idErr ?></span><br>

                <label>Password</label><br>
                <input type="password" name="password">
                <span> * <?php echo $PasswordErr ?></span><br>


                <input type="checkbox" name="remember_me" value="yes">
                <label>Remember Me</label><br><br>

                <input type="submit" name="submit" value="Login">
                <a href="register.php">Register</a>
            </div>

        </form>

    </div>

</body>

</html>