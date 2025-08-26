<?php
session_start();

// Verify if the user is logged in and has admin privileges
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.html');
    exit;
}

// Include any necessary PHP code for additional functionality

?>

<!DOCTYPE html>
<html lang="en">
<!-- Your HTML content for dashboard.html goes here -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="university_categories.php">University Categories</a></li>
                <li><a href="event_categories.php">Event Categories</a></li>
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
    </header>
    
    <section>
        <h2>Welcome to Your Dashboard</h2>
        <!-- Dashboard content goes here -->
    </section>

    <footer>
        <!-- Footer content -->
    </footer>
</body>

</html>

<?php
// Close any open resources or connections
?>
