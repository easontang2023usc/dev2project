<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("webdev.iyaserver.com", "mparthas", "AcadDev_Parthasarathy_8846782870", "mparthas_wardrobe");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Updated query to match your database structure
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
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
            }
            .item-image {
                max-width: 300px;
                height: auto;
                margin: 20px 0;
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
        </style>
    </head>
    <body>
    <h1>Item Details</h1>
    <?php if (isset($item['images'])): ?>
        <img src="<?php echo htmlspecialchars($item['images']); ?>" alt="Item Image" class="item-image">
    <?php endif; ?>

    <p><strong>Name:</strong> <?php echo htmlspecialchars($item['item_name']); ?></p>
    <p><strong>Size:</strong> <?php echo htmlspecialchars($item['size_name']); ?></p>
    <p><strong>Color:</strong> <?php echo htmlspecialchars($item['color_name']); ?></p>
    <p><strong>Brand:</strong> <?php echo htmlspecialchars($item['brand_name']); ?></p>
    <p><strong>Type:</strong> <?php echo htmlspecialchars($item['item_type_name']); ?></p>
    <p><strong>Added:</strong> <?php echo date('M d, Y', strtotime($item['acquired_dt'])); ?></p>

    <a href="../pages/item_filter.php" class="back-link">Back to Results</a>
    </body>
    </html>

<?php
$stmt->close();
$conn->close();
?>