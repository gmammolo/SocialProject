<?php


//################################à
//DEFAULT TEMPLATE
$icon = "Template/images/";

GestoreTemplate::addTabMenu("Home","/SocialProject/index.php",  $icon ."home.png" , Role::Unverified );
GestoreTemplate::addTabMenu("News","/SocialProject/index.php?page=news" ,  $icon . 'file%203.png' , Role::Register);
GestoreTemplate::addTabMenu("Gestione", null , $icon . "engine.png" , Role::Register );
GestoreTemplate::addTabMenu("Profilo", "/SocialProject/index.php?page=profile" , $icon ."eye.png" , Role::Register ,"Gestione");
GestoreTemplate::addTabMenu("Amministrazione","/SocialProject/index.php?page=admin",  $icon ."shield.png" , Role::Administrator , "Gestione");
GestoreTemplate::addTabMenu("Friends","/SocialProject/index.php?page=friend" ,   $icon . 'user.png' , Role::Register);
GestoreTemplate::addTabMenu("Logout", '/SocialProject/index.php?Logout=true', $icon ."display%20down.png" , Role::Unverified);

GestoreTemplate::addJavascript("Template/js/jquery.min.js");
GestoreTemplate::addJavascript("Template/js/jquery.scrolly.min.js");
GestoreTemplate::addJavascript("Template/js/jquery.scrollzer.min.js");
GestoreTemplate::addJavascript("Template/js/scripts.js");
GestoreTemplate::addJavascript("View/SearchBar/search.js");
//GestoreTemplate::addJavascript("Template/js/skel.min.js");
//GestoreTemplate::addJavascript("Template/js/skel-layers.min.js");
//GestoreTemplate::addJavascript("Template/js/init.js");

GestoreTemplate::addCss("Template/css/skel.css");
GestoreTemplate::addCss("Template/css/style.css");
GestoreTemplate::addCss("Template/css/style-wide.css");
GestoreTemplate::addCss("http://yui.yahooapis.com/pure/0.6.0/pure-min.css");

//if(!Session::check('user'))
//    Session::set ('user', User::getVisitator());


$login = filter_input(INPUT_GET, 'Login');
if(isset($login) && !User::hasAccess(Role::Unverified) )
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
    header("Location: "._HOME_URL_);
    die();
}

//#############################à
//GESTIONE ACCESSI 
if( User::checkAccessLevel(Role::Register) ) {
    
        GestoreTemplate::addCss("Template/css/style-site.css");
    
    if(User::checkAccessLevel(Role::Unverified)) {
        //LOGIN EFFETTUATO
//        GestoreTemplate::addContent(_DIR_VIEW_."LoremIpsum.php");
    }
    else {
        //IN ATTESA DI ABILITAZIONE
        //GestoreTemplate::addContent(_DIR_VIEW_."LoremIpsum.php");
    }

    
    require_once  "Template/page.php";
    
   
    
}
else if(User::checkAccessLevel(Role::Unverified)){
    
}
else {
    //NO LOGIN EFFETTUATO
    GestoreTemplate::addJavascript("View/Account/Login.js");
    GestoreTemplate::addJavascript("View/Account/Join.js");
    GestoreTemplate::addContent(_DIR_VIEW_."Account/Account.php");
    GestoreTemplate::addCss("Template/css/style-login.css");
    require_once  "Template/login-page.php";
}


