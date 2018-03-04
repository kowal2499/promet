var PROMET = {};

(function ($) {
    'use strict'

    //----------------------------------------------------/
    // Predefined variables
    //----------------------------------------------------/

    var $window = $(window),
        $document = $(document),
        $body = $('body'),

        // elements
        $preloader = $('.preloader'),
        $mapData = $('#googleMapData'),
        $slider = $('.slick-slider'),
        $sidebarToggle = $('#sidebarToggle')

    //----------------------------------------------------/
    // PAGE LOADER
    //----------------------------------------------------/

    PROMET.loader = function () {
        if (!$preloader.length) return;
        $preloader.fadeOut(400);
    }

    //----------------------------------------------------/
    // GOOGLE MAPS
    //----------------------------------------------------/

    PROMET.googleMaps = function() {
        if (!$mapData.length) return;

        var rawSettings = $mapData.data('settings');
        PROMET.mapSettings = JSON.parse(decodeURIComponent(rawSettings));

        // load external js
        var scriptTag = document.createElement('script');
        scriptTag.src = "https://maps.googleapis.com/maps/api/js?key=" + PROMET.mapSettings.apiKey + "&callback=PROMET.callbackMap";
        document.head.appendChild(scriptTag);
    };

    PROMET.callbackMap = function() {
        // new map
        var map = new google.maps.Map(
            document.getElementById('map'),
            {
                zoom: parseInt(PROMET.mapSettings.zoom),
                center: {lat: parseFloat(PROMET.mapSettings.coordX), lng: parseFloat(PROMET.mapSettings.coordY)},
                scrollwheel: false
            }
        );

        // add marker
        var marker = new google.maps.Marker({
            position: {lat: parseFloat(PROMET.mapSettings.coordX), lng: parseFloat(PROMET.mapSettings.coordY)},
            map: map
        });
    };

    //----------------------------------------------------/
    // SLICK SLIDER
    //----------------------------------------------------/

    PROMET.slider = function() {
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

    //----------------------------------------------------/
    // SLIDEBARS
    //----------------------------------------------------/

    PROMET.slidebars = function() {
        PROMET.slidebarsController = new slidebars();
        PROMET.slidebarsController.init();

        $sidebarToggle.on('click', function (event) {
            event.stopPropagation();
            event.preventDefault();

            PROMET.slidebarsController.toggle('mobileSidebar');
        });

        jQuery(window).on('resize', function () {
            // close mobile sidebars
            PROMET.slidebarsController.close('mobileSidebar');
        });
    }

    //----------------------------------------------------/
    // HOME PRODUCTS WIDGET
    //----------------------------------------------------/

    PROMET.homeProductsWidget = function() {
        $document.on('click', '#home-products .menu .valingContent', PROMET.homeProductsWidgetClick);
        $('#home-products ul li:first-child .valingContent').trigger('click');
    }

    PROMET.homeProductsWidgetClick = function(e) {
        // ustaw aktywny element w menu
        jQuery(e.target).closest('ul').find('li').removeClass('active');
        jQuery(e.target).closest('li').addClass('active');

        var selectedCategory = jQuery(e.target).closest('li').data('category');

        var specimens = jQuery('.showcase .specimen');
        for (var i = 0; i < specimens.length; i++) {
            if (jQuery(specimens[i]).data('category') === selectedCategory) {
                jQuery(specimens[i]).show();
            } else {
                jQuery(specimens[i]).hide();
            }
        }
    }

    //----------------------------------------------------/
    // SINGLE PRODUCT
    //----------------------------------------------------/

    PROMET.singleProduct = function() {
        if (!$('#single-product').length) return;

        jQuery(document).on('click', '#single-product .thumbnails .blend', PROMET.singleProductThumbnailClick);
        jQuery('#single-product .thumbnails .blend').first().trigger('click');

        // enable lightbox
        jQuery('#single-product .scene a').simpleLightbox({});
    }

    PROMET.singleProductThumbnailClick = function(e) {
        // get an id of the clicked element
        var id = jQuery(e.target).data('id');
        jQuery('#single-product .thumbnails .tile .blend').removeClass('active');
        jQuery(e.target).addClass('active');
        // hide all on scene
        jQuery('#single-product .scene img').css('display', 'none');
        jQuery('#single-product .scene img[data-id="' + id + '"]').css('display', 'block');
        jQuery('#single-product .scene img[data-id="' + id + '"]').addClass('animated fadeIn');
    }


    //----------------------------------------------------/
    // DOM READY
    //----------------------------------------------------/

    $document.ready(function() {
        PROMET.loader();
        PROMET.slidebars();
        PROMET.slider();
        PROMET.homeProductsWidget(),
        PROMET.singleProduct();
        PROMET.googleMaps();
    });

})(jQuery);
