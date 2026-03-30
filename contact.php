<?php
$conn = new mysqli("localhost", "root", "", "agroculture_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$phone   = $_POST['phone'] ?? '';
$address = $_POST['address'] ?? '';
$message = $_POST['message'] ?? '';

$stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, address, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $address, $message);

if ($stmt->execute()) {
    echo "<h3 style='color:green; text-align:center;'>Thank you! Your message has been received successfully.</h3>";
    echo "<p style='text-align:center;'><a href='javascript:history.back()'>← Go Back</a></p>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>