<?php
include './provider.php';

$sql = "
    SELECT 
       c.*, i.* 
    FROM invoices i
    JOIN checkout c ON i.checkout_id = c.id;
";

$stmt = $connection->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();

$stt = 1;
foreach ($results as $a) {
    echo '<tr>';
    echo '<td>' . $stt . '</td>';
    echo '<td>' . $a['firstname'] . '</td>';
    echo '<td>' . $a['address'] . '</td>';
    echo '<td>' . $a['email'] . '</td>';
    echo '<td>' . $a['phone'] . '</td>';
    echo '<td>' . $a['invoice_date'] . '</td>';
    echo '<td>' . $a['quantity'] . '</td>';
    echo '<td>'.'      ' . '</td>';
    echo '<td>' . number_format($a['price']) . '</td>';
    echo '<td>' . number_format($a['total_amount']) . '</td>';
    echo '</tr>';

    $stt++;
}
?>