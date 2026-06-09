<?php
//     $image_fields = ['image', 'image1', 'image2', 'image3'];
//     $uploaded_paths = [];

// foreach ($image_fields as $field) {
//     // 1. Check ki file select hui hai ya nahi
//     if (empty($_FILES[$field]['name'])) {
//         die("Error: $field required hai. Charo images upload karein.");
//     }

//     // 2. Format check (Sirf WEBP)
//     $allowed_types = ['image/webp'];
//     if (!in_array($_FILES[$field]['type'], $allowed_types)) {
//         die("Error: $field ka format galat hai. Sirf WEBP images upload karein.");
//     }

//     // 3. Upload logic (Example)
//     $ext = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
//     $new_name = uniqid('img_', true) . '.' . $ext;
//     $target = "../uploads/" . $new_name;

//     if (move_uploaded_file($_FILES[$field]['tmp_name'], $target)) {
//         $uploaded_paths[$field] = $target; // Paths ko array mein save kar rahe hain
//     } else {
//         die("Error: $field upload karne mein masla hua.");
//     }
// }
//     // if (empty($_FILES['image']['name'])) {
//     //   die("Error: Image required hai.");
//     // }

//     // $allowed_types = ['image/webp'];
//     // if (!in_array($_FILES['image']['type'], $allowed_types)) {
//     //   die("Error: Sirf WEBP image upload karein.");
//     // }

//     $arr = [
//       'package_id'  => $package_id,
//       'title'       => $title,
//       'price'       => $price,
//       'description' => $desc,
//     ];

//     $filesMap = ['image' => 'image'];
//     $obj->insert_data('sub_packeges', $arr, $filesMap);

//     header("Location: manage-subpackeges.php");
//     exit();
//   }
// }

// ... aapka purana code upar wala ...


session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: login.php");
  exit;
}

include_once '../config/db.php';
$obj = new database();
$type = isset($_GET['type']) ? $_GET['type'] : 'sub-packages';

if ($type === 'sub-packages') {
    // Sab kuch IS bracket ke andar hona chahiye
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

        if ($package_id <= 0) { die("Error: Valid package select karein."); }
        if (!is_numeric($price) || $price < 0) { die("Error: Price valid number hona chahiye."); }

        // --- Image Upload Logic ---
        $image_fields = ['image', 'img_1', 'img_2', 'img_3'];
        $uploaded_paths = [];

        foreach ($image_fields as $field) {
            if (empty($_FILES[$field]['name'])) {
                die("Error: $field missing hai. Charo images select karein.");
            }

            $allowed_types = ['image/webp'];
            $file_type = $_FILES[$field]['type'];
            
            if (!in_array($file_type, $allowed_types)) {
                die("Error: $field sirf WEBP honi chahiye.");
            }

            $ext = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
            $new_name = uniqid('img_', true) . '.' . $ext;
            $target = "../uploads/" . $new_name;

            if (move_uploaded_file($_FILES[$field]['tmp_name'], $target)) {
                $uploaded_paths[$field] = $target; 
            } else {
                die("Error: $field upload fail.");
            }
        }

        // --- Data Array Construction ---
        // Note: Make sure columns image1, image2, image3 exist in DB
        $arr = [
          'package_id'  => $package_id,
          'title'       => $title,
          'price'       => $price,
          'description' => $desc,
          'image'       => $uploaded_paths['image'],
          'img_1'      => $uploaded_paths['img_1'], // DB column 'image1'
          'img_2'      => $uploaded_paths['img_2'], // DB column 'image2'
          'img_3'      => $uploaded_paths['img_3']  // DB column 'image3'
        ];

        if($obj->insert_data('sub_packeges', $arr)) {
            header("Location: manage-subpackeges.php?success=1");
            exit();
        } else {
            die("Database Error.");
        }
    } // End of isset submit
} // End of type check
?>

 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once('./includes/header-link.php'); ?>
</head>
<body class="vertical-layout">
  <div class="infobar-settings-sidebar-overlay"></div>
  <div id="containerbar">
    <?php include_once('./includes/leftbar.php'); ?>
    <div class="rightbar">
      <?php include_once('./includes/mobile-topbar.php'); ?>
      <?php include_once('./includes/topbar.php'); ?>

      <div class="breadcrumbbar">
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-12">
            <h4 class="page-title">Welcome India Holidays</h4>
            <div class="breadcrumb-list">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Add Sub Package</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="contentbar">
        <div class="row">
          <div class="col-lg-12">
            <div class="card m-b-30">
              <div class="card-header">
                <h5 class="card-title">Add Sub Package</h5>
              </div>
              <div class="card-body">
                <form action="add-subpackeges.php?type=sub-packages" method="post" enctype="multipart/form-data">

                  <div class="form-row">
                    <!-- Package direct select -->
                    <div class="form-group col-md-6">
                      <label>Parent Package <span class="text-danger">*</span></label>
                      <select class="form-control" name="package_id" required>
                        <option value="">-- Package Select Karein --</option>
                        <?php
                        $all_packages = $obj->select_data('subcategories');
                        foreach ($all_packages as $pkg): ?>
                          <option value="<?php echo $pkg['id']; ?>">
                            <?php echo ucwords(htmlspecialchars($pkg['subcategory_name'])); ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="form-group col-md-6">
                      <label>Sub Package Title <span class="text-danger">*</span></label>
                      <input type="text" name="title" class="form-control"
                             placeholder="e.g. Manali Honeymoon Special" required>
                    </div>
                  </div>

                    <div class="form-group col-md-6">
                      <label>Price (₹) <span class="text-danger">*</span></label>
                      <input type="number" name="price" class="form-control"
                             placeholder="Price" min="0" step="0.01" required>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Image <span class="text-danger">*</span>
                        <small class="text-muted">(852×536 px, sirf .webp)</small>
                      </label>
                      <input type="file" name="image" class="form-control"
                             accept="image/webp" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Image <span class="text-danger">*</span>
                        <small class="text-muted">(852×536 px, sirf .webp)</small>
                      </label>
                      <input type="file" name="img_1" class="form-control"
                             accept="image/webp" required>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Image <span class="text-danger">*</span>
                        <small class="text-muted">(852×536 px, sirf .webp)</small>
                      </label>
                      <input type="file" name="img_2" class="form-control"
                             accept="image/webp" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Image <span class="text-danger">*</span>
                        <small class="text-muted">(852×536 px, sirf .webp)</small>
                      </label>
                      <input type="file" name="img_3" class="form-control"
                             accept="image/webp" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="desc" rows="5"
                              placeholder="Sub package ki detail likhein..."></textarea>
                  </div>

                  <button type="submit" name="submit" class="btn btn-primary my-3 mx-3">
                    Sub Package Add Karein
                  </button>

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