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
                    <a href="addproduct.html" class="btn btn-added"><img src="layout_dashboard/assets/img/icons/plus.svg" alt="img" class="me-1">Add New Product</a>
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


                            $stt = 1;
                            ?>
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($categories) && is_array($categories) && count($categories) > 0) {
                                    if (count($categories) > 0) {

                                        foreach ($categories as $category) {
                                ?>
                                            <tr>
                                                <th scope="row"><?php echo $category['id']; ?></th>
                                                <td><?php echo $category['name']; ?></td>
                                                <td>
                                                    <a class="btn btn-primary" href="./edit-category.php">Sửa</a>
                                                    <a class="btn btn-danger" href="./delete-category.php?id=<?php echo $category['id']; ?>">Xóa</a>
                                                </td>
                                                
                                            </tr>
                                <?php
                                        }
                                    }
                                } else {
                                    echo "Không có danh mục hoặc dữ liệu bị thiếu.";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>