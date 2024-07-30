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

# Code Explanation for front end "hello.html" (changed to hello.php after adding new webpage)
-HTML creates a basic control panel with embedded CSS code for styling, formatting, and designing elements on the page.
-JavaScript is used to send actions (clicking the button) to a backend PHP script (databse.php) via a POST request. 

-*sendAction* function for handling button clicks. It uses fetch API to send a POST request to http://localhost/BACKEND/databse.php with the specified action appended as a query parameter.
-'fetch' initiates a network request to the URL specified.

-.then(response => response.json()): converts the response into JSON format.

-.then(data => { console.log('Response:', data); ... }): logs JSON data to the console.

-.catch(error => { console.error('Error sending action:', error); ... }): catches errors that may take place during the fetch request, logs them to the console, and alerts the user.

# Code Explanation for backend "databse.php"
-Started by checking if the request method is POST and if the action parameter is present in the URL query string by "if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action'])) {"

-Responds to frontend through a JSON response (header('Content-Type: application/json'); echo json_encode($response);) which indicating the outcome of the database operation (success or error).

-The PHP script then records the action (<action_name>) and the timestamp into a MySQL database (my_actions) after a button is clicked and JavaScript code on the frontend makes a POST request to http://localhost/BACKEND/databse.php?action=<action_name>.

-($_GET['action']) was used to create an SQL query to add the received action and the current timestamp (NOW()) into the actions table of the database.

-$conn->query($sql) executes the query.

-($conn->query($sql) === TRUE) reviews if the query was successful. If true, it constructs a success response ($response) that indicates the action was recorded successfully. If not, it constructs an error response ($response) with details from $conn->error.

# Java Script code Explanation "script.js"

-Used javascript code in my frontend to send action to backend through POST request.

-Is also used to alert the user in case of an error in fetching data from the backend.

-Used (console.log) and (console.error) to log responses and errors which helps during development and debugging.

-This function shortens the communication between the frontend and backend, which makes interaction based on user actions easier and updates the UI accordingly with data fetched from the server.

# Updated files e

