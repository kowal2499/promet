<?php
/*
Plugin Name: Promet plugins
Description: Specyficzne funkcjonalności dla strony www firmy PROMET
Version: 1.0
Author: Roman Kowalski
Author URI: roman@erla.pl
Text Domain: promet
*/

include_once(plugin_dir_path(__FILE__) . 'classes/base/widget.php');
include_once(plugin_dir_path(__FILE__) . 'classes/base/custom_post_type.php');
include_once(plugin_dir_path(__FILE__) . 'classes/base/widget_setup.php');
include_once(plugin_dir_path(__FILE__) . 'classes/base/Settings.php');


include_once(plugin_dir_path(__FILE__) . 'classes/cpt/CustomPost.php');
include_once(plugin_dir_path(__FILE__) . 'classes/cpt/Research.php');
include_once(plugin_dir_path(__FILE__) . 'classes/cpt/Products.php');



include_once(plugin_dir_path(__FILE__) . 'classes/inputs/Input_General.php');
include_once(plugin_dir_path(__FILE__) . 'classes/inputs/Text.php');
include_once(plugin_dir_path(__FILE__) . 'classes/inputs/Repeatable.php');
include_once(plugin_dir_path(__FILE__) . 'classes/inputs/Number.php');
include_once(plugin_dir_path(__FILE__) . 'classes/inputs/Textarea.php');
include_once(plugin_dir_path(__FILE__) . 'classes/inputs/Select.php');
include_once(plugin_dir_path(__FILE__) . 'classes/inputs/Checkbox.php');
include_once(plugin_dir_path(__FILE__) . 'classes/inputs/Radio.php');
include_once(plugin_dir_path(__FILE__) . 'classes/inputs/SlideshowConfig.php');
