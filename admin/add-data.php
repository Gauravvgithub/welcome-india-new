<?php
 session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: login.php");
  exit;
}

include_once('../config/db.php');
$obj = new database();
$type = $_GET['type'] ?? null;

// Packages
if ($type === 'packages') {
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    // Validate required fields
    $required_fields = ['title', 'destination_id', 'location', 'desc', 'price'];
    foreach ($required_fields as $field) {
      if (empty($_POST[$field])) {
        die("Error: '$field' is required.");
      }
    }

    // Sanitize user input
    $title               = trim($_POST['title']);
    $destination_id      = trim($_POST['destination_id']);
    $location            = trim($_POST['location']);
    $desc                = trim($_POST['desc']);
    $price               = trim($_POST['price']);
    $customize_packages  = isset($_POST['customize_packages']) ? 1 : 0;   // ← new
    $amazing_destinations = isset($_POST['amazing_destinations']) ? 1 : 0; // ← new

    // Validate destination is a valid number
    if (!is_numeric($destination_id) || $destination_id <= 0) {
      die("Error: Please select a valid destination.");
    }

    // Validate price is numeric
    if (!is_numeric($price) || $price < 0) {
      die("Error: Price must be a valid number.");
    }

    // Validate main image is uploaded
    if (empty($_FILES['image']['name'])) {
      die("Error: Main image is required.");
    }

    $tbl_name = 'packages';

    $arr = [
      'title'                => $title,
      'destination_id'       => $destination_id,
      'location'             => $location,
      'price'                => $price,
      'description'          => $desc,
      'customize_packages'   => $customize_packages,   // ← new
      'amazing_destinations' => $amazing_destinations, // ← new
    ];

    // Validate image file types (webp only)
    $allowed_types = ['image/webp'];
    $toValidate = ['image', 'gallery_1', 'gallery_2', 'gallery_3', 'gallery_4'];
    foreach ($toValidate as $f) {
      if (!empty($_FILES[$f]['name']) && !in_array($_FILES[$f]['type'], $allowed_types)) {
        die("Error: '$f' must be a WEBP image file.");
      }
    }

    // Map file inputs -> DB columns
    $filesMap = [
      'image'     => 'image',
      'gallery_1' => 'gallery_1',
      'gallery_2' => 'gallery_2',
      'gallery_3' => 'gallery_3',
      'gallery_4' => 'gallery_4',
    ];

    $obj->insert_data($tbl_name, $arr, $filesMap);

    header("Location: manage-data.php?type=packages");
    exit();
  }
}

// Categories
if ($type === 'categories') {
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    // Validate required fields
    $required_fields = ['destination_name'];
    foreach ($required_fields as $field) {
      if (empty($_POST[$field])) {
        die("Error: '$field' is required.");
      }
    }

    // Sanitize user input
    $destination_name = trim($_POST['destination_name']);

    // Validate image is uploaded
    if (empty($_FILES['image']['name'])) {
      die("Error: Destination image is required.");
    }

    // Validate image file type (webp only)
    $allowed_types = ['image/webp'];
    if (!in_array($_FILES['image']['type'], $allowed_types)) {
      die("Error: Image must be a WEBP file.");
    }

    $tbl_name = 'destination';

    $arr = [
      'destination_name' => $destination_name,
    ];

    $filesMap = [
      'image' => 'image',
    ];

    $obj->insert_data($tbl_name, $arr, $filesMap);

    header("Location: manage-data.php?type=categories");
    exit();
  }
}

// Testimonials
if ($type === 'testimonial') {
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Validate required fields
    $required_fields = ['name', 'designation', 'review'];
    foreach ($required_fields as $field) {
      if (empty($_POST[$field])) {
        die("Error: '$field' is required.");
      }
    }

    // Sanitize user input
    $name = trim($_POST['name']);
    $designation = trim($_POST['designation']);
    $review = trim($_POST['review']);

    $tbl_name = 'testimonial';

    $arr = [
      'name' => $name,
      'designation' => $designation,
      'review' => $review
    ];

    // Call insert_data with both image keys
    $obj->insert_data($tbl_name, $arr);

    header("Location: manage-data.php?type=testimonial");
    exit();
  }
}

