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
    protected $accessLevel;
    protected $email;
    protected $profile;
    
    
    
    
    public function __construct($ar = array()) {
            $this->id = $ar['id'];
            $this->username = $ar['username'];
            //TODO:: VALUTARE LA PRESENZA DI QUESTO CAMPO PER MOTIVI DI SICUREZZA...
            //$this->password = $ar['password'];
            $this->roles = unserialize($ar['roles']);
            $this->email = $ar['email'];
            $this->profile = Profile::getProfileByID($ar['profile']);
            $this->accessLevel = $ar['accessLevel'];

    }

    function getAccessLevel() {
        return $this->accessLevel;
    }

    function setAccessLevel($accessLevel) {
        $this->accessLevel = $accessLevel;
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

    /**
        * 
        * @return Profile
        */
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
    
    
    public static function getUser() {
        
        if(!Session::check('user'))  {
            return User::getVisitator();
        }
        else  {
            
            $user = Session::get ('user', 'User');
            if ($user->getAccessLevel() == "") {
                Session::remove('user');
                return User::getVisitator();
            }
            return $user ;
                
        }
            
    }
    
    public static function checkAccessLevel($al)
    {
        $utente = self::getUser();
        return $utente->getAccessLevel() >= $al;
    }
    
    
    
    public static function getVisitator()
    {
        $ar = array(
            "username" => "Visitatore",
            "roles" => serialize(array()),
            "accessLevel" => Role::Unregister,
            "email" => "",
            "id"=> -1,
            "password" => "",
            "profile" => -1
            
        );
        return new User($ar);
    }
    
    
    public static function checkUserValid($user, $pass) {
        $sql = "SELECT username, password FROM User WHERE username = ? ";
        $ris = self::ExecuteQuery($sql, array($user))->fetch();
        return isset($ris['password']) && crypt($pass , $ris['password'] ) == $ris['password'] ;
    }
    
    public static function checkUser($user) {
        $sql = "SELECT COUNT(*) as NUM FROM User WHERE username = ? ";
        $ris = self::ExecuteQuery($sql, array($user ))->fetch();
        return $ris["NUM"]== 1;
    }
    
    
    public static function getUserByLogin($user, $pass) {
        $sql = "SELECT * FROM User WHERE username = ?";
        $ris = self::ExecuteQuery($sql, array($user ))->fetch();
        return (isset($ris['password']) && crypt($pass , $ris['password'] ) == $ris['password']) ? new User($ris) : NULL;
                
    }
    
    public static function getUserByID($id) {
        $sql = "SELECT * FROM User WHERE id = ? ";
        $ris = self::ExecuteQuery($sql, array($id ));
        if ( $ris->rowCount() == 0 )
            return null;
        return new User($ris->fetch());
    }
    
    public static function createAccount($user, $pass, $email) {
        $idprofile= Profile::createProfile($user, $email); 
        $sql = "INSERT INTO `socialproject`.`User` (`id`, `username`, `password`, accessLevel, `roles`, `email`, `profile`) VALUES (NULL, :user, :pass, :al , :role, :email, :profile );";
        $id =  self::InsertQuery($sql, array(":user" => $user, ":pass" => crypt($pass), ":al" => Role::Unverified, ":role" => serialize(array()) , ":email" => $email, ":profile" => $idprofile ));
        return User::getUserByID($id);
    }
    
    
    public static function hasAccess($levelRequired)
    {
        $user = User::getUser();
        return $user->accessLevel >= $levelRequired;
    }
    
}
 

