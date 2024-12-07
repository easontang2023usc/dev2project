<?php
// Initialize database connection
$conn = new mysqli("webdev.iyaserver.com", "mparthas", "AcadDev_Parthasarathy_8846782870", "mparthas_wardrobe");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize filter arrays
$sizes = array("ALL", "XS", "S", "M", "L", "XL", "XXL");
$colors = array("ALL", "Black", "White", "Blue", "Red", "Green", "Yellow");
$brands = array("ALL", "Nike", "Adidas", "Zara", "H&M", "Uniqlo");
$itemTypes = array("ALL", "Shirts", "Pants", "Dresses", "Shoes", "Accessories");

// Process filter selections
$size = isset($_GET['size']) ? $_GET['size'] : 'ALL';
$color = isset($_GET['color']) ? $_GET['color'] : 'ALL';
$brand = isset($_GET['brand']) ? $_GET['brand'] : 'ALL';
$item_type = isset($_GET['item_type']) ? $_GET['item_type'] : 'ALL';

// Start with base query
$sql = "SELECT * FROM items WHERE 1=1";
$params = array();
$types = "";

// Add conditions only for non-'ALL' selections
if ($size !== 'ALL') {
    $sql .= " AND size = ?";
    $params[] = $size;
    $types .= "s";
}
if ($color !== 'ALL') {
    $sql .= " AND color = ?";
    $params[] = $color;
    $types .= "s";
}
if ($brand !== 'ALL') {
    $sql .= " AND brand = ?";
    $params[] = $brand;
    $types .= "s";
}
if ($item_type !== 'ALL') {
    $sql .= " AND item_type = ?";
    $params[] = $item_type;
    $types .= "s";
}

// For debugging - remove in production
// echo "SQL Query: " . $sql . "<br>";
// echo "Parameters: " . print_r($params, true) . "<br>";
// echo "Types: " . $types . "<br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lookbook - Your Digital Closet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
            text-align: center;
        }

        .search-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin: 20px auto;
            max-width: 400px;
        }

        .form-group {
            margin: 15px 0;
            text-align: left;
        }

        .form-group label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
        }

        select {
            width: 200px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            border-top: 1px solid #eee;
            position: fixed;
            bottom: 0;
            width: 100%;
            background: white;
        }

        .footer-logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1>Search Your Closet</h1>
    <p>Find exactly what you're looking for with filters by color, size, brand, item type, and more!</p>

    <div class="search-form">
        <form method="GET" action="">
            <div class="form-group">
                <label for="size">Size:</label>
                <select name="size" id="size">
                    <?php foreach($sizes as $s): ?>
                        <option value="<?php echo $s; ?>" <?php echo ($s == $size) ? 'selected' : ''; ?>><?php echo $s; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="color">Color:</label>
                <select name="color" id="color">
                    <?php foreach($colors as $c): ?>
                        <option value="<?php echo $c; ?>" <?php echo ($c == $color) ? 'selected' : ''; ?>><?php echo $c; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="brand">Brand:</label>
                <select name="brand" id="brand">
                    <?php foreach($brands as $b): ?>
                        <option value="<?php echo $b; ?>" <?php echo ($b == $brand) ? 'selected' : ''; ?>><?php echo $b; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="item_type">Item Type:</label>
                <select name="item_type" id="item_type">
                    <?php foreach($itemTypes as $t): ?>
                        <option value="<?php echo $t; ?>" <?php echo ($t == $item_type) ? 'selected' : ''; ?>><?php echo $t; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" style="margin-top: 20px; padding: 10px 20px;">Search</button>
        </form>
    </div>

    <div class="results-grid">
        <?php
        // Execute the prepared query
        $stmt = $conn->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        while ($item = $result->fetch_assoc()):
            ?>
            <div class="item-card">
                <?php if (!empty($item['image_url'])): ?>
                    <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="item-image">
                <?php endif; ?>
                <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                <p>Size: <?php echo htmlspecialchars($item['size']); ?></p>
                <p>Color: <?php echo htmlspecialchars($item['color']); ?></p>
                <p>Brand: <?php echo htmlspecialchars($item['brand']); ?></p>
                <a href="view_item.php?id=<?php echo $item['id']; ?>">View Details</a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<div class="footer">
    <img src="path_to_logo.png" alt="Lookbook" class="footer-logo">
    <p>Your Closet, Organized Digitally.™</p>
    <p>&copy; 2024 Lookbook. All rights reserved.</p>
</div>

<?php
$stmt->close();
$conn->close();
?>
</body>
</html>