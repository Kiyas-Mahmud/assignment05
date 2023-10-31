<?php
session_start();

// Load user data from the JSON file
$userData = json_decode(file_get_contents("users.json"), true);

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email exists in the user data
    if (isset($userData[$email])) {
        $user = $userData[$email];

        // Check if the provided password matches the stored password
        if ($password === $user['password']) {
            // Login successful
            $_SESSION['email'] = $email;

            // Redirect based on user role
            if ($user['role'] === 'user' || $user['role'] === "") {
                header("Location: index.php"); // Redirect user to user.php
            } elseif ($user['role'] === 'admin' || $user['role'] === 'manager') {
                header("Location: admin.php"); // Redirect admin to admin.php
            }
            exit; // Ensure that the script stops executing after the redirect
        }

    }

    // If login fails, show an error message
    echo "<script>alert('Invalid credentials!')</script>";
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Login</title>

</head>
<body>
<div class="container">
    <h1>Login to your account</h1>
    <form action="login.php" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary mb-3" name="login">Login</button>
        <div>
            <p>Don't have an account? <a href="registration.php">Register Now</a></p>
        </div>
    </form>
</div>
<!-- Your HTML body content -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>