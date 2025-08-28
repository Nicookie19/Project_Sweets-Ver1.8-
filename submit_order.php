<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $pastry = $conn->real_escape_string($_POST['Mochi']);
    $quantity = intval($_POST['quantity']);
    $pickup_date = $conn->real_escape_string($_POST['pickup-date']);
    
    // Calculate total price based on pastry type
    $price_per_box = 150; // Default price
    
    // Pricing logic matching the frontend JavaScript
    if ($pastry === "Berry Blush Mochi" || $pastry === "Berry XD Mochi" || 
        $pastry === "Cookie Cloud Mochi" || $pastry === "Sunny Munch Mochi") {
        $price_per_box = 50; // Individual mochi varieties
    } elseif ($pastry === "Assorted Mochi" || $pastry === "Box of Mini Donuts") {
        $price_per_box = 150; // Assorted mochi and mini donuts
    } else {
        $price_per_box = 0; // Coming soon
    }
    
    $total_price = $quantity * $price_per_box;
    
    // Insert order into database
    $sql = "INSERT INTO orders (name, email, phone, address, pastry, quantity, pickup_date, total_price)
            VALUES ('$name', '$email', '$phone', '$address', '$pastry', $quantity, '$pickup_date', $total_price)";
    
    if ($conn->query($sql) {
        // Send confirmation email (optional)
        $to = $email;
        $subject = "Order Confirmation - Treatx' Pastries";
        $message = "Dear $name,\n\nThank you for your order!\n\nOrder Details:\n- Pastry: $pastry\n- Quantity: $quantity boxes\n- Total: ₱$total_price\n- Pickup Date: $pickup_date\n\nWe will contact you soon to confirm your order.\n\nBest regards,\nTreatx' Pastries Team";
        $headers = "From: treatx.buiz@gmail.com";
        
        // Uncomment to send email (requires proper email configuration)
        // mail($to, $subject, $message, $headers);
        
        echo json_encode(["success" => true, "message" => "Order submitted successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}

$conn->close();
?>
