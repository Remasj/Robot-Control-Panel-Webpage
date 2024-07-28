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
      background-color: #ff7eb9; /* lighter pink on hover */
    }
    
    #forward {
      position: absolute;
      top: 50px; /* adjusting the spacing and format */
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
    <!-- Action buttons -->
    <button id="forward" onclick="sendAction('forward')">Forward</button>
    <button id="backward" onclick="sendAction('backward')">Backward</button>
    <button id="left" onclick="sendAction('left')">Left</button>
    <button id="right" onclick="sendAction('right')">Right</button>
    <button id="stop" onclick="sendAction('stop')">Stop</button>
  </div>

  <script>
    function sendAction(action) {
      fetch('http://localhost/BACKEND/databse.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json', // Send as JSON
        },
        body: JSON.stringify({
          'action_name': action // Send action name in JSON format
        })
      })
      .then(response => response.json())
      .then(data => {
        console.log('Response:', data);
        if (data.success) {
          // Optionally update UI or show success message
          console.log(data.message);
        } else {
          console.error('Error:', data.error);
        }
      })
      .catch(error => {
        console.error('Error sending action:', error);
        alert('Error sending action to backend');
      });
    }
  </script>
</body>
</html>
