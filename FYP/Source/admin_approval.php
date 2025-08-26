<?php
require 'C:\xampp\htdocs\FYP\Source\db.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["event_id"])) {
    $event_id = mysqli_real_escape_string($conn, $_GET["event_id"]);

    // Retrieve event details from the 'pending_events' table
    $sql = "SELECT * FROM pending_events WHERE id = '$event_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $event_data = $result->fetch_assoc();
    } else {
        echo "Event not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
    $action = $_POST["action"];

    if ($action == "approve") {
        // Handle event approval logic
        // Update event status in the database
        $sql = "UPDATE pending_events SET status = 'approved' WHERE id = '$event_id'";
        $conn->query($sql);

        if ($conn->error) {
            echo "Error updating event status: " . $conn->error;
            exit;
        }

        // Move event data to the 'approved_events' table
        $sql = "INSERT INTO approved_events (event_id,eventTitle, eventDate, eventTime, eventLocation, eventDescription, eventCategory, eventImage, eventOrganizer, eventContact)
        VALUES ($event_data['event_id],'$event_data['eventTitle']', '$event_data['eventDate']', '$event_data['eventTime']', '$event_data['eventLocation']', '$event_data['eventDescription']', '$event_data['eventCategory']', '$event_data['eventImage']', '$event_data['eventOrganizer']', '$event_data['eventContact'])";
        $conn->query($sql);

        if ($conn->error) {
            echo "Error moving event data: " . $conn->error;
            exit;
        }

        // Delete event from pending_events table (optional)
        $sql = "DELETE FROM pending_events WHERE id = '$event_id'";
        $conn->query($sql);

        // Redirect to admin dashboard or show a success message
        header("Location: admin_dashboard.php");
        exit;
    } elseif ($action == "reject") {
        // Handle event rejection logic
        // Remove the event from the 'pending_events' table
        $sql = "DELETE FROM pending_events WHERE id = '$event_id'";
        $conn->query($sql);

        if ($conn->error) {
            echo "Error deleting event: " . $conn->error;
            exit;
        }

        // Redirect to admin dashboard or show a success message
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "Invalid action.";
    }
}
?>
