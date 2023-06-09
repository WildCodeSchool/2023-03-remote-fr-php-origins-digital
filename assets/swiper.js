import Swiper from 'swiper/bundle';
import 'swiper/css/bundle'
import './styles/swiper.scss'

window.Swiper = Swiper;

const swiper = new Swiper(".mySwiper_recommandation", {
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


