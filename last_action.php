<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Last Action</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif; /* Girly font */
            background-color: #f8c8dc; /* Light pink background */
            color: #d04877; /* Darker pink for text */
            text-align: center; /* Center the text */
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #fff; /* White background for the container */
            border-radius: 12px; /* Rounded corners */
            padding: 20px;
            max-width: 600px;
            margin: 0 auto; /* Center container */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
        }
        h1 {
            color: #e94e77; /* Bright pink for the heading */
        }
        .action-info {
            font-size: 18px;
            margin-top: 20px;
        }
        .loading {
            font-size: 20px;
            font-weight: bold;
            color: #d04877; /* Darker pink for loading text */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Last Clicked Action</h1>
        <div id="actionInfo" class="action-info loading">Loading...</div>
    </div>
    <script>
        // Fetch the last action from the backend
        fetch('http://localhost/BACKEND/fetch_last_action.php')
            .then(response => response.json())
            .then(data => {
                const actionInfo = document.getElementById('actionInfo');
                if (data.success) {
                    const { action_name, action_time } = data.data;
                    actionInfo.innerHTML = `The last action performed was: <strong>${action_name}</strong><br>Performed at: <strong>${action_time}</strong>`;
                } else {
                    actionInfo.innerHTML = `Error: ${data.message}`;
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                document.getElementById('actionInfo').innerHTML = 'Error fetching data';
            });
    </script>
</body>
</html>
