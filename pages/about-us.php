<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$team_members = [
    [
        'name' => 'Deniz Yamangl',
        'image' => '../Public/denizpic.jpg',
    ],
    [
        'name' => 'Denise Sanchez',
        'image' => '../Public/denisepic.jpg',

    ],
    [
        'name' => 'Maya Parthasarathy',
        'image' => '../Public/mayapic.png',

    ],
    [
        'name' => 'Eason Tang',
        'image' => '../Public/easonpic.jpeg',

    ],
    [
        'name' => 'Giovanni Goree',
        'image' => '../Public/giopic.jpg',

    ]
];

$faqs = [
    [
        'question' => 'What is The Lookbook?',
        'answer' => 'Simply upload photos of your clothing, and The Lookbook organizes them into a digital closet. Use the app to search, filter, and plan outfits with ease.'
    ],
    [
        'question' => 'How does The Lookbook work?',
        'answer' => 'Our intelligent system uses computer vision to categorize your clothes by type, color, brand, and more. Upload a photo, and we do the rest - creating a searchable, visual inventory of your wardrobe.'
    ],
    [
        'question' => 'Why should I use The Lookbook?',
        'answer' => 'The Lookbook saves time, reduces frustration, and helps you make the most of your wardrobe. By providing smart organization and outfit planning, we promote sustainability and help you rediscover clothes you already own.'
    ],
    [
        'question' => 'Is the Lookbook free to use?',
        'answer' => 'The basic version is free, offering core closet organization features. Premium plans with advanced analytics and styling recommendations are coming soon!'
    ]
];

// Include the waitlist component
include '../components/waitlist_component.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../components/ga.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - LookBook</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #a3c7f1;
            --secondary-color: #5b7ea1;
            --text-dark: #333;
            --text-light: #666;
            --background-light: #f9f9fc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', Arial, sans-serif;
        }

        body {
            background-color: var(--background-light);
            color: var(--text-dark);
            line-height: 1.6;
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
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: var(--text-dark);
            font-weight: 700;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 4px;
            background-color: var(--primary-color);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .content-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            border-radius: 15px;
            padding: 3rem;
            margin: 2rem auto;
            max-width: 1100px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
            gap: 2rem;
        }

        .content-text {
            flex: 1;
            text-align: left;
        }

        .content-image {
            flex: 1;
            overflow: hidden;
            border-radius: 15px;
        }

        .content-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .content-section:hover .content-image img {
            transform: scale(1.1);
        }

        .highlight {
            color: var(--secondary-color);
            font-weight: 600;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 2rem;
            margin: 2rem 0;
        }

        .team-member {
            text-align: center;
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 1rem;
            object-fit: cover;
            border: 4px solid var(--primary-color);
        }

        .team-member h3 {
            font-size: 1rem;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .team-member p {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .team-member .member-bio {
            margin-top: 0.5rem;
            font-size: 0.75rem;
            color: var(--text-light);
        }

        .faq-accordion {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: white;
            border-radius: 10px;
            margin-bottom: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .faq-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .faq-header:hover {
            background-color: rgba(163, 199, 241, 0.1);
        }

        .faq-question {
            font-weight: 600;
            color: var(--text-dark);
        }

        .faq-toggle {
            color: var(--secondary-color);
            transition: transform 0.3s ease;
        }

        .faq-content {
            display: none;
            padding: 1rem 1.5rem;
            color: var(--text-light);
        }

        .faq-item.active .faq-content {
            display: block;
        }

        .faq-item.active .faq-toggle {
            transform: rotate(180deg);
        }

        @media (max-width: 1024px) {
            .content-section {
                flex-direction: column;
                text-align: center;
            }

            .content-text, .content-image {
                width: 100%;
            }

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
<?php include '../components/header.php'; ?>

<div class="container">
    <section class="section">
        <h2 class="section-title">Our Story</h2>
        <div class="content-section">
            <div class="content-text">
                <p>The idea for The Lookbook came from a frustration we all know too well: <span class="highlight">digging through a disorganized closet, struggling to find the right outfit.</span></p>
                <br>
                <p>When we started talking to friends and family, we realized this was a universal problem—forgotten favorite pieces, wasted time, and constant clutter. That's when we set out to create a solution!</p>
                <br>
                <p>The <span class="highlight">Lookbook empowers you to organize, search, and rediscover</span> your clothes with smart filters for size, color, brand, and item type. It's not just about convenience - it's about sustainability and helping you make the most of what you already own.</p>
            </div>
            <div class="content-image">
                <img src="../Public/lookbook.png" alt="Lookbook Wardrobe Organization">
            </div>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">Our Mission</h2>
        <div class="content-section">
            <div class="content-image">
                <img src="../Public/sustain.jpg" alt="Sustainability Mission">
            </div>
            <div class="content-text">
                <p>We want to make fashion <span class="highlight">simple, sustainable, and accessible</span> by helping people rediscover their closets and reduce waste.</p>
                <br>
                <p>Our goal is to transform how people interact with their wardrobes. By providing intelligent organization tools, we're not just creating an app - we're building a movement towards more mindful, sustainable fashion consumption.</p>
            </div>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">Our Team</h2>
        <div class="team-grid">
            <?php foreach($team_members as $member): ?>
                <div class="team-member">
                    <img src="<?php echo htmlspecialchars($member['image']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>">
                    <h3><?php echo htmlspecialchars($member['name']); ?></h3>
                    <p><?php echo htmlspecialchars($member['role']); ?></p>
                    <p class="member-bio"><?php echo htmlspecialchars($member['bio']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">FAQs</h2>
        <div class="faq-accordion">
            <?php foreach($faqs as $index => $faq): ?>
                <div class="faq-item" data-index="<?php echo $index; ?>">
                    <div class="faq-header">
                        <h3 class="faq-question"><?php echo htmlspecialchars($faq['question']); ?></h3>
                        <i class="fas fa-chevron-down faq-toggle"></i>
                    </div>
                    <div class="faq-content">
                        <p><?php echo htmlspecialchars($faq['answer']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<?php renderWaitlistForm(); ?>

<?php include '../components/footer.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            item.querySelector('.faq-header').addEventListener('click', function() {
                // Toggle active class on clicked item
                item.classList.toggle('active');

                // Close other open items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });
            });
        });
    });
</script>
</body>
</html>