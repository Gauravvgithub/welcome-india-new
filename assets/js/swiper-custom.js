document.addEventListener("DOMContentLoaded", function () {

  document.querySelectorAll(".trv-tours-st2").forEach(function (slider) {

    new Swiper(slider, {

      slidesPerView: 4,
      spaceBetween: 30,

      grid: {
        rows: 2,
        fill: "row",
      },

      navigation: {
        nextEl: slider.querySelector(".swiper-button-next"),
        prevEl: slider.querySelector(".swiper-button-prev"),
      },

      breakpoints: {

        0: {
          slidesPerView: 1,
          grid: { rows: 2 }
        },

        640: {
          slidesPerView: 2,
          grid: { rows: 2 }
        },

        1024: {
          slidesPerView: 3,
          grid: { rows: 2 }
        },

        1280: {
          slidesPerView: 4,
          grid: { rows: 2 }
        }

      }

    });

  });

});