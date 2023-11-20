<?php
// tao global setting
define("USERNAME", "root");
define("PASSWORD", "");
define("HOST", "localhost");
define("DB_NAME", "duanmau");

try {
    $url = "mysql:host=" . HOST . ";dbname=" . DB_NAME . "";
    $connection = new PDO($url, USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    // Sanitize the incoming ID to prevent SQL injection
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($id !== false && $id !== null) {
        try {
            // Get the current payment_status
            $currentPaymentStatus = getCurrentPaymentStatus($connection, $id);

            // Calculate the new payment_status
            $newPaymentStatus = ($currentPaymentStatus == 'Pending') ? 'Ordered' : 'Pending';

            // Perform the update query
            $sql = "UPDATE invoices SET payment_status = :newPaymentStatus WHERE id = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':newPaymentStatus', $newPaymentStatus, PDO::PARAM_STR);

            // Execute the update query
            if ($stmt->execute()) {
                // Update successful
                echo "Payment status updated to $newPaymentStatus";
                header("Location: dashboard.php");
                // Additional logic or redirect can be added here
            } else {
                // Update failed
                echo "Error updating payment status";
            }
        } catch (PDOException $e) {
            // Handle any database errors
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Invalid or missing ID
        echo "Invalid request";
    }
} else {
    // Redirect if accessed directly without a valid GET request
    header("Location: dashboard.php");
    exit();
}

function getCurrentPaymentStatus($connection, $id) {
    // Function to get the current payment_status
    $sql = "SELECT payment_status FROM invoices WHERE id = :id";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['payment_status'];
}
