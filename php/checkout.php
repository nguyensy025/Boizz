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
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './layoat_phu/head.php'; ?>
    <title>Check Out</title>
</head>

<body>
    <div class="container">
        <?php include './layoat_phu/heder.php'; ?>
        <div class="breadcrumbs-area position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="breadcrumb-content position-relative section-content">
                            <h3 class="title-3">Check Out</h3>
                            <ul>
                                <li><a href="index2.php">Home</a></li>
                                <li>Check Out</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="checkout-area">
                <div class="container container-default-2 custom-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-accordion">
                                <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                                <div id="checkout-login" class="coupon-content">
                                    <div class="coupon-info">
                                        <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est
                                            sit amet ipsum luctus.</p>
                                        <form action="#">
                                            <p class="form-row-first">
                                                <label>Username or email <span>*</span></label>
                                                <input type="text">
                                            </p>
                                            <p class="form-row-last">
                                                <label>Password <span>*</span></label>
                                                <input type="password">
                                            </p>
                                            <p class="form-row">
                                                <input type="checkbox" id="remember_me">
                                                <label for="remember_me">Remember me</label>
                                            </p>
                                            <p class="lost-password"><a href="#">Lost your password?</a></p>
                                        </form>
                                    </div>
                                </div>
                                <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                                <div id="checkout_coupon" class="coupon-checkout-content">
                                    <div class="coupon-info">
                                        <form action="#">
                                            <p class="checkout-coupon">
                                                <input placeholder="Coupon code" type="text">
                                                <input class="coupon-inner_btn" value="Apply Coupon" type="submit">
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $errors = [];
                        if (isset($_SESSION['userName'])) {
                            $userName = $_SESSION['userName'];
                            // Retrieve user information
                            $sql = "SELECT * FROM users WHERE username = :userName";
                            $stm = $connection->prepare($sql);
                            $stm->execute(['userName' => $userName]);
                            $user = $stm->fetch();
                            $userID = $user['id'];
                            // Check if the request method is POST
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                // Validate and sanitize user input
                                $firstname = trim($_POST['firstname'] ?? '');
                                $lastname = trim($_POST['lastname'] ?? '');
                                $address = trim($_POST['address'] ?? '');
                                $apartment = trim($_POST['apartment'] ?? '');
                                $city = trim($_POST['city'] ?? '');
                                $state = trim($_POST['state'] ?? '');
                                $postcode = trim($_POST['postcode'] ?? '');
                                $email = trim($_POST['email'] ?? '');
                                $phone = trim($_POST['phone'] ?? '');
                                // Additional validations
                                if (strlen($firstname) < 1) {
                                    $errors[] = "First Name cannot be empty.";
                                }
                                if (strlen($lastname) < 1) {
                                    $errors[] = "Last Name cannot be empty.";
                                }
                                if (strlen($address) < 1) {
                                    $errors[] = "Address cannot be empty.";
                                }
                                if (strlen($city) < 1) {
                                    $errors[] = "City cannot be empty.";
                                }
                                if (strlen($state) < 1) {
                                    $errors[] = "State cannot be empty.";
                                }
                                if (strlen($phone) < 1) {
                                    $errors[] = "Phone number cannot be empty.";
                                }
                                if (strlen($postcode) < 1) {
                                    $errors[] = "Postcode cannot be empty.";
                                }
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $errors[] = "email invalid email format";
                                }
                                if (empty($errors)) {
                                    // Continue processing the form data
                                    // Define the SQL query for insertion
                                    $sql = "INSERT INTO checkout (firstname, lastname, address, apartment, city, state, postcode, email, phone, user_id)
                                    VALUES (:firstname, :lastname, :address, :apartment, :city, :state, :postcode, :email, :phone, :user_id)";
                                    // Prepare and execute the SQL query
                                    $stm = $connection->prepare($sql);
                                    $success = $stm->execute([
                                        'firstname' => $firstname,
                                        'lastname' => $lastname,
                                        'address' => $address,
                                        'apartment' => $apartment,
                                        'city' => $city,
                                        'state' => $state,
                                        'postcode' => $postcode,
                                        'email' => $email,
                                        'phone' => $phone,
                                        'user_id' => $userID
                                    ]);
                                    $checkoutID = $connection->lastInsertId();
                                }
                            }
                        }
                        ?>
                        <div class="col-lg-6 col-12">
                            <form action="./checkout.php" method="post">
                                <div class="checkbox-form">
                                    <h3>Billing Details</h3>
                                    <div class="row">
                                        <?php if (!empty($errors)) {
                                            echo '<div style="color: red;">';
                                            foreach ($errors as $error) {
                                                echo $error . '<br>';
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>First Name <span>*</span></label>
                                                <input placeholder="John" type="text" name="firstname">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Last Name <span>*</span></label>
                                                <input placeholder="Doe" type="text" name="lastname">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Address <span>*</span></label>
                                                <input placeholder="Street address" type="text" name="address">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <input placeholder="Apartment, suite, unit etc. (optional)" type="text" name="apartment">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Town / City <span>*</span></label>
                                                <input placeholder="City" type="text" name="city">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>State / County <span>*</span></label>
                                                <input placeholder="State" type="text" name="state">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Postcode / Zip <span>*</span></label>
                                                <input placeholder="Zip Code" type="text" name="postcode">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Email Address <span>*</span></label>
                                                <input placeholder="you@example.com" type="text" name='email'>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Phone <span>*</span></label>
                                                <input placeholder="123-456-7890" type="text" name='phone'>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list create-acc">
                                                <input id="cbox" type="checkbox">
                                                <label for="cbox">Create an account?</label>
                                            </div>
                                            <div id="cbox-info" class="checkout-form-list create-account">
                                                <p class="mb-2">Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                                <label>Account password <span>*</span></label>
                                                <input placeholder="password" type="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-button-payment">
                                        <input value="Lưu Thông Tin" type="submit">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-6 col-12">
                            <?php
                            if (isset($_SESSION['userName'])) {
                                $userName = $_SESSION['userName'];

                                $sql = "SELECT * FROM users WHERE username = :userName";
                                $stm = $connection->prepare($sql);
                                $stm->execute(['userName' => $userName]);
                                $user = $stm->fetch();
                                $userID = $user['id'];

                                $queryUserCart = "
                                    SELECT uc.*, p.name, p.image, p.price
                                    FROM user_cart uc
                                    INNER JOIN products p ON uc.product_id = p.id
                                    WHERE uc.user_id = :userID
                                ";
                                $stm = $connection->prepare($queryUserCart);
                                $stm->execute(['userID' => $userID]);
                                $user_cart = $stm->fetchAll();

                                $subtotal = 0;
                                foreach ($user_cart as $row) {
                                    $subtotal += $row['price'] * $row['quantity'];
                                }

                                $queryUserShipping = "
                                    SELECT shipping
                                    FROM orders
                                    WHERE user_id = :userID
                                ";
                                $stm = $connection->prepare($queryUserShipping);
                                $stm->execute(['userID' => $userID]);
                                $shippingInfo = $stm->fetch();
                                $shipping = $shippingInfo['shipping'];

                                $total = $subtotal + $shipping;

                                // Output the user cart data in the order summary table
                            ?>
                                <div class="your-order">
                                    <h3>Your order</h3>
                                    <div class="your-order-table table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="cart-product-name">Product</th>
                                                    <th class="cart-product-quantity">Quantity</th>
                                                    <th class="cart-product-price">Price</th>
                                                    <th class="cart-product-total">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($user_cart as $row) { ?>
                                                    <tr class="cart_item">
                                                        <td class="cart-product-name"><?= $row['name'] ?></td>
                                                        <td class="cart-product-quantity"><?= 'X' . $row['quantity'] ?></td>
                                                        <td class="cart-product-price"><?= number_format($row['price']) ?> VNĐ</td>
                                                        <td class="cart-product-total"><?= number_format($row['price'] * $row['quantity']) ?> VNĐ</td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td class="cart-product-name">Total :</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?= number_format($subtotal) ?> VNĐ</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart-product-name">Shipping :</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?= number_format($shipping) ?> VNĐ</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart-product-name">Cart total :</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?= number_format($total) ?> VNĐ</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Payment method options should be added here if necessary -->
                                </div>
                            <?php
                                try {
                                    function calculateSubtotal($userID, $connection)
                                    {
                                        $queryUserCart = "
                SELECT uc.*, p.name, p.image, p.price
                FROM user_cart uc
                INNER JOIN products p ON uc.product_id = p.id
                WHERE uc.user_id = :userID
            ";

                                        $stm = $connection->prepare($queryUserCart);
                                        $stm->execute(['userID' => $userID]);
                                        $user_cart = $stm->fetchAll();

                                        $subtotal = 0;

                                        foreach ($user_cart as $row) {
                                            $subtotal += $row['price'] * $row['quantity'];
                                        }

                                        return $subtotal;
                                    }

                                    function calculateShipping($userID, $connection)
                                    {
                                        $queryUserShipping = "SELECT shipping FROM orders WHERE user_id = :userID";
                                        $stm = $connection->prepare($queryUserShipping);
                                        $stm->execute(['userID' => $userID]);
                                        $shippingInfo = $stm->fetch();
                                        $shipping = $shippingInfo['shipping'];

                                        return $shipping;
                                    }

                                    $user = null;

                                    if (isset($_SESSION['userName'])) {
                                        $userName = $_SESSION['userName'];
                                        $sql = "SELECT * FROM users WHERE username = :userName";
                                        $stm = $connection->prepare($sql);
                                        $stm->execute(['userName' => $userName]);
                                        $user = $stm->fetch();
                                    }

                                    if (!$user) {
                                        echo "Please log in to view your order.";
                                        exit;
                                    }

                                    $user_id = $user['id'];
                                    $subtotal = calculateSubtotal($user_id, $connection);
                                    $shipping = calculateShipping($user_id, $connection);
                                    $total_amount = $subtotal + $shipping;
                                    $payment_status = 'Pending';
                                    $checkoutID = null;

                                    $che = "SELECT * FROM checkout";
                                    $stm1 = $connection->prepare($che);
                                    $stm1->execute();
                                    $checkout = $stm1->fetch();

                                    if ($checkout) {
                                        $checkoutID = $checkout['id'];
                                        foreach ($user_cart as $row) {
                                            $product_id = $row['product_id'];
                                            $quantity = $row['quantity'];
                                            $price = $row['price'];

                                            $insertInvoiceSQL = "INSERT INTO invoices (user_id, checkout_id, product_id, quantity, price, total_amount, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?)";
                                            $stmt = $connection->prepare($insertInvoiceSQL);
                                            $stmt->execute([$user_id, $checkoutID, $product_id, $quantity, $price, $total_amount, $payment_status]);
                                        }
                                    }
                                } catch (PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                            } else {
                                // Handle the case where the user is not logged in
                                echo "Please log in to view your order.";
                            }
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include './layoat_phu/foo.php'; ?>
    </div>
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

</html>