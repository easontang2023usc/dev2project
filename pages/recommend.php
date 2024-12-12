<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("webdev.iyaserver.com", "mparthas", "AcadDev_Parthasarathy_8846782870", "mparthas_wardrobe");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query for top (shirt, dress, jacket)
$sql_top = "SELECT 
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
WHERE it.item_type_name IN ('Shirt', 'Dress', 'Jacket')
ORDER BY RAND()
LIMIT 1";

// Query for bottom (pant, jean, shorts)
$sql_bottom = "SELECT 
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
WHERE it.item_type_name IN ('Pant', 'Jean', 'Shorts')
ORDER BY RAND()
LIMIT 1";

// Query for shoes
$sql_shoes = "SELECT 
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
WHERE it.item_type_name = 'Shoes'
ORDER BY RAND()
LIMIT 1";

$result_top = $conn->query($sql_top);
$result_bottom = $conn->query($sql_bottom);
$result_shoes = $conn->query($sql_shoes);

$top = $result_top->fetch_assoc();
$bottom = $result_bottom->fetch_assoc();
$shoes = $result_shoes->fetch_assoc();
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Complete Outfit Recommender</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
                line-height: 1.6;
                text-align: center;
            }
            .outfit-container {
                display: flex;
                justify-content: center;
                gap: 30px;
                flex-wrap: wrap;
                margin-top: 30px;
            }
            .item-card {
                flex: 1;
                min-width: 300px;
                max-width: 350px;
                background-color: #f5f5f5;
                border-radius: 8px;
                padding: 20px;
                margin-bottom: 20px;
            }
            .item-image {
                width: 100%;
                height: 300px;
                object-fit: contain;
                margin-bottom: 15px;
            }
            .item-details p {
                margin: 10px 0;
                border-bottom: 1px solid #ddd;
                padding-bottom: 5px;
                text-align: left;
            }
            .button-container {
                margin: 30px 0;
            }
            .button {
                display: inline-block;
                padding: 12px 24px;
                background-color: #ff69b4;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                border: none;
                cursor: pointer;
                font-size: 16px;
                margin: 0 10px;
            }
            .button:hover {
                background-color: #f377b5;
            }
            h1 {
                color: #333;
                margin-bottom: 30px;
            }
            .category-title {
                font-size: 1.2em;
                color: #666;
                margin-bottom: 15px;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
    <h1>Complete Outfit Recommender</h1>

    <div class="outfit-container">
        <?php if ($top): ?>
            <div class="item-card">
                <h2 class="category-title">Top</h2>
                <?php if (isset($top['images'])): ?>
                    <img src="<?php echo htmlspecialchars($top['images']); ?>"
                         alt="<?php echo htmlspecialchars($top['item_name']); ?>"
                         class="item-image">
                <?php endif; ?>
                <div class="item-details">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($top['item_name']); ?></p>
                    <p><strong>Size:</strong> <?php echo htmlspecialchars($top['size_name']); ?></p>
                    <p><strong>Color:</strong> <?php echo htmlspecialchars($top['color_name']); ?></p>
                    <p><strong>Brand:</strong> <?php echo htmlspecialchars($top['brand_name']); ?></p>
                    <p><strong>Type:</strong> <?php echo htmlspecialchars($top['item_type_name']); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($bottom): ?>
            <div class="item-card">
                <h2 class="category-title">Bottom</h2>
                <?php if (isset($bottom['images'])): ?>
                    <img src="<?php echo htmlspecialchars($bottom['images']); ?>"
                         alt="<?php echo htmlspecialchars($bottom['item_name']); ?>"
                         class="item-image">
                <?php endif; ?>
                <div class="item-details">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($bottom['item_name']); ?></p>
                    <p><strong>Size:</strong> <?php echo htmlspecialchars($bottom['size_name']); ?></p>
                    <p><strong>Color:</strong> <?php echo htmlspecialchars($bottom['color_name']); ?></p>
                    <p><strong>Brand:</strong> <?php echo htmlspecialchars($bottom['brand_name']); ?></p>
                    <p><strong>Type:</strong> <?php echo htmlspecialchars($bottom['item_type_name']); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($shoes): ?>
            <div class="item-card">
                <h2 class="category-title">Shoes</h2>
                <?php if (isset($shoes['images'])): ?>
                    <img src="<?php echo htmlspecialchars($shoes['images']); ?>"
                         alt="<?php echo htmlspecialchars($shoes['item_name']); ?>"
                         class="item-image">
                <?php endif; ?>
                <div class="item-details">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($shoes['item_name']); ?></p>
                    <p><strong>Size:</strong> <?php echo htmlspecialchars($shoes['size_name']); ?></p>
                    <p><strong>Color:</strong> <?php echo htmlspecialchars($shoes['color_name']); ?></p>
                    <p><strong>Brand:</strong> <?php echo htmlspecialchars($shoes['brand_name']); ?></p>
                    <p><strong>Type:</strong> <?php echo htmlspecialchars($shoes['item_type_name']); ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!$top && !$bottom && !$shoes): ?>
        <p>No items found in the wardrobe.</p>
    <?php endif; ?>

    <div class="button-container">
        <a href="recommend.php" class="button">Get Another Outfit</a>
        <a href="../pages/item_filter_admin.php" class="button">Back to Results</a>
    </div>
    </body>
    </html>

<?php
$conn->close();
?>