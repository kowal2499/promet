<?php

namespace Inputs;

class Select extends Input_General
{
    public function __construct($id, $title, $wrapper, $desc, $attr)
    {
        parent::__construct($id, $title, $wrapper, $desc, $attr);
    }

    public function render()
    {
        $options = isset($this->attributes['options']) ? $this->attributes['options'] : [];
        $this->beforeRender();

        $value = $this->value ? (' value="' . $this->value . '"') : '';

        echo '<select name="'.$this->id.'" id="'.$this->id.'"'.$value.'>';
        echo '<option>- Wybierz wartość -</option>';
        foreach ($options as $option) {
            $selected = $option['value'] == $this->value ? ' selected="selected"' : '';
            echo '<option value="' . $option['value'] .'"' . $selected .'>' .  $option['name']. '</option>';
        }
        echo '</select>';
        echo '<br><span class="description">'.$this->desc.'</span>';

        $this->afterRender();
    }
}
