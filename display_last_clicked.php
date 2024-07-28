<?php
require_once 'connection.php'; // Path to your database connection file

$lastActionName = "";
$lastActionTime = "";

try {
    // Fetch the most recent action
    $sql = "SELECT action_name, action_time FROM actions ORDER BY id DESC LIMIT 1";
    $stmt = $pdo->query($sql);
    $lastAction = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($lastAction) {
        $lastActionName = $lastAction['action_name'];
        $lastActionTime = $lastAction['action_time'];
    } else {
        $lastActionName = "No actions performed yet.";
        $lastActionTime = "";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Last Clicked Button</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .action-info {
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Last Clicked Button</h1>
        <p>The last action performed was: <?php echo htmlspecialchars($lastActionName); ?></p>
        <p>Performed at: <?php echo htmlspecialchars($lastActionTime); ?></p>
    </div>
</body>
</html>
