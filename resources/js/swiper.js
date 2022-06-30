// import Swiper bundle with all modules installed
import Swiper from "swiper/bundle";

// import styles bundle
import "swiper/css/bundle";

document.addEventListener("DOMContentLoaded", function () {
    // init Swiper:
    const swiper = new Swiper(".swiper", {
        pagination: {
            el: ".swiper-pagination",
            type: "bullets",
            clickable: true,
        },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        loop: true,
        slidesPerView: 1,
        slidesPerGroup: 1,
        initialSlide: 1,
        spaceBetween: 20,
        breakpoints: {
            1200: {
                slidesPerView: 3,
                slidesPerGroup: 3,
            },
            900: {
                slidesPerView: 2,
                slidesPerGroup: 2,
            },
        },
    });
});
