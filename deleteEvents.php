<?php
session_start();

// Include database connection file
require 'db-connect.php';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

// Check if the form has been submitted for deletion
if (isset($_POST['deleteEvent'])) {
    $recid = $_POST['event_id'];

    // Delete the event from the database
    $deleteStmt = $pdo->prepare("DELETE FROM wdv341_events WHERE events_id = ?");
    if ($deleteStmt->execute([$recid])) {
        header("Location: deleteEvents.php?message=Event deleted successfully!");
        exit();
    } else {
        header("Location: deleteEvents.php?message=Error deleting event.");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        input[type="submit"] {
            background-color: #d9534f;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #c9302c;
        }
        a {
            color: #333;
            padding: 5px 10px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .message {
            color: #d9534f;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php
// Display any messages
if (isset($_GET['message'])) {
    echo '<div class="message">' . htmlspecialchars($_GET['message']) . '</div>';
}

// Link back to homepage.php
echo '<a href="homepage.php">Back to Homepage</a>';

// Fetch events from the database
$query = "SELECT * FROM wdv341_events";
$events = $pdo->query($query);

// Display the table of events
echo '<table>';
echo '<tr><th>Event Name</th><th>Description</th><th>Presenter</th><th>Date</th><th>Time</th><th>Delete</th></tr>';
foreach ($events as $event) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($event['events_name']) . '</td>';
    echo '<td>' . htmlspecialchars($event['events_description']) . '</td>';
    echo '<td>' . htmlspecialchars($event['events_presenter']) . '</td>';
    echo '<td>' . htmlspecialchars($event['events_date']) . '</td>';
    echo '<td>' . htmlspecialchars($event['events_time']) . '</td>';
    echo '<td>';
    echo '<form action="deleteEvents.php" method="POST" onsubmit="return confirmDelete(this);">';
    echo '<input type="hidden" name="event_id" value="' . htmlspecialchars($event['events_id']) . '"/>';
    echo '<input type="submit" name="deleteEvent" value="Delete"/>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
?>

<script>
function confirmDelete(form) {
    if (confirm("Are you sure you want to delete this event?")) {
        return true;
    } else {
        return false;
    }
}
</script>
</body>
</html>
