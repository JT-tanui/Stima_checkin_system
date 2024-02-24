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

// Fetch log data from the database
$sql = "SELECT * FROM check_log ORDER BY created_at DESC"; // Assuming check_log is the table storing log data
$result = $conn->query($sql);

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard </title>
  <link rel="stylesheet" href="Assets/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <style>
    /* Accessibility considerations */
    body {
      font-size: 16px;
      line-height: 1.5;
    }

    * {
      box-sizing: border-box;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
      table, th, td {
      border: 1px solid black;
      padding: 8px;
    }
      th {
      background-color: #f2f2f2;
    }
    a:focus {
      outline: 3px solid #007bff;
    }

  </style>
</head>
<body>
  <nav>
    <header>
      <h1>Checking System</h1>
    </header>
    <br><br><br>
      <a href="Dashboard.html"><span class="material-symbols-outlined"> home </span> Dashboard</a>
      <a href="register.php"> <span class="material-symbols-outlined">app_registration</span><span>  Registration</span></a>
      <a href="checkin.php"><span class="material-symbols-outlined">check_in_out</span> Check In</a>
      <a href="checkout.php"><span class="material-symbols-outlined">check_in_out</span>   Check Out</a>
      <a href="Settings.html"><span class="material-symbols-outlined">settings</span>   Settings</a>
  </nav>
<section>
  <h1>Check-In/Check-Out Log</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Event Type</th>
                <th>Event Date</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["event_type"] . "</td>";
                    echo "<td>" . $row["event_date"] . "</td>";
                    echo "<td>" . $row["created_at"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No log data available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>
</body>
</html>
