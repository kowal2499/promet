<?php
/*
Plugin Name: Promet plugins
Description: Specyficzne funkcjonalności dla strony www firmy PROMET
Version: 1.0
Author: Roman Kowalski
Author URI: roman@erla.pl
Text Domain: promet
*/

include_once( plugin_dir_path( __FILE__ ) . 'classes/base/widget.php');
include_once( plugin_dir_path( __FILE__ ) . 'classes/base/custom_post_type.php');
include_once( plugin_dir_path( __FILE__ ) . 'classes/base/widget_setup.php');
include_once( plugin_dir_path( __FILE__ ) . 'classes/base/Settings.php');


include_once( plugin_dir_path( __FILE__ ) . 'classes/cpt/custom_post.php');
include_once( plugin_dir_path( __FILE__ ) . 'classes/cpt/Research.php');
include_once( plugin_dir_path( __FILE__ ) . 'classes/cpt/Products.php');



include_once( plugin_dir_path( __FILE__ ) . 'classes/inputs/Base.php');
include_once( plugin_dir_path( __FILE__ ) . 'classes/inputs/TextInput.php');
include_once( plugin_dir_path( __FILE__ ) . 'classes/inputs/Repeatable.php');
include_once( plugin_dir_path( __FILE__ ) . 'classes/inputs/SlideshowConfig.php');
