<?php
// signup.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
    </style>
</head>
<?php include 'ga.php'; ?>

<body>
<?php include 'header.php'; ?>

<section class="hero">
    <div class="hero-content">
        <h1>Join LookBook Today</h1>
        <p>Create an account to unlock all features and manage your wardrobe effortlessly.</p>
    </div>
</section>

<section class="signup-section">
    <h2>Sign Up</h2>
    <form class="signup-form" action="../signupprocess.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit" class="signup-btn">Sign Up</button>
    </form>
</section>

<footer>
    <p>&copy; <?php echo date('Y'); ?> LookBook. All rights reserved.</p>
</footer>
</body>
</html>
