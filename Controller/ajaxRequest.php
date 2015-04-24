<?php


if($ajaxRequest === "FormProfile" && User::hasAccess(Role::Register) )
{
    require_once _DIR_VIEW_ . 'PrivateArea/FormProfile.php';
    
}