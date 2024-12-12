<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("webdev.iyaserver.com", "mparthas", "AcadDev_Parthasarathy_8846782870", "mparthas_wardrobe");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

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
WHERE ci.item_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

if (!$item) {
    echo "Item not found.";
    exit;
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>View Item</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 1000px;
                margin: 0 auto;
                padding: 20px;
                line-height: 1.6;
            }
            .item-details-container {
                display: flex;
                gap: 40px;
                align-items: flex-start;
            }
            .image-section {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .main-image {
                max-width: 400px;
                max-height: 500px;
                object-fit: contain;
                margin-bottom: 15px;
            }
            .additional-images {
                display: flex;
                flex-direction: column;
                gap: 15px;
                margin-top: 20px;
                width: 100%;
                align-items: center;
            }
            .additional-image {
                width: 100%;
                max-width: 400px;
                height: auto;
                object-fit: contain;
            }
            .item-info {
                flex: 1;
            }
            .item-info p {
                margin: 10px 0;
                border-bottom: 1px solid #eee;
                padding-bottom: 10px;
            }
            .back-link {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                text-decoration: none;
                border-radius: 4px;
            }
            h1 {
                text-align: center;
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <h1>Item Details</h1>

    <div class="item-details-container">
        <div class="image-section">
            <?php if (isset($item['images'])): ?>
                <img src="<?php echo htmlspecialchars($item['images']); ?>"
                     alt="Item Image"
                     class="main-image">
            <?php endif; ?>

            <div class="additional-images">
                <img src="../Public/dataviz.jpeg" alt="Additional Image 1" class="additional-image">
                <img src="../Public/dataviz2.jpeg" alt="Additional Image 2" class="additional-image">
                <img src="../Public/dataviz3.jpeg" alt="Additional Image 3" class="additional-image">
                <img src="../Public/dataviz4.jpeg" alt="Additional Image 4" class="additional-image">
            </div>
        </div>

        <div class="item-info">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($item['item_name']); ?></p>
            <p><strong>Size:</strong> <?php echo htmlspecialchars($item['size_name']); ?></p>
            <p><strong>Color:</strong> <?php echo htmlspecialchars($item['color_name']); ?></p>
            <p><strong>Brand:</strong> <?php echo htmlspecialchars($item['brand_name']); ?></p>
            <p><strong>Type:</strong> <?php echo htmlspecialchars($item['item_type_name']); ?></p>
            <p><strong>Added:</strong> <?php echo date('M d, Y', strtotime($item['acquired_dt'])); ?></p>

            <a href="../pages/item_filter_admin.php" class="back-link">Back to Results</a>
        </div>
    </div>
    </body>
    </html>

<?php
$stmt->close();
$conn->close();
?>