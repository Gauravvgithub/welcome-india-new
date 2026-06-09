<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: login.php");
  exit;
}

include_once('../config/db.php');
$obj = new database();

$type = $_GET['type'] ?? null;
?>

<?php
if ($type === 'packages' && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $title = trim($_POST['title']);
    $destination_id = intval($_POST['destination_id']);
    $subcategory_id = intval($_POST['subcategory_id']); // ← new
    $location = trim($_POST['location']);
    $price = trim($_POST['price']);
    $desc = trim($_POST['description']);
    $customize_packages = trim($_POST['customize_packages']);
    $amazing_destinations = trim($_POST['amazing_destinations']);

    // Image upload handling
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, '../uploads/packages/' . $image_name);
        $arr['image'] = 'uploads/packages/' . $image_name;
    }

    // Prepare data array
    $arr = [
        'title'                => $title,
        'destination_id'       => $destination_id,
        'subcategory_id'       => $subcategory_id,
        'location'             => $location,
        'price'                => $price,
        'description'          => $desc,
        'customize_packages'   => $customize_packages,
        'amazing_destinations' => $amazing_destinations,
    ];

    // Insert into DB
    $obj->insert_data('packages', $arr);

    // Redirect to same page after submit
    header("Location: manage-data.php?type=packages");
    exit;
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
        <!-- End Breadcrumbbar -->

        <!-- Start Contentbar -->
        <div class="contentbar">
          <!-- Start row -->
          <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
              <div class="card m-b-30">
                <div class="card-header">
                  <h5 class="card-title">Manage Packages</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Image</th>
                          <th scope="col">Destination</th> <!-- ← was Category -->
                          <th scope="col">Title</th>
                          <th scope="col">Location</th>
                          <th scope="col">Price</th>
                          <th scope="col">Action</th> <!-- ← removed Paxs -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $count = 0;
                        $packages = $obj->select_data('packages');
                        foreach ($packages as $package) {
                        ?>
                          <tr>
                            <th scope="row"><?php echo ++$count; ?></th>

                            <td>
                              <img src="<?php echo htmlspecialchars($package['image']); ?>" width="150px" alt="<?php echo htmlspecialchars($package['title']); ?>">
                            </td>

                            <!-- Fetch destination name via destination_id -->
                            <td>
                              <?php
                              $dest_id = intval($package['destination_id']);
                              $destinations = $obj->select_data('destination', "id = '$dest_id'");
                              foreach ($destinations as $dest) {
                                echo ucwords(htmlspecialchars($dest['destination_name']));
                              }
                              ?>
                            </td>

                            <td><?php echo htmlspecialchars($package['title']); ?></td>
                            <td><?php echo htmlspecialchars($package['location']); ?></td>
                            <td>₹<?php echo htmlspecialchars($package['price']); ?></td>

                            <td>
                              <a href="edit-data.php?type=packages&id=<?php echo $package['id']; ?>">
                                <button class="btn btn-primary-rgba mt-1">Update</button>
                              </a>
                              <a href="delete.php?type=packages&id=<?php echo $package['id']; ?>">
                                <button class="btn btn-danger-rgba mt-1">Delete</button>
                              </a>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End col -->
          </div>
          <!-- End row -->
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
                  <h5 class="card-title">Manage Categories</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Image</th> <!-- ← added -->
                          <th scope="col">Destination Name</th> <!-- ← was Heading -->
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $destinations = $obj->select_data('destination');  // ← was 'categories'
                        $count = 0;
                        foreach ($destinations as $dest) {
                        ?>
                          <tr>
                            <th scope="row"><?php echo ++$count; ?></th>
                            <td>
                              <img src="<?php echo htmlspecialchars($dest['image']); ?>"
                                width="300px"
                                alt="<?php echo htmlspecialchars($dest['destination_name']); ?>">
                            </td>
                            <td><?php echo ucwords(htmlspecialchars($dest['destination_name'])); ?></td> <!-- ← was $category['category'] -->
                            <td>
                              <a href="edit-data.php?type=categories&id=<?php echo $dest['id']; ?>"> <!-- ← was type=categories -->
                                <button class="btn btn-primary-rgba mt-1">Update</button>
                              </a>
                              <a href="delete.php?type=categories&id=<?php echo $dest['id']; ?>"> <!-- ← was type=categories -->
                                <button class="btn btn-danger-rgba mt-1">Delete</button>
                              </a>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End col -->
          </div>
          <!-- End row -->
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
                  <h5 class="card-title">Manage Testimonial</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Designation</th>
                          <th scope="col">Review</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $testimonials = $obj->select_data('testimonial');
                        $count = 0;
                        foreach ($testimonials as $testimonial) {
                        ?>
                          <tr>
                            <th scope="row"><?php echo ++$count; ?></th>
                            <td><?php echo $testimonial['name'] ?></td>
                            <td><?php echo $testimonial['designation'] ?></td>
                            <td><?php echo $testimonial['review'] ?></td>
                            <td>
                              <a href="edit-data.php?type=testimonial&id=<?php echo $testimonial['id'] ?>">
                                <button class="btn btn-primary-rgba mt-1">Update</button>
                              </a>
                              <a href="delete.php?type=testimonial&id=<?php echo $testimonial['id'] ?>">
                                <button class="btn btn-danger-rgba mt-1">Delete</button>
                              </a>
                            </td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End col -->
          </div>
          <!-- End row -->
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
                  <h5 class="card-title">Manage Blog</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Image</th>
                          <th scope="col">Heading</th>
                          <th scope="col">Description</th> <!-- kept, exists in DB -->
                          <!-- Slug removed ❌ not in DB -->
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $blogs = $obj->select_data('blogs');
                        $count = 0;
                        foreach ($blogs as $blog) {
                        ?>
                          <tr>
                            <th scope="row"><?php echo ++$count; ?></th>

                            <td>
                              <img src="<?php echo htmlspecialchars($blog['image']); ?>"
                                width="150px"
                                alt="<?php echo htmlspecialchars($blog['heading']); ?>">
                            </td>

                            <td><?php echo htmlspecialchars($blog['heading']); ?></td>

                            <td class="limit-words">
                              <?php echo htmlspecialchars(strip_tags($blog['description'])); ?>
                            </td>

                            <td>
                              <a href="edit-data.php?type=blog&id=<?php echo $blog['id']; ?>">
                                <button class="btn btn-primary-rgba mt-1">Update</button>
                              </a>
                              <a href="delete.php?type=blog&id=<?php echo $blog['id']; ?>">
                                <button class="btn btn-danger-rgba mt-1">Delete</button>
                              </a>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End col -->
          </div>
          <!-- End row -->
        </div>
        <!-- End Contentbar -->
      <?php
      }
      ?>

      <?php
      if ($type === 'booking-inquiry') {
      ?>
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Globe Era Travel</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Inquirys</li>
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
                  <h5 class="card-title">Manage Inquirys</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Package Name</th>
                          <th scope="col">Full Name</th>
                          <th scope="col">Phone</th>
                          <th scope="col">Email</th>
                          <th scope="col">Travel Date</th>
                          <th scope="col">No. of Travelers</th>
                          <th scope="col">Message</th>
                          <th scope="col">Received At</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $count = 0;
                        $bookings = $obj->select_data('bookings');
                        foreach ($bookings as $booking) {
                        ?>
                          <tr>
                            <th scope="row"><?php echo ++$count; ?></th>
                            <td><?php echo htmlspecialchars($booking['package_name']); ?></td>
                            <td><?php echo htmlspecialchars($booking['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($booking['phone']); ?></td>
                            <td><?php echo htmlspecialchars($booking['email']); ?></td>
                            <td><?php echo htmlspecialchars($booking['travel_date']); ?></td>
                            <td><?php echo htmlspecialchars($booking['no_of_travelers']); ?></td>
                            <td class="limit-words"><?php echo htmlspecialchars($booking['message']); ?></td>
                            <td><?php echo htmlspecialchars($booking['created_at']); ?></td>
                            <td>
                              <a href="delete.php?type=booking-inquiry&id=<?php echo $booking['id']; ?>">
                                <button class="btn btn-danger-rgba mt-1">Delete</button>
                              </a>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End col -->
          </div>
          <!-- End row -->
        </div>
        <!-- End Contentbar -->
      <?php
      }
      ?>

      <?php
      if ($type === 'general-inquiry') {
      ?>
        <!-- Start Breadcrumbbar -->
        <div class="breadcrumbbar">
          <div class="row align-items-center">
            <div class="col-md-12 col-lg-12">
              <h4 class="page-title">Globe Era Travel</h4>
              <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Inquirys</li>
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
                  <h5 class="card-title">Manage Inquirys</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Full Name</th>
                          <th scope="col">Phone</th>
                          <th scope="col">Email</th>
                          <th scope="col">Destination</th>
                          <th scope="col">Travel Date</th>
                          <th scope="col">No. of Travelers</th>
                          <th scope="col">Message</th>
                          <th scope="col">Received At</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $count = 0;
                        $inquiries = $obj->select_data('general_inquiry');  // ← was 'bookings'
                        foreach ($inquiries as $inquiry) {
                        ?>
                          <tr>
                            <th scope="row"><?php echo ++$count; ?></th>
                            <td><?php echo htmlspecialchars($inquiry['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($inquiry['phone']); ?></td>
                            <td><?php echo htmlspecialchars($inquiry['email']); ?></td>
                            <td><?php echo htmlspecialchars($inquiry['destination']); ?></td> <!-- ← added -->
                            <td><?php echo htmlspecialchars($inquiry['travel_date']); ?></td>
                            <td><?php echo htmlspecialchars($inquiry['no_of_travelers']); ?></td>
                            <td class="limit-words"><?php echo htmlspecialchars($inquiry['message']); ?></td>
                            <td><?php echo htmlspecialchars($inquiry['created_at']); ?></td>
                            <td>
                              <a href="delete.php?type=general-inquiry&id=<?php echo $inquiry['id']; ?>"> <!-- ← updated type -->
                                <button class="btn btn-danger-rgba mt-1">Delete</button>
                              </a>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End col -->
          </div>
          <!-- End row -->
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