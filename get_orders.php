<?php
include 'db_connection.php';

header('Content-Type: application/json');

// Get all orders from database
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);

$orders = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

echo json_encode($orders);

$conn->close();
?>
