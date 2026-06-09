<div class="bg-lightturquoise xl:pt-17.5 pt-12.5 px-5">
    <div class="max-w-250 mx-auto lg:h-25 p-1.75 bg-paleaqua lg:rounded-25xl rounded-2xl">
      <div class="bg-white lg:rounded-25xl rounded-2xl sm:pt-3 sm:pr-3.25 sm:pb-2.25 sm:pl-10 p-5 h-full">
        <form id="locationSearchForm">
          <div class="flex justify-between items-center max-lg:flex-wrap max-sm:flex-col">
            <div class="lg:w-42.5 sm:w-[48%] w-full max-sm:mb-5 max-lg:mb-5 max-lg:border-b border-paleaqua">
              <div class="custom-select style-1" data-label="Color">
                <label class="pb-1.25 flex items-center">
                  <i class="inline-block mr-5">
                    <img src="assets/images/search-icon/icon1.png" alt="Image" class="h-5 w-full" />
                  </i>Location
                </label>
                <!-- <select class="dynamic-select" id="sortingSelect">
                              <option value="Ooty" selected>Ooty</option>
                              <option value="Uttarakhand">Uttarakhand</option>
                              <option value="Bali">Bali</option>
                              <option value="Himachal">Himachal</option>
                              <option value="Darjeeling">Darjeeling</option>
                              <option value="Singapore">Singapore</option>
                              <option value="Malaysia">Malaysia</option>
                            </select> -->
                <!-- <input  type="text" max="10"/> -->
                <input type="text" id="locationInput" placeholder="Search Package..." autocomplete="off"
                  class="outline-none h-8.5 p-0 font-title font-bold text-xl text-primary bg-transparent placeholder:!text-primary w-full border-none" />
              </div>
            </div>
            <div class="lg:w-42.5 sm:w-[48%] w-full max-sm:mb-5 max-lg:mb-5 max-lg:border-b border-paleaqua">
              <div class="custom-select style-1">
                <label class="pb-1.25 flex items-center">
                  <i class="inline-block mr-5"><img src="assets/images/search-icon/icon2.png" alt="Image"
                      class="h-5 w-full" /></i>
                  Activity Type
                </label>
                <select class="dynamic-select" aria-label="Default select example">
                  <option selected>Hill Stations</option>
                  <option value="1">Wildlife</option>
                  <option value="2">Heritage</option>
                  <option value="3">Beachs</option>
                  <option value="3">Honeymoon</option>
                  <option value="3">Yoga & wellness</option>
                  <option value="3">Adventure & Trekking</option>
                </select>
              </div>
            </div>
            <div class="lg:w-42.5 sm:w-[48%] w-full max-sm:mb-5 max-lg:mb-5 max-lg:border-b border-paleaqua">
              <div class="">
                <label class="pb-1.25 flex items-center"><i class="inline-block mr-5"><img
                      src="assets/images/search-icon/icon3.png" class="h-5 w-full"
                      alt="Image" /></i>Date</label>
                <div class="relative">
                  <input
                    class="outline-none h-8.5 p-0 font-title font-bold text-xl text-primary bg-transparent placeholder:!text-primary flatpickr1"
                    placeholder="Date" />
                  <span class="absolute right-3.75 bottom-0 text-input text-lg pointer-events-none">
                    <i class="fa fa-solid fa-calendar-days"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="lg:w-42.5 sm:w-[48%] w-full max-sm:mb-5 max-lg:mb-5 max-lg:border-b border-paleaqua">
              <div class="">
                <label class="pb-1.25 flex items-center"><i class="inline-block mr-5"><img
                      src="assets/images/search-icon/icon4.png" class="h-5 w-full"
                      alt="Image" /></i>Traveler</label>
                <div class="input-group">
                  <span class="flex gap-2.5 w-full">
                    <input type="number" step="1" value="1" name="quantity"
                      class="touchspin h-6 lg:w-17.5 w-full leading-6.75 text-primary font-bold outline-none font-title text-xl" />
                    <button type="button" value="-" data-field="quantity"
                      class="button-minus cursor-pointer size-6 leading-6.75 text-center text-base text-input">
                      <i class="las la-minus text-lg"></i>
                    </button>
                    <button type="button" value="+" data-field="quantity"
                      class="button-plus cursor-pointer size-6 leading-6.75 text-center text-base text-input">
                      <i class="las la-plus text-lg"></i>
                    </button>
                  </span>
                </div>
              </div>
            </div>
            <div class="lg:w-auto w-full">
              <div class="trv-search-st1-search-btn">
                <button type="submit"
                  class="text-28 text-white rounded-full size-15 bg-primary max-lg:w-full! duration-500 cursor-pointer">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>