// Blogs
if ($type === 'blog') {
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    // Validate required fields (only fields that exist in DB)
    $required_fields = ['heading', 'desc'];
    foreach ($required_fields as $field) {
      if (empty($_POST[$field])) {
        die("Error: '$field' is required.");
      }
    }

    // Sanitize user input
    $heading = trim($_POST['heading']);
    $desc    = trim($_POST['desc']);

    // Validate image is required
    if (empty($_FILES['image']['name'])) {
      die("Error: Blog image is required.");
    }

    // Validate image file type (webp only)
    $allowed_types = ['image/webp'];
    if (!in_array($_FILES['image']['type'], $allowed_types)) {
      die("Error: Image must be a WEBP file.");
    }

    $tbl_name = 'blogs';

    $arr = [
      'heading'     => $heading,
      'description' => $desc,
    ];

    $filesMap = [
      'image' => 'image',
    ];

    $obj->insert_data($tbl_name, $arr, $filesMap);

    header("Location: manage-data.php?type=blog");
    exit();
  }
}

?>

<?php
/**
 * admin/add-data.php  — PACKAGES section only (drop this into your existing file)
 *
 * Changes vs original:
 *  1. subcategory_id is now included in $arr and saved to DB
 *  2. get-subcategories.php AJAX endpoint feeds the subcategory dropdown
 *
 * All other sections (categories, testimonial, blog, etc.) are UNCHANGED.
 */

// session_start();
// if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
//   header("Location: login.php");
//   exit;
// }

// include_once('../config/db.php');
// $obj = new database();
// $type = $_GET['type'] ?? null;

// ─── Packages ────────────────────────────────────────────────────────────────
if ($type === 'packages') {
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $required_fields = ['title', 'destination_id', 'location', 'desc', 'price'];
    foreach ($required_fields as $field) {
      if (empty($_POST[$field])) {
        die("Error: '$field' is required.");
      }
    }

    $title                = trim($_POST['title']);
    $destination_id       = trim($_POST['destination_id']);
    $subcategory_id       = !empty($_POST['subcategory_id']) ? intval($_POST['subcategory_id']) : null;
    $location             = trim($_POST['location']);
    $desc                 = trim($_POST['desc']);
    $price                = trim($_POST['price']);
    $customize_packages   = isset($_POST['customize_packages'])   ? 1 : 0;
    $amazing_destinations = isset($_POST['amazing_destinations']) ? 1 : 0;

    if (!is_numeric($destination_id) || $destination_id <= 0) {
      die("Error: Please select a valid destination.");
    }
    if (!is_numeric($price) || $price < 0) {
      die("Error: Price must be a valid number.");
    }
    if (empty($_FILES['image']['name'])) {
      die("Error: Main image is required.");
    }

    $tbl_name = 'packages';

    $arr = [
      'title'                => $title,
      'destination_id'       => $destination_id,
      'subcategory_id'       => $subcategory_id,   // ← saved to DB
      'location'             => $location,
      'price'                => $price,
      'description'          => $desc,
      'customize_packages'   => $customize_packages,
      'amazing_destinations' => $amazing_destinations,
    ];

    $allowed_types = ['image/webp'];
    $toValidate = ['image', 'gallery_1', 'gallery_2', 'gallery_3', 'gallery_4'];
    foreach ($toValidate as $f) {
      if (!empty($_FILES[$f]['name']) && !in_array($_FILES[$f]['type'], $allowed_types)) {
        die("Error: '$f' must be a WEBP image file.");
      }
    }

    $filesMap = [
      'image'     => 'image',
      'gallery_1' => 'gallery_1',
      'gallery_2' => 'gallery_2',
      'gallery_3' => 'gallery_3',
      'gallery_4' => 'gallery_4',
    ];

    $obj->insert_data($tbl_name, $arr, $filesMap);

    header("Location: manage-data.php?type=packages");
    exit();
  }
}

// ─── (All other $type handlers — categories, testimonial, blog, etc. —
//      are IDENTICAL to your original add-data.php. Keep them as-is.) ──────
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Orbiter is a bootstrap minimal & clean admin template">
  <meta name="keywords"
    content="admin, admin panel, admin template, admin dashboard, responsive, bootstrap 4, ui kits, ecommerce, web app, crm, cms, html, sass support, scss">
  <meta name="author" content="Themesbox">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <?php
  include_once('./includes/header-link.php');
  ?>
