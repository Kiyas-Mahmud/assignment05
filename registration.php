<?php
session_start();

$usersFile = 'users.json';

$users = file_exists($usersFile) ? json_decode( file_get_contents( $usersFile), true) : [];

function saveUsers( $users, $file )
{
    file_put_contents( $file, json_encode( $users, JSON_PRETTY_PRINT ) );
}

//registration form handiling
if (isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //validation check
    if (empty($username) || empty($email) || empty($password)){
        $errorMsg = "Please fill all the fields";
    }else{
        if (isset($users[$email])){
            $errorMsg = "Email already exists";
        }else{
            $users[$email] = [
              'username' => $username,
                'email' => $email,
              'password' => $password,
              'role' => '',
            ];

            saveusers($users, $usersFile);
            $_SESSION['email'] = $email;
            header( 'Location: login.php' );
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container col-md-8 mx-auto">
    <h1>Register Now</h1>
    <form class="form" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">User Name</label>
            <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div>
            <input type="hidden" name="role" value="">
        </div>
        <?php

        if ( isset( $errorMsg ) ) {
            echo "<p>$errorMsg</p>";
        }

        ?>

            <button type="submit" name="register" class="btn btn-primary mb-3">Register</button>
        <div>
            <a href="login.php" class="btn btn-info text-white mb-3">
                Already have an account?
            </a>
        </div>



    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>