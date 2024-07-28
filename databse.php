<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Allow from any origin (for development purposes)
header("Access-Control-Allow-Origin: *");
// Enable CORS headers
header("Access-Control-Allow-Headers: Content-Type");
// Allow methods (GET, POST, etc.)
header("Access-Control-Allow-Methods: POST, OPTIONS");

// Checking if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch the action_name from the POST data
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['action_name'])) {
        $action = $data['action_name'];

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

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO actions (action_name, action_time) VALUES (?, NOW())");
        $stmt->bind_param("s", $action);

        if ($stmt->execute()) {
            $response = array("success" => true, "message" => "Action '$action' recorded successfully");
        } else {
            $response = array("success" => false, "error" => $stmt->error);
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Send JSON response back to frontend
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Handle missing action_name
        $response = array("success" => false, "error" => "Action name not provided");
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // Handle invalid request method
    $response = array("success" => false, "error" => "Invalid request method");
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
