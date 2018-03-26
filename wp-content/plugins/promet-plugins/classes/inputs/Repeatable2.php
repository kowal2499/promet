<?php

namespace Inputs;

class Repeatable2 extends Input_General
{
    public function __construct($id, $title, $wrapper, $desc)
    {
        parent::__construct($id, $title, $wrapper, $desc);

        $this->templates = [];
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

    public function render($entire = true)
    {
        var_dump($this->value);
        $this->beforeRender($entire);

        // wygeneruj szablon wiersza (będzie z niego korzystał JS)
        ob_start();
        if (!empty($this->templates)) {
            echo '<tr>';
        }
        foreach ($this->templates as $element) {
            echo '<td>';
            echo '<label for="'.$element->id.'"><strong>'.$element->title.'</strong></label><br><br>';
            $element->render($entire = false);
            echo '</td>';
        }
        if (!empty($this->templates)) {
            // config row
            echo '<td class="row-config">';
            echo '<input type="button" class="button deleteRow" value="Usuń element">';
            echo '</td>';
            echo '</tr>';
        }
        $output = ob_get_clean();



        echo '<div class="rptContainer">';
        echo '<input type="hidden" disabled="disabled" class="rowTemplate" value="'.htmlspecialchars($output).'">';
        echo '<input type="button" class="button addRow" value="Dodaj element" data-qty="'. count($this->value) .'">';
        
        echo '<table class="form-table">';

        foreach ($this->value as $rowId => $row) {
            echo '<tr>';
            foreach ($this->templates as $element) {
                $element->setId($this->id . '[' . $rowId . '][' . $element->wpId . ']');
                $element->setValue($row[$element->wpId]);
                echo '<td>';
                echo '<label for="'.$element->id.'"><strong>'.$element->title.'</strong></label><br><br>';
                $element->render($entire = false);
                echo '</td>';
            }
            echo '<td class="row-config">';
            echo '<input type="button" class="button deleteRow" value="Usuń element">';
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';

        echo '</div>';






        $this->afterRender($entire);
    }
}
