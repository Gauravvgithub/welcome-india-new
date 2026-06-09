<footer class="pt-10 bg-primary bg-cover bg-[url(../images/background/ftr-dark-bg.png)]">
  <div class="container">
    <div class="text-white/06 border-b border-primary">
      <div class="grid grid-cols-12">
        <div class="lg:col-span-3 col-span-12 sm:px-3.75">
          <div>
            <div class="mb-4 text-center block max-w-48.25 after:table after:clear-both">
              <a href="./"><img
                  src="assets/images/main-logo.webp"
                  alt="logo"
                  width="110"
                  height="40"
                  loading="lazy"
                  class="rounded-2xl" /></a>
            </div>
            <p class="sm:pr-12.5 mb-4 text-base text-white/50">
              Experience the vibrant culture and scenic beauty of India. Plan your trip with Incredible India!
            </p>
            <ul class="mt-5">
              <li
                class="inline-flex xl:size-11.5 size-10.5 bg-citrusyellow xl:mr-2.5 mr-1.5 rounded-4xl justify-center items-center duration-500 hover:rounded-2lg group">
                <a
                  class="inline-flex size-9 bg-primary rounded-4xl justify-center items-center duration-500 text-white text-lg group-hover:rounded-2lg"
                  href="#"
                  target="_blank">
                  <i
                    class="fa-brands fa-whatsapp group-hover:rotate-y-[360deg] group-hover:scale-[1.2] !inline-block duration-[0.5s] group-hover:text-citrusyellow"></i>
                </a>
              </li>
              <li
                class="inline-flex xl:size-11.5 size-10.5 bg-citrusyellow xl:mr-2.5 mr-1.5 rounded-4xl justify-center items-center duration-500 hover:rounded-2lg group">
                <a
                  class="inline-flex size-9 bg-primary rounded-4xl justify-center items-center duration-500 text-white text-lg group-hover:rounded-2lg"
                  href="https://www.facebook.com"
                  target="_blank">
                  <i
                    class="fa-brands fa-facebook group-hover:rotate-y-[360deg] group-hover:scale-[1.2] !inline-block duration-[0.5s] group-hover:text-citrusyellow"></i>
                </a>
              </li>
              <li
                class="inline-flex xl:size-11.5 size-10.5 bg-citrusyellow xl:mr-2.5 mr-1.5 rounded-4xl justify-center items-center duration-500 hover:rounded-2lg group">
                <a
                  class="inline-flex size-9 bg-primary rounded-4xl justify-center items-center duration-500 text-white text-lg group-hover:rounded-2lg"
                  href="https://www.instagram.com"
                  target="_blank">
                  <i
                    class="fa-brands fa-instagram group-hover:rotate-y-[360deg] group-hover:scale-[1.2] !inline-block duration-[0.5s] group-hover:text-citrusyellow"></i>
                </a>
              </li>
              <!--<li-->
              <!--  class="inline-flex xl:size-11.5 size-10.5 bg-citrusyellow xl:mr-2.5 mr-1.5 rounded-4xl justify-center items-center duration-500 hover:rounded-2lg group">-->
              <!--  <a-->
              <!--    class="inline-flex size-9 bg-primary rounded-4xl justify-center items-center duration-500 text-white text-lg group-hover:rounded-2lg"-->
              <!--    href="https://www.x.com"-->
              <!--    target="_blank">-->
              <!--    <i-->
              <!--      class="fa-brands fa-youtube group-hover:rotate-y-[360deg] group-hover:scale-[1.2] !inline-block duration-[0.5s] group-hover:text-citrusyellow"></i>-->
              <!--  </a>-->
              <!--</li>-->
              <li class="inline-flex xl:size-11.5 size-10.5 bg-citrusyellow xl:mr-2.5 mr-1.5 rounded-4xl justify-center items-center duration-500 hover:rounded-2lg group">
                <a class="inline-flex size-9 bg-primary rounded-4xl justify-center items-center duration-500 text-white text-lg group-hover:rounded-2lg"
                href="https://www.tripadvisor.in/Profile/welcomeindiaholidays"
                target="_blank">
                 <i class="si si-tripadvisor group-hover:rotate-y-[360deg] group-hover:scale-[1.2] !inline-block duration-[0.5s] group-hover:text-citrusyellow"></i>
                </a>
             </li>
              
              
              
            </ul>
          </div>
        </div>
        <div class="lg:col-span-2 col-span-6 mb-5 sm:px-3.75">
          <div class="mb-10">
            <h3 class="!text-white mb-7.5 relative xl:text-28 text-2xl">Explore</h3>
            <ul>
              <li class="block w-full py-0.5 overflow-hidden">
                <a class="pb-1.5 block duration-500 text-base text-paleaqua font-semibold hover:text-citrusyellow"
                  href="./">Home</a>
              </li>
              <li class="block w-full py-0.5 overflow-hidden">
                <a class="pb-1.5 block duration-500 text-base text-paleaqua font-semibold hover:text-citrusyellow"
                  href="about-us.php">About us</a>
              </li>
              <li class="block w-full py-0.5 overflow-hidden">
                <a class="pb-1.5 block duration-500 text-base text-paleaqua font-semibold hover:text-citrusyellow"
                  href="gallery.php">Gallery</a>
              </li>
              <li class="block w-full py-0.5 overflow-hidden">
                <a class="pb-1.5 block duration-500 text-base text-paleaqua font-semibold hover:text-citrusyellow"
                  href="blogs.php">Blogs</a>
              </li>
              <li class="block w-full py-0.5 overflow-hidden">
                <a class="pb-1.5 block duration-500 text-base text-paleaqua font-semibold hover:text-citrusyellow"
                  href="contact.php">Contact us</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="lg:col-span-2 col-span-6 mb-5 sm:px-3.75">
          <div class="mb-10">
            <h3 class="!text-white mb-7.5 relative xl:text-28 text-2xl">Destinations</h3>
            <?php
            $categories = $obj->select_data('destination');
            if (!empty($categories)) {
              foreach ($categories as $category) {
            ?>
                <li class="block w-full py-0.5 overflow-hidden">
                  <a
                    class="pb-1.5 block duration-500 text-base text-paleaqua font-semibold hover:text-citrusyellow"
                    href="destinations.php?id=<?php echo $category['id']; ?>"><?php echo ucwords(htmlspecialchars($category['destination_name'])); ?> Tour</a>
                </li>
            <?php
              }
            }
            ?>

            <ul>

              <h3 class="!text-white mb-5 mt-3 relative xl:text-28 text-2xl">Legal</h3>
              <li class="block w-full py-0.5 overflow-hidden">
                <a
                  class="pb-1.5 block duration-500 text-base text-paleaqua font-semibold hover:text-citrusyellow"
                  href="terms-conditions.php">Terms & Condition</a>
              </li>
              <li class="block w-full py-0.5 overflow-hidden">
                <a
                  class="pb-1.5 block duration-500 text-base text-paleaqua font-semibold hover:text-citrusyellow"
                  href="privacy-policy.php">Privacy Policy</a>
              </li>
              <li class="block w-full py-0.5 overflow-hidden">
                <a
                  class="pb-1.5 block duration-500 text-base text-paleaqua font-semibold hover:text-citrusyellow"
                  href="contact.php">Contact</a>
              </li>

            </ul>
          </div>
        </div>
        <div class="lg:col-span-3 sm:col-span-6 col-span-12 sm:px-3.75">
          <div class="mb-10">
            <ul>
              <li class="mb-2.5 relative flex items-center">
                <div
                  class="xl:size-14 size-12 xl:min-w-14 min-w-12 rounded-full mr-3.5 bg-white/40 flex items-center justify-center">
                  <i class="fa-solid fa-phone text-xl text-white"></i>
                </div>
                <a href="tel:9958656551">
                  <span class="xl:text-3xl text-2xl text-citrusyellow font-normal font-display">+91 9958656551</span>
                </a>
              </li>
              <li class="mb-2.5 relative flex items-center">
                <div
                  class="xl:size-14 size-12 xl:min-w-14 min-w-12 rounded-full mr-3.5 bg-white/40 flex items-center justify-center">
                  <i class="fa-solid fa-envelope text-xl text-white"></i>
                </div>
                <a class="black text-paleaqua font-semibold xl:text-lg text-sm font-base" href="mailto:info@example.com">Info.welcomeindiaholidays@gmail.com</a>
              </li>
              <li class="relative flex items-center">
                <div
                  class="xl:size-14 size-12 xl:min-w-14 min-w-12 rounded-full mr-3.5 bg-white/40 flex items-center justify-center">
                  <i class="fa-solid fa-house text-xl text-white"></i>
                </div>
                <span class="black text-paleaqua font-semibold xl:text-lg text-sm font-base">Suit No. 1/18A, Mahavir Enclave, Dwarka , Palam, Dabri Road , New Delhi-110045</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div
      class="py-2 text-white relative z-1 font-normal after:absolute after:bg-primary after:max-w-135 after:h-px after:left-1/2 after:top-0 after:-translate-x-1/2">
      <div class="container">
        <p class="copyrights-text text-center text-sm font-semibold">
          © <span class="current-year"></span>
          <a href="http://weclomeindiaholidays.com" target="_blank"><span class="inline-block text-citrusyellow uppercase text-center text-sm font-semibold">Weclome India Holidays</span></a>
          All Rights Reserved.
        </p>
      </div>
      <div class="container">
        <p class="copyrights-text text-center text-sm font-semibold">
          Developed By
          <a href="https://highdigitech.com" target="_blank"><span class="inline-block text-citrusyellow uppercase text-center text-sm font-semibold">High Digi Tech
            </span></a>
        </p>
      </div>
    </div>
  </div>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-icons-font@14.3.0/font/simple-icons.min.css">
  <!-- FOOTER COPYRIGHT -->
</footer>