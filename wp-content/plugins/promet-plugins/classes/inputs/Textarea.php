<?php

namespace Inputs;

class Textarea extends Input_General
{
    public function __construct($id, $title, $wrapper, $desc, $attr)
    {
        parent::__construct($id, $title, $wrapper, $desc, $attr);
    }

    public function render()
    {
        $rows = isset($this->attributes['rows']) ? $this->attributes['rows'] : null;
        $cols = isset($this->attributes['cols']) ? $this->attributes['cols'] : null;

        $this->beforeRender();

        echo '<textarea'.
            ' name="'.$this->id.'"'.
            ' id="'.$this->id.'"'.
            (is_null($rows) ? '' : ' rows="'.intval($rows).'"').
            (is_null($cols) ? '' : ' cols="'.intval($cols).'"').
            '>'.$this->value.'</textarea><span class="description">'.$this->desc.'</span>';

        $this->afterRender();
    }
}
