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
    
    public static function ExecuteQuery($sql , $attr = array() )
    {        
        $ris = Database::getInstance()->query($sql, $attr);
        return $ris;
    }
    
    
    public abstract function Update();
    
    
}
