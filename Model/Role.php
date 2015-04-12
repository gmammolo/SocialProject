<?php

class Role
{
    const __default =  self::Unregister;
    
    const Unregister = 0;
    const Unverified = 1;
    const Register = 2;
    const Moderator = 3;
    const Administrator = 4;
    const Founder = 5;
}