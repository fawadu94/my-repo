<?php
// subscribe_newsletter.php
$conn = new mysqli('localhost', 'root', '', 'eventweb');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);

    // Check if email already exists
    $check = $conn->query("SELECT * FROM newsletter_subscribers WHERE email = '$email'");
    if($check->num_rows == 0){
        $sql = "INSERT INTO newsletter_subscribers (email) VALUES ('$email')";
        if ($conn->query($sql) === TRUE) {
            echo "Subscribed successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "You are already subscribed.";
    }
}
$conn->close();
?>
