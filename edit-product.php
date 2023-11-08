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
        $sql = "SELECT * FROM categories";
        $statement = $connection->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $categories = $statement->fetchAll();

        $errors = [];
        $message = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Add or update product logic here
            // ...
            if (
                isset($_POST['name']) &&
                isset($_POST['price']) && isset($_POST['description']) &&
                isset($_POST['category'])
            ) {
                $name = trim(htmlspecialchars($_POST['name']));
                $price = trim(htmlspecialchars($_POST['price']));
                $category_id = trim(htmlspecialchars($_POST['category']));
                $description = trim(htmlspecialchars($_POST['description']));
                $image = "";
                if (empty($name)) {
                    $errors[] = "Name must not be empty";
                }
                if (empty($price)) {
                    $errors[] = "Price must not be empty";
                }
                if (!is_numeric($price)) {
                    $errors[] = "Price must not be  number";
                }
                if (empty($category_id)) {
                    $errors[] = "Category must not be  empty";
                }
                if (empty($description)) {
                    $errors[] = "Description must not be  empty";
                }
                // if (empty($status)) {
                //     $errors[] = "Status must not be  empty";
                // }
                if ($connection && count($errors) < 1) {
                    if (isset($_FILES['image'])) {
                        $target_dir = "uploads/";
                        $target_file = $target_dir . basename($_FILES["image"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["image"]["tmp_name"]);
                        if ($check == false) {
                            $errors[] = "File is not an image.";
                        }
                        // Check if file already exists
                        if (!file_exists($target_file)) {
                            $uploadOk = 1;
                        }
                        // Check file size
                        if ($_FILES["image"]["size"] > 500000) {
                            $errors[] = "size too large";
                            $uploadOk = 0;
                        }
                        // Allow certain file formats
                        if (
                            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif" && $imageFileType != "webp"
                        ) {
                            $errors[] = "type image not supported";
                            $uploadOk = 0;
                        }

                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            $errors[] = "image invalid";
                        } else {
                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                $image =  htmlspecialchars(basename($_FILES["image"]["name"]));
                            } else {
                                $errors[] = "image invalid";
                            }
                        }
                    }
                    if (empty($errors) && isset($_POST['action'])) {
                        // Nếu không có lỗi -> lưu dữ liệu vào cơ sở dữ liệu
                        // Thêm sản phẩm mới
                        if (
                            isset($_POST['name']) && isset($_POST['price']) && isset($_POST['category']) &&
                            isset($_POST['description']) && isset($_FILES['image']) && isset($_POST['id'])
                        ) {
                            // Xử lý và kiểm tra dữ liệu

                            // Câu truy vấn UPDATE
                            $sqlUp = "UPDATE products 
                            SET name = :name, 
                            price = :price, 
                            category_id = :category_id,
                            description = :description,
                            image = :image
                            WHERE id = :id";

                            // Tiến hành cập nhật dữ liệu
                            $stm = $connection->prepare($sqlUp);
                            if ($stm->execute([
                                ':id' => intval($_POST['id']),
                                ':name' => $name,
                                ':price' => $price,
                                ':category_id' => $category_id,
                                ':description' => $description,
                                ':image' => $image,
                            ])) {
                                $message[] = 'Update success';
                            } else {
                                $errors[] = 'Update fail';
                            }
                        }
                    }
                }
            }
        }

        // Fetch product data from the database
        $sql = "SELECT * FROM products";
        $stm = $connection->prepare($sql);
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute();
        $result = $stm->fetchAll();
        ?>
        <div class="content">
            <!-- Other content here -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $product) : ?>
                        <!-- Display product information here -->
                        <tr>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['price']; ?></td>
                            <td><img style="height: 100px; width: 100px" src="./uploads/<?= $product['image'] ?>"></td>
                            <td><?php echo getCategoryNameById($product['category_id']); ?></td>
                            <td><?php echo $product['description']; ?></td>
                            <td>
                                <button class="btn btn-primary" onclick="updatePro(
                                    <?= $product['id'] ?>,
                                    '<?= $product['name'] ?>',
                                    '<?= $product['price'] ?>',
                                    '<?= $product['description'] ?>')">Edit</button>
                                <a class="btn btn-danger" href="javascript:void(0);" onclick="confirmDelete(<?php echo $product['id']; ?>)">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form action="product-update.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label for="name">Product Name:</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price" class="form-control" min="0">
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select id="category" name="category" class="form-control">
                        <option value="">Select a Category</option>
                        <!-- Assuming $categories is an array of categories fetched from your database -->
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>-gro
                <div class="formup">
                    <label for="description">Description:</label>
                    <textarea type="text" id="description" name="description" class="form-control"></textarea>
                </div>
                <button type="submit" name="action" value="update" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    </div>
    <script>
        updatePro = (id, name, price, description) => {
            const elmId = document.getElementById('id');
            const elmName = document.getElementById('name');
            const elmPrice = document.getElementById('price');
            const elmDescription = document.getElementById('description');
            elmId.value = id;
            elmName.value = name;
            elmPrice.value = price;
            elmDescription.value = description;
        }

        confirmDelete = (id) => {
            const confirmDelete = confirm("Are you sure you want to delete this product?");
            if (confirmDelete) {
                window.location.href = `./delete-product.php?id=${id}`;
            }
        }
    </script>
    </div>
</body>

</html>