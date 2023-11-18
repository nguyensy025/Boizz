<!DOCTYPE html>
<html lang="en">
<?php
include('./layout/header.php');
?>

<body>
    <div class="container">
        <div class="row">
            <?php
            include('./layout/nav.php');
            include('./layout/sidebar.php');
            include('./libs/libs.php');
            ?>
            <div class="col col-lg-10">
                <?php
                $sql = "SELECT * FROM products";
                $stm = $connection->prepare($sql);
                $stm->setFetchMode(PDO::FETCH_ASSOC);
                $stm->execute();
                $result = $stm->fetchAll();
                ?>
                <a href="./product-create.php" class="btn btn-primary">Create Product</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Number</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Category</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 
                        $stt =1;
                        foreach ($result as $product) { ?>
                            <tr>
                                <td><?php
                                echo $stt;
                                ?></td>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td><img style="height: 100px; width: 100px" src="./uploads/<?= $product['image']?>"></td>
                                <td><?php echo getCategoryNameById($product['category_id']); ?></td>
                                <td><?php echo $product['description']; ?></td>
                                <td>
                                    <a class="btn btn-primary" href ="./edit-product.php?id=<?php echo $product['id'];?>">Edit</a>
                                    <a class="btn btn-danger" href="./delete-product.php?id=<?php echo $product['id']; ?>">delete</a>
                                </td>
                            </tr>
                        <?php $stt++;} ?>
                    </tbody>
                </table>
</body>

</html>