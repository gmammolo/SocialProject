<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'DBFieldModel.php';
require_once 'Database.php';
/**
 * Description of model
 *
 * @author Giuseppe
 */
class Model {
    //put your code here
    
    public static $table_name = "";
    protected static $fields;
    protected static $_primary_key = "";
    protected static $_engine = "InnoDB";
    
    protected static $_class_database = array();
    
    public static function init()
    {
        static::$fields = array();
        if(!in_array(static::class , self::$_class_database))
            array_push(self::$_class_database, static::class);
    }
    
    
    public function __construct() {
        foreach( static::$fields as $field )
        {
            $nome = $field->name;
            $this->$nome = "";
        }

    }
        
    public function __get($name) {
        var_dump(static::$fields);
        if(array_key_exists($name, static::$fields))
            return $this->$name;
        
        throw new DatabaseException("Campo non trovato");
    }

    public function __set($name, $value) {
        if(array_key_exists($name, static::$fields))
            $this->$name = $value;  
    }


    public static function AddField($nome, $type, $lenght="",  $attr=array())
    {
        static::$fields[$nome] = new DBFieldModel($nome, $type, $lenght, $attr);  
    }
    
    public static function AddFieldProperty($nome, $attr=array() )
    {
        static::$fields[$nome]->AddProperty($attr);
    }
    
    public static function SetTableName($name)
    {
        static::$table_name = $table_name;        
    }
    
    public static function SetPrimaryKey( $field )
    {
        static::$_primary_key = $field;
    }
    
    
    public static function CreateTable()
    {
        $sql ="CREATE TABLE IF NOT EXISTS " . static::$table_name." (".PHP_EOL;
        $stack = array();
        foreach(static::$fields as $field)
        {
            array_push($stack, $field->StringFormat());
        }
        $sql .= join(' , ', $stack)." )";
        $sql .=  " ENGINE =  ".  static::$_engine . ";";
        return Database::getInstance()->execute($sql);
    }
    
    public static function ExecuteQuery($sql , $fields=array(), $tables = array() , $attr = array()  )
    {        
        //controllare l'esistenza del campo e riscriverla nel formato "table.field"
        //in caso di ambiguità li prende entrambi e genererà un warning
        $select_field = array();
        $table_list = array();
        foreach($fields as $field)
        {
            $pos = strpos($field,".");
            if( $pos === FALSE ) {
                foreach($tables as $table)
                {
                    $tmp = new $table;
                    if(isset($tmp->$field))
                    {                     
                        $string = $tmp::$table_name.".$field";
                    }
                    if(!in_array($tmp::$table_name, $table_list))
                        array_push ($table_list, $tmp::$table_name);

                }
                if($string === "")
                    throw new DatabaseException("$field non trovato nel database");
                else
                {
                    array_push($select_field, $string);
                }
            }
            else
            {
                $table = substr ($field, 0, $pos );
                if(!in_array($table, $table_list))
                    array_push ($table_list, $table);
                if(!in_array($field, $select_field))
                        array_push ($select_field, $field);
            }
        }
        $query= $sql;
        $query =  str_replace(":field" , join(",", $select_field) , $query);
        $query =  str_replace(":table" , join(",", $table_list) , $query);
        
        
        foreach($fields as $key => $field)
        {
            $query =  str_replace($key , $field , $query);
        }
        $ris = Database::getInstance()->query($query, $attr);
        return $ris;
    }
}
