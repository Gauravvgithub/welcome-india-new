<?php
/**
 * admin/get-subcategories.php
 * AJAX endpoint for destination -> subcategory dropdown.
 */
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    exit('Unauthorized');
}

require_once '../config/db.php';
$db   = new database();
$conn = $db->connection;

if (!isset($_POST['destination_id'])) {
    echo '<option value="">Select Subcategory</option>';
    exit;
}

$destination_id = intval($_POST['destination_id']);
$result = mysqli_query(
    $conn,
    "SELECT id, subcategory_name FROM subcategories
     WHERE category_id = '$destination_id'
     ORDER BY subcategory_name ASC"
);

echo '<option value="">Select Subcategory (optional)</option>';

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . intval($row['id']) . '">'
           . ucwords(htmlspecialchars($row['subcategory_name']))
           . '</option>';
    }
} else {
    echo '<option value="" disabled>No subcategories for this destination</option>';
}
