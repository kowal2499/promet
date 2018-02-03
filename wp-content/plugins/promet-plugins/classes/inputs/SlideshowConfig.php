<?php

    class SlideshowConfig extends Base {
        
        public function __construct($id, $title, $desc) {
            parent::__construct($id, $title, $desc);
        }

        public function render() {
            echo "hello, I am SlideshowConfig<br>";
        }
    }