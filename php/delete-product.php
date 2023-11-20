<?php
session_start();
require('./layout/header.php');
require('./provider.php');
if (isset($_GET['id'])) {
   $sql = "DELETE FROM products where id=:id";
   $statement = $connection->prepare($sql);
   if ($statement->execute([
      ':id' => intval($_GET['id']),
   ])) {
      header('Location: listproduct.php');
      $_SESSION['message'] = "delete successfully with id={$_GET['id']}";
      exit;
   }
}
?>