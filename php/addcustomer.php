<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./layout_dashboard/head.php"); ?>
</head>

<body>
    <?php include("./layout_dashboard/header.php"); ?>
    <?php
 

    $errors = [];
    $message = [];

    // Handle user creation
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $email = htmlspecialchars($_POST['email']);

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
    }

    // Fetch the list of users
    $sql = "SELECT * FROM users";
    $stm = $connection->prepare($sql);
    $stm->execute();
    $users = $stm->fetchAll();
    $stt = 1;
    ?>
    ?>
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
                        <form action="./addcustomer.php" method="post">
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
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th scope="col">Number</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <td><?php echo $stt; ?></td>
                                        <td><?php echo $user['id']; ?></td>
                                        <td><?php echo $user['username']; ?></td>
                                        <td><?php echo ($user['role'] === 1) ? 'Admin' : 'User'; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                    </tr>
                                <?php $stt++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>