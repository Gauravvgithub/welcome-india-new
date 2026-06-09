<?php
include_once('config/db.php');
$obj = new database();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) die("Invalid ID");

// Sub package fetch karo
$sub_data = $obj->select_data('sub_packeges', "id = '$id'");
if (empty($sub_data)) die("Sub Package not found");
$sub = $sub_data[0];

// Parent package fetch karo breadcrumb ke liye
// Note: table 'packages' honi chahiye agar aap main package ka naam dikhana chahte hain
$parent_data = $obj->select_data('packages', "id = '{$sub['package_id']}'");
$parent = !empty($parent_data) ? $parent_data[0] : null;
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo ucwords(htmlspecialchars($sub['title'])); ?> - Welcome India</title>
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

          <div class="relative bg-cover bg-center w-full bg-white overflow-hidden"
            style="background-image: url('<?php echo str_replace('../', '', htmlspecialchars($sub['image'])); ?>')">
            <div class="bg-black opacity-50 absolute left-0 top-0 size-full z-1"></div>
            <div class="flex w-full lg:h-160 md:h-135 h-100 pb-10 items-baseline mx-auto">
              <div class="relative md:mt-60 mt-45 flex items-center justify-center w-full flex-col z-5">
                <h2 class="lg:text-60 md:text-52 text-28 relative" style="color: aliceblue">
                  <?php echo ucwords(htmlspecialchars($sub['title'])); ?>
                </h2>
                <ul class="inline-block">
                  <li class="text-base pr-7.5 relative inline-block font-semibold text-white after:content-['-'] after:absolute after:right-2 after:-top-1.5 after:text-primary after:text-26 after:font-normal">
                    <a href="./">Home</a>
                  </li>
                  
                  <li class="relative inline-block text-base font-semibold text-white">
                    <?php echo ucwords(htmlspecialchars($sub['title'])); ?>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="xl:pt-30 pt-17.5 xl:pb-22.5 pb-10">
            <div class="mx-auto mb-7.5 max-w-264 px-3.75">

              <!-- <div class="trv-detail-slider">
                <div class="swiper trv_d-slider">
                  <div class="swiper-wrapper">
                    
                    <?php
                    // Main image + 3 gallery images ka logic
                    $all_pics = ['image', 'img_1', 'img_2', 'img_3'];
                    foreach ($all_pics as $pic):
                      if (!empty($sub[$pic])):
                    ?>
                    <div class="swiper-slide">
                      <div class="rounded-3xl">
                        <img src="<?php echo str_replace('../', '', htmlspecialchars($sub[$pic])); ?>"
                          alt="<?php echo htmlspecialchars($sub['title']); ?>"
                          class="rounded-3xl w-full object-cover" style="height: 500px;" width="1026" height="500" loading="lazy" />
                      </div>
                    </div>
                    <?php
                      endif;
                    endforeach;
                    ?>

                  </div>
                  <div class="swiper-pagination"></div>
                </div>
              </div> -->
              <div class="trv-detail-slider">
                <div class="swiper trv_d-slider">
                  <div class="swiper-wrapper">
                    <?php
                    // 1. Pehle check karein aapke database mein actual columns kya hain
                    // Agar aapne database mein image1, image2 rakha hai to niche wahi likhein
                    $check_keys = ['image', 'img_1', 'img_2', 'img_3'];

                    $found_any = false;
                    foreach ($check_keys as $key) {
                      if (isset($sub[$key]) && !empty($sub[$key])) {
                        $found_any = true;
                        $img_src = str_replace('../', '', $sub[$key]);
                    ?>
                        <div class="swiper-slide">
                          <div class="rounded-3xl">
                            <img src="<?php echo htmlspecialchars($img_src); ?>"
                              alt="Package Image"
                              class="rounded-3xl w-full object-cover"
                              style="height: 500px;" />
                          </div>
                        </div>
                    <?php
                      }
                    }

                    // 2. Agar ek bhi image nahi mili toh placeholder dikhayye (Testing ke liye)
                    if (!$found_any) {
                      echo '<div class="swiper-slide"><p class="text-center p-10">No Images Found in Database Columns</p></div>';
                    }
                    ?>
                  </div>
                  <div class="swiper-pagination"></div>
                </div>
              </div>

              <div class="sm:p-7.5 p-3.5 mt-5 rounded-3xl bg-white">
                <h3 class="md:text-36 text-28 mb-5">
                  <?php echo ucwords(htmlspecialchars($sub['title'])); ?>
                </h3>

                <div class="border rounded-br-xl rounded-bl-xl bg-white p-4 mb-6" style="border-radius: 15px">
                  <h3 class="md:text-28 text-18 mb-2 flex items-center gap-2" style="font-size: large">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M 12 2 C 6.486 2 2 6.486 2 12 C 2 17.514 6.486 22 12 22 C 17.514 22 22 17.514 22 12 C 22 10.874 21.803984 9.7942031 21.458984 8.7832031 L 19.839844 10.402344 C 19.944844 10.918344 20 11.453 20 12 C 20 16.411 16.411 20 12 20 C 7.589 20 4 16.411 4 12 C 4 7.589 7.589 4 12 4 C 13.633 4 15.151922 4.4938906 16.419922 5.3378906 L 17.851562 3.90625 C 16.203562 2.71225 14.185 2 12 2 z M 21.292969 3.2929688 L 11 13.585938 L 7.7070312 10.292969 L 6.2929688 11.707031 L 11 16.414062 L 22.707031 4.7070312 L 21.292969 3.2929688 z" />
                    </svg>
                    &nbsp; Per Person - ₹<?php echo htmlspecialchars($sub['price']); ?>/-
                  </h3>
                </div>

                <div class="mt-5 mb-7.5 prose max-w-none">
                  <?php echo $sub['description']; ?>
                </div>

                <?php
                $galleries = ['image', 'img_1', 'img_2', 'img_3']; // Sabhi images fetch karne ke liye
                $hasGallery = !empty($sub['image']) || !empty($sub['img_1']) || !empty($sub['img_2']) || !empty($sub['img_3']);

                if ($hasGallery) { ?>
                  <h3 class="md:text-36 text-28 mb-5 mt-10">From our gallery</h3>
                  <div class="flex flex-wrap -mx-2"> <?php foreach ($galleries as $gallery) {
                                                        if (!empty($sub[$gallery])) { ?>
                        <div class="lg:w-1/3 md:w-1/2 w-full px-2 mb-4">
                          <div class="relative overflow-hidden lg:rounded-3xl rounded-xxl group">
                            <div class="relative bg-black text-center overflow-hidden">
                              <img src="<?php echo str_replace('../', '', htmlspecialchars($sub[$gallery])); ?>"
                                alt="<?php echo htmlspecialchars($sub['title']); ?>"
                                class="relative block duration-500 w-full xl:h-62.5 lg:h-52.5 h-48 object-cover group-hover:opacity-40 group-hover:scale-110"
                                width="416" height="250" loading="lazy" />

                              <a class="elem size-10 leading-10 text-center block bg-white rounded-md text-heading text-22 absolute left-1/2 top-1/2 opacity-0 duration-500 group-hover:opacity-100 -translate-x-1/2 -translate-y-1/2"
                                href="<?php echo str_replace('../', '', htmlspecialchars($sub[$gallery])); ?>"
                                data-lcl-txt="" data-lcl-author=""
                                data-lcl-thumb="<?php echo str_replace('../', '', htmlspecialchars($sub[$gallery])); ?>">
                                <i class="fa-solid fa-expand"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                    <?php }
                                                      } ?>
                  </div>
                <?php } ?>



                <div class="mt-10">
                  <div class="relative bg-gradient-to-br from-primary/10 to-citrusyellow/10 backdrop-blur-xl border border-white/30 rounded-[30px] shadow-2xl p-6 sm:p-10 max-w-lg mx-auto">
                    <h4 class="text-2xl font-semibold text-primary mb-2">Plan Your Trip ✈️</h4>
                    <p class="text-sm text-gray-600 mb-6">Get a free quote & itinerary within 24 hours.</p>

                    <form action="booking.php" method="POST">
                      <input type="hidden" name="formType" value="Sub Package Inquiry" />

                      <div class="mb-4">
                        <label class="block text-sm font-semibold text-primary mb-2">Selected Package</label>
                        <input type="text" name="packageName" readonly value="<?php echo ucwords(htmlspecialchars($sub['title'])); ?>"
                          class="w-full h-12 px-5 rounded-xl border border-gray-200 bg-[#e8f8f8] text-primary font-medium outline-none" />
                      </div>

                      <div class="mb-4">
                        <label class="block text-sm font-semibold text-primary mb-2">Full Name *</label>
                        <input type="text" name="dzName" required class="w-full h-12 px-5 rounded-xl border border-gray-200 bg-[#f0fafa] focus:border-primary outline-none" />
                      </div>

                      <div class="flex flex-col sm:flex-row gap-4 mb-4">
                        <div class="flex-1">
                          <label class="block text-sm font-semibold text-primary mb-2">Phone *</label>
                          <input type="tel" name="dzPhone" required class="w-full h-12 px-5 rounded-xl border border-gray-200 bg-[#f0fafa] outline-none" />
                        </div>
                        <div class="flex-1">
                          <label class="block text-sm font-semibold text-primary mb-2">Email</label>
                          <input type="email" name="dzEmail" class="w-full h-12 px-5 rounded-xl border border-gray-200 bg-[#f0fafa] outline-none" />
                        </div>
                      </div>

                      <button type="submit" class="w-full h-12 rounded-full bg-primary text-white font-semibold hover:bg-secondary transition-all">
                        Get Free Quote
                      </button>
                    </form>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <?php include_once('includes/footer.php'); ?>
        </div>
      </div>

      <button class="scroltop"><span class="fa fa-angle-up relative"></span></button>
      <?php include_once('includes/off-canvas.php'); ?>
    </div>
    <?php include_once('includes/footer-link.php'); ?>
  </div>
</body>

</html>