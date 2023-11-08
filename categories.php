<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
    <!-- Thêm Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- Đưa phần header và sidebar vào layout -->
            <?php include('./layout/header.php') ?>
            <?php include('./layout/sidebar.php') ?>
            <div class="col col-lg-10">
                <h1>Category Management</h1>
                <form class="form-inline form" action="" method="POST">
                    <?php    $sql = "SELECT * FROM categories_cha";
                        $statement = $connection->prepare($sql);
                        $statement->setFetchMode(PDO::FETCH_ASSOC);
                        $statement->execute();
                        $categories = $statement->fetchAll();?>
                    <input type="hidden" class="form-control" name="id" id="id">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Input category name">
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select id="category" name="category" class="form-control">
                            <option value="">Select a Category</option>
                            <?php foreach ($categories as $category_cha) : ?>
                                <option value="<?php echo $category_cha['id'] ?>"><?php echo $category_cha['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Save</button>
                </form>
                <?php
                if (isset($_POST['name']) && isset($_POST['id']) && isset($_POST['category'])) {
                    $message = "";
                    $id = $_POST['id'];
                    $category_cha = trim(htmlspecialchars($_POST['category']));
                    if (empty($id)) {
                        // TH: Thêm mới
                        $sql = "SELECT * FROM categories where name = :name";
                        $statement = $connection->prepare($sql);
                        $statement->execute([':name' => $_POST['name']]);
                        $count = $statement->rowCount();
                        if ($count > 0) {
                            $message = "<span class='text text-danger'>Category name already exists</span>";
                        } else {
                            $sql = "INSERT INTO categories (name) VALUES (:name)";
                            $statement = $connection->prepare($sql);
                            if ($statement->execute([':name' => $_POST['name']])) {
                                $message = "<span class='text text-success'>Created successfully</span>";
                            }
                        }
                    } else {
                        // TH: Cập nhật
                        $sql = "UPDATE categories SET name = :name WHERE id = :id";
                        $statement = $connection->prepare($sql);
                        if ($statement->execute([':name' => $_POST['name'], ':id' => intval($id)])) {
                            $message = "<span class='text text-success'>Updated successfully</span>";
                        }
                    }
                }
                if (isset($message) && $message !== '') {
                    echo $message;
                }
                // Lấy danh sách categories sau khi thêm hoặc cập nhật
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
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category) { ?>
                            <tr>
                                <th scope="row"><?php echo $category['id'];  ?></th>
                                <td><?php echo $category['name'];  ?></td>
                                <td>
                                    <button class="btn btn-primary" onclick="updateCat(<?= $category['id'] ?>, '<?= $category['name'] ?>')">Edit</button>
                                    <a class="btn btn-danger" href="./delete-category.php?id=<?php echo $category['id'];  ?>">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Thêm Bootstrap JS (nếu cần) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        // Cập nhật giá trị của form khi click nút Edit
        function updateCat(id, name) {
            const elmId = document.getElementById('id');
            const elmName = document.getElementById('name');
            elmId.value = id;
            elmName.value = name;
        }
    </script>
</body>

</html>