<?php
// header.php
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
</style>

<header class="header">
    <div class="logo">
        <h2>LOOKBOOK</h2>
    </div>
    <nav class="nav-links">
        <a href="index.php">Home</a>
        <a href="test.php">Test</a>
        <a href="features.php">Features</a>
        <a href="about-us.php">About Us</a>
        <a href="signup.php">Sign Up</a>
    </nav>
</header>