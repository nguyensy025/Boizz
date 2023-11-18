<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Product</title>
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="./css/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/dashboard.css">
</head>

<body>
    <div class="container">
    <div class="row">
        <?php
        include_once('./layout/header.php');
        include('./layout/nav.php');
        include('./layout/sidebar.php');

        $sql = "SELECT * FROM categories";
        $statement = $connection->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $categories = $statement->fetchAll();
        
        $errors = [];
        $message =[];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (
                isset($_POST['name']) &&
                isset($_POST['price']) && isset($_POST['description']) &&
                isset($_POST['category']) && isset($_POST['detail'])
            ) {
                $name = trim(htmlspecialchars($_POST['name']));
                $price = trim(htmlspecialchars($_POST['price']));
                $category_id = trim(htmlspecialchars($_POST['category']));
                $description = trim(htmlspecialchars($_POST['description']));
                $detail = trim(htmlspecialchars($_POST['detail']));
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
                if (empty($detail)) {
                    $errors[] = "Detail must not be  empty";
                }
                // if (empty($status)) {
                //     $errors[] = "Status must not be  empty";
                // }
                if($connection && count($errors)<1){
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
                        if (file_exists($target_file)) {
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
                        $sql = "INSERT INTO products (name, price, category_id, description, image,detail) 
                                VALUES (:name, :price, :category_id, :description, :image,:detail)";
                        $statement = $connection->prepare($sql);
    
                        $statement->execute([
                            ':name' => $name,
                            ':price' => $price,
                            ':category_id' => $category_id,
                            ':description' => $description,
                            ':image' => $image,
                            ':detail' => $detail
                        ]);
                        // header('Location: product.php');
                        $message []= 'Create success';
                    }
                }
            }
        }


        ?>
        <div class="col col-lg-10 dataa">
            <h4>Create product</h4>
            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php
            if (!empty($message) && $message != '') { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                    foreach ($message as $message){
                        echo $message;
                    }
                    ?>
                </div>
            <?php } ?>
            <form action="" method="post" enctype="multipart/form-data">
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
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea type="text" id="description" name="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="detail">Detail:</label>
                    <textarea type="text" id="detail" name="detail" class="form-control"></textarea>
                </div>
                <button style="margin-top: 20px" type="submit" name="action" value="create" class="btn btn-primary">Add</button>
                <button style="margin: 20px 0px 0px 10px" type="submit" name="action" value="create" class="btn btn-danger"><a href="product.php" style="text-decoration: none; color: white">Go to product</a></button>
            </form>
        </div>
    </div>
    </div>
</body>

</html>