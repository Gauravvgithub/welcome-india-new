<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: login.php");
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
            <!-- Start Breadcrumbbar -->
            <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title">Welcome India Holidays</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                        <div class="card m-b-30 p-5 text-center">
                            <h2 class="m-0">Dashboard</h2>
                        </div>
                    </div>
                    <!-- End col -->
                </div> <!-- End row -->
            </div>
            <!-- End Contentbar -->

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