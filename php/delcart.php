<?php
session_start();
include('./provider.php');

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] >= 0) {
    $productId = $_GET['id'];

    try {
        $sqlDel = "DELETE FROM user_cart WHERE id = :productId";
        $stm = $connection->prepare($sqlDel);
        $stm->bindParam(':productId', $productId, PDO::PARAM_INT);

        if ($stm->execute()) {
            header('Location: Cart.php');
            exit; // Terminate script after redirection
        } else {
            $_SESSION['errors'] = 'Delete failed';
        }
    } catch (PDOException $e) {
        $_SESSION['errors'] = 'Database error: ' . $e->getMessage();
    }
} else {
    $_SESSION['errors'] = 'Invalid product ID';
}

header('Location: cart.php');
exit; // Terminate script after redirection
