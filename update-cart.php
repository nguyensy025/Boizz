<?php
include('./provider.php');
echo 'go here'; 
echo "<pre>";
print_r($_POST['user_cart_id'],$_POST['pro-quantity'],$_POST['pro-subtotal']);
echo "</pre>";

if(isset($_POST['user_cart_id']) && isset($_POST['pro-quantity']) && isset($_POST['pro-subtotal'])){
    $newQuantity = $_POST['pro-quantity'];
    $id = $_POST['user_cart_id'];
    $newSubtotal = $_POST['pro-subtotal'];
    
    // Use prepared statement to prevent SQL injection
    $sqlUpdate = "UPDATE user_cart SET quantity = ?, subtotal = ? WHERE id = ?";
    $stm = $connection->prepare($sqlUpdate);
    
    // Bind parameters and execute the statement
    $stm->bind_param("iis", $newQuantity, $newSubtotal, $id);
    $stm->execute();
    
    // Close the statement
    $stm->close();
}
