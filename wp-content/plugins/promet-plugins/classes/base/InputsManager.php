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
    public function factory($id)
    {
        $input = $this->fields['inputs'][$id];
        $item = null;
        switch ($input['class']) {
            case 'Repeatable':
                $item = new $input['class']($id, $input['title'], $this->varWrapper, $input['desc'], $input['recordDefinition']); // generate the Repeatable object
                break;
            
            default:
                $item = new $input['class']($id, $input['title'], $this->varWrapper, $input['desc'], $input['attr'] ?? null); // generate general object
                break;
        }
        return $item;
    }

    public function getVarWrapper()
    {
        return $this->varWrapper;
    }
}
