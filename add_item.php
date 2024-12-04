<?php
$conn = new mysqli("localhost", "username", "password", "database_name");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $brand = $_POST['brand'];
    $item_type = $_POST['item_type'];

    $sql = "INSERT INTO items (name, size, color, brand, item_type) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $size, $color, $brand, $item_type);
    $stmt->execute();

    header("Location: itemresults.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Item</title>
</head>
<body>
<h1>Add New Item</h1>
<form method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="size">Size:</label>
    <input type="text" id="size" name="size"><br><br>

    <label for="color">Color:</label>
    <input type="text" id="color" name="color"><br><br>

    <label for="brand">Brand:</label>
    <input type="text" id="brand" name="brand"><br><br>

    <label for="item_type">Item Type:</label>
    <input type="text" id="item_type" name="item_type"><br><br>

    <input type="submit" value="Add Item">
</form>
<a href="itemresults.php">Back to Results</a>
</body>
</html>

<?php
$conn->close();
?>
