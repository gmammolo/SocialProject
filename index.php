<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);

define("_ROOT_",dirname(__FILE__)."/");


require_once "Config/Config.php";



GestoreTemplate::addTabMenu("<span class=\"icon fa-home\">Intro</span>", '#top');
GestoreTemplate::addTabMenu("<span class=\"icon fa-th\">Portfolio</span>", '#portfolio');
GestoreTemplate::addTabMenu("<span class=\"icon fa-user\">About Me</span>", '#about');
GestoreTemplate::addTabMenu("<span class=\"icon fa-envelope\">Contact</span>", '#contact');



GestoreTemplate::addJavascript("Template/js/jquery.min.js");
GestoreTemplate::addJavascript("Template/js/jquery.scrolly.min.js");
GestoreTemplate::addJavascript("Template/js/jquery.scrollzer.min.js");
GestoreTemplate::addJavascript("Template/js/scripts.js");
//GestoreTemplate::addJavascript("Template/js/skel.min.js");
//GestoreTemplate::addJavascript("Template/js/skel-layers.min.js");
//GestoreTemplate::addJavascript("Template/js/init.js");

GestoreTemplate::addCss("Template/css/skel.css");
GestoreTemplate::addCss("Template/css/style.css");
GestoreTemplate::addCss("Template/css/style-wide.css");
  

if( !Session::check('utente') ) 
{
    //NO LOGIN EFFETTUATO
    GestoreTemplate::addJavascript("View/Login/Login.js");
    GestoreTemplate::addContent(_DIR_VIEW_."Login/Login.php");
}
else
{
    //LOGIN EFFETTUATO
    GestoreTemplate::addContent(_DIR_VIEW_."Profile/Profile.php");
}


require_once  "Template/page.php";



?>
