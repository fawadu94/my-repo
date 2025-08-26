<?php
require 'C:\xampp\htdocs\FYP\Source\db.php';

// Prepare SQL query to fetch pending events
$sql = "SELECT * FROM pending_events";

// Execute the query
$result = $conn->query($sql);

// Check if any events found
if ($result->num_rows > 0) {
  // Fetch all event details
  $events = array();
  while ($row = $result->fetch_assoc()) {
    $events[] = $row;
  }

  // Encode events as JSON and respond
  header('Content-Type: application/json');
  echo json_encode(array(
    "success" => true,
    "events" => $events
  ));
} else {
  // No events found
  header('Content-Type: application/json');
  echo json_encode(array(
    "success" => false,
    "message" => "No pending events found"
  ));
}

$conn->close();
?>