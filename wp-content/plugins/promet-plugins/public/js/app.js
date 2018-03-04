'use strict'


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
        $map = $('#googleMapData');

    //----------------------------------------------------/
    // PAGE LOADER
    //----------------------------------------------------/
    PROMET.loader = function () {
        if (!$preloader.length) return;
        $preloader.fadeOut(400);
    }

    //Document ready functions
    $document.ready(function() {
        PROMET.loader();
    });

})(jQuery);


// (function (jQuery) {
    
    // jQuery(document).ready(function () {

    var App = {
        slidebarsController: undefined,
        slidebarName: 'mobileSidebar',

        FrontPage: { Products: {} },
        SingleProduct: { Thumbnails: {} },
        GoogleMaps: {}
    }

    App.GoogleMaps.init = function() {
        var elm = jQuery('#googleMapData');
        if (elm.length == 0) return;

        var rawSettings = elm.data('settings');
        this.mapSettings = JSON.parse(decodeURIComponent(rawSettings));

        // load external js
        var scriptTag = document.createElement('script');
        scriptTag.src = "https://maps.googleapis.com/maps/api/js?key=" + this.mapSettings.apiKey + "&callback=App.GoogleMaps.initMap";
        document.head.appendChild(scriptTag);
    }

    App.GoogleMaps.initMap = function() {
        // new map
        var map = new google.maps.Map(
            document.getElementById('map'),
            {
                zoom: parseInt(this.mapSettings.zoom),
                center: {lat: parseFloat(this.mapSettings.coordX), lng: parseFloat(this.mapSettings.coordY)},
                scrollwheel: false
            }
        );

        // add marker
        var marker = new google.maps.Marker({
            position: {lat: parseFloat(this.mapSettings.coordX), lng: parseFloat(this.mapSettings.coordY)},
            map: map
        });
    }

    App.SingleProduct.Thumbnails.click = function (e) {
        // get an id of the clicked element
        var id = jQuery(e.target).data('id');
        jQuery('#single-product .thumbnails .tile .blend').removeClass('active');
        jQuery(e.target).addClass('active');
        // hide all on scene
        jQuery('#single-product .scene img').css('display', 'none');
        jQuery('#single-product .scene img[data-id="' + id + '"]').css('display', 'block');
        jQuery('#single-product .scene img[data-id="' + id + '"]').addClass('animated fadeIn');
    }

    App.FrontPage.Products.click = function (e) {
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

    App.addAnimation = function (e) {
        jQuery('.slideContent h1').addClass('animated fadeInDown visible').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd', function () {
            jQuery(this).removeClass('animated fadeInDown');
        });

        jQuery('.slideContent p.lead').addClass('animated fadeInUp visible ').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd', function () {
            jQuery(this).removeClass('animated fadeInUp');
        });

        jQuery('.slideContent .actor').addClass('animated fadeInLeft visible').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd', function () {
            jQuery(this).removeClass('animated fadeInLeft');
        });
    }

    App.init = function () {
        // Initialize Slidebars
        this.slidebarsController = new slidebars();
        this.slidebarsController.init();

        this.slick = jQuery('.slick-slider').slick({
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3500,
            fade: true,
            cssEase: 'linear',
            pauseOnHover: false,
            arrows: false
        });

        // comment

        App.addAnimation();

        this.slick.on('init', function (event, slick, currentSlide, nextSlide) {
            App.addAnimation();
        });

        this.slick.on('afterChange init', function (event, slick, currentSlide, nextSlide) {
            App.addAnimation();
        });

        this.slick.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            jQuery('.slideContent h1').removeClass('visible');
            jQuery('.slideContent p.lead').removeClass('visible');
            jQuery('.slideContent .actor').removeClass('visible');
        });

        // lightbox
        jQuery('#single-product .scene a').simpleLightbox({});

        // google maps
        this.GoogleMaps.init();
    }

    App.events = function () {
        var el = this;
        jQuery('#sidebarToggle').on('click', function (event) {
            event.stopPropagation();
            event.preventDefault();

            el.slidebarsController.toggle(el.slidebarName);
        });

        jQuery(window).on('resize', function () {
            // close mobile sidebars
            el.slidebarsController.close(el.slidebarName);
        });

        jQuery(document).on('click', '#home-products .menu .valingContent', App.FrontPage.Products.click);
        jQuery(document).on('click', '#single-product .thumbnails .blend', App.SingleProduct.Thumbnails.click);

        jQuery('#home-products ul li:first-child .valingContent').trigger('click');
        jQuery('#single-product .thumbnails .blend').first().trigger('click');
    }

    App.init();
    App.events();
    // });

// })(jQuery);