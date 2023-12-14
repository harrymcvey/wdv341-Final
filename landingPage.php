<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kate's Event Planning</title>
    <style>
        /* Global styles */
        body {
            background-color: #dee0df;
            font-family: 'Arial', sans-serif;
            color: #011401;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header styles */
        header {
            background-color: #1f2230;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 10px 20px;
            position: relative;
            overflow: visible;
        }

        /* Logo styles */
        .logo img {
            height: 100px;
            position: absolute;
            top: -30px;
            left: 20px;
            z-index: 10;
        }

        /* Navigation styles */
        nav ul {
            list-style-type: none;
            display: flex;
            justify-content: flex-end;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            background-color: #1f2230;
            border: 1px solid #1f2230;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover, nav ul li a:focus {
            background-color: #333;
            color: white;
        }

        /* Main content styles */
        main {
            flex: 1;
            padding: 20px;
            text-align: center;
        }

        /* Section styles */
        section {
            margin-bottom: 20px;
        }

        /* Service list styles */
        .services ul {
            list-style-position: inside;
            text-align: left;
            display: inline-block;
            margin: 0 auto;
        }

        /* Horizontal line styles */
        hr {
            border: 0;
            height: 1px;
            background-color: #ccc;
            margin: 40px auto;
            width: 60%; 
        }

        /* Footer styles */
        footer {
            background-color: #1f2230;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }

        /* Media query for responsive design */
        @media screen and (max-width: 767px) {
            nav ul {
                flex-direction: column;
                width: 100%;
            }

            nav ul li {
                width: 100%;
                text-align: center;
            }

            nav ul li a {
                display: block;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Kate's Event Planning Logo">
        </div>
        <nav>
            <ul>
                <li><a href="login.php">Vendor Login</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="intro">
            <h2>Welcome to Kate's Event Planning</h2>
            <p>Your dream event, perfectly planned and stress-free. From intimate gatherings to grand celebrations, we turn your vision into a stunning reality.</p>
            <hr>
        </section>

        <section class="services">
            <h2>Our Services</h2>
            <ul>
                <li>Wedding Planning & Coordination</li>
                <li>Corporate Events & Conferences</li>
                <li>Birthday Parties & Social Gatherings</li>
                <li>Themed Events & Gala Dinners</li>
            </ul>
            <hr>
        </section>

        <section class="testimonials">
            <h2>Client Testimonials</h2>
            <blockquote>
                "Kate and her team went above and beyond to make our day special. Everything was flawless!" - Emily R.
            </blockquote>
            <blockquote>
                "The attention to detail was incredible. Our corporate event was a huge success thanks to Kate's Event Planning." - John D.
            </blockquote>
            <hr>
        </section>

        <section class="contact">
            <h2>Get in Touch</h2>
            <p>Ready to start planning? Contact us to schedule a consultation and let's bring your event to life.</p>
        </section>
    </main>

    <footer>
        <p>© <?= date("Y") ?> Kate's Event Planning</p>
    </footer>
</body>
</html>
