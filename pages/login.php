<?php
// pages/login.php
session_start();
require_once '../components/authentication.php';

// Redirect if already logged in
if(isLoggedIn()) {
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
        <title>Login - LookBook</title>
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

            .login-section {
                padding: 4rem 2rem;
                max-width: 600px;
                margin: 0 auto;
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

            .login-form input:focus {
                border-color: rgba(182, 221, 246, 0.49);
                box-shadow: 0 0 5px rgba(145, 206, 245, 0.49);
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

            .login-btn:hover {
                background-color: #5b7ea1;
            }

            .signup-redirect {
                text-align: center;
                margin-top: 1.5rem;
            }

            .error-message {
                color: red;
                text-align: center;
                margin-bottom: 1rem;
            }

            footer {
                background-color: white;
                padding: 2rem;
                text-align: center;
                border-top: 1px solid #eee;
            }
        </style>
    </head>
    <body>
    <?php include '../components/header.php'; ?>

    <section class="hero">
        <div class="hero-content">
            <h1>Welcome Back!</h1>
            <p>Login to access your wardrobe and continue managing your outfits.</p>
        </div>
    </section>

    <section class="login-section">
        <h2>Login</h2>
        <?php
        if(isset($_SESSION['error'])) {
            echo '<p class="error-message">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <form class="login-form" action="../pages/login_process.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <div class="signup-redirect">
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </section>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> LookBook. All rights reserved.</p>
    </footer>
    </body>
    </html>