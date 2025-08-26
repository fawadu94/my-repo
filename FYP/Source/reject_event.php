<?php
// require 'C:\xampp\htdocs\FYP\Source\db.php';

// // Get event ID from POST request
// $event_id = mysqli_real_escape_string($conn, $_POST["event_id"]);

// // Remove event from pending_events table
// $sql = "DELETE FROM pending_events WHERE id = '$event_id'";
// $conn->query($sql);

// if ($conn->error) {
//   $response = array(
//     "success" => false,
//     "message" => "Error rejecting event: " . $conn->error
//   );
// } else {
//   $response = array(
//     "success" => true,
//     "message" => "Event rejected successfully!"
//   );
// }

// header('Content-Type: application/json');
// echo json_encode($response);

// $conn->close();
require 'C:\xampp\htdocs\FYP\Source\db.php';

$conn = new mysqli('localhost', 'root', '', 'eventweb');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$event_id = $_GET['event_id'];

// Delete event from pending_events
$sql = "DELETE FROM pending_events WHERE id = $event_id";

if ($conn->query($sql) === TRUE) {
    echo "Event rejected and deleted successfully";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

?>