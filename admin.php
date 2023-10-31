<?php
session_start();

// Load user data from the JSON file
$userData = json_decode(file_get_contents("users.json"), true);

// Filter users
$filteredUsers = [];
foreach ($userData as $email => $user) {
    if ($user['role'] === 'admin' || $user['role'] === 'manager' || $user['role'] === 'user' || $user['role'] ==="") {
        $filteredUsers[$email] = $user;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Admin Dashboard</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($filteredUsers as $userEmail => $user): ?>
            <tr>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $userEmail; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td>
                    <a href="edit.php?email=<?php echo $userEmail; ?>" class="btn btn-primary">Edit</a>
                    <a href="delete.php?email=<?php echo $userEmail; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="login.php" class="btn btn-secondary">Logout</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
