<?php
session_start();
ob_start();
include('./provider.php');
if (isset($_SESSION['countPro'])) {
    $countCartPro = $_SESSION['countPro'];
} else {
    $countCartPro = 0;
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include './layoat_phu/head.php'; ?>
</head>

<body>
    <div class="home-wrapper home-2">
        <!-- Header Area Start Here -->
        <?php include './layoat_phu/heder.php'; ?>
        <!-- Header Area End Here -->
        <!-- Begin Slider Area One -->
        <div class="slider-area">
            <div class="obrien-slider arrow-style" data-slick-options='{
        "slidesToShow": 1,
        "slidesToScroll": 1,
        "infinite": true,
        "arrows": true,
        "dots": true,
        "autoplay" : true,
        "fade" : true,
        "autoplaySpeed" : 7000,
        "pauseOnHover" : false,
        "pauseOnFocus" : false
        }' data-slick-responsive='[
        {"breakpoint":992, "settings": {
        "slidesToShow": 1,
        "arrows": false,
        "dots": true
        }}
        ]'>
                <div class="slide-item slide-1 bg-position slide-bg-1 animation-style-01">
                    <div class="slider-content" style="position: absolute;
                    top: 50%;
                    -webkit-transform: translateY(-50%);
                        -ms-transform: translateY(-50%);
                            transform: translateY(-50%);
                    left : 15%;
                    
                    margin: 0 auto;
                    max-width: 1480px;
                    padding: 0 15px;">
                                            <h4 class="slider-small-title" style="font-weight: 400;
                    font-size: 36px;
                    margin-bottom: 10px;">Organic Products</h4>
                        <h2 class="slider-large-title" style="font-size: 60px;">Fresh Avocado</h2>
                        <div class="slider-btn" style=" margin-top: 30px;">
                            <a class="obrien-button black-btn" href="shop.php">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="slide-item slide-4 bg-position slide-bg-1 animation-style-01">
                    <div class="slider-content" style="position: absolute;
                                top: 50%;
                                -webkit-transform: translateY(-50%);
                                    -ms-transform: translateY(-50%);
                                        transform: translateY(-50%);
                               left : 15%;
                               
                                margin: 0 auto;
                                max-width: 1480px;
                                padding: 0 15px;">
                        <h4 class="slider-small-title" style="font-weight: 400;
                            font-size: 36px;
                            margin-bottom: 10px;">Cold process organic</h4>
                        <h2 class="slider-large-title" style="font-size: 50px;">Superior skin care</h2>
                        <div class="slider-btn" style="  margin-top: 30px;">
                            <a class="obrien-button black-btn" href="shop.php">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Area One End Here -->

        <!-- Feature Area Start Here -->
        <div class="feature-area" style="padding-top: 100px;">
            <div class=" container container-default custom-wrapper">
                <div class="row">
                    <div class="col-xl-6 col-lg-5 col-md-12 col-custom">
                        <div class="feature-content-wrapper">
                            <h2 class="title">Important to eat fruit</h2>
                            <p class="desc-content">Eating fruit provides health benefits — people who eat more fruits and vegetables as part of an overall healthy diet are likely to have a reduced risk of some chronic diseases. Fruits provide nutrients vital for health and maintenance of your body.</p>
                            <p class="desc-content"> Fruits are sources of many essential nutrients that are underconsumed, including potassium, dietary fiber, vitamin C, and folate (folic acid).</p>
                            <p class="desc-content"> Most fruits are naturally low in fat, sodium, and calories. None have cholesterol.</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-7 col-md-12 col-custom">
                        <div class="feature-image">
                            <img src="assets/images/feature/feature-1.jpg" alt="Obrien Feature">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature Area End Here -->
        <!-- Product Area Start Here -->
        <div class="product-area" style="padding-top: 100px;">
            <div class="container container-default custom-area">
                <div class="row">
                    <div class="col-lg-5 m-auto text-center col-custom">
                        <div class="section-content">
                            <h2 class="title-1 text-uppercase">Best Sale</h2>
                            <div class="desc-content">
                                <p>All best seller product are now available for you and your can buy this product from here any time any where so sop now</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 product-wrapper col-custom">
                        <div class="product-slider" data-slick-options='{
                        "slidesToShow": 4,
                        "slidesToScroll": 1,
                        "infinite": true,
                        "arrows": false,
                        "dots": false
                        }' data-slick-responsive='[
                        {"breakpoint": 1200, "settings": {
                        "slidesToShow": 3
                        }},
                        {"breakpoint": 992, "settings": {
                        "slidesToShow": 2
                        }},
                        {"breakpoint": 576, "settings": {
                        "slidesToShow": 1
                        }}
                        ]'>
                            <?php
                            $query = "SELECT * FROM products";
                            $stm = $connection->prepare($query);
                            $stm->execute();
                            $products = $stm->fetchAll();
                            ?>
                            <?php
                            foreach ($products as $newArrival) {
                            ?>
                                <div class="single-item">
                                    <div class="single-product position-relative">
                                        <div class="product-image">
                                            <a href="./product-detail.php?id=<?= $newArrival['id']; ?>">
                                                <img src="./uploads/<?= $newArrival['image']; ?>" class="product-image-1 w-100" alt="...">
                                            </a>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="product-title">
                                                <h4 class="title-2"> <a href="product-details.html"><?= $newArrival['name']; ?></a></h4>
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price "><?php echo number_format($newArrival['price']) . ' Vnđ'; ?></span>
                                            </div>
                                        </div>
                                        <div class="add-action d-flex position-absolute">
                                            <a href="cart.php" title="Add To cart">
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
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Area End Here -->
        <!-- Banner Fullwidth Area Start Here -->
        <div class="banner-fullwidth-area" style="padding-top: 100px; margin-top: 100px;">
            <div class="container custom-wrapper">
                <div class="row">
                    <div class="col-md-5 col-lg-6 text-center col-custom">
                        <div class="banner-thumb h-100 d-flex justify-content-center align-items-center">
                            <img src="assets/images/banner/thumb/1.png" alt="Banner Thumb">
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-6 text-center justify-content-center col-custom">
                        <div class="banner-flash-content d-flex flex-column align-items-center justify-content-center h-100">
                            <h2 class="deal-head text-uppercase">Flash Deals</h2>
                            <h3 class="deal-title text-uppercase">Hurry up and Get 25% Discount</h3>
                            <a href="shop.php" class="obrien-button primary-btn">Shop Now</a>
                            <div class="countdown-wrapper d-flex justify-content-center" data-countdown="2023/10/24"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Fullwidth Area End Here -->
        <!-- Banner Area Start Here -->
        <!-- Banner Area End Here -->
        <!-- Product Area Start Here -->

    </div>
    </div>
    </div>
    <!-- Product Area End Here -->
    <!-- Newslatter Area Start Here -->
    <div class="product-area" style="padding-top: 100px;">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-5 m-auto text-center col-custom">
                    <div class="section-content">
                        <h2 class="title-1 text-uppercase">Best Sale</h2>
                        <div class="desc-content">
                            <p>All best seller product are now available for you and your can buy this product from here any time any where so sop now</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 product-wrapper col-custom">
                    <div class="product-slider" data-slick-options='{
                        "slidesToShow": 4,
                        "slidesToScroll": 1,
                        "infinite": true,
                        "arrows": false,
                        "dots": false
                        }' data-slick-responsive='[
                        {"breakpoint": 1200, "settings": {
                        "slidesToShow": 3
                        }},
                        {"breakpoint": 992, "settings": {
                        "slidesToShow": 2
                        }},
                        {"breakpoint": 576, "settings": {
                        "slidesToShow": 1
                        }}
                        ]'>
                        <?php
                        $query = "SELECT * FROM products";
                        $stm = $connection->prepare($query);
                        $stm->execute();
                        $products = $stm->fetchAll();
                        ?>
                        <?php
                        foreach ($products as $newArrival) {
                        ?>
                            <div class="single-item">
                                <div class="single-product position-relative">
                                    <div class="product-image">
                                        <a href="./product-detail.php?id=<?= $newArrival['id']; ?>">
                                            <img src="./uploads/<?= $newArrival['image']; ?>" class="product-image-1 w-100" alt="...">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-title">
                                            <h4 class="title-2"> <a href="product-details.html"><?= $newArrival['name']; ?></a></h4>
                                        </div>
                                        <div class="price-box">
                                            <span class="regular-price "><?php echo number_format($newArrival['price']) . ' Vnđ'; ?></span>
                                        </div>
                                    </div>
                                    <div class="add-action d-flex position-absolute">
                                        <a href="cart.php" title="Add To cart">
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
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newslatter Area End Here -->
    <!-- Latest Blog Area Start Here -->
    <div class="latest-blog-area" style="margin-top: 100px;">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-5 m-auto text-center col-custom">
                    <div class="section-content">
                        <h2 class="title-1 text-uppercase">Latest Blog</h2>
                        <div class="desc-content">
                            <p>If you want to know about the organic product then keep an eye on our blog.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-custom">
                    <div class="obrien-slider" data-slick-options='{
                        "slidesToShow": 2,
                        "slidesToScroll": 1,
                        "infinite": true,
                        "arrows": false,
                        "dots": false
                        }' data-slick-responsive='[
                        {"breakpoint": 1200, "settings": {
                        "slidesToShow": 2
                        }},
                        {"breakpoint": 992, "settings": {
                        "slidesToShow": 2
                        }},
                        {"breakpoint": 768, "settings": {
                        "slidesToShow": 1
                        }},
                        {"breakpoint": 576, "settings": {
                        "slidesToShow": 1
                        }}
                        ]'>
                        <div class="single-blog">
                            <div class="single-blog-thumb">
                                <a href="blog.html">
                                    <img src="assets/images/blog/medium-size/1.jpg" alt="Blog Image">
                                </a>
                            </div>
                            <div class="single-blog-content position-relative">
                                <div class="post-date text-center border rounded d-flex flex-column position-absolute">
                                    <span>14</span>
                                    <span>01</span>
                                </div>
                                <div class="post-meta">
                                    <span class="author">Author: Obrien Demo Admin</span>
                                </div>
                                <h2 class="post-title">
                                    <a href="blog.html">There Are Many Variation of Passages of Lorem Ipsum Available</a>
                                </h2>
                                <p class="desc-content">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making...</p>
                            </div>
                        </div>
                        <div class="single-blog">
                            <div class="single-blog-thumb">
                                <a href="blog.html">
                                    <img src="assets/images/blog/medium-size/2.jpg" alt="Blog Image">
                                </a>
                            </div>
                            <div class="single-blog-content position-relative">
                                <div class="post-date text-center border rounded d-flex flex-column position-absolute">
                                    <span>14</span>
                                    <span>01</span>
                                </div>
                                <div class="post-meta">
                                    <span class="author">Author: Obrien Demo Admin</span>
                                </div>
                                <h2 class="post-title">
                                    <a href="blog.html">There Are Many Variation of Passages of Lorem Ipsum Available</a>
                                </h2>
                                <p class="desc-content">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making...</p>
                            </div>
                        </div>
                        <div class="single-blog">
                            <div class="single-blog-thumb">
                                <a href="blog.html">
                                    <img src="assets/images/blog/medium-size/3.jpg" alt="Blog Image">
                                </a>
                            </div>
                            <div class="single-blog-content position-relative">
                                <div class="post-date text-center border rounded d-flex flex-column position-absolute">
                                    <span>14</span>
                                    <span>01</span>
                                </div>
                                <div class="post-meta">
                                    <span class="author">Author: Obrien Demo Admin</span>
                                </div>
                                <h2 class="post-title">
                                    <a href="blog.html">The Standard Chunk Of Lorem Ipsum Used Since</a>
                                </h2>
                                <p class="desc-content">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making...</p>
                            </div>
                        </div>
                        <div class="single-blog">
                            <div class="single-blog-thumb">
                                <a href="blog.html">
                                    <img src="assets/images/blog/medium-size/4.jpg" alt="Blog Image">
                                </a>
                            </div>
                            <div class="single-blog-content position-relative">
                                <div class="post-date text-center border rounded d-flex flex-column position-absolute">
                                    <span>14</span>
                                    <span>01</span>
                                </div>
                                <div class="post-meta">
                                    <span class="author">Author: Obrien Demo Admin</span>
                                </div>
                                <h2 class="post-title">
                                    <a href="blog.html">There Are Many Variation of Passages of Lorem Ipsum Available</a>
                                </h2>
                                <p class="desc-content">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Latest Blog Area End Here -->

    <!-- Support Area Start Here -->
    <div class="support-area" style="margin-top: 100px;">
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


<!-- Mirrored from template.hasthemes.com/obrien/obrien/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Aug 2023 02:17:55 GMT -->

</html>