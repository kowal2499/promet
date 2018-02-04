<?php


class Promet_Products_Widget extends WP_Widget {

    function __construct() {
		parent::__construct('promet_products_widget', 'Promet Products', array(
			'description' => 'Widget pokazuje produkty firmy'
        ));

        Widget_Setup::getInstance()
            ->enqueue_style('bootstrap', plugins_url('/promet-plugins/public/css/vendor/bootstrap.min.css'))
            ->enqueue_style('owl.carousel.base', plugins_url('/promet-plugins/public/css/vendor/owl.carousel.min.css'))
            ->enqueue_style('slidebars', plugins_url('/promet-plugins/public/css/vendor/slidebars.min.css'))

            ->enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,700,900&amp;subset=latin-ext')
            // ->enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700,800&amp;subset=latin-ext')
            // ->enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700&subset=latin-ext')

            ->enqueue_style('fontawsome', plugins_url('/promet-plugins/public/css/vendor/fontawesome-all.css'))
            ->enqueue_style('animate', plugins_url('/promet-plugins/public/css/vendor/animate.css'))

            ->enqueue_style('css.custom', plugins_url('/promet-plugins/public/css/custom.css'))

            ->enqueue_script('jQuery3', plugins_url('/promet-plugins/public/js/vendor/jquery-3.3.1.min.js'), '', '1.0.0', true)
            ->enqueue_script('owl.carousel', plugins_url('/promet-plugins/public/js/vendor/owl.carousel.min.js'), 'jQuery3', '1.0.0', true)
            ->enqueue_script('bootstrap', plugins_url('/promet-plugins/public/js/vendor/bootstrap.min.js'), 'jQuery3', '1.0.0', true)
            ->enqueue_script('slidebars', plugins_url('/promet-plugins/public/js/vendor/slidebars.min.js'), 'jQuery3', '1.0.0', true)

            ->enqueue_script('app', plugins_url('/promet-plugins/public/js/app.js'), 'jQuery3', '1.0.0', true)
            ->enqueue_script_admin('core-admin.js', plugins_url('/promet-plugins/public/js/admin.js'), 'jQuery', '1.0', true)
            ->enqueue_script_admin('inputs-admin.js', plugins_url('/promet-plugins/admin/js/inputs.js'), 'jQuery', '1.0', true)
            ->enqueue_script_admin('bootstrap_admin.js', plugins_url('/promet-plugins/public/js/bootstrap.min.js'), 'jQuery', '1.0', true)
            ->add_actions();

        $research = Research::getInstance();
        $products = Products::getInstance();

        $settings = Settings::getInstance();
        
    }

}

// globals

function promet_products_load_widget() {
	register_widget('promet_products_widget');
}

add_action('widgets_init', 'promet_products_load_widget');