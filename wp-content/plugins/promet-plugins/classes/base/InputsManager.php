<?php

namespace Base;

/**
 * Zarządza inputami użytymi w panelu administracyjnym
 *
 * @author Roman Kowalski
 */
class InputsManager
{
    private $fields;
    private $varWrapper = 'options';

    public function __construct($arg_fields)
    {
        if (is_array($arg_fields)) {
            $this->fields = $arg_fields;
        } else {
            $json = file_get_contents($arg_fields);
            if (!$json) {
                $this->fields = [];
            } else {
                $this->fields = json_decode($json, $assoc = true);
                if ($this->fields === null) {
                    $this->fileds = [];
                }
            }
        }
    }

    /*
     * Zwraca tablicę pól
     */
    public function getFields()
    {
        return $this->fields['inputs'] ?? [];
    }

    /*
     * Zwraca obiekt konkretnego inputa
     *
     * @input array
     * @return object
     */
    public function factory($id, $input)
    {
        // $input = $this->fields['inputs'][$id];
        $item = null;
        $className = 'Inputs\\' . $input['class'];
        switch ($input['class']) {
            
            case 'Repeatable':
                $item = new $className($id, $input['title'], $this->varWrapper, $input['desc'], $input['recordDefinition']); // generate the Repeatable object
                break;

            case 'Repeatable2':
                $item = new $className($id, $input['title'], $this->varWrapper, $input['desc']); // generate the Repeatable object
                // add elements to the object
                foreach ($input['elements'] as $elementId => $elementBody) {
                    $repeatableObject = $this->factory($elementId, $elementBody);
                    $item->addElement($repeatableObject);
                }
                break;

            default:
                $item = new $className($id, $input['title'], $this->varWrapper, $input['desc'], $input['attr'] ?? null); // generate general object
                break;
        }
        return $item;
    }

    public function getVarWrapper()
    {
        return $this->varWrapper;
    }
}
