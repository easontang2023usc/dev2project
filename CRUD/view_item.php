<?php

$conn = new mysqli("webdev.iyaserver.com", "mparthas", "AcadDev_Parthasarathy_8846782870", "mparthas_wardrobe");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM items WHERE id = ?";
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
</head>
<body>
<h1>Item Details</h1>
<p><strong>Name:</strong> <?php echo htmlspecialchars($item['name']); ?></p>
<p><strong>Size:</strong> <?php echo htmlspecialchars($item['size']); ?></p>
<p><strong>Color:</strong> <?php echo htmlspecialchars($item['color']); ?></p>
<p><strong>Brand:</strong> <?php echo htmlspecialchars($item['brand']); ?></p>
<p><strong>Item Type:</strong> <?php echo htmlspecialchars($item['item_type']); ?></p>
<a href="../pages/itemresults.php">Back to Results</a>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
