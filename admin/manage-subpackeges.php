<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: login.php");
  exit;
}

include_once '../config/db.php';
$obj = new database();

// Delete handle karo
if (isset($_GET['delete_id'])) {
  $del_id = (int)$_GET['delete_id'];
  $obj->delete_data('sub_packeges', "id = $del_id", ['image']);
  header("Location: manage-subpackeges.php");
  exit;
}

// Sare sub packages fetch karo with package title
$sub_packages = $obj->select_data('sub_packeges');
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

      <!-- Breadcrumb -->
      <div class="breadcrumbbar">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h4 class="page-title">Welcome India Holidays</h4>
            <div class="breadcrumb-list">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Manage Sub Packages</li>
              </ol>
            </div>
          </div>
          <div class="col-md-4 text-right">
            <a href="add-subpackeges.php?type=sub-packages" class="btn btn-primary">
              + Add Sub Package
            </a>
          </div>
        </div>
      </div>

      <!-- Content -->
      <div class="contentbar">
        <div class="row">
          <div class="col-lg-12">
            <div class="card m-b-30">
              <div class="card-header">
                <h5 class="card-title">All Sub Packages</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                      <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Package</th>
                        <th>Price (₹)</th>
                        <!-- <th>Duration</th> -->
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($sub_packages)): ?>
                        <?php foreach ($sub_packages as $i => $sub): 
                          // Parent package title fetch karo
                          $parent = $obj->select_data('packages', "id = {$sub['package_id']}");
                          $parent_title = !empty($parent) ? ucwords($parent[0]['title']) : 'N/A';
                          $img = str_replace('../', '', $sub['image']);
                        ?>
                        <tr>
                          <td><?php echo $i + 1; ?></td>
                          <td>
                            <img src="../<?php echo htmlspecialchars($img); ?>" 
                                 alt="<?php echo htmlspecialchars($sub['title']); ?>"
                                 style="width:80px; height:50px; object-fit:cover; border-radius:4px;">
                          </td>
                          <td><?php echo ucwords(htmlspecialchars($sub['title'])); ?></td>
                          <td><?php echo $parent_title; ?></td>
                          <td>₹<?php echo number_format($sub['price'], 2); ?></td>
                          <td>
                            <a href="edit-subpackage.php?id=<?php echo $sub['id']; ?>" 
                               class="btn btn-warning btn-sm">Edit</a>
                            <a href="manage-subpackeges.php?delete_id=<?php echo $sub['id']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Delete karna chahte hain?')">Delete</a>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="7" class="text-center">
                            Abhi koi sub package nahi hai. 
                            <a href="add-subpackeges.php?type=sub-packages">Add karein</a>
                          </td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
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