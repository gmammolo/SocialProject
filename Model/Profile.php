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
    protected $generalita;
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
    function getId() {
        return $this->id;
    }

    function getGeneralita() {
        return $this->generalita;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setGeneralita($generalita) {
        $this->generalita = $generalita;
    }

        public function __construct($arr = array() ) {
        $this->id = $arr['id'];
        $this->avatar =  $arr['avatar'];
        $this->generalita = $arr['generalita'];
        $this->nome = $arr['nome'];
        $this->data = $arr['data'];
        $this->email = $arr['email'];
        $this->residenza = $arr['residenza'];
        
    }
    
    public static function getProfileByID($id)
    {
        if($id == -1)
            return self::getVisitator ();
        
        $ar = Self::ExecuteQuery("SELECT * FROM Profile WHERE id=?;", array($id))->fetch();
        return new Profile($ar);
        
    }

    public function Update() {
        throw new Exception("Not Implement Yet!");
    }
    
    
    public static function getVisitator()
    {
        $ar = array(
            "avatar" => "Template/images/avatar.jpg",
            "nome" => "Visitatore",
            "data" => "00/00/0000",
            "generalita" => "nessuno",
            "email" => "",
            "residenza" => "",
            "id" => -1
        );
        return new Profile($ar);
    }
    
    
    public static function createProfile($nome, $email)
    {
        $avatar = "Template/images/avatar.jpg";
        $sql = "INSERT INTO `socialproject`.`Profile` (`id`, `nome`, `avatar`, `residenza`, `email`) VALUES (NULL, ?, ?, '', ?)";
        return self::InsertQuery($sql, array($nome, $avatar, $email));
    }

}
