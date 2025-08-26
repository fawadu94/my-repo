<!--<//?php
//require 'C:\xampp\htdocs\FYP\db.php';

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$eventTitle = $_POST["eventTitle"];
    //$eventDate = $_POST["eventDate"];
    //$eventTime = $_POST["eventTime"];
    //$eventLocation = $_POST["eventLocation"];
    //$eventDescription = $_POST["eventDescription"];
    //$eventCategory = $_POST["eventCategory"];
    //$eventImage = $_POST["eventImage"];

    // Sanitize and validate your inputs

    // Database connection
    //$conn = new mysqli('localhost', 'root', '', 'eventweb');
    //if ($conn->connect_error) {
     //   die("Connection failed: " . $conn->connect_error);
    //}

    // SQL to add event with column names
    //$sql = "INSERT INTO events (eventTitle, eventDate, eventTime, eventLocation, eventDescription, eventCategory, eventImage) VALUES ('$eventTitle', '$eventDate', '$eventTime', '$eventLocation', '$eventDescription', '$eventCategory', '$eventImage')";

    // Execute query and check for success
    //if ($conn->query($sql) === TRUE) {
      //  echo "New event added successfully";
    //} else {
      //  echo "Error: " . $sql . "<br>" . $conn->error;
    //}

  //  $conn->close();
//}

// Redirect back to the dashboard or show a success message
//?> -->

<?php
require 'C:\xampp\htdocs\FYP\Source\db.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $event_id = mysqli_real_escape_string($conn, $_POST["event_id"]);
    $eventTitle = mysqli_real_escape_string($conn, $_POST["eventTitle"]);
    $eventDate = mysqli_real_escape_string($conn, $_POST["eventDate"]);
    $eventTime = mysqli_real_escape_string($conn, $_POST["eventTime"]);
    $eventLocation = mysqli_real_escape_string($conn, $_POST["eventLocation"]);
    $eventDescription = mysqli_real_escape_string($conn, $_POST["eventDescription"]);
    $eventCategory = mysqli_real_escape_string($conn, $_POST["eventCategory"]);
    $eventImage = $_POST["eventImage"];

    // Insert the event data into a 'pending_events' table
    $sql = "INSERT INTO pending_events (event_id, eventTitle, eventDate, eventTime, eventLocation, eventDescription, eventCategory, eventImage) VALUES ('$event_id','$eventTitle', '$eventDate', '$eventTime', '$eventLocation', '$eventDescription', '$eventCategory', '$eventImage')";

    if ($conn->query($sql) === TRUE) {
        echo "Event submission successful! Waiting for admin approval.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("Location: organizer_dashboard.html");
}
?>
