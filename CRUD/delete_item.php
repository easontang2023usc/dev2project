<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("webdev.iyaserver.com", "mparthas", "AcadDev_Parthasarathy_8846782870", "mparthas_wardrobe");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// First verify the item exists
$check_sql = "SELECT item_id FROM Clothing_Items WHERE item_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("i", $id);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows === 0) {
    die("Item not found.");
}

// If item exists, proceed with deletion
$sql = "DELETE FROM Clothing_Items WHERE item_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../pages/item_filter.php");
    exit;
} else {
    echo "Error deleting record: " . $stmt->error;
}

$stmt->close();
$check_stmt->close();
$conn->close();
?>