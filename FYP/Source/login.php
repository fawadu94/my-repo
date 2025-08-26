<?php
require 'C:\xampp\htdocs\FYP\Source\db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login success
        echo "Login successful";
        
        // Fetch user data
        $user = $result->fetch_assoc();
        $email = $user['email']; // Assuming 'email' is the column name in your 'users' table

        // Redirect based on email content
        if (strpos($email, 'organizer') !== false) {
            header("Location: organizer_dashboard.html");
        } else if (strpos($email, 'admin') !== false) {
            header("Location: admin_dashboard.html");
        } else {
            header("Location: dashboard.html");
        }
        exit();
    } else {
        // Login failed
        echo "Invalid username or password";
    }

    $conn->close();
}
?>
