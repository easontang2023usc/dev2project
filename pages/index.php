<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../components/ga.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Personal Closet | Lookbook</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        html,body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        body {
            margin-top: 60px;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            padding: 0 20px;
        }

        section {
            min-height: auto;
            display: flex;
            align-items: center;
            padding: 40px 0;
            position: relative;
        }

        .hero {
            min-height: calc(100vh - 60px);
            margin-top: 0;
            background-color: #f8f9fa;
            text-align: center;
        }

        .hero h1 {
            font-size: clamp(2.5em, 5vw, 4em);
            margin-bottom: 30px;
            line-height: 1.2;
        }

        .get-started {
            background-color: #ff69b4;
            color: white;
            padding: 15px 40px;
            border-radius: 30px;
            text-decoration: none;
            display: inline-block;
            margin-top: 30px;
            font-size: 1.2em;
            transition: all 0.3s ease;
        }

        .get-started:hover {
            transform: translateY(-3px);
            background-color: #ff45a0;
        }

        .problem {
            background-image: url('../Public/picture 2 home.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            text-align: center;
            min-height: 100vh;
            position: relative;
        }

        .problem::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .problem .container {
            position: relative;
            z-index: 2;
        }

        .problem h2 {
            font-size: clamp(2em, 4vw, 3em);
            margin-bottom: 40px;
        }

        .problem p {
            font-size: clamp(1.1em, 2vw, 1.5em);
            line-height: 1.8;
            margin-bottom: 40px;
        }

        .solution {
            background-color: white;
            padding: 80px 0;
            min-height: 100vh;
        }

        .solution .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
        }

        .solution-text {
            flex: 1;
        }

        .solution-text h2 {
            font-size: clamp(2em, 4vw, 3em);
            margin-bottom: 30px;
        }

        .solution-text p {
            font-size: clamp(1.1em, 2vw, 1.5em);
            line-height: 1.6;
        }

        .solution-image {
            flex: 1;
            height: 600px;
        }

        .solution-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .features {
            background-color: #f9f9f9;
            padding: 80px 0;
        }

        .features h2 {
            font-size: clamp(2em, 4vw, 3em);
            margin-bottom: 60px;
            text-align: center;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .feature-card {
            padding: 40px;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-card h3 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #333;
        }

        .feature-card p {
            font-size: 1.2em;
            line-height: 1.6;
            color: #666;
        }

        .gallery {
            padding: 80px 0;
            background-image: url('../Public/picture 4 home.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            position: relative;
        }

        .gallery::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .gallery .container {
            position: relative;
            z-index: 2;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .footer p {
            font-size: 1.2em;
        }

        @media (max-width: 768px) {
            .solution .container {
                flex-direction: column;
                text-align: center;
            }

            .solution-text {
                padding-right: 0;
            }

            .solution-image {
                height: 400px;
            }

            section {
                padding: 40px 0;
                min-height: auto;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<div class="site-header">
    <?php include '../components/header.php'; ?>
</div>

<section class="hero">
    <div class="container">
        <h1>Your Personal<br>Digital Closet</h1>
        <p>Organize your wardrobe smarter, dress better</p>
        <a href="signup.php" class="get-started">Get Started Today!</a>
    </div>
</section>

<section id="problem" class="problem">
    <div class="container">
        <h2>Tired of a Disorganized Closet?</h2>
        <p>Struggling to find the right outfit?<br>
            Wasting time searching for specific items?<br>
            Never knowing what you actually own?</p>
    </div>
</section>

<section id="solution" class="solution">
    <div class="container">
        <div class="solution-text">
            <h2>Meet Lookbook</h2>
            <p>Your complete digital wardrobe assistant that helps you organize, search, and style your clothes with ease. Never waste time searching through your closet again.</p>
        </div>
        <div class="solution-image">
            <img src="../Public/picture 3 home.png" alt="Organized digital closet solution" loading="lazy">
        </div>
    </div>
</section>

<section id="features" class="features">
    <div class="container">
        <h2>Smart Features for Your Wardrobe</h2>
        <div class="features-grid">
            <div class="feature-card">
                <h3>Smart Filters</h3>
                <p>Find exactly what you're looking for with powerful search filters based on color, style, season, and occasion.</p>
            </div>
            <div class="feature-card">
                <h3>Digital Upload</h3>
                <p>Easily photograph and catalog your entire wardrobe with our intuitive digital upload system.</p>
            </div>
            <div class="feature-card">
                <h3>Custom Organization</h3>
                <p>Create personalized categories and tags that match your unique style and organization preferences.</p>
            </div>
        </div>
    </div>
</section>

<section id="gallery" class="gallery">
    <div class="container">
        <!-- Empty container for background image -->
    </div>
</section>

<footer class="footer">
    <div class="container">
        <p>&copy; <?php echo date("Y"); ?> Lookbook. All rights reserved.</p>
    </div>
</footer>
</body>
</html>