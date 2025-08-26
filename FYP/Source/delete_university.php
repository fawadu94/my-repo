<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];

$sql = "DELETE FROM universities WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "University deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
