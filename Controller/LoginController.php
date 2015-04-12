<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$username = filter_input(INPUT_POST, 'Username');
$password = filter_input(INPUT_POST, 'Password');

$reString = '/[^(A-Z|a-z|0-9]/i';
//$rePass = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/';
$repass = '//';
if(!preg_match($reString, $username ) && checkPassword($password, $cpassword))
{
    User::checkUser($username, $password);
    
}
else
{
    //TODO da in modo molto allegro un segnale di errore
}


function checkPassword($password, $cpassword)
{
   return $password == $cpassword && 
          $password >=4 && $password <= 16 && 
          preg_match('/^\w+$/' , $password ) && 
          !preg_match('/[0-9]/' , $password ) && 
          !preg_match('/[a-z]/' , $password ) && 
          !preg_match('/[A-Z]/' , $password ) ;

}