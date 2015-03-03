<?php
require_once 'Session.php';

class DatabaseException extends Exception
{
    public function __construct($message)
    {
      parent::__construct($message);
    }
}

class Database
{
    // configuration
    protected static    $dbtype     = "sqlite";
    protected static    $dbhost     = "localhost";
    protected static    $dbname     = "test";
    protected static    $dbuser     = "root";
    protected static    $dbpass     = "password";

    protected $conn; 
    
    protected static $instance = null;
    
    protected function __construct() {
        $this->conn = new PDO("mysql:host=".static::$dbhost.";dbname=".static::$dbname,static::$dbuser,static::$dbpass);
    }
    
    /**
     * Esegue una query senza ritorno
     * @param type $sql
     * @param type $attr
     * @return boolean
     */
    public  function execute($sql, $attr=array())
    {
        $q = $this->conn->prepare($sql);
	$q->execute($attr);
        if($q->errorCode() == 0) {
            return TRUE;
        } 
        else {
            return $q->errorInfo();
        }
    }
    
    public function query($sql, $attr=array())
    {
        $q = $this->conn->prepare($sql);
	$q->execute($attr);
        return $q->fetchAll();
    }



    /**
     * 
     * @return Database
     */
    public static function getInstance()
    {
      if(static::$instance == null)
      {   
         $c = __CLASS__;
         static::$instance = new $c;
      }
      return static::$instance;
    }
    
}