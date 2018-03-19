<?php
abstract class Input_General
{
    protected $value;
    protected $id;
    protected $title;
    protected $desc;
    protected $attributes;

    protected $varWrapper;
    
    protected function __construct($id, $title, $wrapper, $desc = null, $attr = null)
    {
        $this->varWrapper = $wrapper;
        $this->id = $this->varWrapper . '[' . $id . ']';
        $this->wpId = $id;
        $this->title = $title;
        $this->desc = $desc;
        $this->attributes = $attr;
    }

    abstract public function render();
    
    protected function beforeRender() {
        echo '<table class="form-table">';
        echo '<tr>';
        echo '<th><label for="'.$this->id.'">'.$this->title.'</label></th>';
        echo '<td>';
    }

    protected function afterRender() {
        echo '</td>';
        echo '</tr>';
        echo '</table>';
    }

    public function setValue($value) {
        $this->value = $value;
    }

    public function getValue() {
        $value = get_option($this->wpId);
        return $value ?? '';
    }

    public function getId() {
        return $this->id;
    }
}