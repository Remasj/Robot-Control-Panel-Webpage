<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Allow from any origin (for development purposes)
header("Access-Control-Allow-Origin: *");
// Enable CORS headers
header("Access-Control-Allow-Headers: Content-Type");
// Allow methods (GET, POST, etc.)
header("Access-Control-Allow-Methods: GET, OPTIONS");

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_actions"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $response = array("success" => false, "error" => "Connection failed: " . $conn->connect_error);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Retrieve the last action from the database
$sql = "SELECT action_name, action_time FROM actions ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $lastAction = $result->fetch_assoc();
    $response = array("success" => true, "data" => $lastAction);
} else {
    $response = array("success" => false, "message" => "No actions found");
}

// Close the connection
$conn->close();

// Send JSON response back to frontend
header('Content-Type: application/json');
echo json_encode($response);
?>
