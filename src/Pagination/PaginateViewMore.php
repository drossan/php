<?php
namespace  Grdar\core\Pagination;

use  Grdar\core\Paths;

class PaginateViewMore extends Paginate
{
    public function __construct($rows, $page = null, $limit = null, $layout = null, $params = null)
    {
        parent::__construct($rows, $page, $limit, $layout, $params);
    }

    public function paginate()
    {
        if ($this->totalrows > 1) {
            if ($this->page  != $this->totalrows) {
                $this->paginate = '
                    <div class="col-xs-12 text-center margin__top-30">
                        <div class="row">
                            <a id="view_more" href="'.$this->pagina.$this->nextPage().$this->hasparams().'" class="btn btn__inverse" data-page="'.$this->nextPage().'">VER MÁS</a>
                        </div>
                    </div>';
            }
        }
        return $this->paginate;
    }
}