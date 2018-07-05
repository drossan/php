<?php 

namespace Grdar\core;

class Magic 
{
    public function getAttribute($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }        
    }
    public function __get($name)
    {
        return $this->getAttribute($name);
    }
}
