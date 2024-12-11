<?php
session_start();
require_once '../components/authentication.php';

// Initialize database connection
$conn = new mysqli("webdev.iyaserver.com", "mparthas", "AcadDev_Parthasarathy_8846782870", "mparthas_wardrobe");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: login.php");
        exit();
    }

    $sql = "SELECT user_id, username, password,admin FROM Users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if ($password === $user['password']) { // Temporary direct comparison
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_in'] = true;
            $_SESSION['admin'] = $user['admin'];  // Add this line

            // For debugging, print after setting session
            error_log('Session variables set: ' . print_r($_SESSION, true));

            header("Location: item_filter_admin.php");  // Make sure this path is correct
            exit();
        }
    }

    $_SESSION['error'] = "Invalid username or password.";
    header("Location: login.php");
    exit();
}

$conn->close();
?>