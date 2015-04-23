<?php


//################################à
//DEFAULT TEMPLATE
$icon = "Template/images/";

MenageTemplate::addTabMenu("Home","/SocialProject/index.php",  $icon ."home.png" , Role::Unverified );
MenageTemplate::addTabMenu("News","/SocialProject/index.php?page=news" ,  $icon . 'file%203.png' , Role::Register);
MenageTemplate::addTabMenu("Gestione", null , $icon . "engine.png" , Role::Register );
MenageTemplate::addTabMenu("Profilo", "/SocialProject/index.php?page=profile&id=".User::getUser()->getId() , $icon ."eye.png" , Role::Register ,"Gestione");
MenageTemplate::addTabMenu("Amministrazione","/SocialProject/index.php?page=admin",  $icon ."shield.png" , Role::Administrator , "Gestione");
MenageTemplate::addTabMenu("Friends","/SocialProject/index.php?page=friend" ,   $icon . 'user.png' , Role::Register);
MenageTemplate::addTabMenu("Logout", '/SocialProject/index.php?Logout=true', $icon ."display%20down.png" , Role::Unverified);

MenageTemplate::addJavascript("Template/js/jquery.min.js");
MenageTemplate::addJavascript("Template/js/jquery.scrolly.min.js");
MenageTemplate::addJavascript("Template/js/jquery.scrollzer.min.js");
MenageTemplate::addJavascript("Template/js/scripts.js");
MenageTemplate::addJavascript("View/SearchBar/search.js");

//GestoreTemplate::addJavascript("Template/js/skel.min.js");
//GestoreTemplate::addJavascript("Template/js/skel-layers.min.js");
//GestoreTemplate::addJavascript("Template/js/init.js");

//MenageTemplate::addCss("Template/css/skel.css");
MenageTemplate::addCss("Template/css/style.css");
MenageTemplate::addCss("Template/css/pure-min.css");


//if(!Session::check('user'))
//    Session::set ('user', User::getVisitator());

$formValidate = filter_input(INPUT_GET, 'formValidate');
if(isset($formValidate))
{
    require_once _DIR_CONTROLLER_ . 'formValidate.php';
    die();
}

$ajaxRequest = filter_input(INPUT_POST, 'ajaxRequest');
if(isset($ajaxRequest))
{
    require_once _DIR_CONTROLLER_ . 'ajaxRequest.php';
    die();
}

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
    MenageTemplate::addCss("Template/css/style-site.css");
    $page = filter_input(INPUT_GET, 'page');
    if(isset($page))
        managePages ($page);
    require_once  "Template/page.php";
    
}
else if(User::checkAccessLevel(Role::Unverified)){
    
    MenageTemplate::addCss("Template/css/style-site.css");
    $page = filter_input(INPUT_GET, 'page');
    if(isset($page))
        managePages ($page);
    require_once  "Template/page.php";
}
else {
    //NO LOGIN EFFETTUATO
    MenageTemplate::addJavascript("View/Account/Login.js");
    MenageTemplate::addJavascript("View/Account/Join.js");
    MenageTemplate::addContent(_DIR_VIEW_."Account/Account.php");
    MenageTemplate::addCss("Template/css/style-login.css");
    require_once  "Template/login-page.php";MenageTemplate::addCss("Template/css/style-login.css");
}


function managePages($page)
{
    $user = User::getUser();
           
    if($page=="profile" && $user->getAccessLevel() >= Role::Unverified)
    {
        MenageTemplate::addContent(_DIR_VIEW_."Profile/Profile.php");
        MenageTemplate::addCss("View/Profile/Profile.css");
        MenageTemplate::addJavascript("View/Profile/Profile.js");
    }
}