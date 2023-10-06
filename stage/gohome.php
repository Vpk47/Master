<?php
// Start a session
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Get the username from the session
    $username = $_SESSION['username'];

    // Record the logout event
    recordLogoutEvent($username);

    // Destroy the session
    session_destroy();
}

// Redirect the user to the login page or any other desired page
header("Location: index.php"); // Replace "login.php" with the URL of your login page
exit;

// Function to record a logout event with a timestamp
function recordLogoutEvent($username) {
    // Database connection settings (replace with your Hostinger MySQL credentials)
    $host = "89.117.188.52";
    $username = "u831675891_Vpk";
    $password = "Codename47@Vpk";
    $database = "u831675891_VpkDigitalArt";

    // Create a connection to the database
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the current timestamp
    $timestamp = date('Y-m-d H:i:s');
    
    // Define the event type (logout)
    $event_type = 'logout';

    // Insert the logout event into the login_events table
    $username = mysqli_real_escape_string($conn, $username);
    $sql = "INSERT INTO login_events (username, logout_time, event_type) VALUES ('$username', '$timestamp', '$event_type')";

    
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
