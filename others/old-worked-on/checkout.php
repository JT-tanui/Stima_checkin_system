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

// Initialize error message
$error_message = "";
$message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get checkinname 
    $input_username = $_POST['checkoutName'];

    // Prepare SQL statement to retrieve user data
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if username exists in database
    if ($result->num_rows == 1) {
        // Username exists, fetch associated row
        $row = $result->fetch_assoc();
        // Get name and event date from form
        $name = $_POST['checkoutName']; // or $_POST['checkoutName'] for check-out
        $event_type = 'check-out'; // or 'check-out' for check-out
        $event_date = $_POST['checkoutDate']; // or $_POST['checkoutDate'] for check-out
    
        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO check_log (name, event_type, event_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $event_type, $event_date);
    
        // Execute SQL statement
        if ($stmt->execute()) {
            $message = "Event recorded successfully";
        } else {
            $message = "Error: " . $stmt->error;
        }
    
        $stmt->close();
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
  <title>Check - in </title>
  <link rel="stylesheet" href="Assets/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <style>
    .form-container {
    flex: 8; /* Assign remaining width for login container */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center; /* Center content vertically */
    background-color: #fff; /* Add white background */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add subtle shadow */
    padding: 2rem; /* Add more padding */
  }
  
  .login-container img {
    width: 100px; /* Adjust logo width */
    height: 100px; /* Adjust logo height */
  }
  
  .form-heading {
    font-size: 24px; /* Increase heading size */
    margin-bottom: 1rem; /* Add spacing below heading */
  }
  
  .login-form {
    width: 300px; /* Set form width */
    display: flex;
    flex-direction: column;
    gap: 1rem; /* Add spacing between form elements */
  }
  
  .form-group {
    display: flex;
    flex-direction: column;
    width: 100%;
  }
  
  .form-group label {
    font-size: 16px;
    margin-bottom: 5px; /* Add spacing below label */
  }
  
  .form-group input[type="text"],
  .form-group input[type="password"] {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
  }
  
  .form-group button {
    padding: 8px 16px;
    border: none;
    background-color: #03138e; /* Green button color */
    color: white;
    font-size: 16px;
    cursor: pointer; /* Indicate clickable element */
    border-radius: 4px;
  }
  
  .form-group button:hover {
    background-color: #152eeb; /* Darker green on hover */
  }
  .form-signup {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
    }
    .form-signup button {
        padding: 8px 16px;
        border: none;
        background-color:#03138e; /* Green button color */
        color: white;
        font-size: 16px;
        cursor: pointer; /* Indicate clickable element */
        border-radius: 4px;
    }

    .form-signup button:hover {
        background-color:#152eeb; /* Darker green on hover */
      }
  </style>
</head>
<body>
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
  <section id="checkin" class="form-container">
    <img src="Assets/img/LOGO.jpg" alt="Logo">
    <div class="form-heading">Check In</div>
    <form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">
        <label for="checkoutName">Name:</label>
        <input type="text" id="checkoutName" name="checkoutName" required>
      </div>
      <div class="form-group">
        <label for="checkoutDate">Date:</label>
        <input type="date" id="checkoutDate" name="checkoutDate" required>
      </div>
      <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
      <?php endif; ?>
      <?php if ($error_message): ?>
      <div class="error-message"><?php echo $error_message; ?></div>
      <?php endif; ?>
      <div class="form-group">
        <button type="submit">Check Out</button>
      </div>
    </form>
  </section>
    </div>
  </section>
</body>
</html>
