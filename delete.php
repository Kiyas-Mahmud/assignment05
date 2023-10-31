<?php
session_start();
$users = json_decode(file_get_contents('users.json'), true);

if (isset($_GET['delete'])) {
    $emailToDelete = $_GET['delete'];

    // Check if the user is logged in as an admin and the user to be deleted exists
    if ($_SESSION['role'] === 'admin' && isset($users[$emailToDelete])) {
        // If the user to be deleted is currently logged in, log them out
        if (isset($_SESSION['email']) && $_SESSION['email'] === $emailToDelete) {
            session_unset();
            session_destroy();
        }

        // Remove the user from the users array
        unset($users[$emailToDelete]);

        // Update the JSON data
        file_put_contents('users.json', json_encode($users));

        // Redirect to admin.php
        header('Location: admin.php');
        exit;
    }
}
?>




