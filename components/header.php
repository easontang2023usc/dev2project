<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Temporary debugging
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    .header {
        background-color: white;
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eee;
    }

    .nav-links {
        display: flex;
        gap: 2rem;
    }

    .nav-links a {
        text-decoration: none;
        color: black;
    }
    .logo {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .logo img {
        height: 40px;  /* Adjust size as needed */
        width: auto;
    }

    .logo h2 {
        color: black;
    }
</style>

<!--<header class="header">-->
<!--    <div class="logo">-->
<!--        <h2>LOOKBOOK</h2>-->
<!--    </div>-->
<!--    <nav class="nav-links">-->
<!--        <a href="../pages/index.php">Home</a>-->
<!--        <a href="../pages/item_filter.php">Search Closet</a>-->
<!--        <a href="../pages/features.php">Features</a>-->
<!--        <a href="../pages/about-us.php">About Us</a>-->
<!--        --><?php //if(isset($_SESSION['user_id']) && $_SESSION['user_id']): ?>
<!--            <a href="../pages/logout.php">Logout (--><?php //echo htmlspecialchars($_SESSION['username'] ?? ''); ?><!--)</a>-->
<!--        --><?php //else: ?>
<!--            <a href="../pages/login.php">Login</a>-->
<!--            <a href="../pages/signup.php">Sign Up</a>-->
<!--        --><?php //endif; ?>
<!--    </nav>-->
<!--</header>-->
<header class="header">
    <div class="logo">
        <div class="logo">
            <img src="../Public/lookbook_logo.png" alt="Lookbook Logo">
        </div>
    </div>
    <nav class="nav-links">
        <a href="../pages/index.php">Home</a>
        <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                <a href="../pages/item_filter_admin.php">Search Closet</a>
            <?php else: ?>
                <a href="../pages/item_filter_user.php">Search Closet</a>
            <?php endif; ?>
            <a href="../pages/features.php">Features</a>
            <a href="../pages/about-us.php">About Us</a>
            <a href="../pages/logout.php" class="user-info">
                Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)
            </a>
        <?php else: ?>
            <a href="../pages/about-us.php">About Us</a>
            <a href="../pages/features.php">Features</a>
            <a href="../pages/login.php">Login</a>
            <a href="../pages/signup.php">Sign Up</a>
        <?php endif; ?>
    </nav>
</header>