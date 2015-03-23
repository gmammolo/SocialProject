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
    protected $enabled;
    protected $verified;
    protected $roles;
    protected $email;
    protected $profile;
    
    
    
    
    public function __construct($ar = array()) {
        $this->id = $ar['id'];
        $this->username = $ar['username'];
        //TODO:: VALUTARE LA PRESENZA DI QUESTO CAMPO PER MOTIVI DI SICUREZZA...
        $this->password = $ar['password'];
        $this->enabled = $ar['enabled'];
        $this->verified = $ar['verified'];
        $this->roles = $ar['roles'];
        $this->email = $ar['email'];
        $this->profile = Profile::GetByID($ar['profile']);
    }


    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEnabled() {
        return $this->enabled;
    }

    public function getVerified() {
        return $this->verified;
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

    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }

    public function setVerified($verified) {
        $this->verified = $verified;
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
        throw new Exception("Not Implement Yet!");
    }
    
    
    /**
     * ritorna un utente non amico da proporre come tale
     */
    public function GetRandomNotFriend()
    {
        throw new Exception("Not Implement Yet!");
    }
    

}
