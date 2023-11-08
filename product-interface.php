<?php
session_start();
require_once('./provider.php');
require('./user.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="./css/bootstrap.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/dashboard.css">
    <title>Sản phẩm</title>
</head>

<body>

<div class="container">
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <h2>Categories</h2>
                <br>
                <?php
                $sql = "SELECT * FROM categories_cha";
                $stm = $connection ->prepare($sql);
                $stm->execute();
                $categories = $stm -> fetchAll();
                foreach ($categories as $category) { ?>
                    <li class="nav-item border m-1">
                        <a class="nav-link" type="submit" href="./load-product.php?id=<?php echo $category['id']; ?>">
                            <?php echo $category['name']; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
    <div class="row">
        <?php
        $query = "SELECT * FROM products";
        $stm = $connection->prepare($query);
        $stm->execute();
        $products = $stm->fetchAll();

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
                    <a  href="./product-detail.php?id=<?php echo $product['id'];?>"><img src="./uploads/<?php echo $product['image']; ?>" class="card-img-top" alt="..." style="height: 24rem;"></a>
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
        echo '</div>'; // Đóng hàng cuối cùng
        ?>
    </div>
</div>
</body>

</html>