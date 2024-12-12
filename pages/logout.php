<?php
session_start();
// Check if user is logged in at all
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php include '../components/ga.php'; ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Logout - LookBook</title>
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
                background-image: url('../Public/picture 1 home  new.webp');
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

            .logout-section {
                padding: 4rem 2rem;
                max-width: 600px;
                margin: 0 auto;
                background: #f9f9f9;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            .logout-section h2 {
                margin-bottom: 2rem;
                font-size: 2rem;
            }

            .button-group {
                display: flex;
                gap: 1rem;
                justify-content: center;
                margin-top: 2rem;
            }

            .btn {
                padding: 0.8rem 2rem;
                border: none;
                border-radius: 5px;
                font-size: 1.1rem;
                cursor: pointer;
                text-decoration: none;
                transition: background-color 0.3s;
            }

            .logout-btn {
                background-color: #a3c7f1;
                color: black;
            }

            .cancel-btn {
                background-color: #f1f1f1;
                color: black;
            }

            .logout-btn:hover {
                background-color: #5b7ea1;
            }

            .cancel-btn:hover {
                background-color: #e1e1e1;
            }

            footer {
                background-color: white;
                padding: 2rem;
                text-align: center;
                border-top: 1px solid #eee;
                position: fixed;
                bottom: 0;
                width: 100%;
            }
        </style>
    </head>

    <body>
    <?php include '../components/header.php'; ?>

    <section class="hero">
        <div class="hero-content">
            <h1>Logout Confirmation</h1>
            <p>We'll miss you! Come back soon to continue managing your wardrobe.</p>
        </div>
    </section>

    <section class="logout-section">
        <h2>Are you sure you want to logout?</h2>
        <div class="button-group">
            <form action="../pages/logout_process.php" method="post" style="display: inline;">
                <button type="submit" class="btn logout-btn">Yes, Logout</button>
            </form>
            <a href="index.php" class="btn cancel-btn">No, Take Me Back</a>
        </div>
    </section>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> LookBook. All rights reserved.</p>
    </footer>
    </body>
    </html>
