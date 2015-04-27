<?php

abstract class BasicEnum {
    
    const __default =  NULL;

    private static function getConstants() {
        
          $reflect = new ReflectionClass ( static::class );
    	  $list_constants = $reflect->getConstants();
           
          $constats = array_keys($list_constants);
          array_shift($constats);
          return $constats;
    }
    
    
    public static function getConstant($index)
    {
        if(static::isValidValue($index))
        {
            
           return static::getConstants()[$index];
        }
        return "";  
    }
    
    
    
    
    public static function isValidName($name) {
        return in_array($name, static::getConstants());
    }

    public static function isValidValue($value) {
        return $value >= 0 && $value < count(static::getConstants());
    }
}

class Role extends BasicEnum 
{
    const __default =  self::Unregister;
    
    const Unregister = 0;
    const Unverified = 1;
    const Register = 2;
    const Moderator = 3;
    const Administrator = 4;
    const Founder = 5;
}