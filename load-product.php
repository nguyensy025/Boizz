<?php
include('./provider.php');
include('./libs/libs.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Load Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="./css/bootstrap.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/dashboard.css">
</head>

<body>
   
    <div class="container">
        <div class="row">
        <a href="./product-interface.php" class="btn btn-primary">Return Product</a>
            <?php
            
            if (isset($_GET['id'])) {
                $sql = 'SELECT * FROM products WHERE category_id= :id';
                $statement = $connection->prepare($sql);
                if ($statement->execute([
                    ':id' => intval($_GET['id']),
                ])) {

                    $products = $statement->fetchAll();
                    $count = 0; // Biến đếm số sản phẩm đã hiển thị trong hàng hiện tại
                    foreach ($products as $product) {
                        if ($count % 4 == 0) {
                            // Đóng hàng trước khi bắt đầu hàng mới
                            if ($count != 0) {
                                echo '</div>';
                            }
                            // Mở hàng mới
                            echo '<div class="row">';
                        }
            ?>
                        <div class="col-md-3 d-flex gap-3 mt-5">
                            <div class="card" style="width: 18rem;">
                                <img src="./uploads/<?php echo $product['image']; ?>" class="card-img-top" alt="..." style="height: 24rem;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                    <h5 class="card-title"><?php echo $product['price'] . 'Vnđ'; ?></h5>
                                    <p class="card-text"><?php echo $product['description']; ?></p>
                                    <a href="#" class="btn btn-primary">Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </div>
            <?php
                        $count++;
                    }
                }
            }

            ?>
        </div>
    </div>

</body>

</html>