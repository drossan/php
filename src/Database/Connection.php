<?php 
namespace Drossan\core\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

class Connection
{
    private $host	= DB_HOST;
	private $user	= DB_USERNAME;
	private $pass	= DB_PASSWORD;
    private $dbname	= DB_DATABASE;
    
    /** @var \Illuminate\Database\Capsule\Manager $capsule */
    public $capsule;

    
    public function __construct()
    {
        $this->capsule = new Capsule;

        $this->capsule->addConnection([
            'driver'    => 'mysql',
            'host'      =>  $this->host,
            'database'  =>  $this->dbname,
            'username'  =>  $this->user,
            'password'  =>  $this->pass,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        // Make this Capsule instance available globally via static methods... (optional)
        $this->capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $this->capsule->bootEloquent();
    }
}
