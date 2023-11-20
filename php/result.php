<?php
include('./provider.php');

$quantity = $_POST['quantity'];
$product_id = $_POST['product_id'];

// Update successful
$sql = "SELECT price FROM products WHERE id = :product_id";
$stm = $connection->prepare($sql);
$stm->bindParam(':product_id', $product_id, PDO::PARAM_INT);
$stm->execute();
$checkOut = $stm->fetch();
$result = $checkOut['price'] * $quantity;
$sqlUpdate = "UPDATE user_cart SET quantity = :quantity, subtotal = :subtotal WHERE product_id = :product_id";
$stmUpdate = $connection->prepare($sqlUpdate);
$stmUpdate->bindParam(':quantity', $quantity, PDO::PARAM_INT);
$stmUpdate->bindParam(':subtotal', $result, PDO::PARAM_INT);
$stmUpdate->bindParam(':product_id', $product_id, PDO::PARAM_INT);
number_format($result);
if ($stmUpdate->execute()) {
    echo json_encode($result);
} else {
    echo json_encode("error");
}

?>