<?php
session_start();

// Set the session variable 'validUser' to false if it exists
if (isset($_SESSION['validUser'])) {
    $_SESSION['validUser'] = false;
}

session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding-top: 50px;
        }
        .message {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="message">
        <p>You have been logged out. Redirecting to login page...</p>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = "login.php";
        }, 3000); // Redirect after 3 seconds
    </script>
</body>
</html>
