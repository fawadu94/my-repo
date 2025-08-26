<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Communication Portal - Message</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1, h2 {
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        textarea:focus {
            border-color: #3498db;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        hr {
            border: 1px solid #ccc;
            margin: 20px 0;
        }

        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
            transition: color 0.3s;
        }

        a:hover {
            color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>Message</h1>
    <form method="POST" action="save_message.php">
        <div>
            <label for="message">Your Message:</label>
            <textarea id="message" name="message" rows="4" cols="50" required></textarea>
        </div>
        <div>
            <button type="submit">Send Message</button>
        </div>
    </form>
    <hr>
    <h2>Messages:</h2>
    <?php include('messages.php'); ?>
    <a href="index1.html">Back to Home</a>
</body>
</html>
