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
$name = $_POST['name'];
$location = $_POST['location'];

$sql = "INSERT INTO universities (id, name, location) VALUES ('$id', '$name', '$location')";

if ($conn->query($sql) === TRUE) {
    echo "University added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
