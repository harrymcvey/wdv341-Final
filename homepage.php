<!DOCTYPE html>
<html>
<head>
    <title>Admin Homepage</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 25px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        main {
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            padding: 0.5em;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            margin-bottom: 10px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 10px;
            background-color: lightgray;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #ddd;
        }

        @media screen and (max-width: 767px) {
            main {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Administration Panel</h1>
    </header>

    <main>
        <nav>
            <ul>
                <li><a href='eventsForm.php'>Add New Event</a></li>
                <li><a href='updateEvent.php'>Update Events</a></li>
                <li><a href='deleteEvents.php'>Delete Events</a></li>
                <li><a href='logout.php'>Logout of Administrator</a></li>
            </ul>
        </nav>
    </main>
</body>
</html>
