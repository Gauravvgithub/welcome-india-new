<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: login.php");
  exit;
}

include_once('../config/db.php');
$obj = new database();


$type = $_GET['type'] ?? null;
$id = $_GET['id'] ?? null;

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
    $title                = trim($_POST['title']);
    $destination_id       = trim($_POST['destination_id']);
    $location             = trim($_POST['location']);
    $desc                 = trim($_POST['desc']);
    $price                = trim($_POST['price']);
    $customize_packages   = isset($_POST['customize_packages']) ? 1 : 0;   // ← new
    $amazing_destinations = isset($_POST['amazing_destinations']) ? 1 : 0; // ← new

    // Validate destination is a valid number
    if (!is_numeric($destination_id) || $destination_id <= 0) {
      die("Error: Please select a valid destination.");
    }

    // Validate price is numeric
    if (!is_numeric($price) || $price < 0) {
      die("Error: Price must be a valid number.");
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

    // Validate image file types (webp only) if new images uploaded
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

    $id        = intval($_GET['id']);
    $condition = "id = $id";

    $obj->update_data($tbl_name, $arr, $condition, $filesMap);

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

    $tbl_name = 'destination';

    $arr = [
      'destination_name' => $destination_name,
    ];

    $id = intval($_GET['id']);
    $condition = "id = $id";

    // Validate image file type if new image uploaded
    if (!empty($_FILES['image']['name'])) {
      $allowed_types = ['image/webp'];
      if (!in_array($_FILES['image']['type'], $allowed_types)) {
        die("Error: Image must be a WEBP file.");
      }
      $filesMap = ['image' => 'image'];
    } else {
      $filesMap = [];  // No new image, keep existing
    }

    $obj->update_data($tbl_name, $arr, $condition, $filesMap);

    header("Location: manage-data.php?type=categories");
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

    $tbl_name = 'blogs';

    $arr = [
      'heading'     => $heading,
      'description' => $desc,
    ];

    // Validate image file type if new image uploaded
    if (!empty($_FILES['image']['name'])) {
      $allowed_types = ['image/webp'];
      if (!in_array($_FILES['image']['type'], $allowed_types)) {
        die("Error: Blog image must be in WEBP format.");
      }
      $filesMap = ['image' => 'image'];
    } else {
      $filesMap = [];  // No new image, keep existing
    }

    // Validate ID
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      die("Invalid or missing ID.");
    }

    $id        = intval($_GET['id']);
    $condition = "id = $id";

    $obj->update_data($tbl_name, $arr, $condition, $filesMap);

    header("Location: manage-data.php?type=blog");
    exit();
  }
}

