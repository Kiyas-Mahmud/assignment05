<?php
session_start();

// Load user data from the JSON file
$userData = json_decode(file_get_contents("users.json"), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['newRole'])) {
        $email = $_POST['email'];
        $newRole = $_POST['newRole'];

        // Check if the logged-in user has permission to update roles
        if (isset($userData[$email])) {
            $loggedInUser = $userData[$_SESSION['email']];
            if ($loggedInUser['role'] === 'admin' || $loggedInUser['role'] === 'manager') {
                $userData[$email]['role'] = $newRole;

                // Save the updated user data back to users.json
                file_put_contents("users.json", json_encode($userData));

                // Redirect to admin.php
                header("Location: admin.php");
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Role</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Edit User Role</h1>
    <form method="post" action="edit.php">
        <div class="mb-3">
            <label for="email" class="form-label">User Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="newRole" class="form-label">New Role</label>
            <select class="form-select" id="newRole" name="newRole" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
    <a href="admin.php" class="btn btn-secondary">Back to Admin Dashboard</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
