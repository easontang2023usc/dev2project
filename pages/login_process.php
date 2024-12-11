<?php
session_start();

$servername = "webdev.iyaserver.com";
$username = "mparthas";
$password = "AcadDev_Parthasarathy_8846782870";
$dbname = "mparthas_wardrobe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Basic validation
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: login.php");
        exit;
    }

    // Prepare SQL statement to prevent SQL injection
    $sql = "SELECT user_id, username, password FROM Users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to index page after successful login
            header("Location: index.php");
            exit;
        } else {
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: login.php");
        exit;
    }

    $stmt->close();
}

$conn->close();
?>
