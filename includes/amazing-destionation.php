<?php
include_once('config/db.php');
$obj = new database();
?>
<div class="relative overflow-hidden md:pb-22.5 pb-10 bg-contain bg-position-[bottom_center] bg-repeat-x">
  <div class="bg-lightturquoise sm:mx-15 pb-5">
    <div class="container-fluid">
      <!-- TITLE START-->
      <div class="text-center max-w-150 mx-auto md:mb-15 mb-7.5">
        <h2 class="xl:text-46 md:text-40 text-3xl mb-2.5">
          Amazing<span class="text-citrusyellow">
            Destinations</span>
        </h2>
        <p class="text-base">Crafted Just for You</p>
        <div class="-mt-7">
          <img src="assets/images/background/Title-Separator.png" alt="Image" class="w-117.5 inline-block"
            width="470" height="70" loading="lazy" />
        </div>
      </div>
      <!-- TITLE END-->

      <div>
        <div class="swiper trv-tours-st1 xl:pb-29! pb-22.5!">
          <div class="swiper-wrapper">
            <!-- popular things -->
            <?php
            // Fetch only amazing destination packages ← updated condition
            $package = $obj->select_data('packages', "amazing_destinations = 1");
            if (!empty($package)) {
              foreach ($package as $package_det) {
            ?>
                <div class="swiper-slide">
                  <div class="mx-3.75">
                    <div class="rounded-tr-3xl rounded-tl-3xl overflow-hidden relative">

                      <!-- Dynamic Image -->
                      <a href="package-detail.php?id=<?php echo $package_det['id']; ?>">
                        <img
                          src="<?php echo str_replace('../', '', htmlspecialchars($package_det['image'])); ?>"
                          alt="<?php echo htmlspecialchars($package_det['title']); ?>"
                          class="xl:h-105 h-80 w-full object-cover object-center"
                          width="309" height="500" loading="lazy" />
                      </a>

                      <div class="absolute bottom-0 left-0 right-0 py-3.75 px-7.5 bg-caribbeanlight backdrop-blur duration-500">
                        <h3 class="2xl:text-28 text-2xl font-medium">
                          <a href="package-detail.php?id=<?php echo $package_det['id']; ?>" class="text-white">
                            <i class="fa-solid fa-location-dot"></i>
                            <?php echo ucwords(htmlspecialchars($package_det['title'])); ?> <!-- Dynamic Title -->
                          </a>
                        </h3>
                      </div>
                    </div>

                    <div class="bg-white p-7.5 rounded-bl-3xl rounded-br-3xl shadow-[0px_18px_18px_rgba(0,106,114,0.15)]">
                      <div class="mb-7.5 flex">
                        <div class="text-xl/[1.3] font-title font-medium">
                          <a href="package-detail.php?id=<?php echo $package_det['id']; ?>"
                            class="text-primary duration-500 hover:text-citrusyellow duration-500">
                            <?php echo mb_strimwidth(strip_tags($package_det['description']), 0, 120, '...'); ?> <!-- Dynamic Description -->
                          </a>
                        </div>
                      </div>

                      <div class="flex items-center justify-between">
                        <div class="trv-book">
                          <span class="text-citrusyellow font-bold text-lg">
                            ₹<?php echo htmlspecialchars($package_det['price']); ?>/-
                          </span>
                          <span class="block text-sm text-primary mt-1">
                            <i class="fa-solid fa-location-dot text-citrusyellow mr-1"></i>
                            <?php
                            $location_words = explode(' ', ucwords(htmlspecialchars($package_det['location'])));
                            $short_location = implode(' ', array_slice($location_words, 0, 3));
                            echo count($location_words) > 3 ? $short_location . '...' : $short_location;
                            ?>
                          </span>
                        </div>
                        <div class="trv-book">
                          <a href="package-detail.php?id=<?php echo $package_det['id']; ?>"
                            class="site-button outline">Book Now</a>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              <?php
              }
            } else { ?>
              <div class="w-full text-center py-10">
                <p class="text-primary text-lg">No amazing destinations found.</p>
              </div>
            <?php } ?>
          </div>
          <div style="margin-top: 90px">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="absolute -left-28.75 top-2/5 w-57.5 opacity-50 animate-slide-top2">
    <img src="assets/images/hotballon-Left.png" alt="image" width="233" height="333" />
  </div>
  <div class="absolute -right-13.75 top-2/5 w-27.5 animate-slide-top">
    <img src="assets/images/hotballon-right.png" alt="image" width="110" height="166" />
  </div>
</div>