<?php
include_once('config/db.php');
$obj = new database();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) die("Invalid ID");

// ✅ FIX: subcategory info 'subcategories' table se fetch karo
// (pehle galti se 'sub_packeges' se fetch ho raha tha)
$package_data = $obj->select_data('subcategories', "id = '$id'");
if (empty($package_data)) die("Package not found");
$package = $package_data[0];

// ✅ FIX: sub_packeges mein package_id = subcategory ka id hota hai
// Database schema: sub_packeges.package_id → subcategories.id
$sub_packages = $obj->select_data('sub_packeges', "package_id = '$id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo ucwords(htmlspecialchars($package['subcategory_name'])); ?> - Welcome India</title>
  <meta name="title" content="<?php echo ucwords(htmlspecialchars($package['subcategory_name'])); ?> - Welcome India" />
  <meta name="description" content="Explore sub packages for <?php echo ucwords(htmlspecialchars($package['subcategory_name'])); ?>" />
  <meta name="robots" content="index, follow" />
  <?php include_once('includes/header-link.php'); ?>
</head>

<body id="bg" class="selection:bg-[#484848] selection:text-white">
  <?php include_once('includes/preloader.php'); ?>
  <?php include_once('includes/cursor.php'); ?>

  <div class="page-wraper">
    <?php include_once('includes/header.php'); ?>

    <div id="smooth-wrapper">
      <div id="smooth-content">
        <div class="page-content">

          <!-- INNER PAGE BANNER -->
          <div class="relative bg-cover bg-center w-full bg-white overflow-hidden"
            style="background-image: url('<?php echo str_replace('../', '', htmlspecialchars($package['image'])); ?>')">
            <div class="bg-black opacity-50 absolute left-0 top-0 size-full z-1"></div>
            <div class="flex w-full lg:h-160 md:h-135 h-100 pb-10 items-baseline mx-auto">
              <div class="relative md:mt-60 mt-45 flex items-center justify-center w-full flex-col z-5">
                <div>
                  <h2 class="lg:text-60 md:text-52 text-28 relative" style="color: aliceblue">
                    <?php echo ucwords(htmlspecialchars($package['subcategory_name'])); ?>
                  </h2>
                </div>
                <div>
                  <ul class="inline-block">
                    <li class="text-base pr-7.5 relative inline-block font-semibold text-white after:content-['-'] after:absolute after:right-2 after:-top-1.5 after:text-primary after:text-26 after:font-normal">
                      <a href="./">Home</a>
                    </li>
                    <li class="relative inline-block text-base font-semibold text-white">
                      <?php echo ucwords(htmlspecialchars($package['subcategory_name'])); ?>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- INNER PAGE BANNER END -->

          <!-- SUB PACKAGES SECTION START -->
          <div class="relative overflow-hidden pt-20 md:pb-22.5 pb-10">
            <div class="bg-lightturquoise sm:mx-15 pb-5">
              <div class="container-fluid">

                <!-- TITLE -->
                <div class="text-center max-w-150 mx-auto md:mb-15 mb-7.5">
                  <h2 class="xl:text-46 md:text-40 text-3xl mb-2.5">
                    <?php echo ucwords(htmlspecialchars($package['subcategory_name'])); ?>
                    <span class="text-citrusyellow">Packages</span>
                  </h2>
                  <div class="-mt-7">
                    <img src="assets/images/background/Title-Separator.png" alt="Image"
                         class="w-117.5 inline-block" width="470" height="70" loading="lazy" />
                  </div>
                </div>
                <!-- TITLE END -->

                <!-- SUB PACKAGES SLIDER -->
                <?php if (!empty($sub_packages)): ?>
                <div class="swiper trv-tours-st1 xl:pb-16! pb-12!" style="overflow: hidden;">
                  <div class="swiper-wrapper">

                    <?php foreach ($sub_packages as $sub):
                      $img = str_replace('../', '', htmlspecialchars($sub['image']));
                    ?>
                    <div class="swiper-slide">
                      <div class="mx-3.75">

                        <!-- IMAGE -->
                        <div class="rounded-tr-3xl rounded-tl-3xl overflow-hidden relative">
                          <a href="sub-package-detail.php?id=<?php echo $sub['id']; ?>">
                            <div class="card-slider" style="height:260px; overflow:hidden;">
                              <?php if (!empty($img)): ?>
                                <img src="<?php echo $img; ?>"
                                     alt="<?php echo htmlspecialchars($sub['title']); ?>"
                                     class="slide active w-full h-full object-cover"
                                     onerror="this.src='assets/images/background/inr-banner.jpg'" />
                              <?php else: ?>
                                <img src="assets/images/background/inr-banner.jpg"
                                     alt="<?php echo htmlspecialchars($sub['title']); ?>"
                                     class="slide active w-full h-full object-cover" />
                              <?php endif; ?>
                            </div>
                          </a>

                          <div class="absolute bottom-0 left-0 right-0 py-3.75 px-7.5 bg-caribbeanlight backdrop-blur duration-500">
                            <h3 class="2xl:text-28 text-2xl font-medium">
                              <a href="sub-package-detail.php?id=<?php echo $sub['id']; ?>" class="text-white">
                                <i class="fa-solid fa-location-dot"></i>
                                <?php echo ucwords(htmlspecialchars($sub['title'])); ?>
                              </a>
                            </h3>
                          </div>
                        </div>

                        <!-- CONTENT -->
                        <div class="bg-white p-7.5 rounded-bl-3xl rounded-br-3xl shadow-[0px_18px_18px_rgba(0,106,114,0.15)]">
                          <div class="mb-4">
                            <span class="block text-sm text-primary">
                              <i class="fa-solid fa-indian-rupee-sign text-citrusyellow mr-1"></i>
                              ₹<?php echo number_format((float)$sub['price'], 0); ?> / per person
                            </span>
                          </div>
                          <div class="trv-book">
                            <a href="sub-package-detail.php?id=<?php echo $sub['id']; ?>"
                               class="site-button outline">Book Now</a>
                          </div>
                        </div>

                      </div>
                    </div>
                    <?php endforeach; ?>

                  </div><!-- /swiper-wrapper -->
                </div><!-- /swiper -->

                <!-- NAVIGATION BUTTONS — below the slider -->
                <div class="flex justify-center items-center gap-4 mt-6 mb-4">
                  <div class="subpkg-prev" title="Previous">
                    <i class="fa-solid fa-chevron-left"></i>
                  </div>
                  <div class="subpkg-next" title="Next">
                    <i class="fa-solid fa-chevron-right"></i>
                  </div>
                </div>

                <?php else: ?>
                <!-- <div class="text-center py-20">
                  <h3 class="text-2xl text-primary">Is category mein abhi koi package nahi hai.</h3>
                </div> -->
                <?php endif; ?>
                <!-- SUB PACKAGES SLIDER END -->

              </div>
            </div>
          </div>
          <!-- SUB PACKAGES SECTION END -->

          <!-- COUNTER SECTION START -->
          <div class="bg-white xl:p-20 pt-12.5 pb-5">
            <div class="container">
              <div class="row">
                <!--<div class="lg:w-1/4 md:w-1/2 w-full">-->
                <!--  <div class="relative max-xl:mb-7.5">-->
                <!--    <div class="min-w-25 size-25 bg-primary rounded-2xl flex items-baseline justify-start absolute left-0 -top-12.5 p-3.75">-->
                <!--      <img src="assets/images/trv-icon/count-icon1.png" alt="Image" class="w-12.5" width="50" height="50" loading="lazy" />-->
                <!--    </div>-->
                <!--    <div class="relative z-1 p-8.75 ml-14.5 mt-12.5 bg-primary/5 border-[7px] border-white shadow-step-bx4 backdrop-blur-[25px] rounded-3xl">-->
                <!--      <h4 class="font-medium text-2xl leading-8 mb-5">Awards Winning</h4>-->
                <!--      <div class="font-black text-42 leading-[0.75] font-base text-heading">-->
                <!--        <span class="value" data-value="3600">3600</span><b>+</b>-->
                <!--      </div>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->
                <div class="lg:w-1/4 md:w-1/2 w-full">
                  <div class="relative max-xl:mb-7.5">
                    <div class="min-w-25 size-25 bg-citrusyellow rounded-2xl flex items-baseline justify-start absolute left-0 -top-12.5 p-3.75">
                      <img src="assets/images/trv-icon/count-icon2.png" alt="Image" class="w-12.5" width="50" height="50" loading="lazy" />
                    </div>
                    <div class="relative z-1 p-8.75 ml-14.5 mt-12.5 bg-primary/5 border-[7px] border-white shadow-step-bx4 backdrop-blur-[25px] rounded-3xl">
                      <h4 class="font-medium text-2xl leading-8 mb-5">Happy Traveler</h4>
                      <div class="font-black text-42 leading-[0.75] font-base text-heading">
                        <span class="value" data-value="7634">7634</span><b>+</b>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full">
                  <div class="relative max-xl:mb-7.5">
                    <div class="min-w-25 size-25 bg-primary rounded-2xl flex items-baseline justify-start absolute left-0 -top-12.5 p-3.75">
                      <img src="assets/images/trv-icon/count-icon3.png" alt="Image" class="w-12.5" width="50" height="50" loading="lazy" />
                    </div>
                    <div class="relative z-1 p-8.75 ml-14.5 mt-12.5 bg-primary/5 border-[7px] border-white shadow-step-bx4 backdrop-blur-[25px] rounded-3xl">
                      <h4 class="font-medium text-2xl leading-8 mb-5">Tours success</h4>
                      <div class="font-black text-42 leading-[0.75] font-base text-heading">
                        <span class="value" data-value="2.5">2.5</span><b>K</b>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full">
                  <div class="relative max-xl:mb-7.5">
                    <div class="min-w-25 size-25 bg-citrusyellow rounded-2xl flex items-baseline justify-start absolute left-0 -top-12.5 p-3.75">
                      <img src="assets/images/trv-icon/count-icon4.png" alt="Image" class="w-12.5" width="50" height="50" loading="lazy" />
                    </div>
                    <div class="relative z-1 p-8.75 ml-14.5 mt-12.5 bg-primary/5 border-[7px] border-white shadow-step-bx4 backdrop-blur-[25px] rounded-3xl">
                      <h4 class="font-medium text-2xl leading-8 mb-5">Our Experience</h4>
                      <div class="font-black text-42 leading-[0.75] font-base text-heading">
                        <span class="value" data-value="25">13</span><b>+</b>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- COUNTER SECTION END -->

          <?php include_once('includes/footer.php'); ?>
        </div>
      </div>

      <button class="scroltop">
        <span class="fa fa-angle-up relative" id="btn-vibrate"></span>
      </button>

      <?php include_once('includes/off-canvas.php'); ?>
    </div>
    <?php include_once('includes/footer-link.php'); ?>
  </div>

  <!-- Nav button styles -->
  <style>
  .subpkg-prev, .subpkg-next {
    width: 44px; height: 44px;
    border-radius: 50%;
    background: #006a72;
    color: #fff;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; font-size: 16px;
    transition: background 0.25s, transform 0.2s;
    user-select: none;
    box-shadow: 0 4px 12px rgba(0,106,114,0.3);
  }
  .subpkg-prev:hover, .subpkg-next:hover {
    background: #f5c842; color: #022943; transform: scale(1.1);
  }
  .subpkg-prev.swiper-button-disabled, .subpkg-next.swiper-button-disabled {
    opacity: 0.35; cursor: not-allowed; pointer-events: none;
  }
  </style>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
    if (typeof Swiper !== 'undefined') {
      new Swiper('.trv-tours-st1', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        navigation: {
          nextEl: '.subpkg-next',
          prevEl: '.subpkg-prev',
        },
        breakpoints: {
          640:  { slidesPerView: 2 },
          1024: { slidesPerView: 3 },
          1280: { slidesPerView: 4 },
        }
      });
    }
  });
  </script>

</body>
</html>
