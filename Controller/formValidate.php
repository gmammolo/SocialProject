<?php

if($formValidate === "FormProfile" && User::hasAccess(Role::Register) )
{
    require_once _DIR_VIEW_ . 'Profile/FormProfile.php';
    
    $username = filter_input(INPUT_POST, 'Username');
    $email = filter_input(INPUT_POST, 'Email');
    $residenza = filter_input(INPUT_POST, 'Residenza');
    $data = filter_input(INPUT_POST, 'Data');
    $gender = filter_input(INPUT_POST, 'Gender');
    if(filter_input(INPUT_GET, 'Update') && 
            (preg_match("/[^'\x22]+/", $username) && 
            preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/',$email) && 
            preg_match("/[^'\x22]+/", $residenza) &&
            preg_match("/(0000-00-00)|(((19|20)\d\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01]))$/", $data) &&
            ($gender == "nessuno" || $gender == "uomo" || $gender == "donna" || $gender == "altro")
            ) )
    {
        //update
    }
            
    header("location: " . _HOME_URL_ . "?page=profile"  );
    
    
    
}




