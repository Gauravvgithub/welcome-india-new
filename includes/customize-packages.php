<?php
/**
 * includes/customize-packages.php
 * Shows subcategories of Customize Packages (category_id = 9)
 * Swiper slider with nav buttons below the section.
 * Click → sub-packege.php?id=<subcategory_id>
 *   which should query: SELECT * FROM sub_packeges WHERE package_id = $id
 */

include_once('config/db.php');
$obj = new database();

$CUSTOMIZE_DEST_ID = 9;

$subcategories = $obj->select_data('subcategories', "category_id = '$CUSTOMIZE_DEST_ID'");

if (empty($subcategories)) {
    return;
}
?>

<div class="relative overflow-hidden md:pb-22.5 pb-10 bg-contain bg-position-[bottom_center] bg-repeat-x">
  <div class="bg-lightturquoise sm:mx-15 pb-5">
    <div class="container-fluid">

      <!-- TITLE -->
      <div class="text-center max-w-150 mx-auto md:mb-15 mb-7.5">
        <h2 class="xl:text-46 md:text-40 text-3xl mb-2.5">
          Customized
          <span class="text-citrusyellow">Tour Packages</span>
        </h2>
        <div class="-mt-7">
          <img src="assets/images/background/Title-Separator.png" alt="Image" class="w-117.5 inline-block" />
        </div>
      </div>

      <!-- SWIPER SLIDER -->
      <div class="swiper customize-tours-swiper xl:pb-16! pb-12!">
        <div class="swiper-wrapper">

          <?php foreach ($subcategories as $sc):
            $sc_id   = intval($sc['id']);
            $sc_name = ucwords(trim(htmlspecialchars($sc['subcategory_name'])));
            $sc_img  = str_replace('../', '', htmlspecialchars($sc['image']));
            $has_img = !empty(trim($sc['image']));
          ?>

            <div class="swiper-slide">
              <div class="mx-3.75 home-tour-card">

                <!-- IMAGE -->
                <div class="rounded-tr-3xl rounded-tl-3xl overflow-hidden relative">
                  <a href="sub-packege.php?id=<?php echo $sc_id; ?>">
                    <div class="card-slider home-tour-image">
                      <?php if ($has_img): ?>
                        <img src="<?php echo $sc_img; ?>"
                             class="slide active w-full h-full object-cover"
                             alt="<?php echo $sc_name; ?>"
                             onerror="this.src='assets/images/background/inr-banner.jpg'" />
                      <?php else: ?>
                        <img src="assets/images/background/inr-banner.jpg"
                             class="slide active w-full h-full object-cover"
                             alt="<?php echo $sc_name; ?>" />
                      <?php endif; ?>
                    </div>
                  </a>

                  <div class="absolute bottom-0 left-0 right-0 py-3.75 px-7.5 bg-caribbeanlight backdrop-blur duration-500">
                    <h3 class="2xl:text-28 text-2xl font-medium home-tour-title">
                      <a href="sub-packege.php?id=<?php echo $sc_id; ?>" class="text-white">
                        <i class="fa-solid fa-location-dot"></i>
                        <?php echo $sc_name; ?>
                      </a>
                    </h3>
                  </div>
                </div>

                <!-- CONTENT -->
                <div class="bg-white p-7.5 rounded-bl-3xl rounded-br-3xl shadow-[0px_18px_18px_rgba(0,106,114,0.15)] home-tour-content">
                  <div class="mb-7.5 flex home-tour-text">
                    <div class="w-full text-xl/[1.3] font-title font-medium">
                      <a href="sub-packege.php?id=<?php echo $sc_id; ?>" class="text-primary hover:text-citrusyellow duration-500">
                        Explore <?php echo $sc_name; ?> packages
                      </a>
                    </div>
                  </div>

                  <div class="flex items-center justify-between home-tour-footer">
                    <div class="trv-book">
                      <span class="block text-sm text-primary mt-1">
                        <i class="fa-solid fa-location-dot text-citrusyellow mr-1"></i>
                        Customize Tour
                      </span>
                    </div>
                    <div class="trv-book">
                      <a href="sub-packege.php?id=<?php echo $sc_id; ?>" class="site-button outline">View All</a>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          <?php endforeach; ?>

        </div><!-- /swiper-wrapper -->
      </div><!-- /swiper -->

      <!-- NAVIGATION BUTTONS — placed BELOW the slider section -->
      <div class="flex justify-center items-center gap-4 mt-6 mb-4">
        <div class="customize-tours-prev swiper-nav-btn" title="Previous">
          <i class="fa-solid fa-chevron-left"></i>
        </div>
        <div class="customize-tours-next swiper-nav-btn" title="Next">
          <i class="fa-solid fa-chevron-right"></i>
        </div>
      </div>

    </div>
  </div>
</div>

<style>
/* Shared nav button style for customize-tours section */
.customize-tours-prev,
.customize-tours-next {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: #006a72;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  font-size: 16px;
  transition: background 0.25s, transform 0.2s;
  user-select: none;
  box-shadow: 0 4px 12px rgba(0,106,114,0.3);
}
.customize-tours-prev:hover,
.customize-tours-next:hover {
  background: #f5c842;
  color: #022943;
  transform: scale(1.1);
}
.customize-tours-prev.swiper-button-disabled,
.customize-tours-next.swiper-button-disabled {
  opacity: 0.35;
  cursor: not-allowed;
  pointer-events: none;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
  if (typeof Swiper !== 'undefined') {
    new Swiper('.customize-tours-swiper', {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      navigation: {
        nextEl: '.customize-tours-next',
        prevEl: '.customize-tours-prev',
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
