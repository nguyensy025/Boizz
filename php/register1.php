<!DOCTYPE html>
<html>

<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php
    require_once("./provider.php");
    $errors = [];
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            /**
             * us -> not empty
             *  password => >6 ky tu
             *  email hop le
             */
            if (strlen($username) < 1) {
                $errors[] =  "username not empty";
            }
            if (strlen($password) < 6) {
                $errors[] =  "password not empty and > 6 ky tu";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "email invalid email format";
            }
            if (isset($connection) && count($errors) < 1) {
                    //check account 
                    //lấy data từ data base
                    $sqlCheck ="SELECT * FROM users Where username = :username";
                    $stm = $connection ->prepare ($sqlCheck);
                    $stm->setFetchMode(PDO::FETCH_ASSOC);
                    $list=$stm->fetchAll();
                    if($stm -> execute([
                        ':username' => $_POST['username']
                    ]))
                    $count = $stm -> rowCount();
                    if($count>0){
                        $errors []= 'Username already exists';
                    }
                    else{
                            $sql = "INSERT INTO users (username,password,role,email) VALUES (:username,:password,:role,:email)";
                            $stm2 = $connection-> prepare($sql);
                            if($stm2 -> execute([
                                ':username' => $username,
                                ':password' => password_hash($password, PASSWORD_DEFAULT),
                                ":role" => 2,
                                ":email" => $email
                            ]))
                            {
                                header("Location: login.php");
                            }
                            else{
                                $errors = 'Resgister fault!';
                            }
                    }
                    
            }
        }
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Register</h2>
                <?php
                if (isset($errors) &&   count($errors) > 0)  { 
                    foreach($errors as $error){
                        echo '<div class="alert alert-danger" role="alert">
                        '.$error.'
                        </div>';
                        
                    }
                    unset($errors);
                }
                ?>
                <form action="./register.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter your username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password">
                    </div>
                    <div class="form-group">
                        <label for="password">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email">
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>

                </form>
            </div>
        </div>
    </div>

</body>

</html>