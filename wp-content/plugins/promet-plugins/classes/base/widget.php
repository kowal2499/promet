<?php
include_once( plugin_dir_path( __FILE__ ) . 'custom_post_type.php');
include_once( plugin_dir_path( __FILE__ ) . 'widget_setup.php');

include_once( plugin_dir_path( __FILE__ ) . 'Settings.php');

include_once( plugin_dir_path( __FILE__ ) . 'Research.php');
include_once( plugin_dir_path( __FILE__ ) . 'Products.php');

class Promet_Products_Widget extends WP_Widget {

    function __construct() {
		parent::__construct('promet_products_widget', 'Promet Products', array(
			'description' => 'Widget pokazuje produkty firmy'
        ));

        Widget_Setup::getInstance()
            ->enqueue_style('bootstrap', plugins_url('/promet-plugins/public/css/bootstrap.min.css'))
            ->enqueue_style_admin('bootstrap_admin', plugins_url('/promet-plugins/public/css/bootstrap.min.css'))
            ->enqueue_style('owl.carousel.base', plugins_url('/promet-plugins/public/css/owl.carousel.min.css'))
            ->enqueue_style('css.custom', plugins_url('/promet-plugins/public/css/custom.css'))
            ->enqueue_script('owl.carousel.js', plugins_url('/promet-plugins/public/js/owl.carousel.min.js'), 'jQuery', '1.0.0', true)
            ->enqueue_script('core.js', plugins_url('/promet-plugins/public/js/main.js'), 'jQuery', '1.0.0', true)
            ->enqueue_script_admin('core-admin.js', plugins_url('/promet-plugins/public/js/admin.js'), 'jQuery', '1.0', true)
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