<?php
// database connection file
require 'db-connect.php';

// Define variables and initialize with empty values
$name = $description = $presenter = "";
$date_inserted = $date_updated = date("Y-m-d H:i:s"); // Current date and time

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if honeypot field is empty
    if(empty($_POST['honeypot'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $presenter = $_POST['presenter'];

        // Processing the date_time input
        $date_time = $_POST['date_time'];
        $date_time = str_replace("T", " ", $date_time); 
        $date_parts = explode(" ", $date_time);
        $events_date = $date_parts[0]; 
        $events_time = $date_parts[1] ?? '00:00'; 

        // Prepare an insert statement
        $sql = "INSERT INTO wdv341_events (events_name, events_description, events_presenter, events_date, events_time, events_date_inserted, events_date_updated) VALUES (:name, :description, :presenter, :events_date, :events_time, :date_inserted, :date_updated)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":presenter", $presenter);
            $stmt->bindParam(":events_date", $events_date);
            $stmt->bindParam(":events_time", $events_time);
            $stmt->bindParam(":date_inserted", $date_inserted);
            $stmt->bindParam(":date_updated", $date_updated);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                echo "Event inserted successfully.";
            } else {
                echo "Error inserting event.";
            }
        }

        unset($stmt);
    } else {
        echo "Error";
    }
}

unset($pdo);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            max-width: 500px;
            margin: auto;
        }
        label, input, textarea {
            display: block;
            width: 100%;
            margin-top: 10px;
        }
        input[type="text"], input[type="datetime-local"], textarea {
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
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
    </style>
</head>
<body>
    <!-- Link to go back to homepage -->
    <p><a href="homepage.php">Back to Homepage</a></p>

    <form action="eventsForm.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>

        <label for="presenter">Presenter:</label>
        <input type="text" id="presenter" name="presenter"><br>

        <label for="date_time">Date and Time:</label>
        <input type="datetime-local" id="date_time" name="date_time"><br>

        <!-- Honeypot field for bot protection -->
        <input type="text" name="honeypot" style="display:none;">

        <input type="submit" value="Submit">
    </form>
</body>
</html>
