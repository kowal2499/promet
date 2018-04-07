
(function ($) {
    'use strict'

//----------------------------------------------------/
// SLICK SLIDER
//----------------------------------------------------/

PROMET.slider = function() {
    var $slider = PROMET.globals.$slider;
    
    if (!$slider.length) return;
    $slider.slick({
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3500,
        fade: true,
        cssEase: 'linear',
        pauseOnHover: false,
        arrows: false
    });

    PROMET.sliderAddAnimation();

    $slider.on('init', function (event, slick, currentSlide, nextSlide) {
        PROMET.sliderAddAnimation();
    });

    $slider.on('afterChange init', function (event, slick, currentSlide, nextSlide) {
        PROMET.sliderAddAnimation();
    });

    $slider.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        $('.slideContent h1').removeClass('visible');
        $('.slideContent p.lead').removeClass('visible');
        $('.slideContent .actor').removeClass('visible');
    });
};

PROMET.sliderAddAnimation = function() {
    $('.slideContent h1').addClass('animated fadeInDown visible').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd', function () {
        $(this).removeClass('animated fadeInDown');
    });

    $('.slideContent p.lead').addClass('animated fadeInUp visible ').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd', function () {
        $(this).removeClass('animated fadeInUp');
    });

    $('.slideContent .actor').addClass('animated fadeInLeft visible').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd', function () {
        $(this).removeClass('animated fadeInLeft');
    });
};

})(jQuery);