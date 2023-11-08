<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./layout_dashboard/head.php"); ?>
</head>

<body>
    <?php include("./layout_dashboard/header.php"); ?>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Product List</h4>
                    <h6>Manage your products</h6>
                </div>
                <div class="page-btn">
                    <a href="addproduct.php" class="btn btn-added"><img src="layout_dashboard/assets/img/icons/plus.svg" alt="img" class="me-1">Add New Product</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="layout_dashboard/assets/img/icons/filter.svg" alt="img">
                                    <span><img src="layout_dashboard/assets/img/icons/closes.svg" alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="layout_dashboard/assets/img/icons/search-white.svg" alt="img"></a>
                            </div>
                        </div>
                        <div class="wordset">
                            <ul>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="layout_dashboard/assets/img/icons/pdf.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="layout_dashboard/assets/img/icons/excel.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="layout_dashboard/assets/img/icons/printer.svg" alt="img"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <?php
                                    $sql = "SELECT * FROM products";
                                    $stm = $connection->prepare($sql);
                                    $stm->setFetchMode(PDO::FETCH_ASSOC);
                                    $stm->execute();
                                    $result = $stm->fetchAll();
                                    $stt = 1;
                                    ?>
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
                                foreach ($result as $product) { ?>

                                    <tr>
                                        <td><?php
                                            echo $stt;
                                            ?></td>
                                        <td><?php echo $product['name']; ?></td>
                                        <td><?php echo $product['price']; ?></td>
                                        <td><img style="height: 100px; width: 100px" src="./uploads/<?= $product['image'] ?>"></td>
                                        <td><?= ($product['category_id']) ?></td>
                                        <td><?php echo $product['description']; ?></td>
                                        <td>
                                            <a class="btn btn-primary" href="./edit-product.php?id=<?php echo $product['id']; ?>">Edit</a>
                                            <a class="btn btn-danger" href="./delete-product.php?id=<?php echo $product['id']; ?>">delete</a>
                                        </td>
                                    </tr>
                                <?php $stt++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>