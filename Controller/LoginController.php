<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$username = filter_input(INPUT_POST, 'Username');
$password = filter_input(INPUT_POST, 'Password');
//$username = $_REQUEST['Username'];
//$password = $_REQUEST['Password'];

$reString = '/[^(A-Z|a-z|0-9)]/i';
$rePass = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/';

$user_irregular = preg_match($reString, $username );

$pass_irregular = preg_match($rePass , $password );

if(!$user_irregular && !$pass_irregular)
{
    //TODO: fa il check nel DB se esiste l'utente e lo setta
    
}
else
{
    //TODO da in modo molto allegro un segnale di errore
}