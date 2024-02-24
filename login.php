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
$message = "";
// Check connection
if ($conn->connect_error) {
    $message = ("Connection failed: " . $conn->connect_error);
}

// Initialize error message
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from form
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Prepare SQL statement to retrieve user data
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if username exists in database
    if ($result->num_rows == 1) {
        // Username exists, fetch associated row
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($input_password, $row['password'])) {
            // Password is correct, redirect user to dashboard or desired page
            header("Location: Dashboard.html");
            exit();
        } else {
            // Password is incorrect, set error message
            $error_message = "Incorrect password";
        }
    } else {
        // Username doesn't exist, set error message
        $error_message = "Username not found";
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="Assets/styles.css">
</head>
<body>
  <aside>
  </aside>
  <div class="login-container">
    <img src="Assets/img/LOGO.jpg" alt="Logo">
    <div class="form-heading">Check in system<hr>Admin  Login <br> </div>
    <form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <?php if ($error_message): ?>
      <div class="error-message"><?php echo $error_message; ?></div>
      <?php endif; ?>
      <div class="form-group">
        <button type="submit">Login</button>
      </div>
      <div class="form-signup"> 
        <P style="font-size: 25px;">or</P>
        <p>Don't have an account? </p>
        <button>Contact ICT admin</button>
      </div>
    </form>
  </div>
</body>
</html>
