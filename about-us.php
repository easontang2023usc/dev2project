<?php
// about-us.php

$team_members = [
    [
        'name' => 'Deniz Yamangl',
        'image' => '/api/placeholder/200/200'
    ],
    [
        'name' => 'Denise Sanchez',
        'image' => '/api/placeholder/200/200'
    ],
    [
        'name' => 'Maya Parthasarathy',
        'image' => '/api/placeholder/200/200'
    ],
    [
        'name' => 'Eason Tang',
        'image' => '/api/placeholder/200/200'
    ],
    [
        'name' => 'Giovanni Goree',
        'image' => '/api/placeholder/200/200'
    ]
];

$faqs = [
    [
        'question' => 'What is The Lookbook?',
        'answer' => 'Simply upload photos of your clothing, and The Lookbook organizes them into a digital closet. Use the app to search, filter, and plan outfits with ease.'
    ],
    [
        'question' => 'How does The Lookbook work?',
        'answer' => 'Simply upload photos of your clothing, and The Lookbook organizes them into a digital closet. Use the app to search, filter, and plan outfits with ease.'
    ],
    [
        'question' => 'Why should I use The Lookbook?',
        'answer' => 'The Lookbook saves time, reduces frustration, and helps you make the most of your wardrobe. Plus, it promotes sustainability by encouraging mindful use of the clothes you already own.'
    ],
    [
        'question' => 'Is the Lookbook free to use?',
        'answer' => 'The basic version is free, but we offer premium features for users looking to take their closet organization to the next level. Stay tuned for updates!'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - LookBook</title>
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
        }

        .section {
            margin: 4rem 0;
            text-align: center;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .story-card {
            background: #fff;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem auto;
            max-width: 800px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .mission-card {
            background: #fff;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem auto;
            max-width: 800px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 2rem;
            margin: 2rem 0;
        }

        .team-member {
            text-align: center;
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 1rem;
            object-fit: cover;
        }

        .team-member h3 {
            font-size: 1.1rem;
            margin-top: 0.5rem;
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            margin-bottom: 2rem;
            text-align: center;
        }

        .faq-question {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .faq-answer {
            color: #666;
            line-height: 1.6;
        }

        footer {
            background-color: white;
            padding: 2rem;
            text-align: center;
            border-top: 1px solid #eee;
            margin-top: 4rem;
        }

        .highlight {
            font-weight: bold;
        }

        @media (max-width: 1024px) {
            .team-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .team-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .container {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .team-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <section class="section">
        <h2 class="section-title">Our Story</h2>
        <div class="story-card">
            <p>The idea for The Lookbook came from a frustration we all know too well: <span class="highlight">digging through a disorganized closet, struggling to find the right outfit.</span></p>
            <br>
            <p>When we started talking to friends and family, we realized this was a universal problem—forgotten favorite pieces, wasted time, and constant clutter. That's when we set out to create a solution.</p>
            <br>
            <p>The <span class="highlight">Lookbook empowers you to organize, search, and rediscover</span> your clothes with smart filters for size, color, brand, and item type. It's not just about convenience - it's about sustainability and helping you make the most of what you already own. By reducing waste and simplifying your daily routine, The Lookbook transforms how you connect with your closet, so you can love your wardrobe all over again.</p>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">Our Mission</h2>
        <div class="mission-card">
            <p>We want to make fashion <span class="highlight">simple, sustainable, and accessible</span> by helping people rediscover their closets and reduce waste.</p>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">Our Team</h2>
        <div class="team-grid">
            <?php foreach($team_members as $member): ?>
                <div class="team-member">
                    <img src="<?php echo htmlspecialchars($member['image']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>">
                    <h3><?php echo htmlspecialchars($member['name']); ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">FAQs</h2>
        <div class="faq-container">
            <?php foreach($faqs as $faq): ?>
                <div class="faq-item">
                    <h3 class="faq-question"><?php echo htmlspecialchars($faq['question']); ?></h3>
                    <p class="faq-answer"><?php echo htmlspecialchars($faq['answer']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<footer>
    <div class="footer-content">
        <div class="logo">
            <h2>LOOKBOOK</h2>
            <p>"Your Closet, Organized Digitally."</p>
        </div>
        <div class="contact">
            <p>Contact Us</p>
            <p>[email here]</p>
        </div>
        <p>&copy; <?php echo date('Y'); ?> Lookbook. All rights reserved.</p>
    </div>
</footer>
</body>
</html>