<?php
namespace  Grdar\core\Pagination;

use  Grdar\core\Paths;

class Paginate
{
    protected $rows;
    protected $page;
    protected $init;
    protected $limit = ROWSPERPAGE;
    protected $limit_option = ROWSPERPAGE_OPTION;
    protected $pagina = PAGE;
    protected $limite = LIMIT;
    protected $changelimit = CHANGELIMIT;
    protected $layout;
    protected $pagination;
    protected $paginate;
    protected $paths;

    protected $adjacents = 2;

    public function __construct($rows, $page = null, $limit = null, $layout = null, $params = null)
    {
        $this->rows = $rows;
        $limit != null ? $this->limit = $limit : false ;
        $this->page = $this->hasPages($page);
        $this->init = $this->init();
        $this->totalrows = ceil($this->rows / $this->limit);
        $this->params = $params;
        $this->layout = $layout;
        $this->params();

        $this->hasChangelimit();


        return $this->pagination = "LIMIT $this->init, $this->limit";
    }

    public function init()
    {
        return $this->page != null ? $this->init = ($this->page - 1) * $this->limit :  $this->init = 0;
    }

    protected function params()
    {
        if(isset($_REQUEST)){
            foreach ($_REQUEST as $key => $value) {
                switch ($key) {
                    case 'pagina':
                    case 'lng':
                    case 'lng':
                    case 'PHPSESSID':
                    case 'id_pedido':
                    case 'id_carro':
                    case '_ga':
                    case '_gid':
                    case '_gat_gtag_UA_111392183_1':
                    case '_ym_visorc_47059407':
                        break;
                    default:
                        $this->params .= '&'.$key.'='.$value;
                        break;
                }
            }
        }
    }

    public function hasChangelimit()
    {
        if($this->changelimit === 'true'){
            return $this->changeLimit();
        }
    }

    public function hasPages($page)
    {
        return $page != null ? $this->page = $page :  $this->page = 1;
    }
   
    public function hasParams()
    {
        return $this->params != null ? $this->params  :  null ;
    }

    public function prevPage()
    {
        return $this->page - 1;
    }

    public function nextPage()
    {
        return $this->page + 1;
    }

    public function getLimitOption()
    {
        return explode(',', $this->limit_option); 
    }

    public function changeLimit()
    {
        $this->paginate .= '
        <div class="pull-left pagination-detail">
            <span class="pagination-info">Mostrando 1 a '.$this->limit.' - de '.$this->totalrows.' resultados</span>
            <span class="page-list">
                <span class="btn-group dropup">
                    <button type="button" class="btn btn-default  dropdown-toggle" data-toggle="dropdown">
                        <span class="page-size">10</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">';
                        foreach ($this->getLimitOption() as $value) {
                            $this->paginate .= '<li><a href="'.$this->layout.$this->limite.$value.'">'.$value.'</a></li>';
                        }

        $this->paginate .= '<li><a href="">Todos</a>
                    </ul>
                </span> resultados por página
            </span>
        </div>';
    }

    public function __toString()
    {
        return $this->pagination;
    }
}

