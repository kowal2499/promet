<?php

namespace Inputs;

class Repeatable2 extends Input_General
{
    public function __construct($id, $title, $wrapper, $desc)
    {
        parent::__construct($id, $title, $wrapper, $desc);

        $this->templates = [];
        $this->records = [];
    }

    public function addElement($element)
    {
        // pozbywamy się przedrostka z nazwy i id elementu
        $originalId = $element->getWpId();

        $newId = $this->id . '[%index%]' . '[' . $originalId . ']';
        $element->setId($newId);

        // dodajemy element do wzorców
        $this->templates[] = $element;
    }

    public function render()
    {
        $this->beforeRender();

        echo 'Mam takie elementy<br>';

        ob_start();
        foreach ($this->templates as $element) {
            $element->render();
        }
        $output = ob_get_clean();

        echo '<div class="rptContainer">';
        echo '<input type="hidden" disabled="disabled" class="rowTemplate" value="'.htmlspecialchars($output).'">';
        echo '<input type="button" class="button addRow" value="Dodaj element" data-qty="'. count($this->records) .'">';
        echo '<div class="rows"></div>';
        echo '</div>';
        $this->afterRender();
    }
}
