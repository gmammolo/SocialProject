<?php
$username = filter_input(INPUT_POST, 'Username');
$password = filter_input(INPUT_POST, 'Password');

$user_irregular = preg_match("/[^'\x22]+/", $username);
$pass_irregular = preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(.){4,16}/', $password);
if ($user_irregular && $pass_irregular) {
    if(User::checkUserValid($username, $password))
    {
        
        $user = User::getUserByLogin($username, $password);
        $user = Session::set('user', $user);
        header("Location: "._HOME_URL_);
        echo 'nvsdonvosdnvsdovnsdonvoisd';
        die();
    }
    else
        Utility::RedMessage ("Account non esistente");
} else {
    Utility::RedMessage("LogIn fallito: Dati inesatti.".PHP_EOL."N.B. Si consiglia l'abilitazione di Javascript");
}
