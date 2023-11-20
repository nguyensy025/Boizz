<?php
session_start();
require('./layout/header.php');
require('./provider.php');
if (isset($_GET['id'])) {
   $sql = "DELETE FROM users where id=:id";
   $statement = $connection->prepare($sql);
   if ($statement->execute([
      ':id' => intval($_GET['id']),
   ])) {
      header('Location: customerlist.php');
      $_SESSION['message'] = "delete successfully with id={$_GET['id']}";
      exit;
   }
}