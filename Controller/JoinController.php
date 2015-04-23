<?php


$username = filter_input(INPUT_POST, 'username');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$cpassword = filter_input(INPUT_POST, 'cpassword');

if(!preg_match("/['\x22]/", $username ) &&
        preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/',$email) &&
        $password == $cpassword &&
        preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(.){4,16}/', $password))
{
    if(User::checkUser($username, $password))
        Utility::RedMessage("Account Già esistente");
    else
    {
        Utility::GreenMessage("Registrazione in corso");
        $user = User::createAccount($username, $password, $email);
        if(!$user)
            Utility::RedMessage ("Errore nella creazione Account. Si prega di contattare un amministratore");
        else
        {
           Session::set('user', $user);
           header("Location: "._HOME_URL_);
           die();
        }
    }
}
else
{
    Utility::RedMessage("Crezione Account fallita: Dati inesatti.".PHP_EOL."N.B. Si consiglia l'abilitazione di Javascript");
}