<?php
require 'C:\xampp\htdocs\FYP\Source\db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];
    $user_id = 1;  // Replace with the actual user ID (e.g., from a login system)
    $query = "INSERT INTO messages (content, user_id) VALUES ('$message', $user_id)";

    if (mysqli_query($conn, $query)) {
        header("Location: message.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
