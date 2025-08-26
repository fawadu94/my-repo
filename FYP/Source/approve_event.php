<?php 
/* require 'C:\xampp\htdocs\FYP\db.php';

// Get event ID from POST request
$eventID = mysqli_real_escape_string($conn, $_POST["event_id"]);

// Update event status to "approved"
$sql = "UPDATE pending_events SET status = 'approved' WHERE id = '$eventID'";
$conn->query($sql);

if ($conn->error) {
  $response = array(
    "success" => false,
    "message" => "Error approving event: " . $conn->error
  );
} else {
  // Move event data to approved_events table (optional)
  // ...

  // Optionally, delete event from pending_events table
  // ...

  $response = array(
    "success" => true,
    "message" => "Event approved successfully!"
  );
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
*/










// require 'C:\xampp\htdocs\FYP\Source\db.php';

// // Get event ID and action from POST request
// $event_id = mysqli_real_escape_string($conn, $_POST["event_id"]);
// $action = mysqli_real_escape_string($conn, $_POST["action"]);

// // Handle action based on value
// switch ($action) {
//   case "approve":
//     // Update event status to "approved"
//     $sql = "UPDATE pending_events SET status = 'approved' WHERE id = '$event_id'";
//     $conn->query($sql);

//     if ($conn->error) {
//       $response = array(
//         "success" => false,
//         "message" => "Error approving event: " . $conn->error
//       );
//     } else {
//       // Move event data to approved_events table (optional)
//       // ...

//       // Optionally, delete event from pending_events table
//       // ...

//       $response = array(
//         "success" => true,
//         "message" => "Event approved successfully!"
//       );
//     }
//     break;

//   default:
//     $response = array(
//       "success" => false,
//       "message" => "Invalid action."
//     );
//     break;
// }

// header('Content-Type: application/json');
// echo json_encode($response);

// $conn->close();





require 'C:\xampp\htdocs\FYP\Source\db.php';
 
// Database connection with error handling
$conn = new mysqli('localhost', 'root', '', 'eventweb');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Retrieve event ID with validation
$event_id = isset($_GET['event_id']) && ctype_digit($_GET['event_id']) ? $_GET['event_id'] : null;
if (!$event_id) {
    die("Missing or invalid event ID");
}

// Prepared statements for security
$stmt_approve = $conn->prepare("INSERT INTO approved_events SELECT * FROM pending_events WHERE id = ?");
$stmt_delete = $conn->prepare("DELETE FROM pending_events WHERE id = ?");

// Bind parameters and execute queries within a transaction
$conn->begin_transaction();
$stmt_approve->bind_param("i", $event_id);
$stmt_delete->bind_param("i", $event_id);

if ($stmt_approve->execute() && $stmt_delete->execute()) {
    $conn->commit();
    echo "Event approved and moved successfully";
} else {
    $conn->rollback();
    echo "Error: " . $conn->error;
}

$stmt_approve->close();
$stmt_delete->close();
$conn->close();


?> 
