<?php


function managePages($page)
{
    $user = User::getUser();
    if($user->getAccessLevel() == Role::Unverified)
    {
        Utility::YellowMessage("Attendi che un Moderatore ti abiliti ad avere accesso completo al sito!");
    }
    if(!isset($page) || $page =="home" || $page == "")
    {
        MenageTemplate::addContent(_DIR_VIEW_."Home/Home.php");
        MenageTemplate::addCss("View/Home/Home.css");
        MenageTemplate::addJavascript("View/Home/Home.js");
        MenageTemplate::addCss("View/Home/Showcase.css");
        MenageTemplate::addJavascript("View/Home/Showcase.js");
    }
    else if($page=="profile" && $user->getAccessLevel() >= Role::Unverified)
    {
        MenageTemplate::addContent(_DIR_VIEW_."PrivateArea/Profile.php");
        MenageTemplate::addCss("View/PrivateArea/Profile.css");
        MenageTemplate::addJavascript("View/PrivateArea/Profile.js");
        MenageTemplate::addCss("View/Home/Home.css");
        MenageTemplate::addJavascript("View/Home/Home.js");
    }
    else if($page=="admin" && $user->getAccessLevel() >= Role::Moderator)
    {
        MenageTemplate::addContent(_DIR_VIEW_."PrivateArea/AccountList.php");
        MenageTemplate::addCss("View/PrivateArea/AccountList.css");
        MenageTemplate::addJavascript("View/PrivateArea/AccountList.js");
    }
    else if($page=="friends" && $user->getAccessLevel() >= Role::Register)
    {
        MenageTemplate::addContent(_DIR_VIEW_."Friends/Friends.php");
        MenageTemplate::addCss("View/Friends/Friends.css");
        MenageTemplate::addJavascript("View/Friends/Friends.js");
    }
    else if($page=="news" && $user->getAccessLevel() >= Role::Register)
    {
        MenageTemplate::addContent(_DIR_VIEW_."News/News.php");
        MenageTemplate::addCss("View/News/News.css");
        MenageTemplate::addJavascript("View/News/News.js");
        MenageTemplate::addCss("View/Home/Showcase.css");
        MenageTemplate::addJavascript("View/Home/Showcase.js");
    }
    
}