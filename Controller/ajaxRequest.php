<?php

if($ajaxRequest === "FormProfile" && User::hasAccess(Role::Register) )
{
    require_once _DIR_VIEW_ . 'PrivateArea/FormProfile.php';
    
}
else if($ajaxRequest == "search" && User::hasAccess(Role::Register)  ) {
    $search = filter_input(INPUT_POST, "search" );
    require_once _DIR_VIEW_ . 'SearchBar/search.php';
}