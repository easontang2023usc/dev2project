<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - LookBook</title>
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
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
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

        .welcome-section {
            padding: 4rem 2rem;
            max-width: 800px;
            margin: 0 auto;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .welcome-section h2 {
            margin-bottom: 1.5rem;
            font-size: 2.5rem;
        }

        .welcome-section p {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .dashboard-link {
            text-decoration: none;
            color: white;
            background-color: #a3c7f1;
            padding: 0.8rem 2rem;
            border-radius: 5px;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        .dashboard-link:hover {
            background-color: #5b7ea1;
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
<?php include 'header.php'; ?>

<section class="hero">
    <div class="hero-content">
        <h1>Welcome to LookBook!</h1>
        <p>Your wardrobe management journey begins here.</p>
    </div>
</section>

<section class="welcome-section">
    <h2>Hello, Welcome!</h2>
    <p>Thank you for signing up. You can now explore our features to manage your wardrobe effortlessly.</p>
</section>

<footer>
    <p>&copy; <?php echo date('Y'); ?> LookBook. All rights reserved.</p>
</footer>
</body>
</html>
