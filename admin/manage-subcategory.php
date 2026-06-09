<?php
require_once '../config/db.php';

$db = new database();
$conn = $db->connection;

// Delete Logic
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM subcategories WHERE id='$id'");
    header("Location: manage-subcategory.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Subcategory</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        a.button { padding: 5px 10px; text-decoration: none; border-radius: 4px; color: white; }
        a.edit { background-color: #007bff; }
        a.delete { background-color: #dc3545; }
        a.button:hover { opacity: 0.8; }
    </style>
</head>
<body>

<h2>Manage Subcategories</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Destination</th>
        <th>Subcategory Name</th>
        <th>Action</th>
    </tr>

<?php
// ✅ FIXED QUERY
$query = "
SELECT subcategories.*, destination.destination_name 
FROM subcategories 
JOIN destination ON subcategories.category_id = destination.id
ORDER BY subcategories.id DESC
";

$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)){
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['destination_name']; ?></td>
    <td><?php echo $row['subcategory_name']; ?></td>
    <td>
        <!-- Edit Button -->
        <a class="button edit" href="edit-subcategory.php?id=<?php echo $row['id']; ?>">Edit</a>
        <!-- Delete Button -->
        <a class="button delete" href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this subcategory?')">Delete</a>
    </td>
</tr>

<?php } ?>

</table>

</body>
</html>