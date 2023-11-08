<?php
// Include necessary database connection and functions files
include('./libs/libs.php');
include('./user.php');

$errors = [];
$message = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle product update logic here
    // ...
    if (
        isset($_POST['name']) && isset($_POST['price']) && isset($_POST['category']) &&
        isset($_POST['description']) && isset($_FILES['image']) && isset($_POST['id'])
    ) {
        $id = intval($_POST['id']);
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
            $errors[] = "Price must be a number";
        }
        if (empty($category_id)) {
            $errors[] = "Category must not be empty";
        }
        if (empty($description)) {
            $errors[] = "Description must not be empty";
        }

        if (empty($errors)) {
            // Process the image upload
            if (isset($_FILES['image'])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if file already exists
                if (!file_exists($target_file)) {
                    $uploadOk = 1;
                }

                // Check file size
                if ($_FILES["image"]["size"] > 500000) {
                    $errors[] = "Size too large";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" && $imageFileType != "webp"
                ) {
                    $errors[] = "Image type not supported";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $errors[] = "Image upload failed";
                } else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $image = htmlspecialchars(basename($_FILES["image"]["name"]));
                    } else {
                        $errors[] = "Image upload failed";
                    }
                }
            }

            if (empty($errors)) {
                // Update product information in the database
                $sqlUp = "UPDATE products 
                    SET name = :name, 
                    price = :price, 
                    category_id = :category_id,
                    description = :description,
                    image = :image
                    WHERE id = :id";

                $stm = $connection->prepare($sqlUp);
                if ($stm->execute([
                    ':id' => $id,
                    ':name' => $name,
                    ':price' => $price,
                    ':category_id' => $category_id,
                    ':description' => $description,
                    ':image' => $image,
                ])) {
                    $message[] = 'Product update successful';
                } else {
                    $errors[] = 'Product update failed';
                }
            }
        }
    }
}
?>

<!-- HTML code for displaying error messages and success messages -->
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./layout_dashboard/head.php") ?>
</head>
<body>
    <?php include("./layout_dashboard/header.php") ?>
    <div class="page-wrapper">
        <div class="content">
            <!-- Display error messages -->
            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Display success messages -->
            <?php if (!empty($message)) : ?>
                <div class="alert alert-success" role="alert">
                    <?php foreach ($message as $msg) : ?>
                        <?php echo $msg; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Include a form for updating the product -->
            <!-- This form should contain fields for name, price, image, category, and description -->
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
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea type="text" id="description" name="description" class="form-control"></textarea>
                </div>
                <button type="submit" name="action" value="update" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</body>

</html>