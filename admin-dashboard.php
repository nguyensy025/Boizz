<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ASM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="./css/bootstrap.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/dashboard.css">
</head>

<body>
    <?php
    session_start();
    require_once('./provider.php');
    $errors = [];
    $message = [];

    // Handle user creation
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Validate form inputs
        if (strlen($username) < 1) {
            $errors[] = "Username is required.";
        }
        if (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters long.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if (empty($errors)) {
            // Check if the username already exists
            $sqlCheck = "SELECT * FROM users WHERE username = :username";
            $stm = $connection->prepare($sqlCheck);
            $stm->execute([':username' => $username]);
            $count = $stm->rowCount();

            if ($count > 0) {
                $errors[] = 'Username already exists.';
            } else {
                // Create a new user
                $sql = "INSERT INTO users (username, password, role, email) VALUES (:username, :password, 2, :email)";
                $stm2 = $connection->prepare($sql);
                if ($stm2->execute([
                    ':username' => $username,
                    ':password' => password_hash($password, PASSWORD_DEFAULT),
                    ':email' => $email
                ])) {
                    $message[] = 'User created successfully.';
                } else {
                    $errors[] = 'User creation failed.';
                }
            }
        }
    }

    // Handle user editing
    if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
        $userId = intval($_GET['id']);
        $sql = "SELECT * FROM users WHERE id = :id";
        $stm = $connection->prepare($sql);
        $stm->execute([':id' => $userId]);
        $user = $stm->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $errors[] = 'User not found.';
        }

        // Handle form submission for editing
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newUsername = $_POST['new_username'];
            $newEmail = $_POST['new_email'];

            // Validate inputs (you can add more validation if needed)
            if (strlen($newUsername) < 1) {
                $errors[] = 'New username is required.';
            }
            if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Invalid email format.';
            }

            if (empty($errors)) {
                // Update user data
                $sql = "UPDATE users SET username = :username, email = :email WHERE id = :id";
                $stm = $connection->prepare($sql);
                if ($stm->execute([':username' => $newUsername, ':email' => $newEmail, ':id' => $userId])) {
                    $message[] = 'User updated successfully.';
                } else {
                    $errors[] = 'User update failed.';
                }
            }
        }
    }

    // Fetch the list of users
    $sql = "SELECT * FROM users";
    $stm = $connection->prepare($sql);
    $stm->execute();
    $users = $stm->fetchAll();
    ?>

    <div class="container">
        <div class="row">
            <?php
            include('./layout/nav.php');
            include('./layout/sidebar.php');
            ?>
            <div class="col col-lg-10">
                <form action="./admin-dashboard.php" method="post">
                    <h2>Create Account</h2>
                    <?php
                    // Display error messages if there are any
                    if (!empty($errors)) {
                        foreach ($errors as $error) {
                            echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                        }
                    }
                    // Display success message if available
                    if (!empty($message)) {
                        foreach ($message as $msg) {
                            echo '<div class="alert alert-success" role="alert">' . $msg . '</div>';
                        }
                    }
                    ?>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter your username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>

                <?php if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) { ?>
                    <form action="./admin-dashboard.php?action=edit&id=<?php echo $user['id']; ?>" method="post">
                        <h2>Edit User</h2>
                        <?php
                        // Display error messages if there are any
                        if (!empty($errors)) {
                            foreach ($errors as $error) {
                                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                            }
                        }
                        ?>
                        <div class="form-group">
                            <label for="new_username">New Username</label>
                            <input type="text" class="form-control" name="new_username" placeholder="Enter new username" value="<?php echo $user['username']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="new_email">New Email</label>
                            <input type="email" class="form-control" name="new_email" placeholder="Enter new email" value="<?php echo $user['email']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                <?php } ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <th scope="row"><?php echo $user['id']; ?></th>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo ($user['role'] === 1) ? 'Admin' : 'User'; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td>
                                    <a class="btn btn-primary" href="./admin-dashboard.php?action=edit&id=<?php echo $user['id']; ?>">Edit</a>
                                    <a class="btn btn-danger" href="./admin-del-dashboard.php?id=<?php echo $user['id']; ?>">Delete</a>
                                </td>   
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>