<?php
// Start PHP session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <style>
        :root {
            --primary-color: #a3c7f1;
            --secondary-color: #5b7ea1;
            --text-dark: #333;
            --background-light: #f9f9fc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', Arial, sans-serif;
        }

        .header {
            background-color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo img {
            height: 50px;
            width: auto;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a,
        .btn {
            text-decoration: none;
            color: var(--text-dark);
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover,
        .btn:hover {
            background-color: #ff69b4;
            color: white;
        }

        .btn {
            background-color: #ff69b4;
            color: white;
            font-weight: 600;
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid #ff69b4;
            color: #ff69b4;
        }

        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                background-color: white;
                position: absolute;
                top: 100%;
                right: 0;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
            }

            .nav-links.active {
                display: flex;
            }

            .menu-toggle {
                display: block;
                cursor: pointer;
            }
        }

        .menu-toggle {
            display: none;
        }

        .menu-toggle span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: var(--text-dark);
            margin: 5px 0;
        }
    </style>
</head>
<body>
<header class="header">
    <div class="logo">
        <img src="../Public/lookbook_logo.png" alt="Lookbook Wardrobe Organization">
    </div>
    <nav class="nav-links">
        <a href="../pages/index.php">Home</a>
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <a href="../pages/item_filter_<?php echo $_SESSION['admin'] == 1 ? 'admin' : 'user'; ?>.php">Search Closet</a>
            <a href="../pages/recommend.php">Recommend</a>
            <a href="../pages/features.php">Features</a>
            <a href="../pages/about-us.php">About Us</a>
            <a href="../pages/logout.php" class="btn-outline">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
        <?php else: ?>
            <a href="../pages/about-us.php">About Us</a>
            <a href="../pages/features.php">Features</a>
            <a href="../pages/login.php" class="btn">Login</a>
            <a href="../pages/signup.php" class="btn-outline">Sign Up</a>
        <?php endif; ?>
    </nav>
    <div class="menu-toggle" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
    </div>
</header>

<script>
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.classList.toggle('active');
    }
</script>
</body>
</html>
