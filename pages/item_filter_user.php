<?php
session_start();
require_once '../components/authentication.php';

// Check if user is logged in first
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}

// If they are an admin, send them to admin page
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    header("Location: item_filter_admin.php");
    exit();
}

// Initialize database connection
$conn = new mysqli("webdev.iyaserver.com", "mparthas", "AcadDev_Parthasarathy_8846782870", "mparthas_wardrobe");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get lookup table data
$sizes_query = "SELECT DISTINCT size_id, size_name FROM Sizes ORDER BY size_id";
$colors_query = "SELECT DISTINCT color_id, color_name FROM Colors ORDER BY color_id";
$brands_query = "SELECT DISTINCT brand_id, brand_name FROM Brands ORDER BY brand_id";
$types_query = "SELECT DISTINCT item_type_id, item_type_name FROM Item_Types ORDER BY item_type_id";

$sizes_result = $conn->query($sizes_query);
$colors_result = $conn->query($colors_query);
$brands_result = $conn->query($brands_query);
$types_result = $conn->query($types_query);

// Pagination settings
$items_per_page = 10;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Base query
$base_sql = "SELECT 
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
WHERE 1=1";

$count_sql = "SELECT COUNT(*) as total FROM Clothing_Items ci WHERE 1=1";

$params = array();
$types = "";

// Add filters based on selections
if (isset($_GET['size']) && $_GET['size'] != 'ALL') {
    $base_sql .= " AND ci.size_id = ?";
    $count_sql .= " AND ci.size_id = ?";
    $params[] = $_GET['size'];
    $types .= "i";
}

if (isset($_GET['color']) && $_GET['color'] != 'ALL') {
    $base_sql .= " AND ci.color_id = ?";
    $count_sql .= " AND ci.color_id = ?";
    $params[] = $_GET['color'];
    $types .= "i";
}

if (isset($_GET['brand']) && $_GET['brand'] != 'ALL') {
    $base_sql .= " AND ci.brand_id = ?";
    $count_sql .= " AND ci.brand_id = ?";
    $params[] = $_GET['brand'];
    $types .= "i";
}

if (isset($_GET['item_type_name']) && $_GET['item_type_name'] != 'ALL') {
    $base_sql .= " AND ci.item_type_id = ?";
    $count_sql .= " AND ci.item_type_id = ?";
    $params[] = $_GET['item_type_name'];
    $types .= "i";
}

// Get total number of items for pagination
$count_stmt = $conn->prepare($count_sql);
if (!empty($params)) {
    $count_stmt->bind_param($types, ...$params);
}
$count_stmt->execute();
$total_items = $count_stmt->get_result()->fetch_assoc()['total'];
$total_pages = ceil($total_items / $items_per_page);

