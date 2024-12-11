<?php
$conn = new mysqli("webdev.iyaserver.com", "mparthas", "AcadDev_Parthasarathy_8846782870", "mparthas_wardrobe");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $brand = $_POST['brand'];
    $item_type = $_POST['item_type'];

    $sql = "UPDATE items SET name = ?, size = ?, color = ?, brand = ?, item_type = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $size, $color, $brand, $item_type, $id);
    $stmt->execute();

    header("Location: itemresults.php");
    exit;
} else {
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
</head>
<body>
<h1>Edit Item</h1>
<form method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($item['name']); ?>"><br><br>

    <label for="size">Size:</label>
    <input type="text" id="size" name="size" value="<?php echo htmlspecialchars($item['size']); ?>"><br><br>

    <label for="color">Color:</label>
    <input type="text" id="color" name="color" value="<?php echo htmlspecialchars($item['color']); ?>"><br><br>

    <label for="brand">Brand:</label>
    <input type="text" id="brand" name="brand" value="<?php echo htmlspecialchars($item['brand']); ?>"><br><br>

    <label for="item_type">Item Type:</label>
    <input type="text" id="item_type" name="item_type" value="<?php echo htmlspecialchars($item['item_type']); ?>"><br><br>

    <input type="submit" value="Update">
</form>
<a href="../pages/itemresults.php">Back to Results</a>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
