<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM universities";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $universities = array();
    while($row = $result->fetch_assoc()) {
        $universities[] = $row;
    }
    echo json_encode($universities);
} else {
    echo "0 results";
}

$conn->close();
?>
