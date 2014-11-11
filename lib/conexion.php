<?php
class conexion extends PDO
{
    private static $instance = null;
    protected static $exec = "SELECT";
    public function __construct()
    {
       include('config_db.php');
		$dns='pgsql:dbname='.$config_db['database'].';host='.$config_db['server'].';port='.$config_db['port'];
        $user = $config_db['user'];
        $pass = $config_db['password'];
        parent::__construct($dns,$user,$pass);
    }
    public static function getExec()
    {
        return self::$exec;
    }
    public static function singleton()
	{
             if( self::$instance == null )
                {
                    self::$instance = new self();
                }
             return self::$instance;
	}
	public  function db()
	{
		return $this->dbname;
	}
}
?>
