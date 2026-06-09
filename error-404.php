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
                    Error 404
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
                      Error 404
                    </li>
                  </ul>
                </div>
              </div>
              <!-- BREADCRUMB ROW END -->
            </div>
            <div class="h-50 w-full absolute top-50 left-0 z-1">
              <div class="inline-block whitespace-nowrap animate-moveCloud">
                <img
                  src="assets/images/inr-banner-cloud.png"
                  alt="Image"
                  class="h-47.5" />
              </div>
            </div>
            <div class="absolute w-1/2 right-0 top-0 bottom-0 z-1">
              <div class="mt-60 animate-slide-right">
                <img
                  src="assets/images/airplane.png"
                  alt="Image"
                  class="animate-slide-top-fast"
                  width="378"
                  height="146" />
              </div>
            </div>
            <div class="absolute right-11.25 bottom-16.25 animate-slide-top2">
              <img
                src="assets/images/hotballon-Left.png"
                alt="Image"
                class="md:w-21 w-10"
                width="84"
                height="121" />
            </div>
            <div
              class="absolute md:-right-15 -right-10 top-41.25 animate-slide-top">
              <img
                src="assets/images/hotballon-right.png"
                alt="Image"
                class="md:w-37.5 w-20"
                width="230"
                height="333" />
            </div>
          </div>
          <!-- INNER PAGE BANNER END -->

          <!-- Error SECTION START -->
          <div
            class="xl:pt-30 pt-12.5 xl:pb-50 pb-5 bg-[url(../images/error-bg-cloud.png)] bg-no-repeat bg-[center_bottom]">
            <div class="container">
              <div>
                <div class="text-center lg:flex items-center justify-between">
                  <div class="mb-7.5">
                    <span
                      class="font-title xl:text-40 text-2xl font-bold text-primary text-left block leading-none">Oops!</span>
                    <h1
                      class="!font-base xl:!text-50xxl !text-35xl !font-bold text-primary text-shadow-[0px_26px_10px_rgba(6,97,104,0.26)] leading-[0.75] flex items-center justify-center">
                      4
                      <img
                        src="assets/images/hotballon-error.png"
                        alt="Image"
                        class="xl:max-w-43 max-w-30 mb-5 animate-error-ballonanimation w-full"
                        width="172"
                        height="258"
                        loading="lazy" />4
                    </h1>
                    <div
                      class="pt-2.5 p-7.5 relative max-w-132.5 max-lg:mx-auto">
                      <h2 class="text-36 mb-5">Page Not Found</h2>
                      <p class="text-lg mb-7.5">
                        The page you're looking for isn't available. Try to
                        search again or use the go to.
                      </p>
                      <a href="./" class="site-button">Back to Home</a>
                    </div>
                  </div>
                  <div
                    class="lg:max-w-167.5 max-w-100 lg:pl-5 max-lg:mx-auto mb-7.5">
                    <img
                      src="assets/images/error-bg.png"
                      alt="img"
                      width="650"
                      height="697"
                      loading="lazy" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Error  SECTION END -->

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