<?php

abstract class BasicEnum {
    
    const __default =  NULL;
    private static $constCacheArray = NULL;

    private static function getConstants() {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }
    
    
    public static function getConstant($value)
    {
        var_dump (static::getConstants());
        if(static::isValidValue($value - 1))
            
            return static::getConstants()[$value-1];
    }

    public static function isValidName($name, $strict = false) {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value) {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict = true);
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