/* Sets slider */
const setSlider = () => {
    $('.slider').slick({
        dots: false,
        infinite: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 3000,
        waitForAnimate: false,
    });
};

/* jQuery functions */
$(document).ready(function () {
    setSlider();
});
