<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include './layoat_phu/head.php'; ?>
</head>

<body>
    <?php
    session_start();
    ob_start();
    include('./user.php');
    include('./provider.php');
    if (isset($_SESSION['countPro'])) {
        $countCartPro = $_SESSION['countPro'];
    } else {
        $countCartPro = 0;
    }
    ?>
    <div class="shop-wrapper">
        <?php include './layoat_phu/heder.php'; ?>
        <!-- Breadcrumb Area Start Here -->
        <div class="breadcrumbs-area position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="breadcrumb-content position-relative section-content">
                            <h3 class="title-3">Shop Fullwidth</h3>
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>Shop</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End Here -->
        <!-- Shop Main Area Start Here -->
        <div class="shop-main-area shop-fullwidth">
            <div class="container container-default custom-area">
                <div class="row flex-row-reverse">
                    <div class="col-12 col-custom widget-mt">
                        <!--shop toolbar start-->
                        <div class="shop_toolbar_wrapper">
                            <div class="shop_toolbar_btn">
                                <button data-role="grid_4" type="button" class="active btn-grid-4" data-bs-toggle="tooltip" title="4"><i class="fa fa-th"></i></button>
                                <button data-role="grid_3" type="button" class="btn-grid-3" data-bs-toggle="tooltip" title="3"> <i class="fa fa-th-large"></i></button>
                            </div>
                            <div class="shop-select">
                                <form class="d-flex flex-column w-100" action="#">
                                    <div class="form-group">

                                        <select id="categorySelect" class="form-control nice-select w-100" onchange="navigateToCategory()">
                                            <option value="#">Select a category</option>
                                            <?php
                                            // Your database connection code here
                                            $sql = "SELECT * FROM categories_cha";
                                            $stm = $connection->prepare($sql);
                                            $stm->execute();
                                            $categories = $stm->fetchAll();

                                            foreach ($categories as $category) {
                                                echo '<option type="submit" value="./shop1.php?id=' . $category['id'] . '">' . $category['name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--shop toolbar end-->
                        <!-- Shop Wrapper Start -->
                        <div class="row shop_wrapper grid_4">
                            <?php
                            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                            $productsPerPage = 9;
                            $from = ($page - 1) * $productsPerPage;

                            // Fetch products with pagination
                            $sql = "SELECT * FROM products LIMIT :from, :perPage";
                            $statement = $connection->prepare($sql);
                            $statement->bindParam(':from', $from, PDO::PARAM_INT);
                            $statement->bindParam(':perPage', $productsPerPage, PDO::PARAM_INT);
                            $statement->setFetchMode(PDO::FETCH_ASSOC);
                            $statement->execute();
                            $products = $statement->fetchAll();

                            $currentPage = $page;

                            $prevPage = $currentPage - 1;
                            $nextPage = $currentPage + 1;

                            $queryCount = "SELECT COUNT(*) as total FROM products";
                            $statementCount = $connection->query($queryCount);
                            $totalrows = $statementCount->fetch(PDO::FETCH_ASSOC)['total'];
                            $totalpages = ceil($totalrows / $productsPerPage);
                            ?>

                            <?php
                            foreach ($products as $product) {
                            ?>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-custom product-area">

                                    <div class="single-product position-relative">
                                        <div class="product-image">
                                            <a class="d-block" href="./product-detail.php?id=<?php echo $product['id']; ?>">
                                                <img src="./uploads/<?php echo $product['image']; ?>" alt="" class="product-image-1 w-100" style="height: 24rem;">
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <div class="product-title">
                                                <h4 class="title-2"> <a href="./product-detail.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></h4>
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price "><?php echo number_format($product['price']) . 'Vnđ'; ?></span>
                                            </div>
                                        </div>
                                        <div class="add-action d-flex position-absolute">
                                            <a href="./product-detail.php?id=<?php echo $product['id']; ?>" title="Add To cart">
                                                <i class="ion-bag"></i>
                                            </a>
                                            <a href="compare.html" title="Compare">
                                                <i class="ion-ios-loop-strong"></i>
                                            </a>
                                            <a href="wishlist.html" title="Add To Wishlist">
                                                <i class="ion-ios-heart-outline"></i>
                                            </a>
                                            <a href="#exampleModalCenter" data-bs-toggle="modal" title="Quick View">
                                                <i class="ion-eye"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <script>
                            function navigateToCategory() {
                                var select = document.getElementById("categorySelect");
                                var selectedOption = select.options[select.selectedIndex];
                                if (selectedOption.value !== "#") {
                                    window.location.href = selectedOption.value;
                                }
                            }
                        </script>
                        <!-- Shop Wrapper End -->
                        <!-- Bottom Toolbar Start -->
                        <div class="row">
                            <div class="col-sm-12 col-custom">
                                <div class="toolbar-bottom mt-30">
                                    <nav class="pagination pagination-wrap mb-10 mb-sm-0">
                                        <ul class="pagination">
                                            <?php

                                            if ($currentPage > 1) {
                                                echo "<li class='prev'><a href='shop1z.php?option=home&page=$prevPage' title='Previous'><i class='ion-ios-arrow-thin-left'></i></a></li>";
                                            } else {
                                                echo "<li class='disabled prev'><i class='ion-ios-arrow-thin-left'></i></li>";
                                            }

                                            for ($i = 1; $i <= $totalpages; $i++) {
                                                if ($i == $currentPage) {
                                                    echo "<li class='active'><a>$i</a></li>";
                                                } else {
                                                    echo "<li><a href='shop1.php?option=home&page=$i'>$i</a></li>";
                                                }
                                            }

                                            if ($currentPage < $totalpages) {
                                                echo "<li class='next'><a href='shop1.php?option=home&page=$nextPage' title='Next'><i class='ion-ios-arrow-thin-right'></i></a></li>";
                                            } else {
                                                echo "<li class='disabled next'><i class='ion-ios-arrow-thin-right'></i></li>";
                                            }
                                            ?>
                                        </ul>
                                    </nav>
                                    <p class="desc-content text-center text-sm-right">Showing 1 - 12 of 34 result</p>
                                </div>
                            </div>
                        </div>
                        <!-- Bottom Toolbar End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Main Area End Here -->
        <!-- Support Area Start Here -->
        <div class="support-area">
            <div class="container container-default custom-area">
                <div class="row">
                    <div class="col-lg-12 col-custom">
                        <div class="support-wrapper d-flex">
                            <div class="support-content">
                                <h1 class="title">Need Help ?</h1>
                                <p class="desc-content">Call our support 24/7 at 01234-567-890</p>
                            </div>
                            <div class="support-button d-flex align-items-center">
                                <a class="obrien-button primary-btn" href="contact-us.html">Contact now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Support Area End Here -->
        <!-- Footer Area Start Here -->
        <?php include './layoat_phu/foo.php'; ?>
        <!-- Footer Area End Here -->
    </div>

    <!-- Modal Area Start Here -->
    <div class="modal fade obrien-modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close close-button" data-bs-dismiss="modal" aria-label="Close">
                    <span class="close-icon" aria-hidden="true">x</span>
                </button>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 text-center">
                                <div class="product-image">
                                    <img src="assets/images/product/1.jpg" alt="Product Image">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="modal-product">
                                    <div class="product-content">
                                        <div class="product-title">
                                            <h4 class="title">Product dummy name</h4>
                                        </div>
                                        <div class="price-box">
                                            <span class="regular-price ">$80.00</span>
                                            <span class="old-price"><del>$90.00</del></span>
                                        </div>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span>1 Review</span>
                                        </div>
                                        <p class="desc-content">we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame bel...</p>
                                        <form class="d-flex flex-column w-100" action="#">
                                            <div class="form-group">
                                                <select class="form-control nice-select w-100">
                                                    <option>S</option>
                                                    <option>M</option>
                                                    <option>L</option>
                                                    <option>XL</option>
                                                    <option>XXL</option>
                                                </select>
                                            </div>
                                        </form>
                                        <div class="quantity-with_btn">
                                            <div class="quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" value="0" type="text">
                                                    <div class="dec qtybutton">-</div>
                                                    <div class="inc qtybutton">+</div>
                                                </div>
                                            </div>
                                            <div class="add-to_cart">
                                                <a class="btn obrien-button primary-btn" href="cart.html">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Area End Here -->

    <!-- Scroll to Top Start -->
    <a class="scroll-to-top" href="#">
        <i class="ion-chevron-up"></i>
    </a>
    <!-- Scroll to Top End -->

    <!-- JS
============================================ -->

    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- jQuery Migrate JS -->
    <script src="assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <!-- Slick Slider JS -->
    <script src="assets/js/plugins/slick.min.js"></script>
    <!-- Countdown JS -->
    <script src="assets/js/plugins/jquery.countdown.min.js"></script>
    <!-- Ajax JS -->
    <script src="assets/js/plugins/jquery.ajaxchimp.min.js"></script>
    <!-- Jquery Nice Select JS -->
    <script src="assets/js/plugins/jquery.nice-select.min.js"></script>
    <!-- Jquery Ui JS -->
    <script src="assets/js/plugins/jquery-ui.min.js"></script>
    <!-- jquery magnific popup js -->
    <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

</body>


<!-- Mirrored from template.hasthemes.com/obrien/obrien/shop-fullwidth.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Aug 2023 02:18:00 GMT -->

</html>