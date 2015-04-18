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
GestoreTemplate::addCss("http://yui.yahooapis.com/pure/0.6.0/pure-min.css");

if(!Session::check('user'))
    Session::set ('user', User::getVisitator());


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

$logout = filter_input(INPUT_GET, 'Logout');
if(isset($logout))
{
    Session::destroy();
}


//#############################à
//GESTIONE ACCESSI 
if( User::checkUserRole(Role::Unregister) ) {
    //NO LOGIN EFFETTUATO
    GestoreTemplate::addJavascript("View/Account/Login.js");
    GestoreTemplate::addJavascript("View/Account/Join.js");
    GestoreTemplate::addContent(_DIR_VIEW_."Account/Account.php");
    GestoreTemplate::addCss("Template/css/style-login.css");
    require_once  "Template/login-page.php";
    
}
else {
    GestoreTemplate::addCss("Template/css/style-site.css");
    
    if(User::checkUserRole(Role::Unverified)) {
        //LOGIN EFFETTUATO
        GestoreTemplate::addContent(_DIR_VIEW_."Profile/Profile.php");
    }
    else {
        GestoreTemplate::addContent(_DIR_VIEW_."Profile/Profile.php");
    }

    
    require_once  "Template/page.php";
}


