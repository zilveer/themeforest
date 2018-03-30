<?php


class AitColumnsElement extends AitElement
{

    private $elementsByColumnIndex = array();

    private $narrowColumns = array();

    public function init()
    {
        if (isset($this->config['@configuration']['narrow-columns'])) {
            $this->narrowColumns = $this->config['@configuration']['narrow-columns'];
        }
    }

    public function addElementToColumn(AitElement $element, $columnIndex)
    {
        $this->elementsByColumnIndex[$columnIndex][] = $element;
    }



    public function getElementsOfColumn($columnIndex)
    {
        if(isset($this->elementsByColumnIndex[$columnIndex])){
            return $this->elementsByColumnIndex[$columnIndex];
        }else{
            return array();
        }
    }



    public function getColumnsCssClasses()
    {
        $op = $this->getOptions();
        $columns = array_map('trim', explode(',', $op['columns']['columns-css-classes']));
        return $columns;
    }



    public function getGridCssClass()
    {
        $op = $this->getOptions();
        return $op['columns']['grid-css-class'];
    }



    public function isNarrowColumn($columnCssClass)
    {
        if (isset($this->narrowColumns[$this->getGridCssClass()]) && is_array($this->narrowColumns[$this->getGridCssClass()])) {
            return in_array($columnCssClass, $this->narrowColumns[$this->getGridCssClass()]);
        } else {
            return false;
        }
    }
}
