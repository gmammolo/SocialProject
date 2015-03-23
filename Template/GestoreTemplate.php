<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GestoreTemplate
 *
 * @author giuseppe
 */
class GestoreTemplate {
   
    /**
     * Menu del template
     * @var array
     */
    protected static $menu = array();
    
    /**
     * array contenente tutti gli include del css
     * @var array 
     */
    protected static $css = array();
    
    
    /**
     * array contente il contenuto da stampare nel content <br>
     * Non permette di gestire direttamente la posizione dei vari content inseriti, <br> 
     * pertanto in caso di impostazioni personalizzate si usa un file php intermediario <br>
     * @var array
     */
    protected static $contents =array();
    
    /**
     * Array con al suo interno i riferimenti al percorso dei wiget <br>
     * @var array
     */
    protected static $widget=array();
    
    /**
     * variabile contenente i vari javascript del sito;
     * @var array 
     */
    protected static  $scripts =array();
    
    /**
     * Aggiunge una regola del css
     * @param string $url
     */
    public static function addCss($url)
    {
            self::$css[] = $url;
    }
    
    /**
     * Aggiunge una regola del Javascript
     * @param string $url
     */
    public static function addJavascript($url)
    {
        self::$scripts[] = $url;
    }
    
    /**
     * Aggiunge un content al sito
     * @param string $url
     */
    public static function addContent($url)
    {
        self::$contents[] = $url;
        
    }
    
    /**
     * Aggiunge un widget
     * @param string $url
     */
    public static function addWidget($url)
    {
        self::$widget[] = $url;
        
    }
    
    /**
     * Nome del tab del menu principale <br>
     * se l'url non è presente si organizza per l'inserimento di un array. <br>
     * @param string $nome
     * @param string $url optional
     */
    public static function addTabMenu($nome, $url = NULL)
    {
            if(is_null($url))
            {
                self::$menu[$nome] = array();
            }
            else //string
            {
                self::$menu[$nome] = $url ;
            }
    }
    
    /**
     * Inserisce un subtab del Menu <br>
     * @param string $menuName Nome del Menu
     * @param string $nome Nome del subMenu 
     * @param string $url
     */
    public static function addSubTabMenu($menuName, $nome, $url)
    {
        if(isset(self::$menu[$menuName]))
            self::$menu[$menuName][$nome] = $url ; 
    }
    
    
    /**
     * Ritorna l'array con le regole del css
     * @return array
     */
    public static function getCss()
    {
        return self::$css;
    }
    
    /**
     * Ritorna l'array con l'url dei file javascript
     * @return array
     */
    public static function getJavascript()
    {
        return self::$scripts;
    }
    
    /**
     * Ritorna l'array dei content
     * @return array
     */
    public static function getContents()
    {
        return self::$contents;
    }
    
     /**
     * Ritorna l'array dei widget
     * @return array
     */
    public static function getWidget()
    {
        return self::$widget;
    }
    
    /**
     * return array 
     * @return array
     */
    public static function getMenu()
    {
        return self::$menu;
    }
    
    
}
