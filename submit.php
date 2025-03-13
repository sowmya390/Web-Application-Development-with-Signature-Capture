<?php
// Include database connection
include 'database.php';

// Validate and sanitize input
$name = htmlspecialchars($_POST['name']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$phone = htmlspecialchars($_POST['phone']);
$signature = $_POST['signature']; // Base64 encoded signature

// Insert data into the database
$stmt = $conn->prepare("INSERT INTO signatures (name, email, phone, signature) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $signature);

if ($stmt->execute()) {
    $id = $stmt->insert_id;
    header("Location: confirmation.php?id=$id");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>