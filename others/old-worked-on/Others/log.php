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
    
    // Get name and event date from form
    $name = $_POST['checkinName']; // or $_POST['checkoutName'] for check-out
    $event_type = 'check-in'; // or 'check-out' for check-out
    $event_date = $_POST['checkinDate']; // or $_POST['checkoutDate'] for check-out

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO check_log (name, event_type, event_date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $event_type, $event_date);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Event recorded successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close database connection
$conn->close();
?>
