<?php
require 'C:\xampp\htdocs\FYP\Source\db.php';

// Get action and event ID from request
$action = mysqli_real_escape_string($conn, $_GET["action"]);
$event_id = mysqli_real_escape_string($conn, $_GET["event_id"]);

// Handle actions based on GET request
switch ($action) {
  case "details":
    // Fetch event details and return JSON response
    $sql = "SELECT * FROM pending_events WHERE id = '$event_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $eventData = $result->fetch_assoc();
      $response = array(
        "success" => true,
        "event" => $eventData
      );
    } else {
      $response = array(
        "success" => false,
        "message" => "Event not found"
      );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    break;

  case "approve":
    // Update event status and move data to approved_events table
    $sql = "UPDATE pending_events SET status = 'approved' WHERE id = '$event_id'";
    $conn->query($sql);

    if ($conn->error) {
      $response = array(
        "success" => false,
        "message" => "Error approving event: " . $conn->error
      );
    } else {
      // Move event data to approved_events table (optional)
      $sql = "INSERT INTO approved_events (event_id,eventTitle, eventDate, eventTime, eventLocation, eventDescription, eventCategory, eventImage, eventOrganizer, eventContact)
      SELECT  event_id, eventTitle, eventDate, eventTime, eventLocation, eventDescription, eventCategory, eventImage, eventOrganizer, eventContact FROM pending_events WHERE id = '$event_id'";
      $conn->query($sql);

      // Optionally, delete event from pending_events table
      $sql = "DELETE FROM pending_events WHERE id = '$event_id'";
      $conn->query($sql);

      $response = array(
        "success" => true,
        "message" => "Event approved successfully!"
      );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    break;

  case "reject":
    // Remove event from pending_events table
    $sql = "DELETE FROM pending_events WHERE id = '$event_id'";
    $conn->query($sql);

    if ($conn->error) {
      $response = array(
        "success" => false,
        "message" => "Error rejecting event: " . $conn->error
      );
    } else {
      $response = array(
        "success" => true,
        "message" => "Event rejected successfully!"
      );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    break;

  default:
    $response = array(
      "success" => false,
      "message" => "Invalid action."
    );

    header('Content-Type: application/json');
    echo json_encode($response);
    break;
}

$conn->close();

?>