<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get name and check-in date from form
    $name = $_POST['checkinName'];
    $checkin_date = $_POST['checkinDate'];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO check_ins (name, checkin_date) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $checkin_date);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Check-in successful";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close database connection
$conn->close();
?>
