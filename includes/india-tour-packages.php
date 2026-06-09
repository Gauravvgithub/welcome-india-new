<?php
/**
 * includes/india-tour-packages.php
 * Shows subcategories of India Tours (category_id = 8)
 * Swiper slider with nav buttons below the section.
 * Click → sub-packege.php?id=<subcategory_id>
 *   which should query: SELECT * FROM sub_packeges WHERE package_id = $id
 */

include_once('config/db.php');
$obj = new database();

$INDIA_DEST_ID = 8;

$subcategories = $obj->select_data('subcategories', "category_id = '$INDIA_DEST_ID'");

if (empty($subcategories)) {
    return;
}
?>

<div class="relative overflow-hidden md:pb-22.5 pb-10 bg-contain bg-position-[bottom_center] bg-repeat-x">
  <div class="bg-lightturquoise sm:mx-15 pb-5">
    <div class="container-fluid">

      <!-- TITLE -->
      <div class="text-center max-w-150 mx-auto md:mb-15 mb-7.5">
        <h2 class="xl:text-46 md:text-40 text-3xl mb-2.5" style="margin-top: 120px;">
          India
          <span class="text-citrusyellow">Tour Packages</span>
        </h2>
        <div class="-mt-7">
          <img src="assets/images/background/Title-Separator.png" alt="Image" class="w-117.5 inline-block" />
        </div>
      </div>

      <!-- SWIPER SLIDER -->
      <div class="swiper india-tours-swiper xl:pb-16! pb-12!">
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
                        India Tour
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
        <div class="india-tours-prev swiper-nav-btn" title="Previous">
          <i class="fa-solid fa-chevron-left"></i>
        </div>
        <div class="india-tours-next swiper-nav-btn" title="Next">
          <i class="fa-solid fa-chevron-right"></i>
        </div>
      </div>

    </div>
  </div>
</div>

<style>
/* Shared nav button style for india-tours section */
.india-tours-prev,
.india-tours-next {
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
.india-tours-prev:hover,
.india-tours-next:hover {
  background: #f5c842;
  color: #022943;
  transform: scale(1.1);
}
.india-tours-prev.swiper-button-disabled,
.india-tours-next.swiper-button-disabled {
  opacity: 0.35;
  cursor: not-allowed;
  pointer-events: none;
}

.home-tour-card {
  display: flex;
  flex-direction: column;
  height: 100%;
}
.home-tour-image {
  height: 260px;
  overflow: hidden;
}
.home-tour-title {
  min-height: 72px;
  display: flex;
  align-items: center;
}
.home-tour-content {
  min-height: 190px;
  display: flex;
  flex-direction: column;
}
.home-tour-text {
  min-height: 58px;
}
.home-tour-footer {
  margin-top: auto;
  gap: 12px;
}
@media (max-width: 767px) {
  .home-tour-image {
    height: 220px;
  }
  .home-tour-title {
    min-height: 58px;
  }
  .home-tour-content {
    min-height: 170px;
  }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
  if (typeof Swiper !== 'undefined') {
    new Swiper('.india-tours-swiper', {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      navigation: {
        nextEl: '.india-tours-next',
        prevEl: '.india-tours-prev',
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
