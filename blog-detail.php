<?php
include_once('config/db.php');
$obj = new database();
$id = $_GET['id'] ?? null;
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Character Encoding -->
  <meta charset="UTF-8" />

  <!-- Responsive Design -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Title -->
  <title>Welcome India</title>

  <meta name="title" content="Welcome India" />
  <meta name="description" content="Welcome India for travel agencies, tour operators, holiday planners, and booking." />
  <meta name="keywords" content="Welcome India for travel agencies, tour operators, holiday planners, and booking" />
  <meta name="author" content="HDT" />
  <meta name="robots" content="index, follow" />
  <?php
  include_once('includes/header-link.php');
  ?>
</head>

<body id="bg" class="selection:bg-[#484848] selection:text-white">
  <!-- LOADING AREA START ===== -->
  <?php
  include_once('includes/preloader.php');
  ?>
  <!-- LOADING AREA  END ====== -->

  <!-- Curser Pointer -->
  <?php
  include_once('includes/cursor.php');
  ?>

  <div class="page-wraper">
    <?php
    include_once('includes/header.php');
    ?>

    <div id="smooth-wrapper">
      <div id="smooth-content">
        <!-- CONTENT START -->
        <div class="page-content">
          <!-- INNER PAGE BANNER -->
          <?php
          $blog = $obj->select_data('blogs', "id = '$id'");
          if (!empty($blog)) {
            foreach ($blog as $blog_det) {
          ?>
              <!-- INNER PAGE BANNER -->
              <div class="relative bg-cover bg-center w-full bg-white overflow-hidden"
                style="background-image: url('assets/images/nb/bn.jpg')">
                <div class="opacity-100 absolute left-0 top-0 size-full"></div>
                <div class="flex w-full lg:h-160 md:h-135 h-100 pb-10 items-baseline mx-auto">
                  <div class="relative md:mt-60 mt-45 flex items-center justify-center w-full flex-col z-5">
                    <div>
                      <h2 class="lg:text-60 md:text-52 text-28 relative">
                        <?php echo htmlspecialchars($blog_det['heading']); ?> <!-- Dynamic Heading -->
                      </h2>
                    </div>
                    <!-- BREADCRUMB ROW -->
                    <div>
                      <ul class="inline-block">
                        <li class="text-base pr-7.5 relative inline-block font-semibold text-primary after:content-['-'] after:absolute after:right-2 after:-top-1.5 after:text-primary after:text-26 after:font-normal">
                          <a href="./">Home</a>
                        </li>
                        <li class="relative inline-block text-base font-semibold text-primary">
                          Blogs
                        </li>
                      </ul>
                    </div>
                    <!-- BREADCRUMB ROW END -->
                  </div>
                </div>
              </div>
              <!-- INNER PAGE BANNER END -->

              <!-- SECTION START -->
              <div class="section-full xl:pt-30 pt-12.5 xl:pb-22.5 pb-5">
                <div class="container">
                  <div class="section-content">
                    <div class="row flex justify-center">
                      <div class="w-full mb-7.5">
                        <div class="trv-detail-main-wrap">

                          <!-- Top Image -->
                          <div class="rounded-3xl overflow-hidden relative mb-10">
                            <img
                              src="<?php echo str_replace('../', '', htmlspecialchars($blog_det['image'])) ?>"
                              alt="<?php echo htmlspecialchars($blog_det['heading']); ?>"
                              class="w-full object-cover object-center md:h-107.5 sm:h-72.5 h-77.25"
                              width="856"
                              height="430"
                              loading="lazy" />
                          </div>

                          <!-- Info -->
                          <div class="bg-white sm:p-10 p-5 rounded-3xl">
                            <ul class="flex flex-wrap mb-5">
                              <li class="text-lg font-normal text-primary leading-[1.2] relative font-title pe-5 after:content-['/'] after:absolute after:right-1.5 after:-top-1 after:text-xl after:text-citrusyellow">
                                By Admin
                              </li>
                              <li class="text-lg font-normal text-primary leading-[1.2] relative font-title pe-5 after:absolute after:right-1.5 after:-top-1 after:text-xl after:text-citrusyellow">
                                <?php echo date('d M Y', strtotime($blog_det['created_at'])); ?> <!-- Dynamic Date -->
                              </li>
                            </ul>

                            <!-- Dynamic Heading -->
                            <h3 class="md:text-4xl text-28 leading-[1.2] mb-5">
                              <?php echo htmlspecialchars($blog_det['heading']); ?>
                            </h3>

                            <!-- Dynamic Description -->
                            <div class="mb-7.5">
                              <?php echo $blog_det['description']; ?> <!-- No htmlspecialchars — may contain HTML from editor -->
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- SECTION END -->

          <?php
            }
          }
          ?>
          <!-- SECTION END -->
        </div>
        <!-- CONTENT END -->

        <!-- FOOTER START -->
        <?php
        include_once('includes/footer.php');
        ?>
        <!-- FOOTER END -->
      </div>
    </div>

    <!-- BUTTON TOP START -->
    <button class="scroltop">
      <span class="fa fa-angle-up relative" id="btn-vibrate"></span>
    </button>

    <?php
    include_once('includes/off-canvas.php');
    ?>
  </div>

  <!-- JAVASCRIPT  FILES ========================================= -->
  <?php
  include_once('includes/footer-link.php');
  ?>
</body>

</html>