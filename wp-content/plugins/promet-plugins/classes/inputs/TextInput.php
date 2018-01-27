<?php

    class TextInput extends Base {

        public function __construct($id, $title, $desc) {
            parent::__construct($id, $title, $desc);
        }

        public function render() {
            
            $this->beforeRender();

            echo '<input type="text" name="'.$this->id.'" id="'.$this->id.'" value="'.$this->value.'" size="30" />
                    <br /><span class="description">'.$this->desc.'</span>';

            $this->afterRender();
            
        }

    }