<?php
require_once '../config/db.php';

$db = new database();
$conn = $db->connection;

if(!isset($_GET['id'])){
    die("Subcategory ID missing");
}

$id = intval($_GET['id']);

// Fetch current subcategory data
$query = "SELECT * FROM subcategories WHERE id='$id'";
$result = mysqli_query($conn, $query);
$subcategory = mysqli_fetch_assoc($result);
if(!$subcategory){
    die("Subcategory not found");
}


if(isset($_POST['submit'])){
    $category_id = $_POST['category_id'];
    $name = mysqli_real_escape_string($conn, $_POST['subcategory_name']);
    
    // 1. Pehle purani image ka path rakhte hain default
    $image_path = $subcategory['image']; 

    // 2. Check karo agar user ne nayi file upload ki hai
    if(!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = array('jpg', 'jpeg', 'png', 'webp');

        if(in_array($ext, $allowed)) {
            $unique_name = uniqid('subcat_', true) . '.' . $ext;
            $upload_dir = '../uploads/';
            $target = $upload_dir . $unique_name;

            if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                // Nayi image upload ho gayi, purani wali delete kar sakte hain
                if(!empty($subcategory['image']) && file_exists($subcategory['image'])) {
                    unlink($subcategory['image']); 
                }
                $image_path = $target; // Update path variable
            } else {
                die("Error: Image upload fail hui.");
            }
        } else {
            die("Error: Invalid file format.");
        }
    }

    // 3. Database Update Query
    $image_path = mysqli_real_escape_string($conn, $image_path);
    $update = "UPDATE subcategories 
               SET category_id='$category_id', 
                   subcategory_name='$name', 
                   image='$image_path' 
               WHERE id='$id'";

    if(mysqli_query($conn, $update)){
        header("Location: manage-subcategory.php?update=success");
        exit;
    } else {
        $error = mysqli_error($conn);
    }
}
// // Fetch all destinations for dropdown
 $destinations = mysqli_query($conn, "SELECT * FROM destination");
 
// // Handle form submission
// if(isset($_POST['submit'])){
//     $category_id = $_POST['category_id'];
//     $name = mysqli_real_escape_string($conn, $_POST['subcategory_name']);

//     $update = "UPDATE subcategories SET category_id='$category_id', subcategory_name='$name' WHERE id='$id'";
//     if(mysqli_query($conn, $update)){
//         header("Location: manage-subcategory.php");
//         exit;
//     } else {
//         $error = mysqli_error($conn);
//     }
// }



?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Subcategory</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        form { max-width: 500px; }
        label { font-weight: bold; display: block; margin-top: 10px; }
        input, select, button { width: 100%; padding: 8px; margin: 8px 0; }
        button { background-color: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        p.error { color: red; }
    </style>
</head>
<body>

<h2>Edit Subcategory</h2>

<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

<form method="POST" enctype="multipart/form-data">
    <label>Select Destination</label>
    <select name="category_id" required>
        <option value="">Select Destination</option>
        <?php
        while($c = mysqli_fetch_assoc($destinations)){
            $selected = ($c['id'] == $subcategory['category_id']) ? "selected" : "";
            echo "<option value='".$c['id']."' $selected>".$c['destination_name']."</option>";
        }
        ?>
    </select>

    <label>Subcategory Name</label>
    <input type="text" name="subcategory_name" value="<?php echo htmlspecialchars($subcategory['subcategory_name']); ?>" required>
    <img src="<?php echo $subcategory['image']; ?>" width="100">
   
   <input type="file" name="image">

    <button type="submit" name="submit">Update Subcategory</button>
</form>

</body>
</html>