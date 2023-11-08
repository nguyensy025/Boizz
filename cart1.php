<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<?php
include('./layout/header.php');
include('./layout/header-asset.php');
?>

<body>

    <div class="container">
        <div class="col">
            <div class="cart-main-wrapper mt-no-text mb-no-text">
                <div class="container container-default-2 custom-area">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Image</th>
                                            <th class="pro-title">Product</th>
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Quantity</th>
                                            <th class="pro-subtotal">Total</th>
                                            <th class="pro-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <?php

                                    $userName = $_SESSION['userName'];
                                    $sql = "SELECT * FROM users Where username = '$userName'";
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
                                    $total = 0;
                                    ?>

                                    <form action="./update-cart.php">
                                        <?php foreach ($user_cart as $product) { ?>
                                            <tbody>
                                                <tr>
                                                    <input type="hidden" value="<?= $product['id'] ?>" name='user_cart_id'>
                                                    <input type="hidden" value="<?= $product['product_id']; ?>" id='product_id'>
                                                    <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="./uploads/<? echo $product['image'] ?>" alt="Product" /></a></td>
                                                    <td class="pro-title"><a href="#"><? echo $product['name'] ?></a></td>
                                                    <td class="pro-price" id="price"><?
                                                                                        echo (number_format($product['price'])) . ' Vnđ';
                                                                                        ?></td>
                                                    <td class="pro-quantity">
                                                        <div class="quantity">
                                                            <div class="cart-plus-minus">
                                                                <input class="cart-plus-minus-box" name="pro-quantity" value="<?= $product['quantity']; ?>" type="number" id="quantity" min="1">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="pro-subtotal" id="total" name='pro-subtotal'>
                                                        <?php
                                                        echo (number_format($product['subtotal'])) . ' Vnđ';
                                                        ?>

                                                    </td>
                                                    <td class="pro-remove">
                                                        <a href="./delcart.php?id=<? echo $product['id']; ?>">
                                                            <i class="ion-trash-b"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $total += $product['subtotal'];
                                                ?>
                                            <?php } ?>
                                            </tbody>
                                </table>

                            </div>
                            <!-- Cart Update Option -->
                            <div class="cart-update-option d-block d-md-flex justify-content-between">
                                <div class="apply-coupon-wrapper">
                                    <form action="#" method="post" class=" d-block d-md-flex">
                                        <input type="text" placeholder="Enter Your Coupon Code" required />
                                        <button class="btn obrien-button primary-btn">Apply Coupon</button>
                                    </form>
                                </div>

                                <div class="cart-update mt-sm-16">
                                    <a href="./cart.php" type="submit" class="btn obrien-button primary-btn" id="update-cart">Update Cart</a>
                                </div>

                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 ml-auto">
                            <!-- Cart Calculation Area -->
                            <div class="cart-calculator-wrapper">
                                <div class="cart-calculate-items">

                                    <h3>Cart Totals</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>Sub Total</td>
                                                <td id="subTotal">
                                                    <?php if (isset($total)) {
                                                        echo (number_format($total)) . ' Vnđ';
                                                    } else {
                                                        echo $total  . "VNĐ";
                                                    }; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Shipping</td>
                                                <td>

                                                    <?php
                                                    $ship = 0;
                                                    if ($total != 0) {
                                                        $ship = 0.01 * $total;
                                                        echo (number_format($ship)) . " Vnđ";
                                                    } else {
                                                        echo $ship . "Vnđ";
                                                    }; ?>
                                                </td>
                                            </tr>
                                            <tr class="total">
                                                <td>Total</td>
                                                <td class="total-amount">
                                                    <?php
                                                    $checkOut = $total + $ship;
                                                    echo (number_format($checkOut)) . " Vnđ";
                                                    ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <a href="checkout.php" class="btn obrien-button primary-btn d-block">Proceed To Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <script src="./assets/js/jquery.min.js"></script>
    <script>
        $('.inc').each(function(index, element) {
            $(element).click(function(e) {
                var quantity = $(element).closest('.cart-plus-minus').find('.cart-plus-minus-box').val();
                var product_id = $(element).closest('tr').find('#product_id').val();
                //console.log(product_id, quantity)
                $.ajax({
                    url: "./result.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        'quantity': quantity,
                        'product_id': product_id
                    },
                    success: function(result) {
                        $(element).closest('tr').find('.pro-subtotal').html(result);
                    }
                });
            });
        });
        $('.dec').each(function(index, element) {
            $(element).click(function(e) {
                var quantity = $(element).closest('.cart-plus-minus').find('.cart-plus-minus-box').val();
                var product_id = $(element).closest('tr').find('#product_id').val();

                $.ajax({
                    url: "./result.php",
                    type: "POST",
                    dataType: "",
                    data: {
                        'quantity': quantity,
                        'product_id': product_id
                    },
                    success: function(result) {
                        console.log(result);
                        $(element).closest('tr').find('.pro-subtotal').html(result);
                    }
                });
            });
        });
        // Sự kiện khi người dùng thay đổi số lượng sản phẩm
        $('.cart-plus-minus-box').on('change', function() {
            var rowElement = $(this).closest('tr');
            updateSubtotalForRow(rowElement);
        });

        // Sự kiện khi người dùng nhấn "Update Cart"
        $('#subTotal').on('click', function(e) {
            e.preventDefault();

            // Gọi hàm cập nhật subtotal cho mỗi hàng
            $('.pro-subtotal').each(function(index, element) {
                var rowElement = $(element).closest('tr');
                updateSubtotalForRow(rowElement);

                // Lấy dữ liệu từ hàng để gửi qua AJAX
                var quantity = $(rowElement).find('.cart-plus-minus-box').val();
                var product_id = $(rowElement).find('#product_id').val();

                // Gửi dữ liệu thông qua AJAX để cập nhật dữ liệu trên cơ sở dữ liệu
                $.ajax({
                    url: "./result.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        'quantity': quantity,
                        'product_id': product_id
                    },
                    success: function(result) {
                        // Cập nhật tổng giá trị tổng cộng từ kết quả trả về
                        $(rowElement).find('.pro-subtotal').text(result);
                    },
                    error: function() {
                        // Xử lý lỗi nếu cần
                    }
                });
            });
        });

        // Hàm cập nhật tổng giá trị tổng cộng dựa trên các phần tử trong hàng
        function updateSubtotalForRow(rowElement) {
            var quantity = $(rowElement).find('.cart-plus-minus-box').val();
            var price = $(rowElement).find('#price').text();
            var newSubtotal = parseFloat(quantity) * parseFloat(price);
            $(rowElement).find('.pro-subtotal').text(newSubtotal);
        }
    </script>
</body>

</html>