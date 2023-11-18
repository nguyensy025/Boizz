<?php
session_start();
ob_start();

include('./provider.php');

if (isset($_POST['product-id'])) {
    $subTotal = 0;
    $quantity = $_POST['quantity'];
    $userName = $_SESSION['userName'];
    $product_id = $_POST['product-id'];
    $sql = "SELECT * FROM users WHERE username = '$userName'";
    $stm = $connection->prepare($sql);
    $stm->execute();
    $users = $stm->fetch();
    
    $sqlProduct = "SELECT * FROM  products where id = '$product_id'";
    $stm = $connection->prepare($sqlProduct);
    $stm->execute();
    $products = $stm->fetch();

    $userID = $users['id'];
    $productPrice = $products['price'];
    $subTotal = $quantity * $productPrice;
    
    $querySearch ="SELECT * FROM user_cart Where product_id = '$product_id'";
    $stm = $connection->prepare($querySearch);
    $stm->execute();
    $search = $stm->fetch();

    if(empty($search)){
        $sqlInsert =" INSERT INTO user_cart (product_id,user_id,subtotal,quantity) VALUES (
            $product_id,
            $userID,
            $subTotal,
            $quantity
       )" ;
       $stm = $connection->prepare($sqlInsert);
       if($stm->execute()){
        header('Location: cart.php');
       }
       else{
        echo 'fail';
       }
       
    }
    else{
        $query ="SELECT * FROM user_cart Where product_id = '$product_id'";
        $stm = $connection->prepare($query);
        $stm->execute();
        $old = $stm->fetch();
        $oldTotal = $old['subtotal'];
        $oldQuantity = $old['quantity'];
        $newQuantity =$quantity + $oldQuantity;
        $newTotal = $subTotal + $oldTotal;

        $queryUp = "UPDATE user_cart  
        SET 
            subtotal = '$newTotal',
            quantity = '$newQuantity'
        WHERE product_id = '$product_id'";
        $stm = $connection->prepare($queryUp);
        if($stm->execute()){
            header('Location:cart.php');
        }
        else {
            echo 'fail';
        }

        
    }
    
    
}
?>
