<?php
// Define feature cards content
$features = [
    [
        'title' => 'Smart Filters',
        'description' => 'Search your closet effortlessly with advanced filters by size, brand, item type, and more to quickly find exactly what you need.'
    ],
    [
        'title' => 'Digital Upload',
        'description' => 'Upload photos of your clothing items to create a fully digital wardrobe you can browse and organize anytime.'
    ],
    [
        'title' => 'Organization',
        'description' => 'Customize your closet categories and sort items to fit your unique style and preferences, making your wardrobe more accessible.'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'ga.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lookbook - Your Digital Closet</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            text-align: center;
        }

        h1, h2 {
            margin: 2rem 0;
        }

        .feature-text {
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .highlight {
            font-weight: bold;
        }

        .closet-image {
            max-width: 600px;
            margin: 2rem auto;
            display: block;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin: 3rem 0;
        }

        .feature-card {
            padding: 1.5rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            text-align: left;
        }

        .feature-card h3 {
            margin-bottom: 1rem;
        }

        .logo-section {
            margin: 4rem 0;
            text-align: center;
        }

        .logo-section img {
            max-width: 200px;
        }

        .logo-text {
            font-style: italic;
            margin-top: 1rem;
        }

        footer {
            text-align: center;
            padding: 2rem;
            border-top: 1px solid #eee;
        }

        @media (max-width: 768px) {
            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1>Search Your Closet</h1>
    <p class="feature-text">Find exactly what you're looking for with filters by color, size, brand, item type, and more!</p>

    <section>
        <h2>The Problem</h2>
        <p class="feature-text">
            Disorganized closets make it difficult to quickly find clothing items based
            on size, color, brand, or type, leading to <span class="highlight">wasted time</span> and <span class="highlight">frustration</span>.
        </p>
    </section>

    <section>
        <h2>The Solution</h2>
        <p class="feature-text">
            The Lookbook <span class="highlight">digitally organizes</span> your wardrobe, enabling quick and easy searches.
        </p>
        <img src="../Public/image.png" alt="Digital Closet Organization" class="closet-image">
    </section>

    <div class="features-grid">
        <?php foreach($features as $feature): ?>
            <div class="feature-card">
                <h3><?php echo htmlspecialchars($feature['title']); ?></h3>
                <p><?php echo htmlspecialchars($feature['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="logo-section">
        <img src="images/logo.png" alt="Lookbook Logo">
        <p class="logo-text">Your Closet, Organized Digitally.™</p>
    </div>
</div>

<footer>
    <p>&copy; <?php echo date('Y'); ?> Lookbook. All rights reserved.</p>
</footer>
</body>
</html>