<?php

class Widget_Setup {

    private static $instance;
    
    private $front_styles = array();
    private $admin_styles = array();
    private $front_scripts = array();
    private $admin_scripts = array();


    private function __construct() {}

    static public function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new Widget_Setup;
        }
        return self::$instance;
    }

/*    function construct(
            $widget_class = '',
            $admin_styles = array(),
            $admin_scripts = array(),
            $front_styles = array(),
            $front_scripts = array(),
            $shortcodes) {
        $this->widget_class = $widget_class;
        $this->admin_styles = $admin_styles;
        $this->admin_scripts = $admin_scripts;
        $this->front_styles = $front_styles;
        $this->front_scripts = $front_scripts;
     

        // shortcodes
        foreach ($shortcodes as $shortcode) {
            add_shortcode($shortcode["name"], $shortcode["function"]);
        }
    }
*/

    public function enqueue_style($handle, $src, $deps=array(), $version='1.0', $media='all') {
        $this->front_styles[] = array(
            'handle' => $handle,
            'src' => $src,
            'deps' => $deps,
            'version' => $version,
            'media' => $media
        );
        return self::$instance;
    }

    public function enqueue_style_admin($handle, $src, $deps=array(), $version='1.0', $media='all') {
        $this->admin_styles[] = array(
            'handle' => $handle,
            'src' => $src,
            'deps' => $deps,
            'version' => $version,
            'media' => $media
        );
        return self::$instance;
    }

    public function enqueue_script($handle, $src, $deps=array(), $version='1.0', $inFooter=true) {
        $this->front_scripts[] = array(
            'handle' => $handle,
            'src' => $src,
            'deps' => $deps,
            'version' => $version,
            'inFooter' => $inFooter
        );
        return self::$instance;
    }

    public function enqueue_script_admin($handle, $src, $deps=array(), $version='1.0', $inFooter=true) {
        $this->admin_scripts[] = array(
            'handle' => $handle,
            'src' => $src,
            'deps' => $deps,
            'version' => $version,
            'inFooter' => $inFooter
        );
        return self::$instance;
    }

    public function debug() {
        var_dump($this->front_scripts);
    }

    
    public function add_actions() {
        if (is_admin() == true) {
            // die();
        }
        // odpal style
        add_action('wp_enqueue_scripts', function() {
            foreach ($this->front_styles as $style) {
                wp_enqueue_style(
                    $style['handle'],
                    $style['src'],
                    $style['deps'],
                    $style['version'],
                    $style['media']
                );
            }
            return true;
        });
        // odpal skrypty
        add_action('wp_enqueue_scripts', function() {
            if (is_admin()) return;
            $scripts = $this->front_scripts;

            foreach ($scripts as $script) {
                wp_enqueue_script(
                    $script['handle'],
                    $script['src'],
                    $script['deps'],
                    $script['version'],
                    $script['inFooter']
                );
            }
            return true;
        });

        // odpal style admina
        add_action('admin_enqueue_scripts', function() {
            foreach ($this->admin_styles as $style) {
                wp_enqueue_style(
                    $style['handle'],
                    $style['src'],
                    $style['deps'],
                    $style['version'],
                    $style['inFooter']
                );
            }
            return true;
        });

        // odpal skrypty admina
        add_action('admin_enqueue_scripts', function() {
            if (!is_admin()) return;
            $scripts = $this->admin_scripts;

            foreach ($scripts as $script) {
                wp_enqueue_script(
                    $script['handle'],
                    $script['src'],
                    $script['deps'],
                    $script['version'],
                    $script['inFooter']
                );
            }
            return true;
        });

    }

}
