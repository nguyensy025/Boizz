<!doctype html>
<html class="no-js" lang="en">
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

<!-- Mirrored from template.hasthemes.com/obrien/obrien/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Aug 2023 02:18:03 GMT -->

<head>
    <?php include './layoat_phu/head.php'; ?>
</head>
<body>

    <div class="shop-wrapper">
        <?php include './layoat_phu/heder.php'; ?>
        <!-- Breadcrumb Area Start Here -->
        <div class="breadcrumbs-area position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="breadcrumb-content position-relative section-content">
                            <h3 class="title-3">Shop Sidebar</h3>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>Shop</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End Here -->
        <!-- Shop Main Area Start Here -->
        <div class="shop-main-area">
            <div class="container container-default custom-area">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9 col-12 col-custom widget-mt">
                        <!--shop toolbar start-->
                        <div class="shop_toolbar_wrapper">
                            <div class="shop-select">
                                <h5>san pham</h5>
                            </div>
                        </div>
                        <!--shop toolbar end-->
                        <!-- Shop Wrapper Start -->
                        <?php
                        if (isset($_GET['id'])) {
                            $query = "SELECT * FROM products WHERE category_id= :id";
                            $stm = $connection->prepare($query);
                            $stm->execute([
                                ':id' => intval($_GET['id']),
                            ]);
                            $products = $stm->fetchAll();
                        }
                        ?>
                        <div class="row shop_wrapper grid_3">
                            <?php
                            foreach ($products as $product) {
                            ?>
                                <!-- this -->
                                <div class="col-md-6 col-sm-6 col-lg-4 col-custom product-area">
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
                                            <a href="cart.html" title="Add To cart">
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
                                        <div class="product-content-listview">
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
                                            <div class="add-action-listview d-flex">
                                                <a href="cart.html" title="Add To cart">
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
                                            <p class="desc-content">
                                                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <!-- Shop Wrapper End -->
                        <!-- Bottom Toolbar Start -->
                        <div class="row">
                            <div class="col-sm-12 col-custom">
                                <div class="toolbar-bottom mt-30">
                                    <nav class="pagination pagination-wrap mb-10 mb-sm-0">
                                        <ul class="pagination">
                                            <li class="disabled prev">
                                                <i class="ion-ios-arrow-thin-left"></i>
                                            </li>
                                            <li class="active"><a>1</a></li>
                                            <li>
                                                <a href="#">2</a>
                                            </li>
                                            <li class="next">
                                                <a href="#" title="Next >>"><i class="ion-ios-arrow-thin-right"></i></a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <p class="desc-content text-center text-sm-right">Showing 1 - 12 of 34 result</p>
                                </div>
                            </div>
                        </div>
                        <!-- Bottom Toolbar End -->
                    </div>
                    <div class="col-lg-3 col-12 col-custom">
                        <!-- Sidebar Widget Start -->
                        <aside class="sidebar_widget widget-mt">
                            <div class="widget_inner">
                                <div class="widget-list widget-mb-1">
                                    <h3 class="widget-title">Search</h3>
                                    <div class="search-box">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search Our Store" aria-label="Search Our Store">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-list widget-mb-1">
                                    <h3 class="widget-title">Categories</h3>
                                    <div class="sidebar-body">
                                        <ul class="sidebar-list">
                                            <li><a href="./shop.php">All</a></li>
                                        </ul>
                                    </div>
                                    <?php
                                    $sql = "SELECT * FROM categories_cha";
                                    $stm = $connection->prepare($sql);
                                    $stm->execute();
                                    $categories = $stm->fetchAll();
                                    foreach ($categories as $category) { ?>
                                        <div class="sidebar-body">
                                            <ul class="sidebar-list">
                                                <li><a href="./shop-load-product.php?id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                    </div>
                    </aside>
                    <!-- Sidebar Widget End -->
                    <div class="row shop_wrapper grid_3">
                        <?php
                        $description = 'Limited';  // Đặt giá trị cố định
                        $query = "SELECT * FROM products WHERE description = :description";
                        $stm = $connection->prepare($query);
                        $stm->bindValue(':description', $description, PDO::PARAM_STR);  // Gán giá trị cho tham số ràng buộc
                        $stm->execute();
                        $limited = $stm->fetchAll();
                        ?>
                        <?php
                        foreach ($limited as $product) {
                        ?>
                            <div class="col-md-6 col-sm-6 col-lg-4 col-custom product-area">

                                <div class="single-product position-relative">
                                    <div class="product-image">
                                        <a href="./product-detail.php?id=<?php echo $product['id']; ?>">
                                            <img src="./uploads/<?php echo $product['image']; ?>" class="image" alt="...">
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
                                            <h4 class="title-2"> <a href="product-details.html"><?php echo $product['name']; ?></a></h4>
                                        </div>
                                        <div class="price-box">
                                            <span class="regular-price"><?php echo number_format($product['price']) . ' Vnđ'; ?></span>
                                        </div>
                                    </div>
                                    <div class="add-action d-flex position-absolute">
                                        <a href="cart.html" title="Add To cart">
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
                                    <div class="product-content-listview">
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="product-title">
                                            <h4 class="title-2"> <a href="product-details.html">Product dummy name</a></h4>
                                        </div>
                                        <div class="price-box">
                                            <span class="regular-price ">$80.00</span>
                                            <span class="old-price"><del>$90.00</del></span>
                                        </div>
                                        <div class="add-action-listview d-flex">
                                            <a href="cart.html" title="Add To cart">
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
                                        <p class="desc-content">
                                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

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


<!-- Mirrored from template.hasthemes.com/obrien/obrien/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Aug 2023 02:18:04 GMT -->

</html>