<?php
// features.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../components/ga.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features - LookBook</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .hero {
            position: relative;
            height: 60vh;
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)),
            url('../Public/Background Image.png');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            padding: 2rem;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .get-started-btn {
            background-color: #FFD700;
            color: black;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            margin-top: 1rem;
        }

        .features-section {
            padding: 4rem 2rem;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 4rem;
            margin-bottom: 4rem;
            max-width: 1200px;
            margin: 4rem auto;
        }

        .feature:nth-child(even) {
            flex-direction: row-reverse;
        }

        .feature-content {
            flex: 1;
        }

        .feature-image {
            flex: 1;
            height: 400px;
            background-color: #f5f5f5;
            background-size: cover;
            background-position: center;
        }

        .feature h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .feature p {
            line-height: 1.6;
            color: #666;
        }

        footer {
            background-color: white;
            padding: 2rem;
            text-align: center;
            border-top: 1px solid #eee;
        }

        @media (max-width: 768px) {
            .feature {
                flex-direction: column !important;
                gap: 2rem;
            }

            .feature-image {
                width: 100%;
                height: 300px;
            }
        }
    </style>
</head>
<body>
<?php include '../components/header.php'; ?>


<section class="hero">
    <div class="hero-content">
        <h1>Unlock Your Wardrobe's Potential</h1>
        <p>We manage your wardrobe so you won't have to outfit in</p>
        <button class="get-started-btn">Get started</button>
    </div>
</section>

<section class="features-section">
    <?php
    $features = [
        [
            'title' => 'Sort & Filter',
            'description' => 'Effortlessly navigate your wardrobe with our sort and filter tools. Find exactly what you need by filtering items by type, color, size, occasion, or custom tags. Our intuitive interface lets you sort visually, making it easy to spot your favorite items or discover hidden gems. With advanced search and quick actions, managing your wardrobe has never been this efficient.',
            'image' => 'Public/Image 2.png'
        ],
        [
            'title' => 'Manage',
            'description' => 'Take control of your wardrobe with a streamlined digital catalog. Easily upload images, add details like size, color, and occasion, and track outfit combinations or wear history. Keep tabs on your items\' condition, lifecycle, and even get reminders for neglected pieces. Whether you\'re updating your inventory or planning your next outfit, our tools help you stay organized and intentional about your fashion choices.',
            'image' => 'Public/Image 3.png'
        ],
        [
            'title' => 'Recommend',
            'description' => 'Maximize your wardrobe\'s potential with personalized recommendations tailored to your lifestyle. Discover outfit combinations for various occasions, from casual outings to formal events, and get tips on how to make the most of your existing wardrobe. Identify gaps in your collection and receive suggestions for seasonal updates to create a versatile and functional wardrobe.',
            'image' => 'Public/Image 4.png'
        ]
    ];

    foreach($features as $feature): ?>
        <div class="feature">
            <div class="feature-content">
                <h2><?php echo htmlspecialchars($feature['title']); ?></h2>
                <p><?php echo htmlspecialchars($feature['description']); ?></p>
            </div>
            <div class="feature-image" style="background-image: url('<?php echo $feature['image']; ?>')"></div>
        </div>
    <?php endforeach; ?>
</section>

<footer>
    <p>&copy; <?php echo date('Y'); ?> LookBook. All rights reserved.</p>
</footer>
</body>
</html>