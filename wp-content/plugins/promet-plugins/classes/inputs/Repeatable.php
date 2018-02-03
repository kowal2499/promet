<?php

    class Repeatable extends Base {

        public function __construct($id, $title, $desc, $recordDefinition) {
            parent::__construct($id, $title, $desc);

            $this->record = $recordDefinition;
        }

        public function render() {
            
            $this->beforeRender();

            
            echo '<div class="repeatable" data-related="'.$this->id.'">';

            echo '<div class="repeatable-head">';
            // hidden main field
            echo '<input type="hidden" class="repeatable-row-def" value="'.htmlspecialchars(json_encode($this->record)).'" size="60" />';
            echo '<input type="hidden" class="repeatable-value" name="'.$this->id.'" id="'.$this->id.'" value="'.$this->value.'" size="60" />';
            echo '<br>';

            // add new button
            echo '<a class="button repeatable-add-new" href="#" data-related="'.$this->id.'">+</a><br><br>';
            echo '</div>';

            // body
            echo '<div class="repeatable-body"></div>';
        
            echo '</div>';

            $this->afterRender();
            
        }

    }