<?php
session_start();

// Database connection file
require 'db-connect.php';

// Initialize the variables
$error = "";
$success = "";

// Fetch All Events
$stmt = $pdo->prepare("SELECT * FROM wdv341_events");
$stmt->execute();
$eventsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle Update Event
if (isset($_POST['updateEvent'])) {
    $recid = $_POST['event_id'];

    // Extract posted form data
    $eventName = $_POST['eventName'];
    $eventDescription = $_POST['eventDescription'];
    $eventPresenter = $_POST['eventPresenter'];
    $eventDate = $_POST['eventDate'];
    $eventTime = $_POST['eventTime'];

    // Update the event data in the database
    $updateStmt = $pdo->prepare("UPDATE wdv341_events SET events_name = ?, events_description = ?, events_presenter = ?, events_date = ?, events_time = ? WHERE events_id = ?");
    if ($updateStmt->execute([$eventName, $eventDescription, $eventPresenter, $eventDate, $eventTime, $recid])) {
        $success = "Event updated successfully!";
    } else {
        $error = "Error updating event.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Event</title>
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
        input[type="text"], input[type="date"], input[type="time"], textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            color: #d9534f;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .success {
            color: #5cb85c;
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
        a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1>Instructions:</h1>
    <p>To update an event, make changes to the fields and then click the "Update" button next to the event you want to update. (you may have to refresh the page to see the updated results)</p>
    
    <!-- Link to go back to homepage -->
    <p><a href="homepage.php">Back to Homepage</a></p>

    <?php if ($error != ""): ?>
        <div class="message"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($success != ""): ?>
        <div class="message success"><?= $success ?></div>
    <?php endif; ?>

    <?php if (!empty($eventsData)): ?>
        <table>
            <tr>
                <th>Event Name</th>
                <th>Event Description</th>
                <th>Event Presenter</th>
                <th>Event Date</th>
                <th>Event Time</th>
                <th>Action</th>
            </tr>
            <?php foreach ($eventsData as $event): ?>
                <form action="updateEvent.php" method="post">
                    <input type="hidden" name="event_id" value="<?= $event['events_id'] ?>">
                    <tr>
                        <td><input type="text" name="eventName" value="<?= htmlspecialchars($event['events_name']) ?>"></td>
                        <td><textarea name="eventDescription"><?= htmlspecialchars($event['events_description']) ?></textarea></td>
                        <td><input type="text" name="eventPresenter" value="<?= htmlspecialchars($event['events_presenter']) ?>"></td>
                        <td><input type="date" name="eventDate" value="<?= htmlspecialchars($event['events_date']) ?>"></td>
                        <td><input type="time" name="eventTime" value="<?= htmlspecialchars($event['events_time']) ?>"></td>
                        <td><input type="submit" name="updateEvent" value="Update"></td>
                    </tr>
                </form>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No events found.</p>
    <?php endif; ?>
</body>
</html>
