
(function($) {
    'use strict'
    $(document).ready(function () {

        var App = {
            slidebarsController: undefined,
            slidebarName: 'mobileSidebar',

            FrontPage: {Products: {
            }}
        }


        App.FrontPage.Products.click = function(e) {
            // ustaw aktywny element w menu
            $(e.target).closest('ul').find('li').removeClass('active');
            $(e.target).closest('li').addClass('active');

            var selectedCategory = $(e.target).closest('li').data('category');
            
            var specimens = $('.showcase .specimen');
            for (var i=0; i<specimens.length; i++) {
                if ($(specimens[i]).data('category') === selectedCategory) {
                    $(specimens[i]).show();
                } else {
                    $(specimens[i]).hide();
                }
            }
        }

        App.addAnimation = function(e) {
            $('.slideContent h1').addClass('animated fadeInDown visible').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd', function() {
                $(this).removeClass('animated fadeInDown');
            });

            $('.slideContent p.lead').addClass('animated fadeInUp visible ').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd', function() {
                $(this).removeClass('animated fadeInUp');
            });

            $('.slideContent .actor').addClass('animated fadeInLeft visible').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd', function() {
                $(this).removeClass('animated fadeInLeft');
            });
        }

        App.init = function() {
            // Initialize Slidebars
            this.slidebarsController = new slidebars();
            this.slidebarsController.init();

            this.slick = $('.slick-slider').slick({
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

            this.slick.on('init', function(event, slick, currentSlide, nextSlide){
                App.addAnimation();
                console.log('init')
              });

            this.slick.on('afterChange init', function(event, slick, currentSlide, nextSlide){
                App.addAnimation();
              });

              this.slick.on('beforeChange', function(event, slick, currentSlide, nextSlide){
                $('.slideContent h1').removeClass('visible');
                $('.slideContent p.lead').removeClass('visible');
                $('.slideContent .actor').removeClass('visible');
              });
        }

        App.events = function() {
            var el = this;
            $('#sidebarToggle').on('click', function(event) {
                event.stopPropagation();
                event.preventDefault();

                el.slidebarsController.toggle(el.slidebarName);
            });

            $(window).on('resize', function() {
                // close mobile sidebars
                el.slidebarsController.close(el.slidebarName);
            });

            $(document).on('click', '#home-products .menu .valingContent', App.FrontPage.Products.click);
            $('#home-products ul li:first-child .valingContent').trigger('click');

        }
    
        App.init();
        App.events();
    });

})(jQuery);