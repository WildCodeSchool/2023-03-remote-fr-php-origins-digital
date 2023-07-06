import Swiper from 'swiper/bundle';
import 'swiper/css/bundle'
import './styles/swiper.scss'

window.Swiper = Swiper;

const swiper = new Swiper(".mySwiper_recommandation", {
    // Default parameters
    slidesPerView: 2,
    slidesPerGroup: 2,
    spaceBetween: 10,
    preload: 'none',
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    // Responsive breakpoints
    breakpoints: {
    // when window width is >= 576px
        576: {
            slidesPerView: 2,
            slidesPerGroup: 2,
            spaceBetween: 20
        },
        // when window width is >= 768px
        768: {
            slidesPerView: 3,
            slidesPerGroup: 3,
            spaceBetween: 20
        },
        // when window width is >= 992px
        992: {
            slidesPerView: 4,
            slidesPerGroup: 4,
            spaceBetween: 20
        }
    }
});

const swiperNew = new Swiper(".mySwiper_nouveaute", {
    // Default parameters
    slidesPerView: 2,
    spaceBetween: 10,
    preload: 'none',
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    // Responsive breakpoints
    breakpoints: {
    // when window width is >= 576px
        576: {
            slidesPerView: 2,
            spaceBetween: 1
        },
        // when window width is >= 768px
        768: {
            slidesPerView: 3,
            spaceBetween: 2
        },
        // when window width is >= 992px
        992: {
            slidesPerView: 4,
            spaceBetween: 2
        }
    }
});
const swiper_favoris = new Swiper('.videoBookmarksSwiper', {
    loop: false,
    slidesPerView: 4,
    spaceBetween: 2,
    direction: "vertical",
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});


const swiperTop = new Swiper(".mySwiper_top", {
    // Default parameters
    slidesPerView: 3.5,
    spaceBetween: 20,
    cssMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
    mousewheel: true,
    keyboard: true,
});
