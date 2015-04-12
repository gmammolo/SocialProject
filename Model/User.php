<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Model.php';


/**
 * Description of User
 *
 * @author giuseppe
 */
class User extends Model{
    //put your code here
    
    protected $username;
    protected $password; 
    protected $roles;
    protected $email;
    protected $profile;
    
    
    
    
    public function __construct($ar = array()) {
        $this->id = $ar['id'];
        $this->username = $ar['username'];
        //TODO:: VALUTARE LA PRESENZA DI QUESTO CAMPO PER MOTIVI DI SICUREZZA...
        $this->password = $ar['password'];
        $this->roles = unserialize($ar['roles']);
        $this->email = $ar['email'];
        $this->profile = Profile::getProfileByID($ar['profile']);
    }


    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getProfile() {
        return $this->profile;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRoles($roles) {
        $this->roles = $roles;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setProfile($profile) {
        $this->profile = $profile;
    }

    public function Update() {
        //TODO: serialize(role);
        throw new Exception("Not Implement Yet!");
    }
    
    
    /**
     * ritorna un utente non amico da proporre come tale
     */
    public function GetRandomNotFriend()
    {
        throw new Exception("Not Implement Yet!");
    }
    
    
    
    
    
    
    //*********************************************************************
    //*******************************************************************
    
    public static $utente;
    
    public static function getUser() {
        if(isset(self::$utente)) 
            return self::$utente;
        
        if(!Session::check('utente'))  {
            return User::getVisitator();
        }
        else  {
            self::$utente = Session::get ('utente', 'User');
            return self::$utente;
        }
            
    }
    
    public static function checkUserRole($role)
    {
        $utente = self::getUser();
        return in_array($role,$utente->getRoles()) ;
    }
    
    
    public static function getVisitator()
    {
        $ar = array(
            "username" => "Visitatore",
            "roles" => serialize(array(Role::Unregister)),
            "email" => "",
            "id"=> -1,
            "password" => "",
            "profile" => -1
            
        );
        return new User($ar);
    }
    
    
    public static function CheckUser($user, $pass) {
        $sql = "SELECT COUNT(username) FROM User WHERE username = ? AND password = ? ";
        $ris = Database::getInstance()->query($sql, array($user, crypt($pass) ));
        var_dump($ris);
    }
    
    
    
    

}
 

