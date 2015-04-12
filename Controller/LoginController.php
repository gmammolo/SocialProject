<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$username = filter_input(INPUT_POST, 'Username');
$password = filter_input(INPUT_POST, 'Password');

$user_irregular = preg_match("/[^'\x22]+/", $username);
$pass_irregular = preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(.){4,16}/', $password);

if (!$user_irregular && !$pass_irregular) {
    User::checkUser($username, $password);
} else {
    Utility::RedMessage("LogIn fallito: Dati inesatti.".PHP_EOL."N.B. Si consiglia l'abilitazione di Javascript");
}
