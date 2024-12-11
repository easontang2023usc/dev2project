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
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $admin = 0;

    $sql = "INSERT INTO Users (username, email, password, admin) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $hashed_password, $admin);

    if ($stmt->execute()) {

        header("Location: index.php");
        exit;
    } else {

        if ($conn->errno === 1062) {
            echo "Username or email already exists.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}

$conn->close();
?>
