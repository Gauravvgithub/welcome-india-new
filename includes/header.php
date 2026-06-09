<?php
include_once('config/db.php');
$obj = new database();
?>
<header
  class="site-header sticky-header absolute lg:left-8.75 lg:right-8.75 lg:top-8.75 left-0 right-0 top-0 duration-500 z-999 [.site-header.is-fixed]:fixed [.site-header.is-fixed]:animate-header-scroll-animation [.site-header.is-fixed]:bg-primary [.site-header.is-fixed]:rounded-b-3xl [.site-header.is-fixed]:top-0"
  style="background-color: #ffffff; border-radius: 25px">
  <div class="main-bar-wraper">
    <div
      class="w-full lg:min-h-30 min-h-20 lg:ps-8.75 px-4 lg:pe-13.75 duration-500 rounded-5xl flex items-center justify-between">
      <div class="flex relative w-full">
        <div class="flex items-center relative z-9 h-20 lg:w-44 w-30">
          <a href="./" class="table-cell align-middle">
            <img src="assets/images/main-logo.webp" alt="logo" class="object-contain duration-500"
              style="width: 256px; height: 105px" />
          </a>
        </div>
        <button
          class="xmenu-toggler lg:hidden float-right mt-4.5 mb-4 md:ml-7 ml-4 size-11 bg-dark-600 relative cursor-pointer max-lg:order-1"
          type="button">
          <span class="block absolute left-2.5 h-0.5 rounded-px bg-white duration-300 top-3.25 w-5.5"
            style="background-color: #000000"></span>
          <span class="block absolute left-2.5 h-0.5 rounded-px bg-white duration-0 top-5.5 w-6.25"
            style="background-color: #000000"></span>
          <span class="block absolute left-2.5 h-0.5 rounded-px bg-white duration-300 top-8 w-4"
            style="background-color: #000000"></span>
        </button>
        <div
          class="lg:hidden fixed top-0 left-0 bg-black size-full duration-300 z-999 opacity-0 visible pointer-events-none menu-close fade-overlay">
        </div>
        <div
          class="flex lg:justify-center lg:basis-auto lg:grow max-lg:flex-col justify-start font-base max-lg:fixed max-lg:h-screen max-lg:px-5 max-lg:top-0 max-lg:-left-75 max-lg:z-9999 max-lg:bg-white max-lg:w-72 max-lg:overflow-auto max-lg:duration-700 header-nav custom-scroll">
          <div class="flex items-center relative z-9 py-6.25 lg:hidden">
            <a href="./" class="table-cell align-middle">
              <img src="assets/images/main-logo.webp" alt="" class="object-contain duration-500" />
            </a>
          </div>
          <ul class="lg:flex flex-wrap navbar-nav">
            <li class="lg:inline-block block max-lg:border-b max-lg:border-gray-200 relative group">
              <a class="lg:py-7.5 py-2 xl:px-5 lg:px-2 relative lg:inline-block block text-lg font-medium lg:text-#022943 text-#022943 hover:text-#022943"
                href="./">
                <span class="inline-block">Home</span>
                <i
                  class="fas fa-chevron-right lg:!hidden !block size-7 !leading-7 text-center text-xs bg-black text-white float-end"></i>
              </a>
            </li>
            <li class="lg:inline-block block max-lg:border-b max-lg:border-gray-200 relative group">
              <a class="lg:py-7.5 py-2 xl:px-5 lg:px-2 relative lg:inline-block block text-lg font-medium lg:text-#022943 text-#022943 hover:text-#022943"
                href="about-us.php">
                <span class="inline-block">About</span>
              </a>
            </li>
            <li class="lg:inline-block block max-lg:border-b max-lg:border-gray-200 relative group">
              <a class="lg:py-7.5 py-2 xl:px-5 lg:px-2 relative lg:inline-block block text-lg font-medium lg:text-#022943 text-#022943 hover:text-#022943"
                href="#">
                <span class="inline-block">Destinations</span>
                <i
                  class="fas fa-chevron-right lg:!hidden !block size-7 !leading-7 text-center text-xs bg-black text-white float-end"></i>
              </a>
              <ul
                class="lg:absolute bg-white lg:rounded-xxl block lg:left-0 w-full lg:w-55 lg:opacity-0 lg:invisible lg:translate-y-10 z-10 mt-0 text-left duration-500 lg:group-hover:opacity-100 lg:group-hover:visible lg:group-hover:translate-y-0 max-lg:hidden sub-menu">
                <?php
                $categories = $obj->select_data('destination');
                if (!empty($categories)) {
                  foreach ($categories as $category) {
                ?>
                    <li class="relative border-b border-black/5">
                      <a class="block relative text-sm text-primary font-semibold py-3 lg:px-5 duration-500 hover:text-primary hover:pl-6.25"
                        href="destinations.php?id=<?php echo $category['id']; ?>">
                        <span><?php echo ucwords(htmlspecialchars($category['destination_name'])); ?></span> <!-- Dynamic Name -->
                      </a>
                    </li>
                <?php
                  }
                }
                ?>
              </ul>
            </li>
            <li class="lg:inline-block block max-lg:border-b max-lg:border-gray-200 relative group">
              <a class="lg:py-7.5 py-2 xl:px-5 lg:px-2 relative lg:inline-block block text-lg font-medium lg:text-#022943 text-#022943 hover:text-#022943"
                href="gallery.php">
                <span class="inline-block">Gallery</span>
                <i
                  class="fas fa-chevron-right lg:!hidden !block size-7 !leading-7 text-center text-xs bg-black text-white float-end"></i>
              </a>
            </li>
            <li class="lg:inline-block block max-lg:border-b max-lg:border-gray-200 relative group">
              <a class="lg:py-7.5 py-2 xl:px-5 lg:px-2 relative lg:inline-block block text-lg font-medium lg:text-#022943 text-#022943 hover:text-#022943"
                href="blogs.php">
                <span class="inline-block">Blogs</span>
                <i
                  class="fas fa-chevron-right lg:!hidden !block size-7 !leading-7 text-center text-xs bg-black text-white float-end"></i>
              </a>

            </li>
            <li class="lg:inline-block block max-lg:border-b max-lg:border-gray-200 relative group">
              <a class="lg:py-7.5 py-2 xl:px-5 lg:px-2 relative lg:inline-block block text-lg font-medium lg:text-#022943 text-#022943 hover:text-#022943"
                href="contact.php">
                <span class="inline-block">Contact</span>
              </a>
            </li>
          </ul>
          <div class="lg:hidden block max-lg:p-5 text-center mt-auto">
            <ul>
              <li class="inline-block mx-0.5">
                <a class="size-10 !leading-10 border border-black/10 text-center text-primary fab fa-facebook-f"
                  target="_blank" href="https://www.facebook.com/"></a>
              </li>
              <li class="inline-block mx-0.5">
                <a class="size-10 !leading-10 border border-black/10 text-center text-primary fab fa-twitter"
                  target="_blank" href="https://twitter.com/"></a>
              </li>
              <li class="inline-block mx-0.5">
                <a class="size-10 !leading-10 border border-black/10 text-center text-primary fab fa-linkedin-in"
                  target="_blank" href="https://www.linkedin.com/"></a>
              </li>
              <li class="inline-block mx-0.5">
                <a class="size-10 !leading-10 border border-black/10 text-center text-primary fab fa-instagram"
                  target="_blank" href="https://www.instagram.com/"></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="flex lg:justify-end lg:items-center z-9 h-20 xl:pl-8 max-lg:ms-auto">
          <div class="flex items-center">
            <ul class="ml-5 flex items-center -mr-2.5">
              <li class="inline-block" data-drawer="#offcanvas-right" data-drawer-placement="right">
                <button
                  class="lg:mt-4.5 lg:mb-4 lg:ml-5 lg:size-11 bg-dark-600 relative cursor-pointer max-lg:order-1 max-md:ms-auto toggle-nav-btn"
                  type="button" aria-label="Toggle drawer">
                  <span
                    class="block absolute left-2.5 h-0.5 rounded-px bg-black duration-300 top-3.25 w-7 max-lg:hidden"></span>
                  <span
                    class="block absolute left-2.5 h-0.5 rounded-px bg-black duration-0 top-5.5 w-7 max-lg:hidden"></span>
                  <span
                    class="block absolute left-2.5 h-0.5 rounded-px bg-black duration-300 top-8 w-7 max-lg:hidden"></span>
                  <b
                    class="lg:hidden uppercase fixed -rotate-90 -translate-y-1/2 -right-7.5 bg-primary px-5 rounded-t-2lg text-white tracking-[2px] top-1/2">Info</b>
                </button>
              </li>
            </ul>
          </div>
        </div>
        <div
          class="fixed -top-full left-0 size-full bg-body-bg z-999 flex items-center justify-center p-8 duration-500 xmenu-search"
          id="searchOverlay1">
          <form
            class="absolute top-1/2 left-1/2 -translate-1/2 w-[calc(100%_-_80px)] max-w-150 text-primary text-3xl font-light text-left outline-none p-1.5 duration-500 bg-paleaqua rounded-25xl"
            action="#">
            <div class="relative flex flex-wrap items-stretch w-full bg-white rounded-25xl overflow-hidden">
              <input name="search" value="" type="text"
                class="h-17.5 pr-3 pl-7.5 text-lg text-primary w-[1%] flex-1 outline-none duration-300 placeholder:text-primary focus:border-primary"
                placeholder="Search..." />
              <span class="flex">
                <button type="button"
                  class="px-2.5 outline-none size-17.5 bg-primary text-2xl text-white rounded-full flex-1 ml-2.5 duration-500 cursor-pointer">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
          <button type="button"
            class="absolute right-8 top-8 text-primary bg-citrusyellow text-base size-10 cursor-pointer rounded search-remove">
            <i class="fa fa-close"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</header>