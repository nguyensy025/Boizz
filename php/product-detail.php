<?php
include('./provider.php');
session_start();
ob_start();
if (isset($_SESSION['countPro'])) {
    $countCartPro = $_SESSION['countPro'];
} else {
    $countCartPro = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './layoat_phu/head.php'; ?>
    <title>Sản phẩm</title>
</head>
<body>
    <?php
    $sql = 'SELECT * FROM products WHERE id = :id';
    $statement = $connection->prepare($sql);
    if ($statement->execute([
        ':id' => intval($_GET['id']),
    ])) {
        $product_dt = $statement->fetchAll();
    }
    foreach ($product_dt as $product_dt) {
        /* echo '<pre>';
        var_dump($product_dt); */
    ?>
        <div class="container">
            <?php include './layoat_phu/heder.php'; ?>
            <div class="breadcrumbs-area position-relative">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="breadcrumb-content position-relative section-content">
                                <h3 class="title-3">Product</h3>
                                <ul>
                                    <li><a href="index2.php">Home</a></li>
                                    <li>product</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="single-product-main-area">
                    <div class="container container-default custom-area">
                        <div class="row">
                            <div class="col-lg-5 col-custom">
                                <div class="product-details-img horizontal-tab">
                                    <div class="product-slider popup-gallery product-details_slider" data-slick-options='{
                        "slidesToShow": 1,
                        "arrows": false,
                        "fade": true,
                        "draggable": false,
                        "swipe": false,
                        "asNavFor": ".pd-slider-nav"
                        }'>
                                        <div class="single-image border">

                                            <img src="./uploads/<?php echo $product_dt['image']; ?>" alt="Product">

                                        </div>

                                    </div>
                                    <div class="pd-slider-nav product-slider" data-slick-options='{
                        "slidesToShow": 4,
                        "asNavFor": ".product-details_slider",
                        "focusOnSelect": true,
                        "arrows" : false,
                        "spaceBetween": 30,
                        "vertical" : false
                        }' data-slick-responsive='[
                            {"breakpoint":1501, "settings": {"slidesToShow": 4}},
                            {"breakpoint":1200, "settings": {"slidesToShow": 4}},
                            {"breakpoint":992, "settings": {"slidesToShow": 4}},
                            {"breakpoint":575, "settings": {"slidesToShow": 3}}
                        ]'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-custom">
                                <div class="product-summery position-relative">
                                    <div class="product-head mb-3">
                                        <h2 class="product-title"><?php echo $product_dt['name']; ?></h2>
                                    </div>
                                    <div class="price-box mb-2">
                                        <span class="regular-price"><?php echo $product_dt['price']; ?>VNĐ</span>
                                        <span class="old-price"><del>4000000</del>VNĐ</span>
                                    </div>
                                    <div class="product-rating mb-3">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <p class="desc-content mb-5"><? echo $product_dt['detail']; ?></p>
                                    <form action="./add-to-cart.php" method="post">
                                        <div class="quantity-with_btn mb-4">
                                            <div class="quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" value="1" type="text" id="quantity" name="quantity">
                                                    <div class="dec qtybutton">-</div>
                                                    <div class="inc qtybutton">+</div>
                                                </div>
                                            </div>
                                            <div class="add-to_cart">
                                                <button class="btn obrien-button primary-btn" type="submit" name="product-id" value="<?= $product_dt['id']; ?>">Add to cart</button>
                                                <a class="btn obrien-button-2 treansparent-color pt-0 pb-0" href="wishlist.html">Add to wishlist</a>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="buy-button mb-5">
                                        <a href="#" class="btn obrien-button-3 black-button">Buy it now</a>
                                    </div>
                                    <div class="social-share mb-4">
                                        <span>Share :</span>
                                        <a href="#"><i class="fa fa-facebook-square facebook-color"></i></a>
                                        <a href="#"><i class="fa fa-twitter-square twitter-color"></i></a>
                                        <a href="#"><i class="fa fa-linkedin-square linkedin-color"></i></a>
                                        <a href="#"><i class="fa fa-pinterest-square pinterest-color"></i></a>
                                    </div>
                                    <div class="payment">
                                        <a href="#"><img class="border" src="assets/images/payment/img-payment.png" alt="Payment"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-no-text">
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#connect-1" role="tab" aria-selected="true">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="profile-tab" data-bs-toggle="tab" href="#connect-2" role="tab" aria-selected="false">Reviews</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="contact-tab" data-bs-toggle="tab" href="#connect-3" role="tab" aria-selected="false">Shipping Policy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase" id="review-tab" data-bs-toggle="tab" href="#connect-4" role="tab" aria-selected="false">Size Chart</a>
                                    </li>
                                </ul>
                                <div class="tab-content mb-text" id="myTabContent">
                                    <div class="tab-pane fade show active" id="connect-1" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="desc-content">
                                            <p class="mb-3"><?php echo $product_dt['description']; ?></p>
                                            <p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="connect-2" role="tabpanel" aria-labelledby="profile-tab">
                                        <!-- Start Single Content -->
                                        <div class="product_tab_content  border p-3">
                                            <div class="review_address_inner">
                                                <!-- Start Single Review -->
                                                <div class="pro_review mb-5">
                                                    <div class="review_thumb">
                                                        <img alt="review images" src="assets/images/review/1.jpg">
                                                    </div>
                                                    <div class="review_details">
                                                        <div class="review_info mb-2">
                                                            <div class="product-rating mb-2">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </div>
                                                            <h5>Admin - <span> December 19, 2020</span></h5>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin in viverra ex, vitae vestibulum arcu. Duis sollicitudin metus sed lorem commodo, eu dapibus libero interdum. Morbi convallis viverra erat, et aliquet orci congue vel. Integer in odio enim. Pellentesque in dignissim leo. Vivamus varius ex sit amet quam tincidunt iaculis.</p>
                                                    </div>
                                                </div>
                                                <!-- End Single Review -->
                                            </div>
                                            <!-- Start RAting Area -->
                                            <div class="rating_wrap">
                                                <h5 class="rating-title-1 mb-2">Add a review </h5>
                                                <p class="mb-2">Your email address will not be published. Required fields are marked *</p>
                                                <h6 class="rating-title-2 mb-2">Your Rating</h6>
                                                <div class="rating_list mb-4">
                                                    <div class="review_info">
                                                        <div class="product-rating mb-3">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End RAting Area -->
                                            <div class="comments-area comments-reply-area">
                                                <div class="row">
                                                    <div class="col-lg-12 col-custom">
                                                        <form action="#" class="comment-form-area">
                                                            <div class="row comment-input">
                                                                <div class="col-md-6 col-custom comment-form-author mb-3">
                                                                    <label>Name <span class="required">*</span></label>
                                                                    <input type="text" required="required" name="Name">
                                                                </div>
                                                                <div class="col-md-6 col-custom comment-form-emai mb-3">
                                                                    <label>Email <span class="required">*</span></label>
                                                                    <input type="text" required="required" name="email">
                                                                </div>
                                                            </div>
                                                            <div class="comment-form-comment mb-3">
                                                                <label>Comment</label>
                                                                <textarea class="comment-notes" required="required"></textarea>
                                                            </div>
                                                            <div class="comment-form-submit">
                                                                <input type="submit" value="Submit" class="comment-submit btn obrien-button primary-btn">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Content -->
                                    </div>
                                    <div class="tab-pane fade" id="connect-3" role="tabpanel" aria-labelledby="contact-tab">
                                        <div class="shipping-policy">
                                            <h4 class="title-3 mb-4">Shipping policy for our store</h4>
                                            <p class="desc-content mb-2">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate</p>
                                            <ul class="policy-list mb-2">
                                                <li>1-2 business days (Typically by end of day)</li>
                                                <li><a href="#">30 days money back guaranty</a></li>
                                                <li>24/7 live support</li>
                                                <li>odio dignissim qui blandit praesent</li>
                                                <li>luptatum zzril delenit augue duis dolore</li>
                                                <li>te feugait nulla facilisi.</li>
                                            </ul>
                                            <p class="desc-content mb-2">Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum</p>
                                            <p class="desc-content mb-2">claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per</p>
                                            <p class="desc-content mb-2">seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="connect-4" role="tabpanel" aria-labelledby="review-tab">
                                        <div class="size-tab table-responsive-lg">
                                            <h4 class="title-3 mb-4">Size Chart</h4>
                                            <table class="table border">
                                                <tbody>
                                                    <tr>
                                                        <td class="cun-name"><span>UK</span></td>
                                                        <td>18</td>
                                                        <td>20</td>
                                                        <td>22</td>
                                                        <td>24</td>
                                                        <td>26</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cun-name"><span>European</span></td>
                                                        <td>46</td>
                                                        <td>48</td>
                                                        <td>50</td>
                                                        <td>52</td>
                                                        <td>54</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cun-name"><span>usa</span></td>
                                                        <td>14</td>
                                                        <td>16</td>
                                                        <td>18</td>
                                                        <td>20</td>
                                                        <td>22</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cun-name"><span>Australia</span></td>
                                                        <td>28</td>
                                                        <td>10</td>
                                                        <td>12</td>
                                                        <td>14</td>
                                                        <td>16</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cun-name"><span>Canada</span></td>
                                                        <td>24</td>
                                                        <td>18</td>
                                                        <td>14</td>
                                                        <td>42</td>
                                                        <td>36</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php include './layoat_phu/foo.php'; ?>
        </div>
    <?php } ?>
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

</html>