// Testimonial
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

    $id = intval($_GET['id']);
    $condition = "id = $id";

    // Update the data with possible images
    $obj->update_data($tbl_name, $arr, $condition);

    // Redirect
    header("Location: manage-data.php?type=testimonial");
    exit();
  }
}

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
                  <h5 class="card-title">Edit Package</h5>
                </div>
                <div class="card-body">
                  <?php
                  $packages = $obj->select_data('packages', "id = '$id'");
                  foreach ($packages as $package) {
                  ?>
                    <form action="" method="post" enctype="multipart/form-data">

                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>Title</label>
                          <input type="text" name="title" class="form-control" placeholder="Title"
                            value="<?php echo htmlspecialchars($package['title']); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Destination <span class="text-danger">*</span></label>
                          <?php $destinations = $obj->select_data('destination'); ?>
                          <select class="select2-single form-control" name="destination_id" required>
                            <option value="">Select Destination</option>
                            <?php foreach ($destinations as $dest) { ?>
                              <option value="<?php echo $dest['id']; ?>"
                                <?php echo ($package['destination_id'] == $dest['id']) ? 'selected' : ''; ?>>
                                <?php echo ucwords(htmlspecialchars($dest['destination_name'])); ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>Location</label>
                          <input type="text" name="location" class="form-control" placeholder="Location"
                            value="<?php echo htmlspecialchars($package['location']); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Price</label>
                          <input type="number" name="price" class="form-control" placeholder="Price"
                            value="<?php echo htmlspecialchars($package['price']); ?>" min="0" step="0.01" required>
                        </div>
                      </div>

                      <!-- Checkbox Options with current DB values pre-checked -->
                      <div class="form-row my-3">
                        <div class="form-group col-md-6">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                              name="customize_packages" id="customize_packages" value="1"
                              <?php echo ($package['customize_packages'] == 1) ? 'checked' : ''; ?>> <!-- ← pre-checked -->
                            <label class="custom-control-label" for="customize_packages">
                              Customize Package
                            </label>
                          </div>
                        </div>
                        <div class="form-group col-md-6">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                              name="amazing_destinations" id="amazing_destinations" value="1"
                              <?php echo ($package['amazing_destinations'] == 1) ? 'checked' : ''; ?>> <!-- ← pre-checked -->
                            <label class="custom-control-label" for="amazing_destinations">
                              Amazing Destination
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="desc" id="editor" placeholder="Content"
                          rows="5"><?php echo htmlspecialchars($package['description']); ?></textarea>
                      </div>

                      <div class="form-row">
                        <span class="my-4 mx-auto text-primary" style="font-size: 17px;">
                          Leave image fields empty to keep current images. Upload to replace.
                        </span>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label>Image</label>
                          <input type="file" name="image" class="form-control" accept="image/webp">
                          <?php if (!empty($package['image'])) { ?>
                            <img src="<?php echo htmlspecialchars($package['image']); ?>" width="180px" class="mt-2" alt="Main Image">
                          <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Gallery 1</label>
                          <input type="file" name="gallery_1" class="form-control" accept="image/webp">
                          <?php if (!empty($package['gallery_1'])) { ?>
                            <img src="<?php echo htmlspecialchars($package['gallery_1']); ?>" width="180px" class="mt-2" alt="Gallery 1">
                          <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Gallery 2</label>
                          <input type="file" name="gallery_2" class="form-control" accept="image/webp">
                          <?php if (!empty($package['gallery_2'])) { ?>
                            <img src="<?php echo htmlspecialchars($package['gallery_2']); ?>" width="180px" class="mt-2" alt="Gallery 2">
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label>Gallery 3</label>
                          <input type="file" name="gallery_3" class="form-control" accept="image/webp">
                          <?php if (!empty($package['gallery_3'])) { ?>
                            <img src="<?php echo htmlspecialchars($package['gallery_3']); ?>" width="180px" class="mt-2" alt="Gallery 3">
                          <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Gallery 4</label>
                          <input type="file" name="gallery_4" class="form-control" accept="image/webp">
                          <?php if (!empty($package['gallery_4'])) { ?>
                            <img src="<?php echo htmlspecialchars($package['gallery_4']); ?>" width="180px" class="mt-2" alt="Gallery 4">
                          <?php } ?>
                        </div>
                      </div>

                      <button type="submit" name="submit" class="btn btn-primary mt-3">Update Package</button>
                    </form>
                  <?php } ?>
                </div>
              </div>
            </div>
            <!-- End col -->
          </div> <!-- End row -->
        </div>
        <!-- End  Contentbar -->
      <?php
      }
      ?>

      <?php
      if ($type === 'service') {
      ?>
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Welcome India Holidays</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Services</li>
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
                  <h5 class="card-title">Edit Service</h5>
                </div>
                <div class="card-body">
                  <?php
                  $services = $obj->select_data('service', "id = '$id'");
                  foreach ($services as $service) {
                  ?>
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>Heading</label>
                          <input type="text" name="heading" class="form-control" placeholder="Heading" required value="<?php echo $service['heading'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                          <label>Slug</label>
                          <input type="text" name="slug" class="form-control" placeholder="Slug" required value="<?php echo $service['slug'] ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputAddress">Description</label>
                        <textarea class="form-control" name="desc" id="editor" placeholder="Description" rows="5" required><?php echo $service['description'] ?></textarea>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputAddress">Image</label>
                          <input type="file" name="image" class="form-control" accept="image/webp" placeholder="Title">
                          <span>Upload an image with dimensions 872 x 536 pixels & .webp format.</span>
                          <img class="mt-2" src="<?php echo $service['image'] ?>" width="150px" alt=""> <br>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputAddress">Gallery 1</label>
                          <input type="file" name="gallery_1" class="form-control" accept="image/webp" placeholder="Title">
                          <span>Upload an image with dimensions 872 x 536 pixels & .webp format.</span>
                          <img class="mt-2" src="<?php echo $service['gallery_1'] ?>" width="150px" alt=""> <br>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputAddress">Gallery 2</label>
                          <input type="file" name="gallery_2" class="form-control" accept="image/webp" placeholder="Title">
                          <span>Upload an image with dimensions 872 x 536 pixels & .webp format.</span>
                          <img class="mt-2" src="<?php echo $service['gallery_2'] ?>" width="150px" alt=""> <br>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label>Image Alt Text</label>
                          <input type="text" name="img_alt_text" class="form-control" placeholder="Image Alt Text" required value="<?php echo $service['img_alt_text'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Gallery 1 Alt Text</label>
                          <input type="text" name="gallery1_alt_text" class="form-control" placeholder="Gallery 1 Alt Text" required value="<?php echo $service['gallery1_img_alt_text'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Gallery 2 Alt Text</label>
                          <input type="text" name="gallery2_alt_text" class="form-control" placeholder="Gallery 2 Alt Text" required value="<?php echo $service['gallery2_img_alt_text'] ?>">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="inputAddress">Meta Title</label>
                          <textarea class="form-control" name="meta_title" placeholder="Meta Title" rows="3" required><?php echo $service['meta_title'] ?></textarea>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputAddress">Meta Keywords</label>
                          <textarea class="form-control" name="meta_keywords" placeholder="Meta Keywords" rows="3" required><?php echo $service['meta_keywords'] ?></textarea>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputAddress">Meta Description</label>
                          <textarea class="form-control" name="meta_desc" placeholder="Meta Description" rows="3" required><?php echo $service['meta_desc'] ?></textarea>
                        </div>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary mt-3">Edit</button>
                    </form>
                  <?php
                  }
                  ?>
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
      if ($type === 'about') {
      ?>
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Welcome India Holidays</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">About</li>
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
                  <h5 class="card-title">Edit About</h5>
                </div>
                <div class="card-body">
                  <?php
                  $about = $obj->select_data('about', "id = '$id'");
                  foreach ($about as $about_det) {
                  ?>
                  <?php
                  }
                  ?>
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label>Heading</label>
                        <input type="text" class="form-control" name="heading" id="inputEmail4" placeholder="Heading" required value="<?php echo $about_det['heading'] ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" name="desc" id="editor" placeholder="Content" rows="5" required><?php echo $about_det['description'] ?></textarea>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Image One</label>
                        <input type="file" name="image_one" class="form-control" placeholder="Title" accept="image/webp">
                        <img src="<?php echo $about_det['image_one'] ?>" width="150px" alt="">
                        <span>Please upload an image with dimensions 312 x 630 pixels, preferably in .webp format.</span>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Image One Alt Text</label>
                        <input type="text" name="image_one_alt_text" class="form-control" id="inputEmail4" placeholder="Image Alt Text" required value="<?php echo $about_det['img_one_alt_text'] ?>">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Image Two</label>
                        <input type="file" name="image_two" class="form-control" placeholder="Title" accept="image/webp">
                        <img src="<?php echo $about_det['image_two'] ?>" width="150px" alt="">
                        <span>Please upload an image with dimensions 312 x 310 pixels, preferably in .webp format.</span>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Image Two Alt Text</label>
                        <input type="text" name="image_two_alt_text" class="form-control" id="inputEmail4" placeholder="Image Alt Text" required value="<?php echo $about_det['img_two_alt_text'] ?>">
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-3">Edit</button>
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
      if ($type === 'our-story') {
      ?>
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Welcome India Holidays</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Our Story</li>
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
                  <h5 class="card-title">Edit Our Story</h5>
                </div>
                <div class="card-body">
                  <?php
                  $our_story = $obj->select_data('our_story', "id = '$id'");
                  foreach ($our_story as $our_story_det) {
                  ?>
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <label>Heading</label>
                          <input type="text" class="form-control" name="heading" id="inputEmail4" placeholder="Heading" required value="<?php echo $our_story_det['heading'] ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" id="editor" placeholder="Content" rows="5" required><?php echo $our_story_det['description'] ?></textarea>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary mt-3">Edit</button>
                    </form>
                  <?php
                  }
                  ?>
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
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
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
                  <h5 class="card-title">Edit Category</h5>
                </div>
                <div class="card-body">
                  <?php
                  $destinations = $obj->select_data('destination', "id = '$id'");
                  foreach ($destinations as $dest) {
                  ?>
                    <form action="" method="post" enctype="multipart/form-data">

                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>Destination Name <span class="text-danger">*</span></label>
                          <input type="text"
                            name="destination_name"
                            class="form-control"
                            placeholder="Destination Name"
                            value="<?php echo htmlspecialchars($dest['destination_name']); ?>"
                            required>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Image <small class="text-muted">(Leave empty to keep current image)</small></label>
                          <input type="file" name="image" class="form-control" accept="image/webp">
                        </div>
                      </div>

                      <!-- Show current image -->
                      <?php if (!empty($dest['image'])) { ?>
                        <div class="form-row mb-3">
                          <div class="col-md-3">
                            <label>Current Image</label><br>
                            <img src="<?php echo htmlspecialchars($dest['image']); ?>"
                              width="150px"
                              alt="<?php echo htmlspecialchars($dest['destination_name']); ?>">
                          </div>
                        </div>
                      <?php } ?>

                      <button type="submit" name="submit" class="btn btn-primary mt-3">Update Destination</button>
                    </form>
                  <?php } ?>
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
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
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
                  <h5 class="card-title">Edit Review's</h5>
                </div>
                <div class="card-body">
                  <?php
                  $testimonials = $obj->select_data('testimonial', "id = '$id'");
                  foreach ($testimonials as $testimonial) {
                  ?>
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>Name</label>
                          <input type="text" name="name" class="form-control" placeholder="Name" required value="<?php echo $testimonial['name']  ?>">
                        </div>
                        <div class="form-group col-md-6">
                          <label>Designation</label>
                          <input type="text" name="designation" class="form-control" placeholder="Designation" required value="<?php echo $testimonial['designation']  ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Review</label>
                        <textarea class="form-control" name="review" placeholder="Review" rows="5" required><?php echo $testimonial['review']  ?></textarea>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary mt-3">Edit</button>
                    </form>
                  <?php
                  }
                  ?>
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
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
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
                  <h5 class="card-title">Edit Blog</h5>
                </div>
                <div class="card-body">
                  <?php
                  $blogs = $obj->select_data('blogs', "id = '$id'");
                  foreach ($blogs as $blog) {
                  ?>
                    <form action="" method="post" enctype="multipart/form-data">

                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>Heading <span class="text-danger">*</span></label>
                          <input type="text" name="heading" class="form-control" placeholder="Heading"
                            value="<?php echo htmlspecialchars($blog['heading']); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Image <small class="text-muted">(Leave empty to keep current image)</small></label>
                          <input type="file" name="image" class="form-control" accept="image/webp">
                          <small class="text-muted">Upload an image with dimensions 872 x 490 pixels in .webp format.</small>
                          <?php if (!empty($blog['image'])) { ?>
                            <img src="<?php echo htmlspecialchars($blog['image']); ?>"
                              width="250px" class="mt-2"
                              alt="<?php echo htmlspecialchars($blog['heading']); ?>">
                          <?php } ?>
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="desc" id="editor" placeholder="Description"
                          rows="5" required><?php echo htmlspecialchars($blog['description']); ?></textarea>
                      </div>

                      <button type="submit" name="submit" class="btn btn-primary mt-3">Update Blog</button>
                    </form>
                  <?php } ?>
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
                  <h5 class="card-title">Edit Images</h5>
                </div>
                <div class="card-body">
                  <?php
                  $iconic_des = $obj->select_data('iconic_des', "id = '$id'");
                  foreach ($iconic_des as $iconic_des_det) {
                  ?>
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label>Heading</label>
                          <input type="text" name="title" class="form-control" placeholder="Heading" required value="<?php echo $iconic_des_det['title'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputAddress">Image</label>
                          <input type="file" name="image" class="form-control" accept="image/webp" placeholder="Title">
                          <img src="<?php echo $iconic_des_det['image'] ?>" width="150px" alt=""> <br>
                          <span>Upload an image with dimensions 872 x 490 pixels & .webp format.</span>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Image Alt Text</label>
                          <input type="text" name="img_alt_text" class="form-control" placeholder="Image Alt Text" required value="<?php echo $iconic_des_det['img_alt_text'] ?>">
                        </div>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary mt-3">Edit</button>
                    </form>
                  <?php
                  }
                  ?>
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
                  <h5 class="card-title">Edit Images</h5>
                </div>
                <div class="card-body">
                  <?php
                  $amazing_des = $obj->select_data('amazing_des', "id = '$id'");
                  foreach ($amazing_des as $amazing_des_det) {
                  ?>
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label>Heading</label>
                          <input type="text" name="title" class="form-control" placeholder="Heading" required value="<?php echo $amazing_des_det['title'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputAddress">Image</label>
                          <input type="file" name="image" class="form-control" accept="image/webp" placeholder="Title">
                          <img src="<?php echo $amazing_des_det['image'] ?>" width="150px" alt=""> <br>
                          <span>Upload an image with dimensions 936 x 930 pixels & .webp format.</span>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Image Alt Text</label>
                          <input type="text" name="img_alt_text" class="form-control" placeholder="Image Alt Text" required value="<?php echo $amazing_des_det['img_alt_text'] ?>">
                        </div>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary mt-3">Edit</button>
                    </form>
                  <?php
                  }
                  ?>
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
      if ($type === 'home-meta') {
      ?>
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Welcome India Holidays</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Home Meta</li>
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
                  <h5 class="card-title">Edit Home Meta</h5>
                </div>
                <div class="card-body">
                  <?php
                  $metas = $obj->select_data('home_meta', "id = '$id'");
                  foreach ($metas as $meta) {
                  ?>
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Meta Title</label>
                        <textarea class="form-control" name="meta_title" placeholder="Meta Title" rows="3" required><?php echo $meta['meta_title'] ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Meta Keywords</label>
                        <textarea class="form-control" name="meta_keywords" placeholder="Meta Keywords" rows="3" required><?php echo $meta['meta_keywords'] ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Meta Description</label>
                        <textarea class="form-control" name="meta_desc" placeholder="Meta Description" rows="3" required><?php echo $meta['meta_description'] ?></textarea>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary mt-3">Edit</button>
                    </form>
                  <?php
                  }
                  ?>
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
      if ($type === 'about-meta') {
      ?>
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Welcome India Holidays</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">About Meta</li>
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
                  <h5 class="card-title">Edit About Meta</h5>
                </div>
                <div class="card-body">
                  <?php
                  $metas = $obj->select_data('about_meta', "id = '$id'");
                  foreach ($metas as $meta) {
                  ?>
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Meta Title</label>
                        <textarea class="form-control" name="meta_title" placeholder="Meta Title" rows="3" required><?php echo $meta['meta_title'] ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Meta Keywords</label>
                        <textarea class="form-control" name="meta_keywords" placeholder="Meta Keywords" rows="3" required><?php echo $meta['meta_keywords'] ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Meta Description</label>
                        <textarea class="form-control" name="meta_desc" placeholder="Meta Description" rows="3" required><?php echo $meta['meta_description'] ?></textarea>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary mt-3">Edit</button>
                    </form>
                  <?php
                  }
                  ?>
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
</body>

</html>