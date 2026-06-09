<?php
include_once('config/db.php');
$obj = new database();

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
  header("Location: ./");
  exit;
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome India</title>
  <meta name="title" content="Welcome India" />
  <meta name="description" content="Welcome India for travel agencies, tour operators, holiday planners, and booking." />
  <meta name="keywords" content="Welcome India for travel agencies, tour operators, holiday planners, and booking" />
  <meta name="author" content="HDT" />
  <meta name="robots" content="index, follow" />
  <?php include_once('includes/header-link.php'); ?>
  <style>
    /* Subcategory card grid - matches existing destinations-grid style */
    .subcategory-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 2rem;
      padding: 0 1rem;
    }

    @media (min-width: 768px) {
      .subcategory-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (min-width: 1024px) {
      .subcategory-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    /* Card image zoom on hover */
    .subcat-card .subcat-img {
      transition: transform 0.5s ease;
    }

    .subcat-card:hover .subcat-img {
      transform: scale(1.08);
    }

    /* "No subcategories" empty state */
    .empty-state {
      grid-column: 1 / -1;
      text-align: center;
      padding: 5rem 1rem;
    }
  </style>
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
          <?php
          $categories = $obj->select_data('destination', "id = '$id'");
          $category = null;
          if (!empty($categories)) {
            foreach ($categories as $cat) {
              $category = $cat;
            }
          }

          if ($category) {
          ?>
            <div class="relative bg-cover bg-center w-full bg-white overflow-hidden"
              style="background-image: url('<?php echo str_replace('../', '', htmlspecialchars($category['image'])); ?>');">
              <div class="bg-black opacity-50 absolute left-0 top-0 size-full z-1"></div>
              <div class="flex w-full lg:h-160 md:h-135 h-100 pb-10 items-baseline mx-auto">
                <div class="relative md:mt-60 mt-45 flex items-center justify-center w-full flex-col z-5">
                  <div>
                    <h2 class="lg:text-60 md:text-52 text-28 relative" style="color: aliceblue">
                      <?php echo ucwords(htmlspecialchars($category['destination_name'])); ?>
                    </h2>
                  </div>
                  <div>
                    <ul class="inline-block">
                      <li class="text-base pr-7.5 relative inline-block font-semibold text-white after:content-['-'] after:absolute after:right-2 after:-top-1.5 after:text-primary after:text-26 after:font-normal">
                        <a href="./">Home</a>
                      </li>
                      <li class="relative inline-block text-base font-semibold text-white">
                        <?php echo ucwords(htmlspecialchars($category['destination_name'])); ?>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          <!-- INNER PAGE BANNER END -->

          <!-- SUBCATEGORIES SECTION START -->
          <div class="relative overflow-hidden pt-20 md:pb-22.5 pb-10">
            <div class="bg-lightturquoise sm:mx-15 pb-10">
              <div class="container-fluid">

                <!-- TITLE -->
                <div class="text-center max-w-150 mx-auto md:mb-15 mb-7.5">
                  <h2 class="xl:text-46 md:text-40 text-3xl mb-2.5">
                    <?php echo $category ? ucwords(htmlspecialchars($category['destination_name'])) : 'Destination'; ?>
                    <span class="text-citrusyellow">Categories</span>
                  </h2>
                  <div class="-mt-7">
                    <img src="assets/images/background/Title-Separator.png" alt="Image" class="w-117.5 inline-block"
                      width="470" height="70" loading="lazy" />
                  </div>
                </div>
                <!-- TITLE END -->

                <!-- SUBCATEGORY CARDS GRID -->
                <div class="subcategory-grid">
                  <?php
                  // Fetch subcategories for this destination
                  $subcats = $obj->select_data('subcategories', "category_id = '$id'");

                  if (!empty($subcats)) {
                    foreach ($subcats as $subcat) {
                      // Count packages in this subcategory
                      $subcat_id = intval($subcat['id']);
                      $pkg_count_result = $obj->select_data('packages', "subcategory_id = '$subcat_id'");
                      $pkg_count = count($pkg_count_result);
                  ?>
                      <!-- Subcategory Card -->
                      <a href="sub-packege.php?id=<?php echo $subcat['id']; ?>" class="subcat-card block group">
                        <div class="rounded-3xl overflow-hidden shadow-[0px_18px_18px_rgba(0,106,114,0.15)] bg-white">

                          <!-- Image Section -->
                          <div class="relative overflow-hidden" style="height: 240px;">
                            <?php if (!empty($subcat['image'])) { ?>
                              <img
                                class="subcat-img w-full h-full object-cover"
                                src="<?php echo str_replace('../', '', htmlspecialchars($subcat['image'])); ?>"
                                alt="<?php echo ucwords(htmlspecialchars($subcat['subcategory_name'])); ?>"
                                width="400" height="240" loading="lazy" />
                            <?php } else {
                              // Fallback: use destination image if subcategory has no image
                              $fallback = $category ? str_replace('../', '', htmlspecialchars($category['image'])) : 'assets/images/background/bg1.jpg';
                            ?>
                              <img
                                class="subcat-img w-full h-full object-cover"
                                src="<?php echo $fallback; ?>"
                                alt="<?php echo ucwords(htmlspecialchars($subcat['subcategory_name'])); ?>"
                                width="400" height="240" loading="lazy" />
                            <?php } ?>

                            <!-- Overlay gradient on hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 duration-400"></div>

                            <!-- Package count badge -->
                            <?php if ($pkg_count > 0) { ?>
                              <div class="absolute top-4 right-4 bg-citrusyellow text-white text-sm font-semibold px-3 py-1 rounded-full">
                                <?php echo $pkg_count; ?> Package<?php echo $pkg_count !== 1 ? 's' : ''; ?>
                              </div>
                            <?php } ?>

                            <!-- Arrow icon on hover -->
                            <div class="absolute bottom-4 right-4 size-10 bg-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 duration-400 translate-y-2 group-hover:translate-y-0">
                              <i class="fa-solid fa-arrow-right text-primary text-sm"></i>
                            </div>
                          </div>

                          <!-- Name Section -->
                          <div class="py-5 px-6 flex items-center justify-between">
                            <div>
                              <h3 class="text-xl font-medium text-primary group-hover:text-citrusyellow duration-300">
                                <?php echo ucwords(htmlspecialchars($subcat['subcategory_name'])); ?>
                              </h3>
                              <p class="text-sm text-gray-500 mt-1">
                                <?php
                                if ($pkg_count > 0) {
                                  echo $pkg_count . ' package' . ($pkg_count !== 1 ? 's' : '') . ' available';
                                } else {
                                  echo 'Explore options';
                                }
                                ?>
                              </p>
                            </div>
                            <div class="size-10 rounded-full border-2 border-primary/20 group-hover:border-citrusyellow group-hover:bg-citrusyellow duration-300 flex items-center justify-center">
                              <i class="fa-solid fa-chevron-right text-primary group-hover:text-white text-sm duration-300"></i>
                            </div>
                          </div>

                        </div>
                      </a>
                    <?php
                    }
                  } else {
                    ?>
                    <!-- No subcategories — fall back to showing packages directly -->
                    <div class="empty-state">
                      <?php
                      $packages = $obj->select_data('packages', "destination_id = '$id'");
                      if (!empty($packages)) {
                      ?>
                        <!-- Show packages directly if no subcategories exist -->
                        <div class="destinations-grid" style="text-align:left;">
                          <?php foreach ($packages as $package_det) { ?>
                            <div class="destination-item">
                              <div class="mx-3.75">
                                <div class="rounded-tr-3xl rounded-tl-3xl overflow-hidden relative">
                                  <a href="package-detail.php?id=<?php echo $package_det['id']; ?>">
                                    <div class="card-slider">
                                      <img src="<?php echo str_replace('../', '', htmlspecialchars($package_det['image'])); ?>"
                                        alt="<?php echo htmlspecialchars($package_det['title']); ?>"
                                        class="slide active" />
                                      <?php if (!empty($package_det['gallery_1'])) { ?>
                                        <img src="<?php echo str_replace('../', '', htmlspecialchars($package_det['gallery_1'])); ?>"
                                          alt="<?php echo htmlspecialchars($package_det['title']); ?>"
                                          class="slide" />
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
                                <div class="bg-white p-7.5 rounded-bl-3xl rounded-br-3xl shadow-[0px_18px_18px_rgba(0,106,114,0.15)]">
                                  <div class="mb-7.5 flex">
                                    <div class="w-full text-xl/[1.3] font-title font-medium">
                                      <a href="package-detail.php?id=<?php echo $package_det['id']; ?>"
                                        class="text-primary hover:text-citrusyellow duration-500">
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
                                        $short_location = implode(' ', array_slice($location_words, 0, 2));
                                        echo count($location_words) > 2 ? $short_location . '...' : $short_location;
                                        ?>
                                      </span>
                                    </div>
                                    <div class="trv-book">
                                      <a href="package-detail.php?id=<?php echo $package_det['id']; ?>"
                                        class="site-button outline">Read More</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php } ?>
                        </div>
                      <?php } else { ?>
                        <!-- Truly empty -->
                        <div class="text-6xl mb-6">🗺️</div>
                        <h3 class="text-2xl font-medium text-primary mb-3">No Packages Available Yet</h3>
                        <p class="text-gray-500 mb-8">We're working on exciting packages for this destination. Check back soon!</p>
                        <a href="./" class="site-button">Back to Home</a>
                      <?php } ?>
                    </div>
                  <?php } ?>
                </div>
                <!-- SUBCATEGORY CARDS GRID END -->

              </div>
            </div>
          </div>
          <!-- SUBCATEGORIES SECTION END -->

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
                        <span class="value" data-value="13">13</span><b>+</b>
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
</body>

</html>