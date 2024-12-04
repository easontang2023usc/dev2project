<?php
// Database connection
$conn = new mysqli("localhost", "username", "password", "database_name");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get filter criteria
$size = isset($_GET['size']) ? $_GET['size'] : '';
$color = isset($_GET['color']) ? $_GET['color'] : '';
$brand = isset($_GET['brand']) ? $_GET['brand'] : '';
$item_type = isset($_GET['item_type']) ? $_GET['item_type'] : '';

// Prepare SQL query
$sql = "SELECT id, name, size, color, brand, item_type FROM items WHERE size LIKE ? AND color LIKE ? AND brand LIKE ? AND item_type LIKE ?";
$stmt = $conn->prepare($sql);
$sizeParam = "%" . $size . "%";
$colorParam = "%" . $color . "%";
$brandParam = "%" . $brand . "%";
$item_typeParam = "%" . $item_type . "%";
$stmt->bind_param("ssss", $sizeParam, $colorParam, $brandParam, $item_typeParam);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Results</title>
</head>
<body>
<h1>Item Results</h1>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Size</th>
        <th>Color</th>
        <th>Brand</th>
        <th>Item Type</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['size']); ?></td>
            <td><?php echo htmlspecialchars($row['color']); ?></td>
            <td><?php echo htmlspecialchars($row['brand']); ?></td>
            <td><?php echo htmlspecialchars($row['item_type']); ?></td>
            <td>
                <a href="view_item.php?id=<?php echo $row['id']; ?>">View</a>
                <a href="edit_item.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete_item.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<br>
<a href="add_item.php">Add New Item</a>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
