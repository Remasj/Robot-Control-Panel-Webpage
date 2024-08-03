# UPDATED: Robot Control Panel with Webpage to Display Last clicked Value
# Introduction

Control panel for robot's movements and connected it to my XAMPP database "my_actions".

__Purpose:__ is to be able to control the robot virtually and determine its position.

__Softwares used:__ I downloaded XAMPP for creating my database and Visual Studio Code for the coding part.

# My control panel 

<img width="1432" alt="Screenshot 2024-07-15 at 9 10 05 PM" src="https://github.com/user-attachments/assets/e2eff738-dd55-4315-8715-575d609ea56f">

# My database "my_actions" 

<img width="1426" alt="Screenshot 2024-07-15 at 9 10 40 PM" src="https://github.com/user-attachments/assets/2aa9b8aa-ee46-4e19-a274-cd7685897b6d">
Data is displayed in the table: actions.

# Files
__Control Panel Web Page__:

*__Front end__*

__hello.html__ (changed to hello.php after adding new webpage): the main control panel page with buttons to send commands.
-Used HTML to create a basic control panel with embedded CSS code for styling, formatting, and designing elements on the page.
-JavaScript is used to send actions (clicking the button) to a backend PHP script (databse.php) via a POST request. 

__script.js:__ JavaScript file handling button interactions. Used it in my frontend to send action to backend through POST request. It is also used to alert the user in case of an error in fetching data from the backend.


*__Backend__*

__databse.php:__ Processes the commands and stores them in the database.

# Web Page for last clicked button:
*__Front End__*

__last_clicked.php:__ Webpage to display the last clicked button. Retrieves and displays the most recent command from the database. This file queries the database for the last recorded action and displays it.

*__Back End__*

__connection.php:__ Manages database connections. This file handles the connection to the MySQL database.




# Updates: 
Updated initial files and added new frontend and backend for the new webpage.


# Web Page for last clicked value

<img width="1438" alt="Screenshot 2024-08-03 at 11 37 51 PM" src="https://github.com/user-attachments/assets/54fdd987-385c-41f4-9a98-0d08d5fea3e5">

and the database automatically updates and adds the new value as well:
<img width="1416" alt="Screenshot 2024-08-03 at 11 36 44 PM" src="https://github.com/user-attachments/assets/79d6684b-aac8-4710-8975-3b683e38d681">

