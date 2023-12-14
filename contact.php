<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$messageSent = false;

// Include the database connection file
require 'db-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Prepare an insert statement
    $sql = "INSERT INTO contact_messages (firstName, lastName, phone, email, message) VALUES (:firstName, :lastName, :phone, :email, :message)";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":firstName", $firstName);
        $stmt->bindParam(":lastName", $lastName);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":message", $message);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Send email using PHPMailer
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();                                            
                $mail->Host       = 'smtp.gmail.com';                     
                $mail->SMTPAuth   = true;                                   
                $mail->Username   = 'harrymcvey1@gmail.com';                
                $mail->Password   = 'fkyh akjm pyqm wrxn';                          
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                $mail->Port       = 587;                                    

                //Recipients
                $mail->setFrom('harrymcvey1@gmail.com', 'Mailer');
                $mail->addAddress($email, $firstName . ' ' . $lastName);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'New Contact Form Submission';
                $mail->Body    = "First Name: $firstName<br>Last Name: $lastName<br>Phone: $phone<br>Email: $email<br>Message: $message";
                $mail->AltBody = "First Name: $firstName\nLast Name: $lastName\nPhone: $phone\nEmail: $email\nMessage: $message";

                $mail->send();
                $messageSent = true;
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Oops! Something went wrong and we couldn't send your message.";
        }
    }

    unset($stmt);
}

unset($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
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
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="email"], input[type="tel"], textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
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
        .message, .thank-you-message {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 500px;
            margin: auto;
            margin-bottom: 20px;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
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
    <?php if ($messageSent): ?>
        <div class="thank-you-message">
            <p>Thank you for your message! We will get back to you soon.</p>
        </div>
    <?php else: ?>
        <form action="contact.php" method="post">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>

            <input type="submit" value="Submit">
        </form>
    <?php endif; ?>

    <div class="back-link">
        <a href="landingPage.php">Back to Landing Page</a>
    </div>
</body>
</html>
