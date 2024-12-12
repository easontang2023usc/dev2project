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
            padding: 0 20px; /* Added padding */
        }

        section {
            min-height: auto;
            display: flex;
            align-items: center;
            padding: 40px 0; /* Reduced padding */
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
            background-color: #333;
            color: white;
            text-align: center;
            min-height: 100vh;
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

        .problem img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
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
        }

        .solution-image img {
            max-width: 100%;
            height: auto;
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
            background-color: white;
        }

        .gallery .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .gallery img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .gallery img:hover {
            transform: scale(1.05);
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

            section {
                padding: 40px 0;
                min-height: auto; /* Allow sections to be their natural height on mobile */
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .gallery .container {
                grid-template-columns: 1fr;
            }

            .gallery img {
                height: 300px;
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
        <a href="#features" class="get-started">Get Started Today!</a>
    </div>
</section>

<section id="problem" class="problem">
    <div class="container">
        <h2>Tired of a Disorganized Closet?</h2>
        <p>Struggling to find the right outfit?<br>
            Wasting time searching for specific items?<br>
            Never knowing what you actually own?</p>
        <img src="/api/placeholder/800/600" alt="Disorganized closet example" loading="lazy">
    </div>
</section>

<section id="solution" class="solution">
    <div class="container">
        <div class="solution-text">
            <h2>Meet Lookbook</h2>
            <p>Your complete digital wardrobe assistant that helps you organize, search, and style your clothes with ease. Never waste time searching through your closet again.</p>
        </div>
        <div class="solution-image">
            <img src="/api/placeholder/600/800" alt="Organized digital closet solution" loading="lazy">
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
        <?php
        $gallery_images = array(
            array("src" => "/api/placeholder/400/400", "alt" => "Organized Wardrobe Example"),
            array("src" => "/api/placeholder/400/400", "alt" => "Smart Filtering Demo"),
            array("src" => "/api/placeholder/400/400", "alt" => "Digital Closet Interface")
        );

        foreach($gallery_images as $image) {
            echo '<img src="' . htmlspecialchars($image["src"]) . '" alt="' . htmlspecialchars($image["alt"]) . '" loading="lazy">';
        }
        ?>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <p>&copy; <?php echo date("Y"); ?> Lookbook. All rights reserved.</p>
    </div>
</footer>
</body>
</html>