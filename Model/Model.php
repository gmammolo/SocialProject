<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Database.php';
/**
 * Description of model
 *
 * @author Giuseppe
 */
abstract class Model {
    //put your code here
    
    
    protected $id;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    
    
    public static function init()
    {
        
    }
    
    
    public function __construct() 
    {
        
    }

    
    public static function CreateTable()
    {
        $sql ="CREATE TABLE IF NOT EXISTS  ";

        return Database::getInstance()->execute($sql);
    }
    
    /**
     * 
     * @param type $sql
     * @param array $attr
     * @return PDOStatement
     */
    public static function ExecuteQuery($sql , $attr = array() )
    {        
        $ris = Database::getInstance()->query($sql, $attr);
        return $ris;
    }
    
    /**
     * Effettua una query di inserimento
     * @param type $sql
     * @param type $attr
     * @return int ritorna l'iD nel caso si utilizzi un auto_increment
     */
    public static function InsertQuery($sql , $attr = array() )
    {        
        Database::getInstance()->execute($sql, $attr);
        $id = Database::getInstance()->lastInsertId();
        //TODO: sarebbe opportuno inserire controlli sull' ID in futuro, in quanto:
        //This method may not return a meaningful or consistent result across different PDO drivers,
        // because the underlying database may not even support the notion of auto-increment fields or sequences.
        return $id;
    }
    
    
    public abstract function Update();
    
    
}
