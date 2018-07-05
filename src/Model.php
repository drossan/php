<?php 

namespace  Grdar\core;

use  Grdar\core\Database\Database as conection;
use  Grdar\core\Pagination\Paginate;
use  Grdar\core\Sorteable\Sorteable;

abstract class Model
{
    
    protected $database;
    protected $query;
    protected $result;
    protected $return;
    protected $paginate;
    protected $sort;

    public function setQuery($query)
    {
        $this->query = $query.' '.$this->hasSorteable();
        $this->query();
        $this->sort = NULL;
        return $this;
    }
    public function getQuery()
    {
        return $this->return;
    }

    public function get($query)
    {
        $this->query = $query;
        $this->query();
        return $this->return;
    }

    // Ejecuta una consulta a la bd
    protected function query()
    {
		$this->database = new conection();
        $this->database->query($this->query);
        $this->database->execute();
        return $this;
    }

    // Cuenta los resultados devueltos en una query()
    public function rowCount()
    {
        $this->rows = $this->database->rowCount();
        return $this->rows;
    }

    // Último id insertado despues de ejecutar query()
    public function lastInsertId()
    {
        return $this->database->lastInsertId();
    }

    // Devuelve una colección de objetos    
    public function resultsetObject()
    {
        return $this->database->resultsetObject();
    }

    // Devuelve un único Objeto
    public function singleObject()
    {
        return $this->database->singleObject();
    }

    // Paginación
    public function getPaginate()
    {
        return $this->paginate;
    }

    public function paginate($tipe, $page = NULL, $layout = NULL, $limit = NULL)
    {
        $rows = $this->rowCount();
        
        $paginate =  new $tipe($rows, $page, $limit, $layout);

        $this->paginate = $paginate->paginate();
        $this->query = $this->query.' '.$paginate;
        $this->query();
        return $this;
    }

    // Sorteable
    public function hasSorteable()
    {
        return $this->sort != NULL ? $this->sort : '' ;
    }
    
    public function sorteable($field, $order)
    {
        $sorteable = new Sorteable($field, $order);
        $this->sort = $sorteable;
        return $this;
    }
}