<?php
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
    // Get new username from form
    $new_username = $_POST['username'];

    // Update username in the user table
    $sql = "UPDATE users SET username = ? WHERE id = 1"; // Change '1' to the actual user ID
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $new_username);

    if ($stmt->execute()) {
        echo "Username updated successfully";
    } else {
        echo "Error updating username: " . $conn->error;
    }

    $stmt->close();
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
</head>
<body>
    <h1>Account Page</h1>
    <nav>
    <header>
      <h1>Checking System</h1>
    </header>
    <br><br><br>
      <a href="Dashboard.php"><span class="material-symbols-outlined"> home </span> Home</a>
      <a href="register.php"> <span class="material-symbols-outlined">app_registration</span><span>  Registration</span></a>
      <a href="checkin.php"><span class="material-symbols-outlined">check_in_out</span> Check In</a>
      <a href="checkout.php"><span class="material-symbols-outlined">check_in_out</span>   Check Out</a>
      <a href="Settings.html"><span class="material-symbols-outlined">settings</span>   Settings</a>
  </nav>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">New Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <button type="submit">Update Username</button>
    </form>
</body>
</html>
