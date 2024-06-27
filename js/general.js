let swiper = new Swiper(".mySwiper", {
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 3000,
    },
    allowSlideNext: true,
    allowSlidePrev: true,
    loop: true,
    calculateHeight: true,
    autoHeight: true
});

document.addEventListener('DOMContentLoaded', (event) => {
    const burgerMenu = document.querySelector('.burger-menu');
    const mobileNav = burgerMenu.querySelector('.mobile-menu');
    burgerMenu.addEventListener('click', () => {
        mobileNav.classList.toggle('active');
    });
});