// Add pagination to the main query
$base_sql .= " LIMIT ? OFFSET ?";
$params[] = $items_per_page;
$params[] = $offset;
$types .= "ii";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../components/ga.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Digital Closet</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .filter-controls {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-group label {
            font-weight: bold;
            min-width: 60px;
        }

        select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-width: 150px;
        }

        .apply-filters {
            background-color: #ff69b4;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: auto;
        }

        .apply-filters:hover {
            background-color: #ce5592;
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
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
            padding-bottom: 60px; /* Make room for the button */

        }


        .item-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .item-actions {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px;
            margin-top: auto;
            width: 100%;
            box-sizing: border-box;
        }
        .item-actions a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            border-radius: 4px;
            font-size: 14px;
            background-color: #ff69b4;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
            transition: background-color 0.3s ease;
        }

        .item-actions a:hover {
            background-color: #fb7fbd;
        }
        /* Adjust the spacing for item details */
        .item-card h3 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .item-card p {
            margin: 5px 0;
        }

        .active-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0;
        }

        .filter-tag {
            background: #e0e0e0;
            padding: 5px 15px;
            border-radius: 15px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .item-actions {
            margin-top: 15px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .item-actions a {
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            border-radius: 4px;
            font-size: 14px;
            background-color: #ff69b4;
        }

        .item-actions a:hover {
            background-color: #f879b8;
        }
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
        }

        .pagination a, .pagination span {
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #333;
        }

        .pagination a:hover {
            background-color: #f0f0f0;
        }

        .pagination .current {
            background-color: #ff69b4;
            color: white;
            border-color: #ff69b4;
        }

        .pagination .disabled {
            color: #999;
            pointer-events: none;
        }

    </style>
</head>

<body>
<?php include '../components/header.php'; ?>

<div class="container">
    <h1>Your Digital Closet</h1>

    <form method="GET" class="filter-controls">
        <div class="filter-group">
            <label for="size">Size:</label>
            <select name="size" id="size">
                <option value="ALL">All Sizes</option>
                <?php
                $sizes_result->data_seek(0);
                while ($row = $sizes_result->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row['size_id']; ?>"
                        <?php echo (isset($_GET['size']) && $_GET['size'] == $row['size_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['size_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="filter-group">
            <label for="color">Color:</label>
            <select name="color" id="color">
                <option value="ALL">All Colors</option>
                <?php
                $colors_result->data_seek(0);
                while ($row = $colors_result->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row['color_id']; ?>"
                        <?php echo (isset($_GET['color']) && $_GET['color'] == $row['color_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['color_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="filter-group">
            <label for="brand">Brand:</label>
            <select name="brand" id="brand">
                <option value="ALL">All Brands</option>
                <?php
                $brands_result->data_seek(0);
                while ($row = $brands_result->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row['brand_id']; ?>"
                        <?php echo (isset($_GET['brand']) && $_GET['brand'] == $row['brand_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['brand_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="filter-group">
            <label for="item_type">Type:</label>
            <select name="item_type" id="item_type">
                <option value="ALL">All Types</option>
                <?php
                $types_result->data_seek(0);
                while ($row = $types_result->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row['item_type_id']; ?>"
                        <?php echo (isset($_GET['item_type_name']) && $_GET['item_type_name'] == $row['item_type_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['item_type_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <input type="hidden" name="page" value="1">
        <button type="submit" class="apply-filters">Apply Filters</button>
    </form>

    <?php if (isset($_GET['size']) || isset($_GET['color']) || isset($_GET['brand']) || isset($_GET['item_type'])): ?>
        <div class="active-filters">
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
                $type_name = $conn->query("SELECT item_type_name FROM Item_Types WHERE item_type_id = " . intval($_GET['item_type']))->fetch_assoc();
                echo "<span class='filter-tag'>Type: " . htmlspecialchars($type_name['item_type_name']) . "</span>";
            }
            ?>
        </div>
    <?php endif; ?>

    <div class="results-grid">
        <?php
        $stmt = $conn->prepare($base_sql);

        if ($stmt === false) {
            die('Prepare failed: ' . $conn->error . ' (SQL: ' . $base_sql . ')');
        }

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        while ($item = $result->fetch_assoc()):
            ?>
            <div class="item-card">
                <img src="<?php echo htmlspecialchars($item['images']); ?>"
                     alt="<?php echo htmlspecialchars($item['item_name']); ?>"
                     class="item-image">
                <div class="item-details">
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
                <div class="item-actions">
                    <a href="../CRUD/view_item.php?id=<?php echo $item['item_id']; ?>">View Details</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php if ($total_pages > 1): ?>
        <div class="pagination">
            <?php
            // Build the base URL for pagination links
            $params = $_GET;
            unset($params['page']); // Remove existing page from params
            $url = '?' . http_build_query($params) . '&page=';

            // Previous link
            if ($current_page > 1) {
                echo '<a href="' . $url . ($current_page - 1) . '">&laquo; Previous</a>';
            } else {
                echo '<span class="disabled">&laquo; Previous</span>';
            }

            // Page numbers
            for ($i = max(1, $current_page - 2); $i <= min($total_pages, $current_page + 2); $i++) {
                if ($i == $current_page) {
                    echo '<span class="current">' . $i . '</span>';
                } else {
                    echo '<a href="' . $url . $i . '">' . $i . '</a>';
                }
            }

            // Next link
            if ($current_page < $total_pages) {
                echo '<a href="' . $url . ($current_page + 1) . '">Next &raquo;</a>';
            } else {
                echo '<span class="disabled">Next &raquo;</span>';
            }
            ?>
        </div>
    <?php endif; ?>
</div>

<?php
$stmt->close();
$conn->close();
?>
</body>
</html>