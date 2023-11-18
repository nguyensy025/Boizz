<?php
session_start();
require('./layout/header.php');
define("USERNAME", "root");
define("PASSWORD", "");
define("HOST", "localhost");
define("DB_NAME", "duanmau");

//$connection = null;
try {
    $url = "mysql:host=" . HOST . ";dbname=" . DB_NAME . "";
    $connection = new PDO($url, USERNAME, PASSWORD);
} catch (PDOException $e) {
    echo $e->getMessage();
}

// Initialize variables to hold user data and error messages
$user = [];
$errors = [];

// Check if 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']); // Convert 'id' to an integer
    
    // Check if the form has been submitted for editing
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Process the form data (update user information)
        $newUsername = $_POST['username'];
        $newEmail = $_POST['email'];
        
        // Validate form input (add your validation logic here)
        if (empty($newUsername)) {
            $errors[] = 'Username is required.';
        }
        if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format.';
        }
        
        // If there are no validation errors, update the user's information in the database
        if (empty($errors)) {
            $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
            $statement = $connection->prepare($sql);
            if ($statement->execute([
                ':username' => $newUsername,
                ':email' => $newEmail,
                ':id' => $userId,
            ])) {
                $_SESSION['message'] = 'User information updated successfully.';
                header('Location: admin-dashboard.php');
                exit;
            } else {
                $errors[] = 'Error updating user information.';
            }
        }
    } else {
        // Fetch the current user's information from the database
        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        if ($statement->execute([
            ':id' => $userId,
        ])) {
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                $errors[] = 'User not found.';
            }
        } else {
            $errors[] = 'Error fetching user information.';
        }
    }
} else {
    // Handle the case where 'id' parameter is not set (e.g., show an error message)
    $errors[] = 'User ID is not specified in the URL.';
}
