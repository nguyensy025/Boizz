<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./layout_dashboard/head.php") ?>
</head>

<body>
    <?php include("./layout_dashboard/header.php") ?>
    <div class="page-wrapper">
        <?php
        include('./user.php');
        include('./provider.php');
        ?>
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Category Add</h4>
                    <h6>Create new Category</h6>
                </div>
            </div>
            <div class="card">
            
                <?php
                if (!empty($message) && $message != '') { ?>
                    <div class="alert alert-success" role="alert">
                        <?php
                        foreach ($message as $message) {
                            echo $message;
                        }
                        ?>
                    </div>
                <?php } ?>
                <div class="card-body">
                    <div class="row">

                        <form action="./addCategory.php" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Fill name category" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button type="submit" class="btn btn-primary" type="button" id="button-addon2">Create</button>
                            </div>
                            <?php
                            //validate data
                            $message = [];
                            $errors = [];
                            if (isset($_POST['name'])) {
                                $name = $_POST['name'];
                                if (isset($name) && $name === '') {
                                    $errors[] = 'Please fill this field!';
                                }
                                if (strlen($name) < 1) {
                                    $errors[] = 'Name category too short';
                                }
                                if (isset($connection) && count($errors) < 1) {
                                    $sql = "SELECT * FROM categories where name = :name";
                                    $stm = $connection->prepare($sql);
                                    $stm->execute([
                                        ':name' => $_POST['name'],
                                    ]);
                                    $count = $stm->rowCount();

                                    if ($count > 0) {
                                        $errors[] = 'Category name already exists';
                                    } else {
                                        $sql = "INSERT INTO categories (name) VALUES (:name)";
                                        $stm = $connection->prepare($sql);
                                        if ($stm->execute([
                                            ':name' => $_POST['name'],
                                        ])) {
                                            $message[] = 'Add new category successful';
                                        } else {
                                            $errors[] = 'Add new category false!';
                                        }
                                    }
                                }
                            }


                            $sql_all = "SELECT * FROM categories";
                            $stm = $connection->prepare($sql_all);
                            $stm->setFetchMode(PDO::FETCH_ASSOC);
                            $stm->execute();
                            $categories = $stm->fetchAll();
                            if (count($categories) < 0) {
                                $message[] = 'No data in category !';
                            }
                            if (isset($message)) {
                                foreach ($message as $message) {
                                    echo '<div class="alert alert-success" role="alert">
                            ' . $message . '
                            </div>';
                                }
                            }
                            if (isset($errors)) {
                                foreach ($errors as $error) {
                                    echo '<div class="alert alert-danger" role="alert">
                            ' . $error . '
                            </div>';
                                }
                            }

                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>