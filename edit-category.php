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
        include('./libs/libs.php');
        if (isset($_POST['name']) && isset($_POST['id'])) {
            $message = "";
            $id = $_POST['id'];
            if (empty($id)) {
                //case insert nếu id trống thì thêm
                $sql = "SELECT * FROM categories where name = :name";
                $statement = $connection->prepare($sql);
                $statement->execute([
                    ':name' => $_POST['name'],
                ]);
                $count = $statement->rowCount();
                //thêm
                if ($count > 0) {
                    $message = "<span class='text text-danger'>catagory name already exists</span>";
                } else {
                    $sql = "INSERT INTO categories (name) VALUES (:name)";
                    $statement = $connection->prepare($sql);
                    if ($statement->execute([
                        ':name' => $_POST['name'],
                    ])) {

                        $message = "<span  class='text text-success'>created successfully</span>";
                    }
                }
            } else {
                //thì cập nhật
                $sql = "UPDATE categories SET name = :name where id=:id";
                $statement = $connection->prepare($sql);
                if ($statement->execute([
                    ':name' => $_POST['name'],
                    ':id' => intval($id),
                ])) {

                    $message = "<div class='alert alert-success' role='alert'>Updated successfully</div>";
                }
            }
        }
        //in ra thông bao
        if (isset($message) && $message !== '') {
            echo $message;
        }
        // in ra cái bảng
        $sql_all = "SELECT * FROM categories";
        $statement = $connection->prepare($sql_all);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $categories = $statement->fetchAll();
        if (isset($_SESSION['message'])) {
            echo "<div class='alert alert-success' role='alert'>{$_SESSION['message']}</div>";
            unset($_SESSION['message']);
        }
        ?>
        <div class="content">
            <!-- Other content here -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">name</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) { ?>
                        <tr>
                            <th scope="row"><?php echo $category['id'];  ?></th>
                            <td><?php echo $category['name'];  ?></td>
                            <td>
                                <button class="btn btn-primary" onclick="updateCat(<?= $category['id'] ?>, '<?= $category['name'] ?>')">edit</button>
                                <a class="btn btn-danger" href="./delete-category.php?id=<?php echo $category['id'];  ?>">delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <form class="form-inline form" action="" method="POST">
                <input type="hidden" class="form-control" name="id" placeholder="input name category" id="id">
                <input type="text" class="form-control" id="name" name="name" placeholder="Fill name category" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button type="submit" class="btn btn-primary" type="button" id="button-addon2">Save</button>
            </form>
        </div>
    </div>
    </div>
    <script>
        updateCat = (id, name) => {
            //console.log(id, name)
            const elmId = document.getElementById('id');
            const elmName = document.getElementById('name');
            elmId.value = id;
            elmName.value = name;
        }
    </script>
    </div>
</body>

</html>