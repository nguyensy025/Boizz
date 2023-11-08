<?php
include('./user.php');
include('./provider.php');
/* if (!isset($_SESSION['currentUser']) || $_SESSION['currentUser']->role != '2') {
    header('Location: dashboard.php');
}
else{
    header('Location: product-interface.php');
} */
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>