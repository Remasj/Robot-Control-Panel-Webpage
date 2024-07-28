# Web task #1 Robot Control Panel
# Introduction

Control panel for robot's movements and connected it to my XAMPP database "my_actions".

__Purpose:__ is to be able to control the robot virtually and determine its position.

__Softwares used:__ I downloaded XAMPP for creating my database and Visual Studio Code for the coding part.

# My control panel 

<img width="1432" alt="Screenshot 2024-07-15 at 9 10 05 PM" src="https://github.com/user-attachments/assets/e2eff738-dd55-4315-8715-575d609ea56f">

# My database "my_actions"

<img width="1426" alt="Screenshot 2024-07-15 at 9 10 40 PM" src="https://github.com/user-attachments/assets/2aa9b8aa-ee46-4e19-a274-cd7685897b6d">
Data is displayed in the table: actions.

# Code for front end "hello.html"
```html
<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    
    .container {
      position: relative;
      width: 600px; /* adjusted container width */
      height: 600px; /* adjusted container height */
    }
    
    button {
      background-color: pink;
      color: #fff;
      padding: 30px 50px; /* increased padding for bigger buttons */
      font-size: 20px; /* increased font size */
      border: none;
      cursor: pointer;
      border-radius: 15px; /* rounded corners */
      transition: background-color 0.3s ease; /* smooth background color transition */
    }
    
    button:hover {
      background-color: #ff7eb9; /*lighter pink on hover */
    }
    
    #forward {
      position: absolute;
      top: 50px; /*adjusting the spacing and format*/
      left: 50%;
      transform: translateX(-50%);
    }
    
    #backward {
      position: absolute;
      bottom: 50px; 
      left: 50%;
      transform: translateX(-50%);
    }
    
    #left {
      position: absolute;
      top: 50%;
      left: 50px; 
      transform: translateX(-50%);
    }
    
    #right {
      position: absolute;
      top: 50%;
      right: 50px; 
      transform: translateX(50%);
    }
    
    #stop {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
  </style>
  
  <title>Hello Page</title>
</head>
<body>
  <div class="container"> 
    <button id="forward" onclick="sendAction('forward')">Forward</button>
       <button id="backward" onclick="sendAction('backward')">Backward</button>
       <button id="left" onclick="sendAction('left')">Left</button>
       <button id="right" onclick="sendAction('right')">Right</button>
       <button id="stop" onclick="sendAction('stop')">Stop</button>
  </div>

<script>
    function sendAction(action) {
        fetch(`http://localhost/BACKEND/databse.php?action=${action}`, { //initiates a network request to the URL
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            console.log('Response:', data);
            // Optionally update UI or show success message
        })
        .catch(error => {
            console.error('Error sending action:', error);
            alert('Error sending action to backend');
        });
    }
</script>
</body>
</html>
 ```
-HTML creates a basic control panel with embedded CSS code for styling, formatting, and designing elements on the page.
-JavaScript is used to send actions (clicking the button) to a backend PHP script (databse.php) via a POST request. 

-*sendAction* function for handling button clicks. It uses fetch API to send a POST request to http://localhost/BACKEND/databse.php with the specified action appended as a query parameter.
-'fetch' initiates a network request to the URL specified.

-.then(response => response.json()): converts the response into JSON format.

-.then(data => { console.log('Response:', data); ... }): logs JSON data to the console.

-.catch(error => { console.error('Error sending action:', error); ... }): catches errors that may take place during the fetch request, logs them to the console, and alerts the user.

# Code for backend "databse.php"
``` php
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Allow from any origin (for development purposes)
header("Access-Control-Allow-Origin: *");
// Enable CORS headers
header("Access-Control-Allow-Headers: *");
// Allow methods (GET, POST, etc.)
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// Checking if the request method is POST and if the 'action' parameter exists
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action'])) {
    $action = $_GET['action'];

    // Defined database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "my_actions"; // Replace with your database name

    // Created connection to database
    $conn = new mysqli($servername, $username, $password, $dbname); 

    // Checked connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert action into database
    $sql = "INSERT INTO actions (action_name, action_time) VALUES ('$action', NOW())";

    if ($conn->query($sql) === TRUE) {
        $response = array("success" => true, "message" => "Action '$action' recorded successfully");
    } else {
        $response = array("success" => false, "error" => $conn->error);
    }

    // Close the connection
    $conn->close();

    // Send JSON response back to frontend
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Handle invalid requests
    $response = array("success" => false, "error" => "Invalid request");
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
```
-Started by checking if the request method is POST and if the action parameter is present in the URL query string by "if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action'])) {"

-Responds to frontend through a JSON response (header('Content-Type: application/json'); echo json_encode($response);) which indicating the outcome of the database operation (success or error).

-The PHP script then records the action (<action_name>) and the timestamp into a MySQL database (my_actions) after a button is clicked and JavaScript code on the frontend makes a POST request to http://localhost/BACKEND/databse.php?action=<action_name>.

-($_GET['action']) was used to create an SQL query to add the received action and the current timestamp (NOW()) into the actions table of the database.

-$conn->query($sql) executes the query.

-($conn->query($sql) === TRUE) reviews if the query was successful. If true, it constructs a success response ($response) that indicates the action was recorded successfully. If not, it constructs an error response ($response) with details from $conn->error.

# Java Script code "script.js"
```js
function sendAction(action) {
    fetch('http://localhost/BACKEND/databse.php') //initiated fetch request
    .then(response => { //checking if response in successful
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); //parses response body as JSON 
    })
    .then(data => { //handles JSON data from backend
        console.log('API Response:', data);
        // Handle data 
    })
    .catch(error => {
        console.error('Fetch Error:', error);
        // Handle error 
        alert('Error fetching data from backend');
    });
}
```
-Used javascript code in my frontend to send action to backend through POST request.

-Is also used to alert the user in case of an error in fetching data from the backend.

-Used (console.log) and (console.error) to log responses and errors which helps during development and debugging.

-This function shortens the communication between the frontend and backend, which makes interaction based on user actions easier and updates the UI accordingly with data fetched from the server.


