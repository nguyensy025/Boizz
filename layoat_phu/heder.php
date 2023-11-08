
<header class="main-header-area">
    <div class="main-header">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-12 col-custom">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-xl-2 col-sm-6 col-6 col-custom">
                            <div class="header-logo d-flex align-items-center">
                                <a href="index2.php">
                                    <img class="img-full" src="./assets/images/logo/logo.png" alt="Header Logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xl-7 position-static d-none d-lg-block col-custom">
                            <nav class="main-nav d-flex justify-content-center">
                                <ul class="nav">
                                    <li>
                                        <a class="active" href="index2.php">
                                            <span class="menu-text"> Home</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop.php">
                                            <span class="menu-text">Shop</span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="mega-menu dropdown-hover">
                                            <div class="menu-colum">
                                                <ul>
                                                    <li><span class="mega-menu-text">Shop</span></li>
                                                    <li><a href="shop.php">Shop left</a></li>
                                                    <li><a href="shop1.php">Shop</a></li>

                                                </ul>
                                            </div>
                                            <div class="menu-colum">
                                                <ul>
                                                    <li><span class="mega-menu-text">Product</span></li>
                                                    <li><a href="product-details.html">Single Product</a></li>
                                                    <li><a href="variable-product-details.html">Variable Product</a></li>
                                                    <li><a href="external-product-details.html">External Product</a></li>
                                                    <li><a href="gallery-product-details.html">Gallery Product</a></li>
                                                    <li><a href="countdown-product-details.html">Countdown Product</a></li>
                                                </ul>
                                            </div>
                                            <div class="menu-colum">
                                                <ul>
                                                    <li><span class="mega-menu-text">Others</span></li>
                                                    <li><a href="error-404.html">Error 404</a></li>
                                                    <li><a href="compare.html">Compare Page</a></li>
                                                    <li><a href="cart.html">Cart Page</a></li>
                                                    <li><a href="checkout.html">Checkout Page</a></li>
                                                    <li><a href="wishlist.html">Wishlist Page</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="blog-details-fullwidth.html">
                                            <span class="menu-text"> Blog</span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-submenu dropdown-hover">
                                            <li><a href="blog.html">Blog Left Sidebar</a></li>
                                            <li><a href="blog-list-right-sidebar.html">Blog List Right Sidebar</a></li>
                                            <li><a href="blog-list-fullwidth.html">Blog List Fullwidth</a></li>
                                            <li><a href="blog-grid.html">Blog Grid Page</a></li>
                                            <li><a href="blog-grid-right-sidebar.html">Blog Grid Right Sidebar</a></li>
                                            <li><a href="blog-grid-fullwidth.html">Blog Grid Fullwidth</a></li>
                                            <li><a href="blog-details-sidebar.html">Blog Details Sidebar</a></li>
                                            <li><a href="blog-details-fullwidth.html">Blog Details Fullwidth</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="menu-text"> Pages</span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-submenu dropdown-hover">
                                            <li><a href="frequently-questions.html">FAQ</a></li>
                                            <li><a href="my-account.html">My Account</a></li>
                                            <li><a href="./login.php">Login</a></li>
                                            <li><a href="./register.php">Register</a></li>
                                            <li><a href="./doimk.php">Change New Password</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="about-us.html">
                                            <span class="menu-text"> About</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="contact-us.html">
                                            <span class="menu-text">Contact</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <?php
                        if(isset($_SESSION['userName'])){
                        $userName = $_SESSION['userName'];
                        $sql = "SELECT * FROM users WHERE username = '$userName'";
                        $stm = $connection->prepare($sql);
                        $stm->execute();
                        $user = $stm->fetch();
                        $userID = $user['id'];
                        $queryUser_cart = "
                    SELECT uc.*, p.name, p.image, p.price
                    FROM user_cart uc
                    INNER JOIN products p ON uc.product_id = p.id
                    WHERE uc.user_id = '$userID'
                ";

                        $stm = $connection->prepare($queryUser_cart);
                        $stm->execute();
                        $user_cart = $stm->fetchAll();
                        }else{
                            $userName = '';
                        }
                        ?>
                        <div class="col-lg-2 col-xl-3 col-sm-6 col-6 col-custom">
                            <div class="header-right-area main-nav">
                                <ul class="nav">
                                    <li class="login-register-wrap d-none d-xl-flex">
                                        <span><a href="#"><?php echo $userName; ?></a></span>
                                    </li>
                                    <li class="minicart-wrap">
                                        <a href="cart.php" class="minicart-btn toolbar-btn">
                                            <i class="ion-bag"></i>
                                            <span class="cart-item_count">
                                                <?php echo $countCartPro; ?>
                                            </span>
                                        </a>
                                        <div class="cart-item-wrapper dropdown-sidemenu dropdown-hover-2">
                                            <?php foreach ($user_cart as $product) { ?>
                                                <div class="single-cart-item">
                                                    <div class="cart-img">
                                                        <a href="cart.html"><img src="./uploads/<?php echo $product['image'] ?>" alt=""></a>
                                                    </div>
                                                    <div class="cart-text">
                                                        <h5 class="title"><a href="cart.php"><?php echo $product['name'] ?></a></h5>
                                                        <div class="cart-text-btn">
                                                            <div class="cart-qty">
                                                                <span><?php echo $product['quantity'] ?>×</span>
                                                                <span class="cart-price"><?php echo $product['price'] ?></span>
                                                            </div>
                                                            <button type="button"><i class="ion-trash-b"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="cart-price-total d-flex justify-content-between">
                                                <h5>Total :</h5>
                                                <h5><?php echo number_format($_SESSION['total']); ?></h5>
                                            </div>
                                            <div class="cart-links d-flex justify-content-center">
                                                <a class="obrien-button white-btn" href="cart.php">View cart</a>
                                                <a class="obrien-button white-btn" href="checkout.php">Checkout</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <li class="mobile-menu-btn d-lg-none">
                            <a class="off-canvas-btn" href="#">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Main Header Area End -->
    <!-- Sticky Header Start Here-->
    <div class="main-header header-sticky">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-12 col-custom">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-xl-2 col-sm-6 col-6 col-custom">
                            <div class="header-logo">
                                <a href="index2.php">
                                    <img class="img-full" src="assets/images/logo/logo.png" alt="Header Logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xl-7 position-static d-none d-lg-block col-custom">
                            <nav class="main-nav d-flex justify-content-center">
                                <ul class="nav">
                                    <li>
                                        <a href="index2.php">
                                            <span class="menu-text"> Home</span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="active" href="shop.php">
                                            <span class="menu-text">Shop</span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="mega-menu dropdown-hover">
                                            <div class="menu-colum">
                                                <ul>
                                                    <li><span class="mega-menu-text">Shop</span></li>
                                                    <li><a class="active" href="shop.php">Shop</a></li>
                                                </ul>
                                            </div>
                                            <div class="menu-colum">
                                                <ul>
                                                    <li><span class="mega-menu-text">Product</span></li>
                                                    <li><a href="product-details.html">Single Product</a></li>
                                                    <li><a href="variable-product-details.html">Variable Product</a></li>
                                                    <li><a href="external-product-details.html">External Product</a></li>
                                                    <li><a href="gallery-product-details.html">Gallery Product</a></li>
                                                    <li><a href="countdown-product-details.html">Countdown Product</a></li>
                                                </ul>
                                            </div>
                                            <div class="menu-colum">
                                                <ul>
                                                    <li><span class="mega-menu-text">Others</span></li>
                                                    <li><a href="error-404.html">Error 404</a></li>
                                                    <li><a href="compare.html">Compare Page</a></li>
                                                    <li><a href="cart.html">Cart Page</a></li>
                                                    <li><a href="checkout.html">Checkout Page</a></li>
                                                    <li><a href="wishlist.html">Wishlist Page</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="blog-details-fullwidth.html">
                                            <span class="menu-text"> Blog</span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-submenu dropdown-hover">
                                            <li><a href="blog.html">Blog Left Sidebar</a></li>
                                            <li><a href="blog-list-right-sidebar.html">Blog List Right Sidebar</a></li>
                                            <li><a href="blog-list-fullwidth.html">Blog List Fullwidth</a></li>
                                            <li><a href="blog-grid.html">Blog Grid Page</a></li>
                                            <li><a href="blog-grid-right-sidebar.html">Blog Grid Right Sidebar</a></li>
                                            <li><a href="blog-grid-fullwidth.html">Blog Grid Fullwidth</a></li>
                                            <li><a href="blog-details-sidebar.html">Blog Details Sidebar</a></li>
                                            <li><a href="blog-details-fullwidth.html">Blog Details Fullwidth</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="menu-text"> Pages</span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-submenu dropdown-hover">
                                            <li><a href="frequently-questions.html">FAQ</a></li>
                                            <li><a href="my-account.html">My Account</a></li>
                                            <li><a href="login.php">Login</a></li>
                                            <li><a href="register.php">Register</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="about-us.html">
                                            <span class="menu-text"> About</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="contact-us.html">
                                            <span class="menu-text">Contact</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-lg-2 col-xl-3 col-sm-6 col-6 col-custom">
                            <div class="header-right-area main-nav">
                                <ul class="nav">
                                    <li class="login-register-wrap d-none d-xl-flex">
                                        <!-- <span><a href="login.php">Login</a></span>
                                        <span><a href="register.php">Register</a></span> -->
                                        <span><a href="#"><?php echo $userName; ?></a></span>
                                    </li>
                                    <li class="minicart-wrap">
                                        <a href="cart.php" class="minicart-btn toolbar-btn">
                                            <i class="ion-bag"></i>
                                            <span class="cart-item_count"><?php echo $_SESSION['countPro']; ?></span>
                                        </a>
                                        <?php
                                        $userName = $_SESSION['userName'];
                                        $sql = "SELECT * FROM users WHERE username = '$userName'";
                                        $stm = $connection->prepare($sql);
                                        $stm->execute();
                                        $user = $stm->fetch();
                                        $userID = $user['id'];
                                        $queryUser_cart = "
                                        SELECT uc.*, p.name, p.image, p.price
                                        FROM user_cart uc
                                        INNER JOIN products p ON uc.product_id = p.id
                                        WHERE uc.user_id = '$userID'
                                    ";

                                        $stm = $connection->prepare($queryUser_cart);
                                        $stm->execute();
                                        $user_cart = $stm->fetchAll();
                                        ?>
                                        <div class="cart-item-wrapper dropdown-sidemenu dropdown-hover-2">
                                            <?php foreach ($user_cart as $product) { ?>
                                                <div class="single-cart-item">
                                                    <div class="cart-img">
                                                        <a href="cart.html"><img src="./uploads/<?php echo $product['image'] ?>" alt=""></a>
                                                    </div>
                                                    <div class="cart-text">
                                                        <h5 class="title"><a href="cart.php"><?php echo $product['name'] ?></a></h5>
                                                        <div class="cart-text-btn">
                                                            <div class="cart-qty">
                                                                <span><?php echo $product['quantity'] ?>×</span>
                                                                <span class="cart-price"><?php echo $product['price'] ?></span>
                                                            </div>
                                                            <button type="button"><i class="ion-trash-b"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="cart-price-total d-flex justify-content-between">
                                                <h5>Total :</h5>
                                                <h5><?php echo number_format($_SESSION['total']); ?></h5>
                                            </div>
                                            <div class="cart-links d-flex justify-content-center">
                                                <a class="obrien-button white-btn" href="cart.php">View cart</a>
                                                <a class="obrien-button white-btn" href="checkout.php">Checkout</a>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="mobile-menu-btn d-lg-none">
                                        <a class="off-canvas-btn" href="#mobileMenu">
                                            <i class="fa fa-bars"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sticky Header End Here -->
    <!-- off-canvas menu start -->
    <aside class="off-canvas-wrapper" id="mobileMenu">
        <div class="off-canvas-overlay"></div>
        <div class="off-canvas-inner-content">
            <div class="btn-close-off-canvas">
                <i class="fa fa-times"></i>
            </div>
            <div class="off-canvas-inner">

                <div class="search-box-offcanvas">
                    <form>
                        <input type="text" placeholder="Search product...">
                        <button class="search-btn"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <!-- mobile menu start -->
                <div class="mobile-navigation">

                    <!-- mobile menu navigation start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><a href="#">Home</a>
                                <ul class="dropdown">
                                    <li><a href="index.html">Home Page 1</a></li>
                                    <li><a href="index-2.html">Home Page 2</a></li>
                                    <li><a href="index-3.html">Home Page 3</a></li>
                                    <li><a href="index-4.html">Home Page 4</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children"><a href="#">Shop</a>
                                <ul class="megamenu dropdown">
                                    <li class="mega-title has-children"><a href="#">Shop Layouts</a>
                                        <ul class="dropdown">
                                            <li><a href="shop.html">Shop Left Sidebar</a></li>
                                            <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                            <li><a href="shop-list-left.html">Shop List Left Sidebar</a></li>
                                            <li><a href="shop-list-right.html">Shop List Right Sidebar</a></li>
                                            <li><a href="shop-fullwidth.html">Shop Full Width</a></li>
                                        </ul>
                                    </li>
                                    <li class="mega-title has-children"><a href="#">Product Details</a>
                                        <ul class="dropdown">
                                            <li><a href="product-details.html">Single Product Details</a></li>
                                            <li><a href="variable-product-details.html">Variable Product Details</a></li>
                                            <li><a href="external-product-details.html">External Product Details</a></li>
                                            <li><a href="gallery-product-details.html">Gallery Product Details</a></li>
                                            <li><a href="countdown-product-details.html">Countdown Product Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="mega-title has-children"><a href="#">Others</a>
                                        <ul class="dropdown">
                                            <li><a href="error404.html">Error 404</a></li>
                                            <li><a href="compare.html">Compare Page</a></li>
                                            <li><a href="cart.html">Cart Page</a></li>
                                            <li><a href="checkout.html">Checkout Page</a></li>
                                            <li><a href="wishlist.html">Wish List Page</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children "><a href="#">Blog</a>
                                <ul class="dropdown">
                                    <li><a href="blog.html">Blog Left Sidebar</a></li>
                                    <li><a href="blog-list-right-sidebar.html">Blog List Right Sidebar</a></li>
                                    <li><a href="blog-list-fullwidth.html">Blog List Fullwidth</a></li>
                                    <li><a href="blog-grid.html">Blog Grid Page</a></li>
                                    <li><a href="blog-grid-right-sidebar.html">Blog Grid Right Sidebar</a></li>
                                    <li><a href="blog-grid-fullwidth.html">Blog Grid Fullwidth</a></li>
                                    <li><a href="blog-details-sidebar.html">Blog Details Sidebar Page</a></li>
                                    <li><a href="blog-details-fullwidth.html">Blog Details Fullwidth Page</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children "><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="frequently-questions.html">FAQ</a></li>
                                    <li><a href="my-account.html">My Account</a></li>
                                    <li><a href="login-register.html">login &amp; register</a></li>
                                </ul>
                            </li>
                            <li><a href="about-us.html">About Us</a></li>
                            <li><a href="contact-us.html">Contact</a></li>
                        </ul>
                    </nav>
                    <!-- mobile menu navigation end -->
                </div>
                <!-- mobile menu end -->
                <div class="header-top-settings offcanvas-curreny-lang-support">
                    <!-- mobile menu navigation start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><a href="#">My Account</a>
                                <ul class="dropdown">
                                    <li><a href="login.php">Login</a></li>
                                    <li><a href="Register.php">Register</a></li>
                                    <span><a href="#"><?php echo $userName; ?></a></span>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- mobile menu navigation end -->
                </div>
                <!-- offcanvas widget area start -->
                <div class="offcanvas-widget-area">
                    <div class="top-info-wrap text-left text-black">
                        <ul>
                            <li>
                                <i class="fa fa-phone"></i>
                                <a href="info%40yourdomain.html">(1245) 2456 012</a>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i>
                                <a href="info%40yourdomain.html">info@yourdomain.com</a>
                            </li>
                        </ul>
                    </div>
                    <div class="off-canvas-widget-social">
                        <a title="Facebook-f" href="#"><i class="fa fa-facebook-f"></i></a>
                        <a title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                        <a title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                        <a title="Youtube" href="#"><i class="fa fa-youtube"></i></a>
                        <a title="Vimeo" href="#"><i class="fa fa-vimeo"></i></a>
                    </div>
                </div>
                <!-- offcanvas widget area end -->
            </div>
        </div>
    </aside>
    <!-- off-canvas menu end -->
</header>