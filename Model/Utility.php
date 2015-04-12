<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utility
 *
 * @author Giuseppe
 */
class Utility {

    protected static $redMessage = array();
    protected static $greenMessage = array();
    protected static $yellowMessage = array();

    public static function RedMessage($param0) {
        var_dump($param0);
        self::$redMessage[]=$param0;
    }

    public static function GreenMessage($param0) {
        var_dump($param0);
        self::$greenMessage[]=$param0;
    }

    public static function YellowMessage($param0) {
        var_dump($param0);
        self::$yellowMessage[]=$param0;
    }
    //put your code here
}
