<?php
namespace  Grdar\core\Pagination;

use  Grdar\core\Paths;

class PaginateTemplate extends Paginate
{
    public function __construct($rows, $page = null, $limit = null, $layout = null, $params = null)
    {
        parent::__construct($rows, $page, $limit, $layout, $params);
    }

    public function paginate()
    {

        $this->paginate .=  '<div class="pull-right pagination"><ul class="pagination">';
        if ($this->totalrows > 1) {
            // Previous
            if ($this->page != 1) {
                $this->paginate .= '<li><a aria-label="Previous" href="'.$this->pagina.$this->prevPage().$this->hasparams().'">&laquo;<span aria-hidden="true"></i></span></a></li>';
            }
            // Páginas
            if ($this->totalrows < 7 + ($this->adjacents * 2)) {
                for ($i=1; $i <= $this->totalrows; $i++) {
                    if ($this->page == $i) {
                        $this->paginate .= '<li class="active"><a>'.$i.'</a></li>';
                    } else {
                        $this->paginate .= '<li><a href="'.$this->pagina.$i.$this->hasparams().'">'.$i.'</a></li>';
                    }
                }
            } elseif ($this->totalrows > 5 + ($this->adjacents * 2)) {
                if ($this->page < 1 + ($this->adjacents * 2)) {
                    for ($i = 1; $i < 4 + ($this->adjacents * 2); $i++) {
                        if ($this->page == $i) {
                            $this->paginate .= '<li class="active"><a>'.$i.'</a></li>';
                        } else {
                            $this->paginate .= '<li><a href="'.$this->pagina.$i.$this->hasparams().'">'.$i.'</a></li>';
                        }
                    }
                    $this->paginate.= '<li><a>...</a></li>';
                    $this->paginate.= '<li><a href="'.$this->pagina.($this->totalrows - 1).$this->hasparams().'">'.($this->totalrows - 1).'</a></li>';
                    $this->paginate.= '<li><a href="'.$this->pagina.$this->totalrows.$this->hasparams().'">'.$this->totalrows.'</a></li>';
                } elseif ($this->totalrows - ($this->adjacents * 2) > $this->page && $this->page > ($this->adjacents * 2)) {
                    $this->paginate.= '<li><a href="'.$this->pagina.'1'.$this->hasparams().'">1</a></li>';
                    $this->paginate.= '<li><a href="'.$this->pagina.'2'.$this->hasparams().'">2</a></li>';
                    $this->paginate.= '<li><a>...</a></li>';
                    for ($i = $this->page - $this->adjacents; $i <= $this->page + $this->adjacents; $i++) {
                        if ($this->page == $i) {
                            $this->paginate .= '<li class="active"><a>'.$i.'</a></li>';
                        } else {
                            $this->paginate .= '<li><a href="'.$this->pagina.$i.$this->hasparams().'">'.$i.'</a></li>';
                        }
                    }
                    $this->paginate.= '<li><a>...</a></li>';
                    $this->paginate.= '<li><a href="'.$this->pagina.($this->totalrows - 1).$this->hasparams().'">'.($this->totalrows - 1).'</a></li>';
                    $this->paginate.= '<li><a href="'.$this->pagina.$this->totalrows.$this->hasparams().'">'.$this->totalrows.'</a></li>';
                } else {
                    $this->paginate.='<li><a href="'.$this->pagina.'1'.$this->hasparams().'">1</a></li>';
                    $this->paginate.='<li><a href="'.$this->pagina.'2'.$this->hasparams().'">2</a></li>';
                    $this->paginate.= '<li><a>...</a></li>';
                    for ($i = $this->totalrows - (2 + ($this->adjacents * 2)); $i <= $this->totalrows; $i++) {
                        if ($this->page == $i) {
                            $this->paginate .= '<li class="active"><a>'.$i.'</a></li>';
                        } else {
                            $this->paginate .= '<li><a href="'.$this->pagina.$i.$this->hasparams().'">'.$i.'</a></li>';
                        }
                    }
                }
            }
            // Next
            if ($this->page  != $this->totalrows) {
                $this->paginate .= '<li><a aria-label="Next" href="'.$this->pagina.$this->nextPage().$this->hasparams().'">&raquo;</span></a></li>';
            }
        }
        $this->paginate .= '</ul></div>';
        return $this->paginate;
    }

}