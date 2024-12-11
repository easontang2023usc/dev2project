<?php
require_once '../components/authentication.php';
// Rest of your test.php code below
?>

<?php
// Initialize database connection
$conn = new mysqli("webdev.iyaserver.com", "mparthas", "AcadDev_Parthasarathy_8846782870", "mparthas_wardrobe");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get lookup table data
$sizes_query = "SELECT DISTINCT size_id, size_name FROM Sizes ORDER BY size_id";
$colors_query = "SELECT DISTINCT color_id, color_name FROM Colors ORDER BY color_id";
$brands_query = "SELECT DISTINCT brand_id, brand_name FROM Brands ORDER BY brand_id";
$types_query = "SELECT DISTINCT item_type_id, type_name FROM Item_Types ORDER BY item_type_id";

$sizes_result = $conn->query($sizes_query);
$colors_result = $conn->query($colors_query);
$brands_result = $conn->query($brands_query);
$types_result = $conn->query($types_query);

// Base query
$sql = "SELECT 
    ci.item_id,
    ci.item_name,
    ci.images,
    ci.acquired_dt,
    s.size_name,
    c.color_name,
    b.brand_name,
    it.type_name
FROM Clothing_Items ci
LEFT JOIN Sizes s ON ci.size_id = s.size_id
LEFT JOIN Colors c ON ci.color_id = c.color_id
LEFT JOIN Brands b ON ci.brand_id = b.brand_id
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
    <?php include '../components/ga.php'; ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lookbook - Your Digital Closet</title>
    <style>
        .container {
            max-width: 1200px;
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
            /* Added position relative to ensure proper containment */
            position: relative;
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

        /* Simplified button styles to ensure visibility */
        .search-button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: calc(100% - 48px); /* Account for form padding */
            margin-top: 20px;
            display: block; /* Ensure button is block-level */
        }

        .search-button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
<?php include '../components/header.php'; ?>

<div class="container">
    <h1>Search Your Closet</h1>

    <div class="search-form">
        <form method="GET" action="item_filter_admin.php">
            <button type="submit" class="search-button">Search Closet</button>

            <div class="form-group">
                <label for="size">Size:</label>
                <select name="size" id="size">
                    <option value="ALL">All Sizes</option>
                    <?php while ($row = $sizes_result->fetch_assoc()): ?>
                        <option value="<?php echo $row['size_id']; ?>"
                            <?php echo (isset($_GET['size']) && $_GET['size'] == $row['size_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row['size_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="color">Color:</label>
                <select name="color" id="color">
                    <option value="ALL">All Colors</option>
                    <?php while ($row = $colors_result->fetch_assoc()): ?>
                        <option value="<?php echo $row['color_id']; ?>"
                            <?php echo (isset($_GET['color']) && $_GET['color'] == $row['color_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row['color_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="brand">Brand:</label>
                <select name="brand" id="brand">
                    <option value="ALL">All Brands</option>
                    <?php while ($row = $brands_result->fetch_assoc()): ?>
                        <option value="<?php echo $row['brand_id']; ?>"
                            <?php echo (isset($_GET['brand']) && $_GET['brand'] == $row['brand_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row['brand_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="item_type">Type:</label>
                <select name="item_type" id="item_type">
                    <option value="ALL">All Types</option>
                    <?php while ($row = $types_result->fetch_assoc()): ?>
                        <option value="<?php echo $row['item_type_id']; ?>"
                            <?php echo (isset($_GET['item_type']) && $_GET['item_type'] == $row['item_type_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row['type_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

        </form>
    </div>

    <?php if (isset($_GET['size']) || isset($_GET['color']) || isset($_GET['brand']) || isset($_GET['item_type'])): ?>
        <div class="results-header">
            <h2>Search Results</h2>
            <div class="filtered-tags">
                <?php
                if (isset($_GET['size']) && $_GET['size'] != 'ALL') {
                    $size_name = $conn->query("SELECT size_name FROM Sizes WHERE size_id = " . intval($_GET['size']))->fetch_assoc();
                    echo "<span class='filter-tag'>Size: " . htmlspecialchars($size_name['size_name']) . "</span>";
                }
                if (isset($_GET['color']) && $_GET['color'] != 'ALL') {
                    $color_name = $conn->query("SELECT color_name FROM Colors WHERE color_id = " . intval($_GET['color']))->fetch_assoc();
                    echo "<span class='filter-tag'>Color: " . htmlspecialchars($color_name['color_name']) . "</span>";
                }
                if (isset($_GET['brand']) && $_GET['brand'] != 'ALL') {
                    $brand_name = $conn->query("SELECT brand_name FROM Brands WHERE brand_id = " . intval($_GET['brand']))->fetch_assoc();
                    echo "<span class='filter-tag'>Brand: " . htmlspecialchars($brand_name['brand_name']) . "</span>";
                }
                if (isset($_GET['item_type']) && $_GET['item_type'] != 'ALL') {
                    $type_name = $conn->query("SELECT type_name FROM Item_Types WHERE item_type_id = " . intval($_GET['item_type']))->fetch_assoc();
                    echo "<span class='filter-tag'>Type: " . htmlspecialchars($type_name['type_name']) . "</span>";
                }
                ?>
            </div>
            <p class="results-count">Found <?php echo $result->num_rows; ?> items</p>
        </div>
    <?php else: ?>
        <div class="results-header">
            <h2>All Items</h2>
            <p class="results-count">Showing all <?php echo $result->num_rows; ?> items</p>
        </div>
    <?php endif; ?>

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
                <?php if (isset($item['size_name'])): ?>
                    <p>Size: <?php echo htmlspecialchars($item['size_name']); ?></p>
                <?php endif; ?>
                <?php if (isset($item['color_name'])): ?>
                    <p>Color: <?php echo htmlspecialchars($item['color_name']); ?></p>
                <?php endif; ?>
                <?php if (isset($item['brand_name'])): ?>
                    <p>Brand: <?php echo htmlspecialchars($item['brand_name']); ?></p>
                <?php endif; ?>
                <?php if (isset($item['type_name'])): ?>
                    <p>Type: <?php echo htmlspecialchars($item['type_name']); ?></p>
                <?php endif; ?>
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