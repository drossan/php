<?php 
namespace  Grdar\core\Sorteable;

class Sorteable
{
    private $field;
    private $order;
    private $sorteable;
    public function __construct($field, $order)
    {
        $this->field = $field;
        $this->order = $order;
        $this->init = $this->sort();
    }

    public function sort()
    {
        return $this->sorteable = " ORDER by $this->field $this->order";
    }

    public function __toString()
    {
        return $this->sorteable;
    }
}
