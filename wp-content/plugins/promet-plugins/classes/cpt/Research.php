<?php
namespace Base\CPT;

class Research extends CustomPost
{
    private static $instance;
    protected function __construct()
    {

        $this->name = 'research';

        $this->names = array(
            'name' => __('Badania i Rozwój'),
            'singular_name' => 'Element B&R',
            'add_new' => 'Dodaj nowy element B&R',
            'add_new_item' => 'Dodaj nowy element B&R',
            'all_items' => 'Wszystkie elementy B&R',
        );

        $this->args = array(
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'badania'),
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'custom_fields'),
            'menu_position' => 6,
        );

        $this->metaboxes = array(
            array(
                'name' => 'Obrazki',
                'manager' => new \Base\InputsManager(plugin_dir_path(__DIR__)
                    . '../conf/inputs_research_general.json'),
            ),
            array(
                'name' => 'Certfikaty',
                'manager' => new \Base\InputsManager(plugin_dir_path(__DIR__)
                    . '../conf/inputs_research_certificates.json'),
            ),
        );

        parent::__construct();
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
