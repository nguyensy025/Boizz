<?php
session_start();
include './provider.php';

function tinhToanSubtotal($userID)
{
    global $connection;

    $queryUserCart = "
        SELECT uc.*, p.name, p.image, p.price
        FROM user_cart uc
        INNER JOIN products p ON uc.product_id = p.id
        WHERE uc.user_id = :userID
    ";

    $stm = $connection->prepare($queryUserCart);
    $stm->execute(['userID' => $userID]);
    $user_cart = $stm->fetchAll();

    // Calculate subtotal
    $subtotal = 0;

    foreach ($user_cart as $row) {
        $subtotal += $row['price'] * $row['quantity'];
    }

    return $subtotal;
}

function tinhToanShipping($userID)
{
    global $connection;

    $queryUserShipping = "SELECT shipping FROM orders WHERE user_id = :userID";
    $stm = $connection->prepare($queryUserShipping);
    $stm->execute(['userID' => $userID]);
    $shippingInfo = $stm->fetch();
    $shipping = $shippingInfo['shipping'];
    
    return $shipping;
}

// Check if the user is logged in
if (isset($_SESSION['userName'])) {
    $userName = $_SESSION['userName'];

    // Fetch user information
    $sql = "SELECT * FROM users WHERE username = :userName";
    $stm = $connection->prepare($sql);
    $stm->execute(['userName' => $userName]);
    $user = $stm->fetch();

    // Calculate subtotal and shipping
    $subtotal = tinhToanSubtotal($user['id']);
    $shipping = tinhToanShipping($user['id']);

    // Calculate total
    $total = $subtotal + $shipping;

    // Insert the invoice into the database
    $user_id = $user['id'];
    $payment_status = 'paid';

    $insertInvoiceSQL = "INSERT INTO invoices (user_id, total_amount, payment_status) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($insertInvoiceSQL);
    $stmt->execute([$user_id, $total, $payment_status]);

    // Get the ID of the newly created invoice
    $invoice_id = $connection->lastInsertId();

    // Insert each item into the invoice_items table
    $queryUserCart = "
        SELECT uc.*, p.name, p.image, p.price
        FROM user_cart uc
        INNER JOIN products p ON uc.product_id = p.id
        WHERE uc.user_id = :userID
    ";

    $stm = $connection->prepare($queryUserCart);
    $stm->execute(['userID' => $user_id]);
    $user_cart = $stm->fetchAll();

    foreach ($user_cart as $row) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $price = $row['price'];

        $insertItemSQL = "INSERT INTO invoice_items (invoice_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($insertItemSQL);
        $stmt->execute([$invoice_id, $product_id, $quantity, $price]);
    }

    // Clear the user's cart after completing the order
    $clearCartSQL = "DELETE FROM user_cart WHERE user_id = ?";
    $stmt = $connection->prepare($clearCartSQL);
    $stmt->execute([$user_id]);

    // Output the invoice details
    echo "<h2>Invoice Details</h2>";
    echo "<p>Invoice ID: $invoice_id</p>";
    echo "<p>User ID: $user_id</p>";
    echo "<p>Subtotal: $subtotal VNĐ</p>";
    echo "<p>Shipping: $shipping VNĐ</p>";
    echo "<p>Total: $total VNĐ</p>";
    echo "<p>Payment Status: $payment_status</p>";

    // Display items in the invoice
    echo "<h3>Invoice Items</h3>";
    echo "<table border='1'>";
    echo "<tr><th>Product Name</th><th>Quantity</th><th>Price</th></tr>";
    
    foreach ($user_cart as $row) {
        echo "<tr>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['quantity']}</td>";
        echo "<td>{$row['price']} VNĐ</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    // Handle the case where the user is not logged in
    echo "Please log in to view your order.";
}
