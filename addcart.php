<?php
session_start();
ob_start();
include('./provider.php');
if (isset($_GET['addtocart']) && isset($_GET['quantity'])) {
    // Lấy giá trị của trường "quantity"
    $quantity = $_GET['quantity'];
    $id = $_GET['addtocart'] .'';
    
}
    $sql = "SELECT * FROM products Where id=:id";
    $stm =$connection-> prepare($sql);
    
    if($stm ->execute([
        ':id' => $_GET['addtocart']
    ]))
    
    $products = $stm ->fetchAll();
    if (!isset($_SESSION['cart']))
    {
        $_SESSION['cart'] = array();
    }

    global $name;
    global $price;
    global $image;

    foreach($products as $product){
        $name = $product['name'];
        $price = $product['price'];
        $image = $product['image'];
    }
    $addProduct =array($name, $price ,$image ,$quantity,$id);
    array_push( $_SESSION["cart"],   $addProduct );
    header('Location:cart.php');
?>