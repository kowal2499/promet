
(function ($) {
    'use strict'

    //----------------------------------------------------/
    // PAGE LOADER
    //----------------------------------------------------/

    PROMET.loader = function () {
        var preloader = PROMET.globals.$preloader;
        if (!preloader.length) return;
        preloader.fadeOut(400);
    }

    //----------------------------------------------------/
    // GOOGLE MAPS
    //----------------------------------------------------/

    PROMET.googleMaps = function() {
        var $mapData = PROMET.globals.$mapData;
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
    // SLIDEBARS
    //----------------------------------------------------/

    PROMET.slidebars = function() {
        PROMET.slidebarsController = new slidebars();
        PROMET.slidebarsController.init();

        PROMET.globals.$sidebarToggle.on('click', function (event) {
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
        PROMET.globals.$document.on('click', '#home-products .menu .valingContent', PROMET.homeProductsWidgetClick);
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

        PROMET.globals.$document.on('click', '#single-product .thumbnails .blend', PROMET.singleProductThumbnailClick);
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

    PROMET.globals.$document.ready(function() {
        PROMET.loader();
        PROMET.slidebars();
        PROMET.slider();
        PROMET.homeProductsWidget();
        PROMET.singleProduct();
        PROMET.googleMaps();
        PROMET.contactFormSubmit();
    });

})(jQuery);
