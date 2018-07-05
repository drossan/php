<?php
namespace  Grdar\core\Pagination;

use  Grdar\core\Paths;

class PaginateLimit extends Paginate
{
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

}