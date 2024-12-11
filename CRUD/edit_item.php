<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['item_name'];
    $size_id = $_POST['size_id'];
    $color_id = $_POST['color_id'];
    $brand_id = $_POST['brand_id'];
    $item_type_id = $_POST['item_type_id'];

    $sql = "UPDATE Clothing_Items 
            SET item_name = ?, 
                size_id = ?, 
                color_id = ?, 
                brand_id = ?, 
                item_type_id = ? 
            WHERE item_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siiiii", $item_name, $size_id, $color_id, $brand_id, $item_type_id, $id);

    if ($stmt->execute()) {
        header("Location: ../pages/item_filter_admin.php");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }
} else {
    $sql = "SELECT 
        ci.item_id,
        ci.item_name,
        ci.images,
        ci.size_id,
        ci.color_id,
        ci.brand_id,
        ci.item_type_id,
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
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Item</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
            }
            .form-group {
                margin-bottom: 15px;
            }
            label {
                display: inline-block;
                width: 100px;
                font-weight: bold;
            }
            select, input[type="text"] {
                width: 300px;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-top: 20px;
            }
            .back-link {
                display: inline-block;
                margin-top: 20px;
                text-decoration: none;
                color: #666;
            }
            .item-image {
                max-width: 300px;
                height: auto;
                margin: 20px 0;
            }
        </style>
    </head>
    <body>
    <h1>Edit Item</h1>

    <?php if (isset($item['images'])): ?>
        <img src="<?php echo htmlspecialchars($item['images']); ?>" alt="Item Image" class="item-image">
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="item_name">Name:</label>
            <input type="text" id="item_name" name="item_name"
                   value="<?php echo htmlspecialchars($item['item_name']); ?>">
        </div>

        <div class="form-group">
            <label for="size_id">Size:</label>
            <select name="size_id" id="size_id">
                <?php
                $sizes_result->data_seek(0);
                while ($row = $sizes_result->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row['size_id']; ?>"
                        <?php echo ($item['size_id'] == $row['size_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['size_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="color_id">Color:</label>
            <select name="color_id" id="color_id">
                <?php
                $colors_result->data_seek(0);
                while ($row = $colors_result->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row['color_id']; ?>"
                        <?php echo ($item['color_id'] == $row['color_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['color_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="brand_id">Brand:</label>
            <select name="brand_id" id="brand_id">
                <?php
                $brands_result->data_seek(0);
                while ($row = $brands_result->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row['brand_id']; ?>"
                        <?php echo ($item['brand_id'] == $row['brand_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['brand_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="item_type_id">Type:</label>
            <select name="item_type_id" id="item_type_id">
                <?php
                $types_result->data_seek(0);
                while ($row = $types_result->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row['item_type_id']; ?>"
                        <?php echo ($item['item_type_id'] == $row['item_type_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['item_type_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <input type="submit" value="Update">
    </form>
    <a href="../pages/item_filter_admin.php" class="back-link">Back to Results</a>
    </body>
    </html>

<?php
$stmt->close();
$conn->close();
?>