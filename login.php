<?php
session_start();

// Database connection file
require 'db-connect.php';

function validateUser($pdo, $username, $password) {
    $stmt = $pdo->prepare("SELECT * FROM event_user WHERE event_user_name = ? AND event_user_password = ?");
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $password);

    $stmt->execute();

    return $stmt->rowCount() > 0;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (validateUser($pdo, $username, $password)) {
        $_SESSION['validUser'] = true;
        header("Location: homepage.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Website Title</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        form {
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            width: fit-content;
        }
        input[type="text"], input[type="password"] {
            margin-bottom: 10px;
            padding: 5px;
        }
        input[type="submit"] {
            padding: 5px 15px;
            border-radius: 5px;
            border: none;
            background-color: #333;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #444;
        }
        p {
            color: red;
            text-align: center;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
        }
        .back-link a {
            color: #333;
            padding: 5px 10px;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .back-link a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

    <?php if (!isset($_SESSION['validUser']) || !$_SESSION['validUser']): ?>
        <?php if ($error != ""): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="login.php" method="post">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit" value="Login">
        </form>
        <div class="back-link">
            <a href="landingPage.php">Back to Landing Page</a>
        </div>
    <?php endif; ?>

</body>
</html>
