<?php
// Include this in the message.php file to display messages
require 'C:\xampp\htdocs\FYP\Source\db.php';

// Fetch messages from the database
$query = "SELECT * FROM messages ORDER BY timestamp DESC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p>{$row['content']}</p>";
        echo "<p>Posted at: {$row['timestamp']}</p>";
        echo "<hr>";
    }
} else {
    echo "<p>No messages yet.</p>";
}
mysqli_close($conn);
?>
