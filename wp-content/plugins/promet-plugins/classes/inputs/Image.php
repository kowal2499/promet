<?php

namespace Inputs;

class Image extends Input_General
{
    public function __construct($id, $title, $wrapper, $desc, $attr)
    {
        parent::__construct($id, $title, $wrapper, $desc, $attr);
    }

    public function render()
    {
        $size = isset($this->attributes['size']) ? $this->attributes['size'] : '30';
        $min = isset($this->attributes['min']) ? $this->attributes['min'] : null;
        $max = isset($this->attributes['max']) ? $this->attributes['max'] : null;

        $this->beforeRender();
        echo '<div class="img-upload">';
        echo '<img src="" class="preview">';
        echo '<input type="hidden" class="upload" name="'.$this->id.'" id="'.$this->id.'" value="' . $this->value . '">';
        echo '<input type="button" class="button uploaderLauncher" value="Wybierz obraz" data-related="' . $this->id . '">';
        echo '<div>';
        $this->afterRender();
    }
}
