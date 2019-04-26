<?php 
namespace Drossan\core\Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use Drossan\core\Database\Connection;

class Migration extends Connection
{
    /** @var \Illuminate\Database\Schema\Builder $capsule */
    public $schema;
    
    public function init()  {
        $this->schema = $this->capsule->schema();
    }
}
