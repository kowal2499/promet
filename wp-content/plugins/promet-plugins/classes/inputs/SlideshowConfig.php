<?php

    class SlideshowConfig extends Input_General {
        
        public function __construct($id, $title, $desc) {
            parent::__construct($id, $title, $desc);
        }

        public function render() {
            echo "hello, I am SlideshowConfig<br>";
        }
    }