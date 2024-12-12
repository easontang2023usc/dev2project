<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("webdev.iyaserver.com", "mparthas", "AcadDev_Parthasarathy_8846782870", "mparthas_wardrobe");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select a random item
$sql = "SELECT 
    ci.item_id,
    ci.item_name,
    ci.images,
    ci.acquired_dt,
    s.size_name,
    c.color_name,
    b.brand_name,
    it.item_type_name
FROM Clothing_Items ci
LEFT JOIN Sizes s ON ci.size_id = s.size_id
LEFT JOIN Colors c ON ci.color_id = c.color_id
LEFT JOIN Brands b ON ci.brand_id = b.brand_id
LEFT JOIN Item_Types it ON ci.item_type_id = it.item_type_id
ORDER BY RAND()
LIMIT 1";

$result = $conn->query($sql);
$item = $result->fetch_assoc();
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Outfit Recommender</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 1000px;
                margin: 0 auto;
                padding: 20px;
                line-height: 1.6;
                text-align: center;
            }
            .recommendation-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 20px;
                margin-top: 30px;
            }
            .item-image {
                max-width: 400px;
                max-height: 500px;
                object-fit: contain;
            }
            .item-details {
                background-color: #f5f5f5;
                padding: 20px;
                border-radius: 8px;
                max-width: 400px;
                margin: 0 auto;
            }
            .item-details p {
                margin: 10px 0;
                border-bottom: 1px solid #ddd;
                padding-bottom: 5px;
            }
            .button-container {
                margin: 20px 0;
            }
            .button {
                display: inline-block;
                padding: 12px 24px;
                background-color: #4CAF50;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                border: none;
                cursor: pointer;
                font-size: 16px;
                margin: 0 10px;
            }
            .button:hover {
                background-color: #45a049;
            }
            h1 {
                color: #333;
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <h1>Random Outfit Recommender</h1>
    <div class="recommendation-container">
        <?php if ($item): ?>
            <?php if (isset($item['images'])): ?>
                <img src="<?php echo htmlspecialchars($item['images']); ?>"
                     alt="<?php echo htmlspecialchars($item['item_name']); ?>"
                     class="item-image">
            <?php endif; ?>

            <div class="item-details">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($item['item_name']); ?></p>
                <p><strong>Size:</strong> <?php echo htmlspecialchars($item['size_name']); ?></p>
                <p><strong>Color:</strong> <?php echo htmlspecialchars($item['color_name']); ?></p>
                <p><strong>Brand:</strong> <?php echo htmlspecialchars($item['brand_name']); ?></p>
                <p><strong>Type:</strong> <?php echo htmlspecialchars($item['item_type_name']); ?></p>
            </div>
        <?php else: ?>
            <p>No items found in the wardrobe.</p>
        <?php endif; ?>

        <div class="button-container">
            <a href="recommend.php" class="button">Get Another Recommendation</a>
            <a href="../pages/item_filter_admin.php" class="button">Back to Results</a>
        </div>
    </div>
    </body>
    </html>

<?php
$conn->close();
?>