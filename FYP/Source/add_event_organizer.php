<?php
// Include database connection
require_once('C:\xampp\htdocs\FYP\Source\db.php');

// Initialize error messages
$usernameError = "";
$emailError = "";
$passwordError = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty($_POST["username"])) {
        $usernameError = "Username is required";
    } else {
        // Check if username already exists
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_POST["username"]);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $usernameError = "Username already exists";
        }
    }

    // Validate email
    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format";
    } else {
        // Check if email already exists
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_POST["email"]);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $emailError = "Email already exists";
        }
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordError = "Password is required";
    } else if (strlen($_POST["password"]) < 8) {
        $passwordError = "Password must be at least 8 characters long";
    }

    // No errors, proceed with registration
    if (empty($usernameError) && empty($emailError) && empty($passwordError)) {
        // Hash the password
        $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Insert user data into database
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'organizer')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $_POST["username"], $_POST["email"], $hashedPassword);

        if ($stmt->execute()) {
            // Registration successful
            echo"Organizer Added Successfully";
            header("Location: /add_event_organizer.php");
            exit;
        } else {
            // Error during registration
            $error = "Error registering Organizer: " . $conn->error;
        }
    }
}
// Close database connection
$conn->close();
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event Organizer</title>
    <link rel="stylesheet" href="style.css">
</head>
<header>
        <h1>Organizer Management</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.html">Back to Dashboard</a></li>
            </ul>
        </nav>
    </header>
<body>
    <h2>Add Event Organizer</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required value="<?php echo isset($_POST["username"]) ? htmlspecialchars($_POST["username"]) : ""; ?>">
        <span style="color:red;"><?php echo $usernameError; ?></span><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required value="<?php echo isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : ""; ?>">
        <span style="color:red;"><?php echo $emailError; ?></span><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <span style="color:red;"><?php echo $passwordError; ?></span><br>
        <button type="submit">Add Event Organizer</button>
    </form>
</body>
</html> -->
