<div class="relative overflow-hidden md:pb-22.5 pb-10 bg-contain bg-position-[bottom_center] bg-repeat-x">
  <div class="bg-lightturquoise sm:mx-15 pb-5">
    <div class="container-fluid">

      <!-- TITLE (UNCHANGED ✅) -->
      <div class="text-center max-w-150 mx-auto md:mb-15 mb-7.5">
        <h2 class="xl:text-46 md:text-40 text-3xl mb-2.5">
          Most Popular
          <span class="text-citrusyellow">Domestic Tours</span>
        </h2>

        <div class="-mt-7">
          <img src="assets/images/background/Title-Separator.png" alt="Image" class="w-117.5 inline-block" />
        </div>
      </div>
      <!-- TITLE END -->

      <!-- ✅ GRID → SLIDER START -->
      <div class="swiper trv-tours-st1 xl:pb-29! pb-22.5!">
        <div class="swiper-wrapper">

          <?php
          $destinations = $obj->select_data('destination');

          if (!empty($destinations)) {
            foreach ($destinations as $dest) {

              if (strtolower(trim($dest['destination_name'])) == "domestic") {

                $packages = $obj->select_data('packages', "destination_id = '{$dest['id']}'");

                if (!empty($packages)) {
                  foreach ($packages as $package_det) {
          ?>
                    <div class="swiper-slide">
                      <div class="mx-3.75">

                        <!-- IMAGE SLIDER -->
                        <div class="rounded-tr-3xl rounded-tl-3xl overflow-hidden relative">
                          <a href="package-detail.php?id=<?php echo $package_det['id']; ?>">
                            <div class="card-slider">
                              <?php if (!empty($package_det['image'])) { ?>
                                <img src="<?php echo str_replace('../', '', htmlspecialchars($package_det['image'])); ?>" class="slide active" />
                              <?php } ?>
                              <?php if (!empty($package_det['gallery_1'])) { ?>
                                <img src="<?php echo str_replace('../', '', htmlspecialchars($package_det['gallery_1'])); ?>" class="slide" />
                              <?php } ?>
                              <?php if (!empty($package_det['gallery_2'])) { ?>
                                <img src="<?php echo str_replace('../', '', htmlspecialchars($package_det['gallery_2'])); ?>" class="slide" />
                              <?php } ?>
                            </div>
                          </a>

                          <div class="absolute bottom-0 left-0 right-0 py-3.75 px-7.5 bg-caribbeanlight backdrop-blur duration-500">
                            <h3 class="2xl:text-28 text-2xl font-medium">
                              <a href="package-detail.php?id=<?php echo $package_det['id']; ?>" class="text-white">
                                <i class="fa-solid fa-location-dot"></i>
                                <?php echo ucwords(htmlspecialchars($package_det['title'])); ?>
                              </a>
                            </h3>
                          </div>
                        </div>

                        <!-- CONTENT -->
                        <div class="bg-white p-7.5 rounded-bl-3xl rounded-br-3xl shadow-[0px_18px_18px_rgba(0,106,114,0.15)]">
                          <div class="mb-7.5 flex">
                            <div class="w-full text-xl/[1.3] font-title font-medium">
                              <a href="package-detail.php?id=<?php echo $package_det['id']; ?>" class="text-primary hover:text-citrusyellow duration-500">
                                <?php echo mb_strimwidth(strip_tags($package_det['description']), 0, 100, '...'); ?>
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
                              <a href="package-detail.php?id=<?php echo $package_det['id']; ?>" class="site-button outline">Book Now</a>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>

          <?php
                  }
                }
              }
            }
          }
          ?>

        </div>

        <!-- NAVIGATION -->
        <div style="margin-top: 90px">
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </div>
      <!-- ✅ SLIDER END -->

    </div>
  </div>
</div>