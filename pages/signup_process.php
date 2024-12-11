<?php
session_start();

$conn = new mysqli("webdev.iyaserver.com", "mparthas", "AcadDev_Parthasarathy_8846782870", "mparthas_wardrobe");

if ($conn->connect_error) {
    $_SESSION['error'] = "Connection failed: " . $conn->connect_error;
    header("Location: signup.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: signup.php");
        exit;
    }

    // Basic password check - just make sure they match
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: signup.php");
        exit;
    }

    // Check if username or email already exists
    $check_sql = "SELECT username, email FROM Users WHERE username = ? OR email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $row = $check_result->fetch_assoc();
        if ($row['username'] === $username) {
            $_SESSION['error'] = "Username already exists.";
        } else {
            $_SESSION['error'] = "Email already exists.";
        }
        header("Location: signup.php");
        exit;
    }

    // Insert new user with admin = 0
    $sql = "INSERT INTO Users (username, email, password, admin) VALUES (?, ?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful! Please login.";
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        header("Location: signup.php");
        exit;
    }

    $stmt->close();
}

$conn->close();
?>