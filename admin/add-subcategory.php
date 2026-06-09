<?php
require_once '../config/db.php';

$db = new database();
$conn = $db->connection;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Subcategory</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        form { max-width: 500px; }
        label { font-weight: bold; }
        input, select, button { width: 100%; padding: 8px; margin: 8px 0; }
        button { background-color: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        p.success { color: green; }
        p.error { color: red; }
    </style>
</head>
<body>

<h2>Add Subcategory</h2>

<form method="POST" enctype="multipart/form-data">
    <label>Select Destination</label><br>
    <select name="category_id" required>
        <option value="">Select Destination</option>
        <?php
        $cat = mysqli_query($conn, "SELECT * FROM destination");
        while($c = mysqli_fetch_assoc($cat)){
            echo "<option value='".$c['id']."'>".$c['destination_name']."</option>";
        }
        ?>
    </select>

    <label>Subcategory Name</label><br>
    <input type="text" name="subcategory_name" placeholder="Enter Subcategory Name" required>

    <label>Image <span class="text-danger">*</span>
        <small class="text-muted">(852×536 px, sirf .webp)</small>
    </label>
    <input type="file" name="image" class="form-control" accept="image/webp" required>    

    <button type="submit" name="submit">Add Subcategory</button>
</form>

<?php
// if(isset($_POST['submit'])){
//     $category_id = $_POST['category_id'];
//     $name = mysqli_real_escape_string($conn, $_POST['subcategory_name']);
    
    

//     // ✅ Check if subcategory already exists for this destination
//     $check = mysqli_query($conn, "SELECT * FROM subcategories WHERE category_id='$category_id' AND subcategory_name='$name'");
//     if(mysqli_num_rows($check) > 0){
//         echo "<p class='error'>This subcategory already exists for the selected destination.</p>";
//     } else {
//         $query = "INSERT INTO subcategories (category_id, subcategory_name) 
//                   VALUES ('$category_id', '$name' )";


//         if(mysqli_query($conn, $query)){
//             // ✅ Redirect after successful insert
//             header("Location: manage-subcategory.php?success=1");
//             exit;
//         } else {
//             echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
//         }
//     }
//   }

if(isset($_POST['submit'])){
    $category_id = $_POST['category_id'];
    $name = mysqli_real_escape_string($conn, $_POST['subcategory_name']);

    // Image upload karo
    $image_path = '';
    if(!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $unique_name = uniqid('subcat_', true) . '.' . $ext;
        $upload_dir = '../uploads/';
        $target = $upload_dir . $unique_name;

        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image_path = $target;
        } else {
            die("Error: Image upload nahi hui.");
        }
    }

    // Check duplicate
    $check = mysqli_query($conn, "SELECT * FROM subcategories WHERE category_id='$category_id' AND subcategory_name='$name'");
    if(mysqli_num_rows($check) > 0){
        echo "<p class='error'>This subcategory already exists.</p>";
    } else {
        // ← image column add kiya
        $image_path = mysqli_real_escape_string($conn, $image_path);
        $query = "INSERT INTO subcategories (category_id, subcategory_name, image) 
                  VALUES ('$category_id', '$name', '$image_path')";

        if(mysqli_query($conn, $query)){
            header("Location: manage-subcategory.php?success=1");
            exit;
        } else {
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
        }
    }
}
?>


</body>
</html>