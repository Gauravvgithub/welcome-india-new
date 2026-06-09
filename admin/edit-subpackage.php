<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: login.php");
  exit;
}

include_once '../config/db.php';
$obj = new database();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id <= 0) die("Invalid ID");

// Existing data fetch karo
$sub_data = $obj->select_data('sub_packeges', "id = '$id'");
if(empty($sub_data)) die("Sub Package not found");
$sub = $sub_data[0];

// Update handle karo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

  $required_fields = ['title', 'package_id', 'price'];
  foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
      die("Error: '$field' field required hai.");
    }
  }

  $title      = trim($_POST['title']);
  $package_id = (int) $_POST['package_id'];
  $price      = trim($_POST['price']);
  $desc       = trim($_POST['desc'] ?? '');

  $arr = [
    'package_id'  => $package_id,
    'title'       => $title,
    'price'       => $price,
    'description' => $desc,
  ];

  // Sabhi 4 images ke liye array (Main + 3 Gallery)
  $image_fields = [
    'image' => 'image',
    'img_1' => 'img_1',
    'img_2' => 'img_2',
    'img_3' => 'img_3'
  ];

  $obj->update_data('sub_packeges', $arr, "id = $id", $image_fields);

  header("Location: manage-subpackeges.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once('./includes/header-link.php'); ?>
</head>
<body class="vertical-layout">
  <div id="containerbar">
    <?php include_once('./includes/leftbar.php'); ?>
    <div class="rightbar">
      <?php include_once('./includes/topbar.php'); ?>

      <div class="breadcrumbbar">
        <h4 class="page-title">Edit Sub Package</h4>
      </div>

      <div class="contentbar">
        <div class="row">
          <div class="col-lg-12">
            <div class="card m-b-30">
              <div class="card-body">
                <form action="edit-subpackage.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">

                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label>Parent Package</label>
                      <select class="form-control" name="package_id" required>
                        <?php
                        $all_packages = $obj->select_data('subcategories');
                        foreach ($all_packages as $pkg): ?>
                          <option value="<?php echo $pkg['id']; ?>" <?php echo ($pkg['id'] == $sub['package_id']) ? 'selected' : ''; ?>>
                            <?php echo ucwords(htmlspecialchars($pkg['subcategory_name'])); ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Title</label>
                      <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($sub['title']); ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Price (₹)</label>
                      <input type="number" name="price" class="form-control" value="<?php echo htmlspecialchars($sub['price']); ?>" required>
                    </div>
                  </div>

                  <hr>
                  <h5 class="mb-3 text-primary">Package Images (WEBP Only)</h5>
                  
                  <div class="form-row">
                    <?php 
                    // Loop for 4 images (Main Image + 3 Extra)
                    $img_labels = [
                        'image' => 'Main Banner Image',
                        'img_1' => 'Gallery Image 1',
                        'img_2' => 'Gallery Image 2',
                        'img_3' => 'Gallery Image 3'
                    ];

                    foreach($img_labels as $col_name => $label): ?>
                    <div class="form-group col-md-3">
                      <label><?php echo $label; ?></label>
                      
                      <div class="mb-2">
                        <?php if(!empty($sub[$col_name])): ?>
                          <img src="../<?php echo str_replace('../', '', htmlspecialchars($sub[$col_name])); ?>" 
                               style="width:100%; height:120px; object-fit:cover; border-radius:5px; border:1px solid #ddd;">
                        <?php else: ?>
                          <div style="width:100%; height:120px; background:#f0f0f0; display:flex; align-items:center; justify-content:center; border:1px dashed #ccc;">
                             <small class="text-muted">No Image</small>
                          </div>
                        <?php endif; ?>
                      </div>

                      <input type="file" name="<?php echo $col_name; ?>" class="form-control-file" accept="image/webp">
                    </div>
                    <?php endforeach; ?>
                  </div>

                  <hr>

                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="desc" rows="5"><?php echo htmlspecialchars($sub['description']); ?></textarea>
                  </div>

                  <div class="my-3">
                    <button type="submit" name="submit" class="btn btn-primary">Update Sub Package</button>
                    <a href="manage-subpackeges.php" class="btn btn-secondary">Cancel</a>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once('./includes/footer.php'); ?>
    </div>
  </div>
  <?php include_once('./includes/footer-link.php'); ?>
</body>
</html>