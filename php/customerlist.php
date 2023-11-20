<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./layout_dashboard/head.php"); ?>
</head>

<body>
    <?php include("./layout_dashboard/header.php"); ?>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Product List</h4>
                    <h6>Manage your products</h6>
                </div>
                <div class="page-btn">
                    <a href="addproduct.html" class="btn btn-added"><img src="layout_dashboard/assets/img/icons/plus.svg" alt="img" class="me-1">Add New Product</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="layout_dashboard/assets/img/icons/filter.svg" alt="img">
                                    <span><img src="layout_dashboard/assets/img/icons/closes.svg" alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="layout_dashboard/assets/img/icons/search-white.svg" alt="img"></a>
                            </div>
                        </div>
                        <div class="wordset">
                            <ul>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="layout_dashboard/assets/img/icons/pdf.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="layout_dashboard/assets/img/icons/excel.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="layout_dashboard/assets/img/icons/printer.svg" alt="img"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
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
                                    $stt = 1;
                                    ?>
                                    <?php if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) { ?>
                                        <form action="./customerlist.php?action=edit&id=<?php echo $user['id']; ?>" method="post">
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
                                            <button style="padding-bottom: 10px;" type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    <?php } ?>

                                    <th scope="col">Number</th>

                                    <th scope="col">ID</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($users as $user) { ?>

                                    <tr>
                                        <td><?php
                                            echo $stt;
                                            ?></td>

                                        <td><?php echo $user['id']; ?></td>
                                        <td><?php echo $user['username']; ?></td>
                                        <td><?php echo ($user['role'] === 1) ? 'Admin' : 'User'; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td>
                                            <a class="btn btn-primary" href="./customerlist.php?action=edit&id=<?php echo $user['id']; ?>">Edit</a>
                                            <a class="btn btn-danger" href="./customerlist.php?id=<?php echo $user['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php $stt++;
                                } ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div>
</body>

</html>