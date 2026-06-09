<?php
include_once('config/db.php');
$obj = new database();
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
          <div
            class="relative bg-cover bg-center w-full bg-white bg-[url(../images/background/inr-banner.jpg)] overflow-hidden">
            <div class="opacity-100 absolute left-0 top-0 size-full"></div>
            <div
              class="flex w-full lg:h-160 md:h-135 h-100 pb-10 items-baseline mx-auto">
              <div
                class="relative md:mt-60 mt-45 flex items-center justify-center w-full flex-col z-5">
                <div>
                  <h2 class="lg:text-60 md:text-52 text-28 relative">
                    Gallery
                  </h2>
                </div>
                <!-- BREADCRUMB ROW -->
                <div>
                  <ul class="inline-block">
                    <li
                      class="text-base pr-7.5 relative inline-block font-semibold text-primary after:content-['-'] after:absolute after:right-2 after:-top-1.5 after:text-primary after:text-26 after:font-normal">
                      <a href="./">Home</a>
                    </li>
                    <li
                      class="relative inline-block text-base font-semibold text-primary">
                      Gallery
                    </li>
                  </ul>
                </div>
              </div>
              <!-- BREADCRUMB ROW END -->
            </div>
          </div>
          <!-- INNER PAGE BANNER END -->

          <!--GALLERY SECTION START-->

          <div class="bg-white xl:pt-30 pt-12.5 xl:pb-22.5 pb-5">
            <div class="container">
              <!-- TITLE START-->
              <div class="sm:mb-15 mb-7.5 text-center max-w-150 mx-auto">
                <h2 class="xl:text-46 md:text-40 text-3xl mb-2.5">
                  Best Memorable<span class="text-citrusyellow">
                    Gallery!</span>
                </h2>
                <div class="text-base">
                  Destinations worth exploring! Here are a few popular spots
                </div>
                <div class="-mt-7">
                  <img
                    src="assets/images/background/Title-Separator.png"
                    alt="Image"
                    class="w-117.5"
                    width="270"
                    height="70"
                    loading="lazy" />
                </div>
              </div>
              <!-- TITLE END-->
              <div class="section-content">
                <?php
                // Collect ALL images from ALL packages first
                $all_images = [];
                $packages = $obj->select_data('packages');

                if (!empty($packages)) {
                  foreach ($packages as $pkg) {
                    $fields = ['image', 'gallery_1', 'gallery_2', 'gallery_3', 'gallery_4'];
                    foreach ($fields as $field) {
                      if (!empty($pkg[$field])) {
                        $all_images[] = [
                          'src'   => str_replace('../', '', $pkg[$field]),
                          'title' => $pkg['title']
                        ];
                      }
                    }
                  }
                }
                ?>

                <!-- Gallery Grid -->
                <div class="row mb-10 flex flex-wrap -mx-2">
                  <?php if (!empty($all_images)) { ?>
                    <?php foreach ($all_images as $img) { ?>
                      <div class="md:w-1/3 w-1/2 px-2 mb-4">
                        <div class="relative overflow-hidden lg:rounded-3xl rounded-xxl group">
                          <div class="relative bg-black text-center overflow-hidden">
                            <img
                              src="<?php echo htmlspecialchars($img['src']); ?>"
                              alt="<?php echo htmlspecialchars($img['title']); ?>"
                              class="relative block duration-500 w-[110%] xl:h-62.5 lg:h-52.5 h-40 object-cover object-bottom group-hover:opacity-20"
                              width="416" height="250" loading="lazy" />
                            <a class="elem size-10 leading-10 text-center block bg-white rounded-md text-heading text-22 absolute left-1/2 top-1/2 opacity-0 duration-500 group-hover:opacity-100 group-hover:-translate-1/2"
                              href="<?php echo htmlspecialchars($img['src']); ?>"
                              data-lcl-txt="<?php echo htmlspecialchars($img['title']); ?>"
                              data-lcl-author=""
                              data-lcl-thumb="<?php echo htmlspecialchars($img['src']); ?>">
                              <i class="fa-solid fa-expand"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  <?php } else { ?>
                    <div class="w-full text-center py-10">
                      <p class="text-primary text-lg">No gallery images found.</p>
                    </div>
                  <?php } ?>
                </div>

                <!-- Total Image Count -->
                <?php if (!empty($all_images)) { ?>
                  <p class="text-sm text-gray-500 text-center mb-6">
                    Showing <?php echo count($all_images); ?> images
                  </p>
                <?php } ?>
              </div>
            </div>
          </div>
          <!--GALLERY TOUR SECTION END-->

          <!-- CATEGORY SECTION -->

          <!-- CATEGORY END -->

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