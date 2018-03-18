<?php

    class TextInput extends Base {

        public function __construct($id, $title, $desc, $attr) {
            parent::__construct($id, $title, $desc, $attr);
        }

        public function render() {
            
            $size = isset($this->attributes['size']) ? $this->attributes['size'] : '30';
            $this->beforeRender();

            echo '<input type="text" name="'.$this->id.'" id="'.$this->id.'" value="'.$this->value.'" size="' . $size . '" />
                    <br /><span class="description">'.$this->desc.'</span>';

            $this->afterRender();
            
        }

    }