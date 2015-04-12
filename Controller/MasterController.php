<?php


//################################à
//DEFAULT TEMPLATE
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
  

$login = filter_input(INPUT_GET, 'Login');
if(isset($login))
{
    require_once _DIR_CONTROLLER_ . 'LoginController.php';
}

$join = filter_input(INPUT_GET, 'Join');
if(isset($join))
{
    require_once _DIR_CONTROLLER_ . 'JoinController.php';
}

//#############################à
//GESTIONE ACCESSI 
//TODO: questo sistema va cambiato con un sistema di gestione permessi di visualizzazione
//il visitatore ha il "permesso" di visualizzare la schermata di login
if( User::checkUserRole(Role::Unregister) ) 
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

