<?php
// waitlist_component.php
function renderWaitlistForm($customTitle = null, $customDescription = null) {
    // Default values if not provided
    $title = $customTitle ?? "Join Our Waitlist";
    $description = $customDescription ?? "Be the first to know when LookBook launches! Sign up now and get exclusive early access to revolutionize how you manage your wardrobe.";
    ?>
    <section class="waitlist-section">
        <h3><?php echo htmlspecialchars($title); ?></h3>
        <p><?php echo htmlspecialchars($description); ?></p>

        <?php
        // Display waitlist success or error messages
        if(isset($_SESSION['waitlist_success'])) {
            echo '<div class="waitlist-message waitlist-success">' . htmlspecialchars($_SESSION['waitlist_success']) . '</div>';
            unset($_SESSION['waitlist_success']);
        }
        if(isset($_SESSION['waitlist_error'])) {
            echo '<div class="waitlist-message waitlist-error">' . htmlspecialchars($_SESSION['waitlist_error']) . '</div>';
            unset($_SESSION['waitlist_error']);
        }
        ?>

        <form class="waitlist-form" action="../pages/waitlist_process.php" method="post">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <button type="submit" class="waitlist-btn">Get Early Access</button>
        </form>
    </section>

    <style>
        .waitlist-section {
            background-color: #f4f4f4;
            padding: 3rem 2rem;
            text-align: center;
            margin-top: 2rem;
        }

        .waitlist-section h3 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .waitlist-section p {
            color: #666;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .waitlist-form {
            display: flex;
            flex-direction: column;
            max-width: 400px;
            margin: 0 auto;
            gap: 1rem;
        }

        .waitlist-form input {
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .waitlist-btn {
            background-color: #ff69b4;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .waitlist-btn:hover {
            background-color: #f879b8;
        }

        .waitlist-message {
            margin-top: 1rem;
            padding: 0.75rem;
            border-radius: 4px;
        }

        .waitlist-success {
            background-color: #dff0d8;
            color: #64e66f;
        }

        .waitlist-error {
            background-color: #f2dede;
            color: #a94442;
        }
    </style>
    <?php
}
?>