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
    <div id="device_serial_numbers">
      <!-- Initial device serial number field -->
      <div class="form-group device-serial-number" style="display: none;">
        <label for="device_serial_number">Device Serial Number:</label>
        <input type="text" class="device-serial-input" name="device_serial_number">
      </div>
      <div class="form-group device-serial-number" style="display: none;">
        <label for="device_serial_number">Device Serial Number:</label>
        <input type="text" class="device-serial-input" name="device_serial_number">
      </div>
      <div class="form-group device-serial-number" style="display: none;">
        <label for="device_serial_number">Device Serial Number:</label>
        <input type="text" class="device-serial-input" name="device_serial_number">
      </div>
      <div class="form-group device-serial-number" style="display: none;">
        <label for="device_serial_number">Device Serial Number:</label>
        <input type="text" class="device-serial-input" name="device_serial_number">
      </div>
      <div class="form-group device-serial-number" style="display: none;">
        <label for="device_serial_number">Device Serial Number:</label>
        <input type="text" class="device-serial-input" name="device_serial_number">
      </div>
    </div>
    <div id="vehicle_number_plates">
      <!-- Initial vehicle number plate field -->
      <div class="form-group vehicle-number-plate" style="display: none;">
        <label for="vehicle_number_plate">Vehicle Number Plate:</label>
        <input type="text" class="vehicle-number-plate-input" name="vehicle_number_plate">
      </div>
      <div class="form-group vehicle-number-plate" style="display: none;">
        <label for="vehicle_number_plate">Vehicle Number Plate:</label>
        <input type="text" class="vehicle-number-plate-input" name="vehicle_number_plate">
      </div>
      <div class="form-group vehicle-number-plate" style="display: none;">
        <label for="vehicle_number_plate">Vehicle Number Plate:</label>
        <input type="text" class="vehicle-number-plate-input" name="vehicle_number_plate">
      </div>
    </div>
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
<script>
  document.getElementById('User_type').addEventListener('change', function() {
    var userType = this.value;
    if (userType === 'Check_in_user') {
      showNextDeviceSerialField();
      showNextVehicleNumberPlateField();
    } else {
      hideAllDeviceSerialFields();
      hideAllVehicleNumberPlateFields();
    }
  });

  function showNextDeviceSerialField() {
    var deviceSerialFields = document.querySelectorAll('.device-serial-number');
    for (var i = 0; i < deviceSerialFields.length; i++) {
      if (deviceSerialFields[i].style.display === 'none') {
        deviceSerialFields[i].style.display = 'block';
        return; // Stop after showing the first hidden field
      }
    }
    // If no hidden field found, add a new one
    addNewDeviceSerialField();
  }

  function showNextVehicleNumberPlateField() {
    var vehiclePlateFields = document.querySelectorAll('.vehicle-number-plate');
    for (var i = 0; i < vehiclePlateFields.length; i++) {
      if (vehiclePlateFields[i].style.display === 'none') {
        vehiclePlateFields[i].style.display = 'block';
        return; // Stop after showing the first hidden field
      }
    }
    // If no hidden field found, add a new one
    addNewVehicleNumberPlateField();
  }

  function addNewDeviceSerialField() {
    var deviceSerialFields = document.querySelectorAll('.device-serial-number');
    var lastFieldIndex = deviceSerialFields.length - 1;
    var newFieldIndex = lastFieldIndex + 1;
    var newField = document.createElement('div');
    newField.classList.add('form-group', 'device-serial-number');
    newField.innerHTML = `
      <label for="device_serial_number_${newFieldIndex}">Device Serial Number:</label>
      <input type="text" id="device_serial_number_${newFieldIndex}" name="device_serial_number_${newFieldIndex}">
    `;
    document.getElementById('device_serial_numbers').appendChild(newField);
  }

  function addNewVehicleNumberPlateField() {
    var vehiclePlateFields = document.querySelectorAll('.vehicle-number-plate');
    var lastFieldIndex = vehiclePlateFields.length - 1;
    var newFieldIndex = lastFieldIndex + 1;
    var newField = document.createElement('div');
    newField.classList.add('form-group', 'vehicle-number-plate');
    newField.innerHTML = `
      <label for="vehicle_number_plate_${newFieldIndex}">Vehicle Number Plate:</label>
      <input type="text" id="vehicle_number_plate_${newFieldIndex}" name="vehicle_number_plate_${newFieldIndex}">
    `;
    document.getElementById('vehicle_number_plates').appendChild(newField);
  }

  function hideAllDeviceSerialFields() {
    var deviceSerialFields = document.querySelectorAll('.device-serial-number');
    for (var i = 0; i < deviceSerialFields.length; i++) {
      deviceSerialFields[i].style.display = 'none';
    }
  }

  function hideAllVehicleNumberPlateFields() {
    var vehiclePlateFields = document.querySelectorAll('.vehicle-number-plate');
    for (var i = 0; i < vehiclePlateFields.length; i++) {
      vehiclePlateFields[i].style.display = 'none';
    }
  }
</script>

</html>
