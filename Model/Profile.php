<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Model.php';

/**
 * Description of Profile
 *
 * @author giuseppe
 */
class Profile extends Model {
    //put your code here
    protected $id;
    protected $nome;
    protected $avatar;
    protected $email;
    protected $residenza;
    protected $data;
    
    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getResidenza() {
        return $this->residenza;
    }

    public function getData() {
        return $this->data;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setResidenza($residenza) {
        $this->residenza = $residenza;
    }

    public function setData($data) {
        $this->data = $data;
    }
    public function getAvatar() {
        return $this->avatar;
    }

    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }

    public function __construct($arr = array() ) {
        $this->id = $arr['id'];
        $this->avatar =  $arr['avatar'];
        $this->nome = $arr['nome'];
        $this->data = $arr['data'];
        $this->email = $arr['email'];
        $this->residenza = $arr['residenza'];
        
    }
    
    public static function getProfileByID($id)
    {
        if($id == -1)
            return self::getVisitator ();
        
        $ar = Self::ExecuteQuery("SELECT * FROM Profile WHERE id=?;", array($id));
        return new Profile($ar[0]);
        
    }

    public function Update() {
        throw new Exception("Not Implement Yet!");
    }
    
    
    public static function getVisitator()
    {
        $ar = array(
            "avatar" => "default",
            "nome" => "Visitatore",
            "data" => "00/00/0000",
            "email" => "",
            "residenza" => "",
            "id" => -1
        );
        return new Profile($ar);
    }

}
