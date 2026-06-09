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
  <meta
    name="description"
    content="Welcome India for travel agencies, tour operators, holiday planners, and booking." />
  <meta name="keywords" content="Welcome India for travel agencies, tour operators, holiday planners, and booking" />
  <meta name="author" content="HDT" />
  <meta name="robots" content="index, follow" />
  <?php include_once('includes/header-link.php'); ?>
</head>

<body id="bg" class="selection:bg-[#484848] selection:text-white">
  <!-- LOADING AREA START ===== -->
  <?php include_once('includes/preloader.php'); ?>
  <!-- LOADING AREA  END ====== -->

  <!-- Curser Pointer -->
  <?php include_once('includes/cursor.php'); ?>

  <div class="page-wraper">
    <?php include_once('includes/header.php'); ?>

    <div id="smooth-wrapper">
      <div id="smooth-content">
        <!-- CONTENT START -->
        <div class="page-content">
          <?php
          $package = $obj->select_data('packages', "id = '$id'");
          if (!empty($package)) {
            foreach ($package as $package_det) {
          ?>
              <!-- INNER PAGE BANNER -->
              <div class="relative bg-cover bg-center w-full bg-white overflow-hidden"
                style="background-image: url('<?php echo str_replace('../', '', htmlspecialchars($package_det['image'])) ?>')">

                <!-- Overlay ← updated -->
                <div class="bg-black opacity-50 absolute left-0 top-0 size-full z-1"></div>

                <div class="flex w-full lg:h-160 md:h-135 h-100 pb-10 items-baseline mx-auto">
                  <div class="relative md:mt-60 mt-45 flex items-center justify-center w-full flex-col z-5">
                    <div>
                      <h2 class="lg:text-60 md:text-52 text-28 relative" style="color: aliceblue">
                        <?php echo ucwords(htmlspecialchars($package_det['title'])); ?>
                      </h2>
                    </div>
                    <!-- BREADCRUMB ROW -->
                    <div>
                      <ul class="inline-block">
                        <li class="text-base pr-7.5 relative inline-block font-semibold text-white after:content-['-'] after:absolute after:right-2 after:-top-1.5 after:text-primary after:text-26 after:font-normal">
                          <a href="./">Home</a>
                        </li>
                        <li class="relative inline-block text-base font-semibold text-white">
                          <?php echo ucwords(htmlspecialchars($package_det['title'])); ?>
                        </li>
                      </ul>
                    </div>
                    <!-- BREADCRUMB ROW END -->
                  </div>
                </div>
              </div>
              <!-- INNER PAGE BANNER END -->

              <!-- SECTION START -->
              <div class="xl:pt-30 pt-17.5 xl:pb-22.5 pb-10">
                <div class="mx-auto mb-7.5 max-w-264 px-3.75">

                  <!-- Top Slider -->
                  <div class="trv-detail-slider">
                    <div class="swiper trv_d-slider">
                      <div class="swiper-wrapper">

                        <!-- Main Image -->
                        <?php if (!empty($package_det['image'])) { ?>
                          <div class="swiper-slide">
                            <div class="rounded-3xl">
                              <img src="<?php echo str_replace('../', '', htmlspecialchars($package_det['image'])) ?>"
                                alt="<?php echo htmlspecialchars($package_det['title']); ?>"
                                class="rounded-3xl" width="1026" height="500" loading="lazy" />
                            </div>
                          </div>
                        <?php } ?>

                        <!-- Gallery Images -->
                        <?php
                        $galleries = ['gallery_1', 'gallery_2', 'gallery_3', 'gallery_4'];
                        foreach ($galleries as $gallery) {
                          if (!empty($package_det[$gallery])) { ?>
                            <div class="swiper-slide">
                              <div class="rounded-3xl">
                                <img src="<?php echo str_replace('../', '', htmlspecialchars($package_det[$gallery])) ?>"
                                  alt="<?php echo htmlspecialchars($package_det['title']); ?>"
                                  class="rounded-3xl" width="1026" height="500" loading="lazy" />
                              </div>
                            </div>
                        <?php   }
                        } ?>

                      </div>
                      <div class="swiper-pagination"></div>
                    </div>
                  </div>

                  <!-- Info Start -->
                  <div class="sm:p-7.5 p-3.5 mt-5 rounded-3xl bg-white">

                    <!-- Dynamic Title -->
                    <h3 class="md:text-36 text-28 mb-5">
                      <?php echo ucwords(htmlspecialchars($package_det['title'])); ?>
                    </h3>

                    <div class="border rounded-br-xl rounded-bl-xl bg-white"
                      style="margin: 6px; padding: 6px; border-radius: 15px">

                      <!-- Dynamic Price -->
                      <h3 class="md:text-28 text-18 mb-2 flex items-center gap-2" style="font-size: large">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                          <path d="M 12 2 C 6.486 2 2 6.486 2 12 C 2 17.514 6.486 22 12 22 C 17.514 22 22 17.514 22 12 C 22 10.874 21.803984 9.7942031 21.458984 8.7832031 L 19.839844 10.402344 C 19.944844 10.918344 20 11.453 20 12 C 20 16.411 16.411 20 12 20 C 7.589 20 4 16.411 4 12 C 4 7.589 7.589 4 12 4 C 13.633 4 15.151922 4.4938906 16.419922 5.3378906 L 17.851562 3.90625 C 16.203562 2.71225 14.185 2 12 2 z M 21.292969 3.2929688 L 11 13.585938 L 7.7070312 10.292969 L 6.2929688 11.707031 L 11 16.414062 L 22.707031 4.7070312 L 21.292969 3.2929688 z" />
                        </svg>
                        &nbsp; Per Person - ₹<?php echo htmlspecialchars($package_det['price']); ?>/-
                      </h3>

                      <!-- Dynamic Location -->
                      <h3 class="md:text-28 text-18 flex items-center gap-2" style="font-size: large">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                          <path d="M 12 2 C 6.486 2 2 6.486 2 12 C 2 17.514 6.486 22 12 22 C 17.514 22 22 17.514 22 12 C 22 10.874 21.803984 9.7942031 21.458984 8.7832031 L 19.839844 10.402344 C 19.944844 10.918344 20 11.453 20 12 C 20 16.411 16.411 20 12 20 C 7.589 20 4 16.411 4 12 C 4 7.589 7.589 4 12 4 C 13.633 4 15.151922 4.4938906 16.419922 5.3378906 L 17.851562 3.90625 C 16.203562 2.71225 14.185 2 12 2 z M 21.292969 3.2929688 L 11 13.585938 L 7.7070312 10.292969 L 6.2929688 11.707031 L 11 16.414062 L 22.707031 4.7070312 L 21.292969 3.2929688 z" />
                        </svg>
                        &nbsp; Location - <?php echo ucwords(htmlspecialchars($package_det['location'])); ?>
                      </h3>
                    </div>

                    <!-- Dynamic Description -->
                    <div class="mt-5 mb-7.5">
                      <?php echo $package_det['description']; ?> <!-- Raw HTML from editor -->
                    </div>

                    <!-- Gallery Section -->
                    <?php
                    $hasGallery = !empty($package_det['gallery_1']) || !empty($package_det['gallery_2']) ||
                      !empty($package_det['gallery_3']) || !empty($package_det['gallery_4']);
                    if ($hasGallery) { ?>
                      <h3 class="md:text-36 text-28 mb-5">From our gallery</h3>
                      <div class="flex flex-wrap gap-4">
                        <?php foreach ($galleries as $gallery) {
                          if (!empty($package_det[$gallery])) { ?>
                            <div class="md:w-2/4 w-1/2 px-2 mb-4"> <!-- ← added px-2 mb-4 -->
                              <div class="relative overflow-hidden lg:rounded-3xl rounded-xxl group">
                                <div class="relative bg-black text-center overflow-hidden">
                                  <img src="<?php echo str_replace('../', '', htmlspecialchars($package_det[$gallery])); ?>"
                                    alt="<?php echo htmlspecialchars($package_det['title']); ?>"
                                    class="relative block duration-500 w-[110%] xl:h-62.5 lg:h-52.5 h-40 object-cover object-bottom group-hover:opacity-20"
                                    width="416" height="250" loading="lazy" />
                                  <a class="elem size-10 leading-10 text-center block bg-white rounded-md text-heading text-22 absolute left-1/2 top-1/2 opacity-0 duration-500 group-hover:opacity-100 group-hover:-translate-1/2"
                                    href="<?php echo str_replace('../', '', htmlspecialchars($package_det[$gallery])); ?>"
                                    data-lcl-txt="" data-lcl-author=""
                                    data-lcl-thumb="<?php echo str_replace('../', '', htmlspecialchars($package_det[$gallery])); ?>">
                                    <i class="fa-solid fa-expand"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
                        <?php   }
                        } ?>
                      </div>
                    <?php } ?>

                    <!-- Inquiry Form -->
                    <div class="mt-5">
                      <div class="relative bg-gradient-to-br from-primary/10 to-citrusyellow/10 backdrop-blur-xl border border-white/30 rounded-[30px] shadow-2xl max-w-lg mx-auto">
                        <h4 class="text-2xl font-semibold text-primary mb-2">Plan Your Trip ✈️</h4>
                        <p class="text-sm text-gray-600 mb-6">Get a free quote & itinerary within 24 hours.</p>
                        <form id="contactForm" action="booking.php" method="POST" enctype="multipart/form-data"> <!-- ← fixed "POS" → "POST" -->
                          <input type="hidden" name="dzToDo" value="Contact" />
                          <input type="hidden" name="reCaptchaEnable" value="0" />
                          <input type="hidden" name="formType" value="Package Inquiry Form" />

                          <!-- Package Name (pre-filled, readonly) -->
                          <div class="mb-4">
                            <label class="block text-sm font-semibold text-primary mb-2">
                              Package Name
                            </label>
                            <input type="text" name="packageName" readonly
                              value="<?php echo ucwords(htmlspecialchars($package_det['title'])); ?>"
                              class="w-full h-12 px-5 rounded-xl border border-gray-200 bg-[#e8f8f8] text-primary font-medium outline-none cursor-not-allowed" />
                          </div>

                          <!-- Row 1: Full Name -->
                          <div class="mb-4">
                            <label class="block text-sm font-semibold text-primary mb-2">
                              Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="dzName" required placeholder="Your full name"
                              class="w-full h-12 px-5 rounded-xl border border-gray-200 bg-[#f0fafa] focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition-all" />
                          </div>

                          <!-- Row 2: Phone & Email -->
                          <div class="flex flex-col sm:flex-row gap-4 mb-4">
                            <div class="flex-1 mb-4">
                              <label class="block text-sm font-semibold text-primary mb-2">
                                Phone Number <span class="text-red-500">*</span>
                              </label>
                              <input type="tel" name="dzPhone" required placeholder="Your phone number"
                                class="w-full h-12 px-5 rounded-xl border border-gray-200 bg-[#f0fafa] focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition-all" />
                            </div>
                            <div class="flex-1">
                              <label class="block text-sm font-semibold text-primary mb-2">
                                Email Address
                              </label>
                              <input type="email" name="dzEmail" placeholder="Your email address"
                                class="w-full h-12 px-5 rounded-xl border border-gray-200 bg-[#f0fafa] focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition-all" />
                            </div>
                          </div>

                          <!-- Row 3: Travel Date & No. of Travelers -->
                          <div class="flex flex-col sm:flex-row gap-4 mb-4">
                            <div class="flex-1 mb-4">
                              <label class="block text-sm font-semibold text-primary mb-2">
                                Travel Date
                              </label>
                              <input type="date" name="dzTravelDate"
                                class="w-full h-12 px-5 rounded-xl border border-gray-200 bg-[#f0fafa] focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition-all" />
                            </div>
                            <div class="flex-1">
                              <label class="block text-sm font-semibold text-primary mb-2">
                                No. of Travelers
                              </label>
                              <select name="dzTravelers"
                                class="w-full h-12 px-5 rounded-xl border border-gray-200 bg-[#f0fafa] focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition-all">
                                <option value="">Select travelers</option>
                                <option value="1">1 Person</option>
                                <option value="2">2 People</option>
                                <option value="3">3 People</option>
                                <option value="4">4 People</option>
                                <option value="5">5 People</option>
                                <option value="6">6+ People</option>
                              </select>
                            </div>
                          </div>

                          <!-- Row 4: Message -->
                          <div class="mb-6">
                            <label class="block text-sm font-semibold text-primary mb-2">
                              Your Message
                            </label>
                            <textarea name="dzMessage" placeholder="Tell us about your dream trip..."
                              class="w-full h-32 p-5 rounded-xl border border-gray-200 bg-[#f0fafa] focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition-all resize-none"></textarea>
                          </div>

                          <!-- Submit Button -->
                          <button id="submitBtn" type="submit"
                            class="w-full h-12 rounded-full cursor-pointer bg-primary text-white font-semibold text-lg flex items-center justify-center gap-2 transition-all duration-300 hover:bg-secondary">
                            <span id="btnText">Get Free Quote</span>
                            <svg id="loader" class="hidden animate-spin h-5 w-5 text-white"
                              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                              <circle class="opacity-25" cx="12" cy="12" r="10"
                                stroke="currentColor" stroke-width="4"></circle>
                              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>
                          </button>

                        </form>
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
          <!--ALL BLOGS SECTION START-->

          <!--ALL BLOGS SECTION END-->

          <!--COUNTER SECTION START-->

          <div class="bg-white xl:p-20 pt-12.5 pb-5">
            <div class="container">
              <div class="row">
                <!--<div class="lg:w-1/4 md:w-1/2 w-full">-->
                <!--  <div class="relative max-xl:mb-7.5">-->
                <!--    <div-->
                <!--      class="min-w-25 size-25 bg-primary rounded-2xl flex items-baseline justify-start absolute left-0 -top-12.5 p-3.75">-->
                <!--      <img-->
                <!--        src="assets/images/trv-icon/count-icon1.png"-->
                <!--        alt="Image"-->
                <!--        class="w-12.5"-->
                <!--        width="50"-->
                <!--        height="50"-->
                <!--        loading="lazy" />-->
                <!--    </div>-->
                <!--    <div-->
                <!--      class="relative z-1 p-8.75 ml-14.5 mt-12.5 bg-primary/5 border-[7px] border-white shadow-step-bx4 backdrop-blur-[25px] rounded-3xl">-->
                <!--      <h4 class="font-medium text-2xl leading-8 mb-5">Awards Winning</h4>-->
                <!--      <div class="font-black text-42 leading-[0.75] font-base text-heading">-->
                <!--        <span class="value" data-value="3600">3600</span><b>+</b>-->
                <!--      </div>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->
                <div class="lg:w-1/4 md:w-1/2 w-full">
                  <div class="relative max-xl:mb-7.5">
                    <div
                      class="min-w-25 size-25 bg-citrusyellow rounded-2xl flex items-baseline justify-start absolute left-0 -top-12.5 p-3.75">
                      <img
                        src="assets/images/trv-icon/count-icon2.png"
                        alt="Image"
                        class="w-12.5"
                        width="50"
                        height="50"
                        loading="lazy" />
                    </div>
                    <div
                      class="relative z-1 p-8.75 ml-14.5 mt-12.5 bg-primary/5 border-[7px] border-white shadow-step-bx4 backdrop-blur-[25px] rounded-3xl">
                      <h4 class="font-medium text-2xl leading-8 mb-5">Happy Traveler</h4>
                      <div class="font-black text-42 leading-[0.75] font-base text-heading">
                        <span class="value" data-value="7634">7634</span><b>+</b>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full">
                  <div class="relative max-xl:mb-7.5">
                    <div
                      class="min-w-25 size-25 bg-primary rounded-2xl flex items-baseline justify-start absolute left-0 -top-12.5 p-3.75">
                      <img
                        src="assets/images/trv-icon/count-icon3.png"
                        alt="Image"
                        class="w-12.5"
                        width="50"
                        height="50"
                        loading="lazy" />
                    </div>
                    <div
                      class="relative z-1 p-8.75 ml-14.5 mt-12.5 bg-primary/5 border-[7px] border-white shadow-step-bx4 backdrop-blur-[25px] rounded-3xl">
                      <h4 class="font-medium text-2xl leading-8 mb-5">Tours success</h4>
                      <div class="font-black text-42 leading-[0.75] font-base text-heading">
                        <span class="value" data-value="2.5">2.5</span><b>K</b>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full">
                  <div class="relative max-xl:mb-7.5">
                    <div
                      class="min-w-25 size-25 bg-citrusyellow rounded-2xl flex items-baseline justify-start absolute left-0 -top-12.5 p-3.75">
                      <img
                        src="assets/images/trv-icon/count-icon4.png"
                        alt="Image"
                        class="w-12.5"
                        width="50"
                        height="50"
                        loading="lazy" />
                    </div>
                    <div
                      class="relative z-1 p-8.75 ml-14.5 mt-12.5 bg-primary/5 border-[7px] border-white shadow-step-bx4 backdrop-blur-[25px] rounded-3xl">
                      <h4 class="font-medium text-2xl leading-8 mb-5">Our Experience</h4>
                      <div class="font-black text-42 leading-[0.75] font-base text-heading">
                        <span class="value" data-value="13">13</span><b>+</b>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--COUNTER SECTION END-->

          <!-- FOOTER START -->
          <?php include_once('includes/footer.php'); ?>
          <!-- FOOTER END -->
        </div>
      </div>

      <!-- BUTTON TOP START -->
      <button class="scroltop">
        <span class="fa fa-angle-up relative" id="btn-vibrate"></span>
      </button>

      <?php include_once('includes/off-canvas.php'); ?>
    </div>

    <!-- JAVASCRIPT  FILES ========================================= -->
    <?php include_once('includes/footer-link.php'); ?>
  </div>
</body>

</html>

</body>

</html> 