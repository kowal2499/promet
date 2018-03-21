<?php

namespace Inputs;

class Checkbox extends Input_General
{
    public function __construct($id, $title, $wrapper, $desc, $attr)
    {
        parent::__construct($id, $title, $wrapper, $desc, $attr);
    }

    public function render()
    {
        $options = isset($this->attributes['options']) ? $this->attributes['options'] : [];
        $this->beforeRender();

        foreach ($options as $option) {
            $checked = in_array($option['value'], $this->value) ? ' checked' : '';
            echo '<input type="checkbox" name="' . $this->id . '[]" value="' . $option['value'] . '"' . $checked . '>';
            echo $option['name'];
            echo '</input><br>';
        }
        echo '<br><span class="description">'.$this->desc.'</span>';


        $this->afterRender();
    }
}
