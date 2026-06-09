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
          <!-- <div
              class="relative bg-cover bg-center w-full bg-white bg-[url(../images/background/inr-banner.jpg)] overflow-hidden"
            > -->

          <div
            class="relative bg-cover bg-center w-full bg-white overflow-hidden"
            style="background-image: url(&quot;assets/images/nb/bn.jpg&quot;)">
            <div class="opacity-100 absolute left-0 top-0 size-full"></div>
            <div
              class="flex w-full lg:h-160 md:h-135 h-100 pb-10 items-baseline mx-auto">
              <div
                class="relative md:mt-60 mt-45 flex items-center justify-center w-full flex-col z-5">
                <div>
                  <h2 class="lg:text-60 md:text-52 text-28 relative">
                    Blogs
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
                      Blogs
                    </li>
                  </ul>
                </div>
              </div>
              <!-- BREADCRUMB ROW END -->
            </div>
          </div>
          <!-- INNER PAGE BANNER END -->

          <!--EXPLORE POPULAR TOUR START-->
          <div
            class="section-full trv-blog-grid-inner xl:pt-30 pt-12.5 xl:pb-22.5 pb-5">
            <div class="container">
              <div class="section-content">
                <div class="trv-blog-grid-inner-row">
                  <div class="row">
                    <!--BOX-1-->
                    <?php
                    $blogs = $obj->select_data('blogs');
                    if (!empty($blogs)) {
                      foreach ($blogs as $blog) {
                    ?>
                        <div class="lg:w-1/3 md:w-1/2 w-full">
                          <div class="relative mb-7.5">
                            <div class="relative z-1 rounded-2xl overflow-hidden">
                              <a href="blog-detail.php?id=<?php echo $blog['id']; ?>">
                                <img
                                  src="<?php echo str_replace('../', '', htmlspecialchars($blog['image'])); ?>"
                                  alt="<?php echo htmlspecialchars($blog['heading']); ?>"
                                  class="w-full object-cover object-center xl:h-113.25 md:h-97.5 h-85"
                                  width="416"
                                  height="453"
                                  loading="lazy" />
                              </a>
                            </div>

                            <!-- Dynamic Date from created_at -->
                            <div class="size-20 text-heading text-base leading-none bg-paleaqua text-center flex flex-col items-center justify-center rounded-md absolute uppercase right-2.5 top-2.5 z-1">
                              <span class="block text-4xl leading-none font-extrabold text-heading">
                                <?php echo date('d', strtotime($blog['created_at'])); ?> <!-- Day -->
                              </span>
                              <?php echo date('M', strtotime($blog['created_at'])); ?> <!-- Month -->
                            </div>

                            <div class="p-7.5 pt-15 rounded-xxl absolute z-1 bottom-0 left-0 w-full bg-linear-(--bg2-gradient)">
                              <div class="text-lg font-medium text-citrusyellow whitespace-nowrap table font-title leading-none pb-3.75">
                                By Admin
                              </div>
                              <div class="">
                                <h3 class="md:text-28 text-22 !text-white">
                                  <a href="blog-detail.php?id=<?php echo $blog['id']; ?>"
                                    class="hover:text-citrusyellow duration-500">
                                    <?php echo htmlspecialchars($blog['heading']); ?> <!-- Dynamic Heading -->
                                  </a>
                                </h3>
                              </div>
                            </div>

                          </div>
                        </div>
                    <?php }
                    } ?>

                  </div>









                  <ul class="relative block my-7.5 text-center">
                    <li class="relative inline-block mx-px prev">
                      <a
                        class="relative flex justify-center items-center size-11.5 text-primary text-lg leading-11.5 font-bold text-center duration-500 font-title z-1 rounded-2lg border border-primary/20 bg-white hover:bg-primary hover:text-white"
                        href="#0">
                        <i class="las la-angle-left"></i>
                      </a>
                    </li>
                    <li class="relative inline-block mx-px">
                      <a
                        class="relative flex justify-center items-center size-11.5 text-primary text-lg leading-11.5 font-bold text-center duration-500 font-title z-1 rounded-2lg border border-transparent hover:border-primary/20 hover:bg-white"
                        href="#0">1</a>
                    </li>
                    <li class="relative inline-block mx-px">
                      <a
                        class="relative flex justify-center items-center size-11.5 text-primary text-lg leading-11.5 font-bold text-center duration-500 font-title z-1 rounded-2lg border border-transparent hover:border-primary/20 hover:bg-white"
                        href="#0">2</a>
                    </li>
                    <li class="relative inline-block mx-px">
                      <a
                        class="relative flex justify-center items-center size-11.5 text-primary text-lg leading-11.5 font-bold text-center duration-500 font-title z-1 rounded-2lg border border-transparent hover:border-primary/20 hover:bg-white"
                        href="#0">3</a>
                    </li>
                    <li class="relative inline-block mx-px">
                      <a
                        class="relative flex justify-center items-center size-11.5 text-primary text-lg leading-11.5 font-bold text-center duration-500 font-title z-1 rounded-2lg border border-transparent hover:border-primary/20 hover:bg-white"
                        href="#0">...</a>
                    </li>
                    <li class="relative inline-block mx-px next">
                      <a
                        class="relative flex justify-center items-center size-11.5 text-primary text-lg leading-11.5 font-bold text-center duration-500 font-title z-1 rounded-2lg border border-primary/20 bg-white hover:bg-primary hover:text-white"
                        href="#0">
                        <i class="las la-angle-right"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!--EXPLORE POPULAR TOUR END-->
        </div>
        <!-- CONTENT END -->

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