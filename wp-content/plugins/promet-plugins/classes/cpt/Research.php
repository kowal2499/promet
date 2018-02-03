<?php

    class Research extends Custom_Post {

        private static $instance;
        
        protected function __construct() {

            $this->name = 'research';

            $this->names = array(
                'name'              => __('Badania i Rozwój'),
                'singular_name'     => 'Element B&R',
                'add_new'           => 'Dodaj nowy element B&R',
                'add_new_item'      => 'Dodaj nowy element B&R',
                'all_items'         => 'Wszystkie elementy B&R'
            );

            $this->args = array(
                'public'            => true,
                'has_archive'       => true,
                'rewrite'           => array('slug' => 'badania'),
                'supports'          => array('title', 'editor', 'excerpt', 'thumbnail', 'custom_fields'),
                'menu_position'     => 6
            );

            $this->metaboxes = array(
                array(
                    "name"          => "Promet Research Images",
                    "fields"        => array(

                        array(
                            'label' => 'Text Input',
                            'desc'  => 'A description for the field.',
                            'id'    => 'item01',
                            'type'  => 'text' 
                        ),

                        array(
                            'label' => 'Textarea',
                            'desc'  => 'A description for the field.',
                            'id'    => 'item02',
                            'type'  => 'textarea' 
                        ),

                        array(
                            'label' => 'Repeatable',
                            'desc'  => 'A description for the field.',
                            'id'    => 'repeatable',
                            'type'  => 'repeatable'
                        )
                    )
                ),
                
                array(
                    "name"          => "Certfikaty",
                    "fields"        => array(
                        array(
                            'label' => 'Is valid?',
                            'desc'  => 'A description for the field.',
                            'id'    => 'cert03',
                            'type'  => 'checkbox' 
                        ),
                        array(
                            'label' => 'Text Input',
                            'desc'  => 'A description for the field.',
                            'id'    => 'cert02',
                            'type'  => 'text' 
                        ),
                        array(
                            'label' => 'Select box',
                            'desc'  => 'A description for the field.',
                            'id'    => 'sel01',
                            'type'  => 'select',
                            'options' => array(
                                'one' => array(
                                    'label' => 'option one',
                                    'value' => 'one'
                                ),
                                'two' => array(
                                    'label' => 'option two',
                                    'value' => 'two'
                                ),
                                'three' => array(
                                    'label' => 'option three',
                                    'value' => 'three'
                                )
                            )
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