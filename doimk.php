<?php
session_start();
require_once("./provider.php");

// Check if the user is logged in
if (!isset($_SESSION['userName'])) {
    header('Location: login.php');
    exit;
}

$userName = $_SESSION['userName'];

// Fetch the current user's information from the database
$sql = "SELECT * FROM users WHERE username = :username";
$stm = $connection->prepare($sql);
$stm->bindParam(':username', $userName, PDO::PARAM_STR);
$stm->execute();
$user = $stm->fetch();
$userID = $user['id'];

$errors = [];

// Handle form submission for changing the password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if the old password matches the current password
    if (!password_verify($oldPassword, $user['password'])) {
        $errors[] = "Old password is incorrect";
    } elseif ($newPassword != $confirmPassword) {
        $errors[] = "New password and confirm password do not match";
    } elseif (strlen($newPassword) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    } else {
        // Hash the new password and update it in the database
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateSql = "UPDATE users SET password = :password WHERE id = :user_id";
        $updateStatement = $connection->prepare($updateSql);
        $updateStatement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $updateStatement->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $updateStatement->execute();

        echo '<script> alert("Password changed successfully"); </script>';
        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './layoat_phu/head.php'; ?>
</head>

<body>
    <div class="contact-wrapper">
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
                                                    <i class="fa fa-angle-down"></i>
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
                                                            <li><a href="shop.html">Shop Left Sidebar</a></li>
                                                            <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                                            <li><a href="shop-list-left.html">Shop List Left Sidebar</a></li>
                                                            <li><a href="shop-list-right.html">Shop List Right Sidebar</a></li>
                                                            <li><a href="shop-fullwidth.html">Shop Full Width</a></li>
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
                                                <span><a href="login.php">Login</a></span>
                                                <span><a href="register.php">Register</a></span>
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
                                                <a href="index.html">
                                                    <span class="menu-text"> Home</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="active" href="shop.html">
                                                    <span class="menu-text">Shop</span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <div class="mega-menu dropdown-hover">
                                                    <div class="menu-colum">
                                                        <ul>
                                                            <li><span class="mega-menu-text">Shop</span></li>
                                                            <li><a class="active" href="shop.html">Shop Left Sidebar</a></li>
                                                            <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                                            <li><a href="shop-list-left.html">Shop List Left Sidebar</a></li>
                                                            <li><a href="shop-list-right.html">Shop List Right Sidebar</a></li>
                                                            <li><a href="shop-fullwidth.html">Shop Full Width</a></li>
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
                                                <span><a href="login.php">Login</a></span>
                                                <span><a href="register.php">Register</a></span>
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
        <div class="breadcrumbs-area position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="breadcrumb-content position-relative section-content">
                            <h3 class="title-3">Change Password</h3>
                            <ul>
                                <li><a href="index2.php">Home</a></li>
                                <li>Change Password</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="login-register-area mt-no-text mb-no-text">
            <div class="container container-default-2 custom-area">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                        <div class="login-register-wrapper">
                            <div class="section-content text-center mb-5">
                                <h2 class="title-4 mb-2">Change Password</h2>
                                <!-- Display current username -->
                                <p>Current Username: <?php echo $userName; ?></p>
                                <?php
                                // Hiển thị thông báo lỗi nếu có
                                if (!empty($errors)) {
                                    echo '<div style="color: red;">';
                                    foreach ($errors as $error) {
                                        echo $error . '<br>';
                                    }
                                    echo '</div>';
                                }
                                ?>
                                <?php
                                if (isset($message)) { ?>

                                    <div class="alert alert-success" role="alert">
                                        <?php echo $message; ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- Form to change password -->
                            <form method="post" action="doimk.php">
                                <!-- Hidden input to send current username along with the form -->
                                <input type="hidden" name="username" value="<?php echo $userName; ?>">
                                <div class="single-input-item mb-3">
                                    <label for="old_password">Old Password:</label>
                                    <input type="password" name="old_password" ><br>
                                </div>
                                <div class="single-input-item mb-3">
                                    <label for="new_password">New Password:</label>
                                    <input type="password" class="form-control" name="new_password" >
                                </div>
                                <div class="single-input-item mb-3">
                                    <label for="confirm_password">Confirm Password:</label>
                                    <input type="password" class="form-control" name="confirm_password">
                                </div>
                                <input type="submit" class="btn obrien-button-2 primary-color" name="change_password" value="Change Password">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include './layoat_phu/foo.php'; ?>
    </div>

</body>

</html>