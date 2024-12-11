<?php
session_start();
// Redirect if already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../components/ga.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - LookBook</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .hero {
            position: relative;
            height: 50vh;
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)),
            url('/api/placeholder/1200/800');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .hero-content {
            max-width: 600px;
            padding: 2rem;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .signup-section {
            padding: 4rem 2rem;
            max-width: 600px;
            margin: 0 auto;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .signup-section h2 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2rem;
        }

        .signup-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .signup-form input {
            padding: 1rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        .signup-form input:focus {
            border-color: rgba(182, 221, 246, 0.49);
            box-shadow: 0 0 5px rgba(145, 206, 245, 0.49);
        }

        .signup-btn {
            background-color: #a3c7f1;
            color: black;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            margin-top: 1rem;
        }

        .signup-btn:hover {
            background-color: #5b7ea1;
        }

        footer {
            background-color: white;
            padding: 2rem;
            text-align: center;
            border-top: 1px solid #eee;
        }

        .error-message {
            color: #dc3545;
            text-align: center;
            margin-bottom: 1rem;
            padding: 0.5rem;
            border-radius: 4px;
        }

        .success-message {
            color: #28a745;
            text-align: center;
            margin-bottom: 1rem;
            padding: 0.5rem;
            border-radius: 4px;
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
        }

        .password-requirements {
            font-size: 0.9rem;
            color: #666;
            margin-top: -1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
<?php include '../components/header.php'; ?>

<section class="hero">
    <div class="hero-content">
        <h1>Join LookBook Today</h1>
        <p>Create an account to unlock all features and manage your wardrobe effortlessly.</p>
    </div>
</section>

<section class="signup-section">
    <h2>Sign Up</h2>
    <?php
    if(isset($_SESSION['error'])) {
        echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['success'])) {
        echo '<div class="success-message">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    ?>
    <form class="signup-form" action="signupprocess.php" method="post">
        <input type="text" name="username" placeholder="Username" required
               pattern="[a-zA-Z0-9_]{3,20}"
               title="Username must be between 3-20 characters and can only contain letters, numbers, and underscores">

        <input type="email" name="email" placeholder="Email Address" required>

        <input type="password" name="password" placeholder="Password" required
               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
               title="Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number">

        <input type="password" name="confirm_password" placeholder="Confirm Password" required>

        <div class="password-requirements">
            Password must be at least 8 characters long and include:
            <ul>
                <li>At least one uppercase letter</li>
                <li>At least one lowercase letter</li>
                <li>At least one number</li>
            </ul>
        </div>

        <button type="submit" class="signup-btn">Sign Up</button>
    </form>
    <div class="login-link">
        Already have an account? <a href="login.php">Login here</a>
    </div>
</section>

<footer>
    <p>&copy; <?php echo date('Y'); ?> LookBook. All rights reserved.</p>
</footer>
</body>
</html>

<?php
session_start();

$servername = "webdev.iyaserver.com";
$username = "mparthas";
$password = "AcadDev_Parthasarathy_8846782870";
$dbname = "mparthas_wardrobe";

$conn = new mysqli($servername, $username, $password, $dbname);

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

    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: signup.php");
        exit;
    }

    // Username validation
    if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        $_SESSION['error'] = "Username must be between 3-20 characters and can only contain letters, numbers, and underscores.";
        header("Location: signup.php");
        exit;
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: signup.php");
        exit;
    }

    // Password validation
    if (strlen($password) < 8) {
        $_SESSION['error'] = "Password must be at least 8 characters long.";
        header("Location: signup.php");
        exit;
    }

    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
        $_SESSION['error'] = "Password must include at least one uppercase letter, one lowercase letter, and one number.";
        header("Location: signup.php");
        exit;
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: signup.php");
        exit;
    }

    // Check if username or email already exists
    $check_sql = "SELECT username, email FROM Website_users WHERE username = ? OR email = ?";
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

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $sql = "INSERT INTO Website_users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);

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