<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish connection to the database
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "check_in_system"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO users (username, phone_number, department, email, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $username, $phone_number, $department, $email, $password);

// Get form data and sanitize inputs
$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : "";
$phone_number = isset($_POST['Phone-number']) ? htmlspecialchars($_POST['Phone-number']) : "";
$department = isset($_POST['Department']) ? htmlspecialchars($_POST['Department']) : "";
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
$password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : "";

// Execute SQL statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
