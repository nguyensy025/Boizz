<?php
// tao global setting
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("HOST", "localhost");
    define("DB_NAME", "duanmau");
    //$connection = null;
    try {
    $url = "mysql:host=" . HOST . ";dbname=" . DB_NAME . "";
    $connection = new PDO($url, USERNAME, PASSWORD);
    } catch (PDOException $e) {
    echo $e->getMessage();
    }
?>