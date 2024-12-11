<?php
// Initialize database connection
$conn = new mysqli("webdev.iyaserver.com", "mparthas", "AcadDev_Parthasarathy_8846782870", "mparthas_wardrobe");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Base query - Updated with proper JOINs
$sql = "SELECT 
    ci.item_id,
    ci.item_name,
    ci.images,
    ci.acquired_dt,
    b.brand_name,
    c.color_name,
    it.item_type_name,
    ci.size_id
FROM Clothing_Items ci
LEFT JOIN Brands b ON ci.brand_id = b.brand_id
LEFT JOIN Colors c ON ci.color_id = c.color_id
LEFT JOIN Item_Types it ON ci.item_type_id = it.item_type_id
WHERE 1=1";

$params = array();
$types = "";

// Add filters based on selections
if (isset($_GET['size']) && $_GET['size'] != 'ALL') {
    $sql .= " AND ci.size_id = ?";
    $params[] = $_GET['size'];
    $types .= "i";
}

if (isset($_GET['color']) && $_GET['color'] != 'ALL') {
    $sql .= " AND ci.color_id = ?";
    $params[] = $_GET['color'];
    $types .= "i";
}

if (isset($_GET['brand']) && $_GET['brand'] != 'ALL') {
    $sql .= " AND ci.brand_id = ?";
    $params[] = $_GET['brand'];
    $types .= "i";
}

if (isset($_GET['item_type']) && $_GET['item_type'] != 'ALL') {
    $sql .= " AND ci.item_type_id = ?";
    $params[] = $_GET['item_type'];
    $types .= "i";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Your Digital Closet</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .item-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background: white;
        }
        .item-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 4px;
        }
        .filter-tag {
            display: inline-block;
            background: #e0e0e0;
            padding: 5px 10px;
            border-radius: 15px;
            margin: 5px;
        }
    </style>
</head>
<?php include 'ga.php'; ?>

<body>
<header>
    <h1>Your Digital Closet</h1>
</header>


<div class="container">
    <h1>Search Results</h1>

    <div class="filtered-tags">
        <?php
        if (isset($_GET['color']) && $_GET['color'] != 'ALL') {
            $color = $conn->query("SELECT color_name FROM Colors WHERE color_id = " . intval($_GET['color']))->fetch_assoc();
            echo "<span class='filter-tag'>Color: " . htmlspecialchars($color['color_name']) . "</span>";
        }
        if (isset($_GET['brand']) && $_GET['brand'] != 'ALL') {
            $brand = $conn->query("SELECT brand_name FROM Brands WHERE brand_id = " . intval($_GET['brand']))->fetch_assoc();
            echo "<span class='filter-tag'>Brand: " . htmlspecialchars($brand['brand_name']) . "</span>";
        }
        if (isset($_GET['item_type']) && $_GET['item_type'] != 'ALL') {
            $type = $conn->query("SELECT item_type_name FROM Item_Types WHERE item_type_id = " . intval($_GET['item_type']))->fetch_assoc();
            echo "<span class='filter-tag'>Type: " . htmlspecialchars($type['item_type_name']) . "</span>";
        }
        ?>
    </div>

    <div class="results-grid">
        <?php
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Prepare failed: ' . $conn->error . ' (SQL: ' . $sql . ')');
        }

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        echo "<p>Found " . $result->num_rows . " items</p>";

        while ($item = $result->fetch_assoc()):
            ?>
            <div class="item-card">
                <img src="<?php echo htmlspecialchars($item['images']); ?>"
                     alt="<?php echo htmlspecialchars($item['item_name']); ?>"
                     class="item-image">
                <h3><?php echo htmlspecialchars($item['item_name']); ?></h3>
                <p>Added: <?php echo date('M d, Y', strtotime($item['acquired_dt'])); ?></p>
                <?php if (isset($item['brand_name'])): ?>
                    <p>Brand: <?php echo htmlspecialchars($item['brand_name']); ?></p>
                <?php endif; ?>
                <?php if (isset($item['color_name'])): ?>
                    <p>Color: <?php echo htmlspecialchars($item['color_name']); ?></p>
                <?php endif; ?>
                <?php if (isset($item['item_type_name'])): ?>
                    <p>Type: <?php echo htmlspecialchars($item['item_type_name']); ?></p>
                <?php endif; ?>
                <div class="item-actions">
                    <a href="view_item.php?id=<?php echo $item['item_id']; ?>">View</a>
                    <a href="../edit_item.php?id=<?php echo $item['item_id']; ?>">Edit</a>
                    <a href="../delete_item.php?id=<?php echo $item['item_id']; ?>"
                       onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php
$stmt->close();
$conn->close();
?>
</body>
</html>