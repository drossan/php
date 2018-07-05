<?php 
namespace Grdar\core\Translator;

use Grdar\core\Model;

class Translator extends Model
{
    public function traduccion($idioma, $page, $label, $default = null)
    {
        $query = "SELECT  traduccion_$idioma as texto FROM traducciones 
                            WHERE seccion_pagina = '$page' AND label='$label' ";
        $this->setQuery($query);
        $this->getQuery();
        $return =  $this->singleObject();

        if($return == null){
            $this->insert($idioma, $page, $label, $default);
        }else{
            return $return->texto;            
        }
    }

    protected function insert($idioma, $page, $label, $default)
    {
        $query = "INSERT INTO `traducciones` (`seccion_pagina`, `traduccion_es`, `traduccion_en`, `label`) VALUES ('$page', '$default', '$default', '$label');";
        $this->setQuery($query);
        $this->getQuery();
        return $default;
    }
}