</head>

<body class="vertical-layout">

  <div class="infobar-settings-sidebar-overlay"></div>
  <!-- End Infobar Setting Sidebar -->
  <!-- Start Containerbar -->
  <div id="containerbar">
    <!-- Start Leftbar -->

    <?php
    include_once('./includes/leftbar.php');
    ?>
    <!-- End Leftbar -->
    <!-- Start Rightbar -->
    <div class="rightbar">
      <!-- Start Topbar Mobile -->
      <?php
      include_once('./includes/mobile-topbar.php');
      ?>
      <!-- Start Topbar -->
      <?php
      include_once('./includes/topbar.php');
      ?>
      <!-- End Topbar -->

      <?php
      if ($type === 'packages') {
      ?>
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Welcome India Holidays</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.PHP">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Packages</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- End Breadcrumbbar -->

        <!-- Start Contentbar -->
        <div class="contentbar">
          <!-- Start row -->
          <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
              <div class="card m-b-30">
                <div class="card-header">
                  <h5 class="card-title">Add Package</h5>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Destination <span class="text-danger">*</span></label>
                        <select class="select2-single form-control" name="destination_id" required>
                          <option value="">Select Destination</option>
                          <?php
                          $destinations = $obj->select_data('destination');
                          foreach ($destinations as $dest) { ?>
                            <option value="<?php echo $dest['id']; ?>">
                              <?php echo ucwords($dest['destination_name']); ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>



                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" placeholder="Location" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control" placeholder="Price" min="0" step="0.01" required>
                      </div>
                    </div>


                    <div class="form-group col-md-6">
                      <label>Subcategory</label>
                      <select class="form-control" name="subcategory_id" id="subcategory_id" required>
                        <option value="">Select Subcategory</option>
                        <!-- Options dynamically loaded via AJAX -->
                      </select>
                    </div>

                    <!-- Checkbox Options -->
                    <div class="form-row my-3">
                      <div class="form-group col-md-6">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input"
                            name="customize_packages" id="customize_packages" value="1">
                          <label class="custom-control-label" for="customize_packages">
                            Customize Package
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input"
                            name="amazing_destinations" id="amazing_destinations" value="1">
                          <label class="custom-control-label" for="amazing_destinations">
                            Amazing Destination
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" name="desc" id="editor" placeholder="Content" rows="5"></textarea>
                    </div>

                    <div class="form-row">
                      <span class="my-4 mx-auto text-primary" style="font-size: 17px;">
                        Please upload images with dimensions 852 x 536 pixels, preferably in .webp format.
                      </span>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Image <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" accept="image/webp" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Gallery 1</label>
                        <input type="file" name="gallery_1" class="form-control" accept="image/webp">
                      </div>
                      <div class="form-group col-md-4">
                        <label>Gallery 2</label>
                        <input type="file" name="gallery_2" class="form-control" accept="image/webp">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Gallery 3</label>
                        <input type="file" name="gallery_3" class="form-control" accept="image/webp">
                      </div>
                      <div class="form-group col-md-4">
                        <label>Gallery 4</label>
                        <input type="file" name="gallery_4" class="form-control" accept="image/webp">
                      </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary mt-3">Add Package</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- End col -->
          </div> <!-- End row -->
        </div>
        <!-- End Contentbar -->
      <?php
      }
      ?>

      <?php
      if ($type === 'categories') {
      ?>
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Welcome India Holidays</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.PHP">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Categories</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- End Breadcrumbbar -->

        <!-- Start Contentbar -->
        <div class="contentbar">
          <!-- Start row -->
          <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
              <div class="card m-b-30">
                <div class="card-header">
                  <h5 class="card-title">Add Category</h5>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Destination Name <span class="text-danger">*</span></label>
                        <input type="text" name="destination_name" class="form-control" placeholder="Destination Name" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Image <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" accept="image/webp" required>
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-3">Add Destination</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- End col -->
          </div> <!-- End row -->
        </div>
        <!-- End Contentbar -->
      <?php
      }
      ?>

      <?php
      if ($type === 'gallery') {
      ?>
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Welcome India Holidays</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.PHP">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- End Breadcrumbbar -->

        <!-- Start Contentbar -->
        <div class="contentbar">
          <!-- Start row -->
          <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
              <div class="card m-b-30">
                <div class="card-header">
                  <h5 class="card-title">Add Gallery Image's</h5>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="inputAddress">Image</label>
                        <input type="file" name="image" class="form-control" accept="image/webp" required="">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputAddress">Gallery 1</label>
                        <input type="file" name="gallery_1" class="form-control" accept="image/webp">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputAddress">Gallery 2</label>
                        <input type="file" name="gallery_2" class="form-control" accept="image/webp">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="inputAddress">Gallery 3</label>
                        <input type="file" name="gallery_3" class="form-control" accept="image/webp">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputAddress">Gallery 4</label>
                        <input type="file" name="gallery_4" class="form-control" accept="image/webp">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputAddress">Gallery 5</label>
                        <input type="file" name="gallery_5" class="form-control" accept="image/webp">
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-3">Add</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- End col -->
          </div> <!-- End row -->
        </div>
        <!-- End Contentbar -->
      <?php
      }
      ?>

      <?php
      if ($type === 'testimonial') {
      ?>
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Welcome India Holidays</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.PHP">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Testimonial</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- End Breadcrumbbar -->

        <!-- Start Contentbar -->
        <div class="contentbar">
          <!-- Start row -->
          <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
              <div class="card m-b-30">
                <div class="card-header">
                  <h5 class="card-title">Add Review's</h5>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Designation</label>
                        <input type="text" name="designation" class="form-control" placeholder="Designation" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Review</label>
                      <textarea class="form-control" name="review" placeholder="Review" rows="5" required></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-3">Add</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- End col -->
          </div> <!-- End row -->
        </div>
        <!-- End Contentbar -->
      <?php
      }
      ?>

      <?php
      if ($type === 'blog') {
      ?>
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Welcome India Holidays</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.PHP">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- End Breadcrumbbar -->

        <!-- Start Contentbar -->
        <div class="contentbar">
          <!-- Start row -->
          <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
              <div class="card m-b-30">
                <div class="card-header">
                  <h5 class="card-title">Add Blog</h5>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Heading <span class="text-danger">*</span></label>
                        <input type="text" name="heading" class="form-control" placeholder="Heading" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Image <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" accept="image/webp" required>
                        <small class="text-muted">Upload an image with dimensions 872 x 490 pixels in .webp format.</small>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Description <span class="text-danger">*</span></label>
                      <textarea class="form-control" name="desc" id="editor" placeholder="Description" rows="5" required></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary mt-3">Add Blog</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- End col -->
          </div> <!-- End row -->
        </div>
        <!-- End Contentbar -->
      <?php
      }
      ?>

      <?php
      if ($type === 'iconic-destination') {
      ?>
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Welcome India Holidays</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.PHP">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Iconic Destination</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- End Breadcrumbbar -->

        <!-- Start Contentbar -->
        <div class="contentbar">
          <!-- Start row -->
          <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
              <div class="card m-b-30">
                <div class="card-header">
                  <h5 class="card-title">Add Images</h5>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Heading</label>
                        <input type="text" name="title" class="form-control" placeholder="Heading" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputAddress">Image</label>
                        <input type="file" name="image" class="form-control" accept="image/webp" placeholder="Title" required>
                        <span>Upload an image with dimensions 872 x 490 pixels & .webp format.</span>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Image Alt Text</label>
                        <input type="text" name="img_alt_text" class="form-control" placeholder="Image Alt Text" required>
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-3">Add</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- End col -->
          </div> <!-- End row -->
        </div>
        <!-- End Contentbar -->
      <?php
      }
      ?>

      <?php
      if ($type === 'amazing-destination') {
      ?>
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Welcome India Holidays</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.PHP">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Amazing Destination</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- End Breadcrumbbar -->

        <!-- Start Contentbar -->
        <div class="contentbar">
          <!-- Start row -->
          <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
              <div class="card m-b-30">
                <div class="card-header">
                  <h5 class="card-title">Add Images</h5>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Heading</label>
                        <input type="text" name="title" class="form-control" placeholder="Heading" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputAddress">Image</label>
                        <input type="file" name="image" class="form-control" accept="image/webp" placeholder="Title" required>
                        <span>Upload an image with dimensions 936 x 930 pixels & .webp format.</span>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Image Alt Text</label>
                        <input type="text" name="img_alt_text" class="form-control" placeholder="Image Alt Text" required>
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-3">Add</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- End col -->
          </div> <!-- End row -->
        </div>
        <!-- End Contentbar -->
      <?php
      }
      ?>




      <?php if ($type === 'packages'): ?>
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Welcome India Holidays</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Packages</li>
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
                  <h5 class="card-title">Add Package</h5>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="Title" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Destination <span class="text-danger">*</span></label>
                        <select class="select2-single form-control" name="destination_id" id="destination_id" required>
                          <option value="">Select Destination</option>
                          <?php
                          $destinations = $obj->select_data('destination');
                          foreach ($destinations as $dest) { ?>
                            <option value="<?php echo $dest['id']; ?>">
                              <?php echo ucwords($dest['destination_name']); ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <!-- Subcategory — populated via AJAX when destination changes -->
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Sub-Category
                          <small class="text-muted">(Select Destination first)</small>
                        </label>
                        <select class="form-control" name="subcategory_id" id="subcategory_id">
                          <option value="">Select Subcategory</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Location <span class="text-danger">*</span></label>
                        <input type="text" name="location" class="form-control" placeholder="Location" required>
                      </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Price <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control" placeholder="Price" min="0" step="0.01" required>
                      </div>
                    </div>

                    <!-- Checkboxes -->
                    <div class="form-row my-3">
                      <div class="form-group col-md-6">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" name="customize_packages" id="customize_packages" value="1">
                          <label class="custom-control-label" for="customize_packages">Customize Package</label>
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" name="amazing_destinations" id="amazing_destinations" value="1">
                          <label class="custom-control-label" for="amazing_destinations">Amazing Destination</label>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" name="desc" id="editor" placeholder="Content" rows="5"></textarea>
                    </div>

                    <div class="form-row">
                      <span class="my-4 mx-auto text-primary" style="font-size:17px;">
                        Please upload images with dimensions 852 × 536 px in .webp format.
                      </span>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Main Image <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" accept="image/webp" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Gallery 1</label>
                        <input type="file" name="gallery_1" class="form-control" accept="image/webp">
                      </div>
                      <div class="form-group col-md-4">
                        <label>Gallery 2</label>
                        <input type="file" name="gallery_2" class="form-control" accept="image/webp">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Gallery 3</label>
                        <input type="file" name="gallery_3" class="form-control" accept="image/webp">
                      </div>
                      <div class="form-group col-md-4">
                        <label>Gallery 4</label>
                        <input type="file" name="gallery_4" class="form-control" accept="image/webp">
                      </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary mt-3">Add Package</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>


      <!-- Start Footerbar -->
      <?php
      include_once('./includes/footer.php');
      ?>
      <!-- End Footerbar -->
    </div>
    <!-- End Rightbar -->
  </div>
  <!-- End Containerbar -->
  <?php
  include_once('./includes/footer-link.php');
  ?>


  <!-- Your existing HTML content here -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('select[name="destination_id"]').change(function() {
        var destination_id = $(this).val();
        if (destination_id) {
          $.ajax({
            type: 'POST',
            url: 'get-subcategories.php',
            data: {
              destination_id: destination_id
            },
            success: function(html) {
              $('#subcategory_id').html(html);
            }
          });
        } else {
          $('#subcategory_id').html('<option value="">Select Subcategory</option>');
        }
      });
    });
  </script>
  <script>
    $(function() {
      $('#destination_id').on('change', function() {
        var dest_id = $(this).val();
        var $sub = $('#subcategory_id');

        if (!dest_id) {
          $sub.html('<option value="">Select Subcategory</option>');
          return;
        }

        $.ajax({
          type: 'POST',
          url: 'get-subcategories.php', // must be in same admin/ folder
          data: {
            destination_id: dest_id
          },
          success: function(html) {
            $sub.html(html);
          },
          error: function() {
            $sub.html('<option value="">Error loading subcategories</option>');
          }
        });
      });
    });
  </script>


</body>

</html>