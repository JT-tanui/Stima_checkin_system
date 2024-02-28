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
$error_message = "";
// Check connection
if ($conn->connect_error) {
    $error_message = ("Connection failed: " . $conn->connect_error);
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

$message = "";

// Execute SQL statement
if ($stmt->execute()) {
    $message = "New record created successfully";
} else {
    $message =  "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="Assets/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <style>
      nav {
      position: relative;
      flex: 0 0 20%; /* Set width to 20% of left side */
      background-color: #2d24e5;
      padding: 1rem;
      transition: width 0.2s ease-in-out; /* Smooth width transition */
    }
    .login-container {
      flex: 1; /*For 0.8 Assign remaining width for login container */
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
    .form-sigup {
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
    <section class="login-container">
            <img src="Assets/img/LOGO.jpg" alt="Logo">
            <br>
            <div class="form-heading">Registration</div>
            <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
              </div>
              <label for="User_type">Choose user_type:</label>
                <select id="User_type" name="cars">
                  <option value="Administrator">Administrator</option>
                  <option value="Check_in_user">Check in user</option>
                </select>
              <div class="form-group">
                <label for="Phone-number">Phone-number:</label>
                <input type="Phone-number" id="Phone-number" name="Phone-number" required>
              </div>
              <div class="form-group">
                <label for ="Department" >Department:</label>
                <input type="Department" id="Department" name="Department" required>
              </div>              
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
              </div>
              <?php if ($message): ?>
                 <div class="message"><?php echo $message; ?></div>
              <?php endif; ?>
              <?php if ($error_message): ?>
                  <div class="error-message"><?php echo $error_message; ?></div>
              <?php endif; ?>
              <div class="form-group">
                <button type="submit">Register</button>
              </div>
              <div class="form-group">
                <p>Go back to home page</p>
                <a href="homepage.html"></a><button type="submit">Homepage</button>
              </div>
            </form>
  </section>
</body>
</html>
