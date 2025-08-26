<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventweb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch pending events
$sql = "SELECT * FROM pending_events ";
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    echo json_encode($events);
} else {
    echo "0 results";
}
$conn->close();
?>
