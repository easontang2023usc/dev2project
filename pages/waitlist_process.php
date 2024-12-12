<?php
session_start();

$conn = new mysqli("webdev.iyaserver.com", "mparthas", "AcadDev_Parthasarathy_8846782870", "mparthas_wardrobe");

if ($conn->connect_error) {
    $_SESSION['waitlist_error'] = "Connection failed: " . $conn->connect_error;
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    // Basic validation
    if (empty($name) || empty($email)) {
        $_SESSION['waitlist_error'] = "Name and email are required.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['waitlist_error'] = "Invalid email format.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Check if email already exists in Waitlist
    $check_sql = "SELECT email FROM Waitlist WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $_SESSION['waitlist_error'] = "This email is already on our waitlist.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Insert into Waitlist
    $sql = "INSERT INTO Waitlist (name, email) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $email);

    if ($stmt->execute()) {
        // Optional: Send confirmation email
        sendWaitlistConfirmationEmail($name, $email);

        $_SESSION['waitlist_success'] = "You've been added to our waitlist! We'll notify you soon.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        $_SESSION['waitlist_error'] = "Error adding to waitlist: " . $stmt->error;
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $stmt->close();
}

$conn->close();

function sendWaitlistConfirmationEmail($name, $email) {
    $to = $email;
    $subject = "LookBook Waitlist Confirmation";
    $message = "
    <html>
    <body>
        <h2>Welcome to LookBook Waitlist, {$name}!</h2>
        <p>Thank you for your interest in LookBook. We'll notify you as soon as early access becomes available.</p>
        <p>Stay tuned!</p>
        <br>
        <small>If you did not sign up for our waitlist, please ignore this email.</small>
    </body>
    </html>
    ";

    // To send HTML mail, the Content-type header must be set
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: noreply@lookbook.com" . "\r\n";

    // Attempt to send email
    mail($to, $subject, $message, $headers);
}
?>