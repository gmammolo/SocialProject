<?php

$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
$cpassword = filter_input(INPUT_POST, 'cpassword');

$reString = '/[^(A-Z|a-z|0-9)]/i';
$rePass = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/';

