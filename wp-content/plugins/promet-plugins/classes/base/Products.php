<?php
    include_once( plugin_dir_path( __FILE__ ) . 'custom_post.php');

    class Products extends Custom_Post {
        
        private static $instance;

        protected function __construct() {
            $this->name = 'products';

            $this->names = array(
                'name'              => __('Produkty'),
                'singular_name'     => 'Produkt',
                'add_new'           => 'Dodaj nowy produkt',
                'all_items'         => 'Wszystkie produkty'
            );

            $this->args = array(
                'public'            => true,
                'has_archive'       => true,
                'rewrite'           => array('slug' => 'produkty'),
                'supports'          => array('title', 'editor', 'excerpt', 'thumbnail', 'custom_fields'),
                'menu_position'     => 5,
                'taxonomies'        => array('category')
            );

            $this->metaboxes = array(
                array(
                    "name"      =>  "Obrazki",
                    "fields"    =>  array(
                        array(
                            'label' => 'Text Input',
                            'desc'  => 'A description for the field.',
                            'id'    => 'item01',
                            'type'  => 'text' 
                        ),

                        array(
                            'label' => 'Repeatable',
                            'desc'  => 'A description for the field.',
                            'id'    => 'repeatable01',
                            'type'  => 'repeatable'
                        )
                    )
                )
            );

            parent::__construct();
        }
        
        public static function getInstance() {
            if (empty(self::$instance)) {
                self::$instance = new self;
            }
            return self::$instance;
        }
    }