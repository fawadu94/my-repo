<?php
// Connect to database
// ...
$conn = new mysqli('localhost', 'root', '', 'eventweb');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    // ...

    // Insert event into database with status 'pending'
    $sql = "INSERT INTO events (name, date, status) VALUES ('$eventName', '$eventDate', 'pending')";
    // Execute query
    // ...
    echo"Successfully Entered";
}
?>
