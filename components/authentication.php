<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<?php
// login.php
session_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - LookBook</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, sans-serif;
            }

            .login-section {
                padding: 4rem 2rem;
                max-width: 600px;
                margin: 4rem auto;
                background: #f9f9f9;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .login-section h2 {
                text-align: center;
                margin-bottom: 2rem;
                font-size: 2rem;
            }

            .login-form {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            .login-form input {
                padding: 1rem;
                font-size: 1rem;
                border: 1px solid #ddd;
                border-radius: 5px;
                outline: none;
            }

            .login-btn {
                background-color: #a3c7f1;
                color: black;
                padding: 0.8rem 2rem;
                border: none;
                border-radius: 5px;
                font-size: 1.1rem;
                cursor: pointer;
                margin-top: 1rem;
            }

            .signup-link {
                text-align: center;
                margin-top: 1rem;
            }
        </style>
    </head>
    <body>
    <?php include '../components/header.php'; ?>

    <section class="login-section">
        <h2>Login</h2>
        <form class="login-form" action="loginprocess.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <p class="signup-link">
            Don't have an account? <a href="signup.php">Sign up here</a>
        </p>
    </section>
    </body>
    </html>

<?php
// loginprocess.php
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

    if (empty($username) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    $sql = "SELECT user_id, username, password FROM Users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            header("Location: test.php");
            exit;
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<?php
// logout.php
session_start();
session_destroy();
header("Location: login.php");
exit;
?>