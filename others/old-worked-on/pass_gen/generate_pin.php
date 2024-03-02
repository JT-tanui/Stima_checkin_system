<?php
//JS1
//get to understand this code is still on works, hence it requires some error handling, at the mment you can only debugg using the browser console.
// Connect to the database
$db_host = "localhost";
$db_user = "Admin1";
$db_password = "shivachi";
$db_name = "checking_system";
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get staff number from the client-side input box this can either be the staff number or the id numbern it specifies the "where" in sql.
$staffNumber = $_POST['staffNumber'] ?? '';

// Generate and check for a unique 4-digit PIN, this should be the primary key to ensure its uniqueness.
$uniquePIN = generateUniquePIN($conn);

// Hash the PIN so the pin is hashed, cant be visible in the database.
$hashedPIN = password_hash($uniquePIN, PASSWORD_DEFAULT);

// Store the hashed PIN in the database, its stored in the DB column 
$success = storeDataInDatabase($conn, $staffNumber, $hashedPIN);

if ($success) {
    echo json_encode(['success' => true, 'message' => 'PIN stored successfully', 'pin' => $uniquePIN]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error storing PIN']);
}
//this is the function that generates the pin the largest number that can be generated is 9999
function generateUniquePIN($conn) {
    $isUnique = false;

    do {
        // Generate a new 4-digit PIN
        $randomPIN = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        // Check if the PIN already exists in the database, this ensures that after a while and maybe the combination has been depleted no same pin is stored in the DB for different users.
        $query = "SELECT COUNT(*) AS count FROM tbluser WHERE hashed_pin = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $randomPIN);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        // If count is 0, then the PIN is unique, hence can be assigned.
        if ($count == 0) {
            $isUnique = true;
        }
    } while (!$isUnique);

    return $randomPIN;
}

function storeDataInDatabase($conn, $staffNumber, $hashedPIN) {
    //Insert into a 'tbluser' table using MySQLi
    $stmt = $conn->prepare("INSERT INTO tbluser (ID, hashed_pin) VALUES (?, ?) ON DUPLICATE KEY UPDATE hashed_pin = ?");
    $stmt->bind_param('sss', $staffNumber, $hashedPIN, $hashedPIN);
    $success = $stmt->execute();
    $stmt->close();

    return $success;
}
?>
