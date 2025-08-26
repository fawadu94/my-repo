<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_GET["action"];

    if ($action === "add") {
        $data = json_decode(file_get_contents("php://input"), true);
        $id= $data["id"];
        $name = $data["name"];
        $location = $data["location"];

        $sql = "INSERT INTO universities (id,name, location) VALUES ('$id',$name', '$location')";
        if ($conn->query($sql) === TRUE) {
            $response = array("status" => "success", "message" => "University added successfully.");
        } else {
            $response = array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error);
        }
    } elseif ($action === "delete") {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data["id"];

        $sql = "DELETE FROM universities WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            $response = array("status" => "success", "message" => "University deleted successfully.");
        } else {
            $response = array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error);
        }
    }

    header("Content-Type: application/json");
    echo json_encode($response);
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT id, name, location FROM universities";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $universities = array();
        while ($row = $result->fetch_assoc()) {
            $universities[] = $row;
        }
        $response = array("status" => "success", "universities" => $universities);
    } else {
        $response = array("status" => "success", "universities" => array());
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}

$conn->close();
?> 

