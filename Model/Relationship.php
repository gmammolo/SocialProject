<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Model.php';

/**
 * Description of Friendship
 *
 * @author giuseppe
 */
class Relationship extends Model {

    //put your code here


    protected $applicant;
    protected $requested;
    protected $ablocked;
    protected $rblocked;

    /**
     *  Indica se requested ha accettato la richiesta.
     *  E' sufficiente farlo solo in un verso in quanto una volta che applicant 
     * fa la richiesta ha accettato  implicitamente una risposta positiva
     * @var boolean
     */
    protected $accepted;
    protected $requestDate;
    protected $acceptedDate;
    protected $ablockedDate;
    protected $rblockedDate;

    public function __construct($ar = array()) {
        parent::__construct();
//        $this->applicant = GetUserByID($ar["applicant"]);
//        $this->requested = GetUserByID($ar["requested"]);
//        $this->blocked = $ar['blocked'];
//        $this->accepted = $ar['accepted'];
//        $this->requestDate= $ar['requestDate'];
//        $this->acceptedDate = $ar['acceptedDate'];
//        $this->ablockedDate = $ar['blockedDateapllicant'];
//        $this->rblockedDate = $ar['blockedDaterequested'];
    }

    /**
     * 
     * @return User
     */
    function getApplicant() {
        return $this->applicant;
    }

    /**
     * 
     * @return User
     */
    function getRequested() {
        return $this->requested;
    }

    function getAblocked() {
        return $this->ablocked;
    }

    function getRblocked() {
        return $this->rblocked;
    }

    function getAccepted() {
        return $this->accepted;
    }

    function getRequestDate() {
        return $this->requestDate;
    }

    function getAcceptedDate() {
        return $this->acceptedDate;
    }

    function getAblockedDate() {
        return $this->ablockedDate;
    }

    function getRblockedDate() {
        return $this->rblockedDate;
    }

    function setAccepted($accepted) {
        $this->accepted = $accepted;
    }

    function setRequestDate($requestDate) {
        $this->requestDate = $requestDate;
    }

    function setAcceptedDate($acceptedDate) {
        $this->acceptedDate = $acceptedDate;
    }

    function setAblockedDate($ablockedDate) {
        $this->ablockedDate = $ablockedDate;
    }

    function setRblockedDate($rblockedDate) {
        $this->rblockedDate = $rblockedDate;
    }

    /**
     * Blocca e sblocca il Requested
     */
    public function dABlockedAction() {
        $this->blocked = $this->blocked xor 1;
        Update();
    }

    /**
     * Blocca e sblocca l'applicant
     */
    public function dRBlockedAction() {
        $this->blocked = $this->blocked xor 1;
        Update();
    }

    public function Update() {
        throw new Exception("Not Implement Yet!");
    }

    
    
    public static function getRandomNotFriends($userID)
    {
        $sql = "SELECT * FROM `User`\n"
                . "WHERE id <> :userID AND accessLevel > 1 AND id NOT IN (\n"
                . " SELECT applicant From Relationship Where 1\n"
                . " UNION\n"
                . " SELECT requested From Relationship Where 1\n"
                . " ) ORDER BY RAND() LIMIT 30 ";
        $u = Model::ExecuteQuery($sql, array(":userID" => $userID));
        $ris = array();
        while($row =  $u->fetch()) {
            $ris []= new User($row);
        }
        return $ris;    
            
        
    }
    
    
    public static function getRandomRelationship($userID)
    {
        $sql = "SELECT * FROM `User`\n"
                . "WHERE id <> :userID AND accessLevel > 1 AND id IN (\n"
                . " SELECT applicant From Relationship Where 1\n"
                . " UNION\n"
                . " SELECT requested From Relationship Where 1\n"
                . " ) ORDER BY RAND() LIMIT 0, 30 ";
        $u = Model::ExecuteQuery($sql, array(":userID" => $userID));
        return ($u->rowCount() > 0) ? new Relationship($u->fetch()) : null;
    }
    
    public static function getRandomFriend($userID) {
        $sql = "SELECT * FROM `Relationship` WHERE `applicant` = :id OR `requested` = :id AND `accepted`= TRUE AND `ablocked`=FALSE AND `rblocked`= FALSE ORDER BY RAND() LIMIT 1";
        $ris = self::ExecuteQuery($sql, array(":id"=>$userID));
        return ($ris->rowCount()==1) ? new Relationship($ris->fetch()) : NULL; 
    }
}

/**
 * Maschera della classe Relationship: Serve per gestire velocemente le relazioni, in  quanto 
 * non è sempre prestabilito se l'utente collegato è l'applicant o il requested
 * NOTE: USARE SOLO SE LA RELAZIONE HA A CHE FARE CON  L'UTENTE
 * 
 */
class Friendship {
    /*
     *   FUNZIONI STATICHE:
     *       $user = "a";
     *       $fun = "Relationship::".$user."Pippo";
     *       call_user_func($fun);
     * 
     *  FUNZIONI NON STATICHE
     *       $rel = new Relationship();
     *       $user = "r"."Pippo";
     *       $fun = $rel->$user();
     * 
     */

    /**
     *
     * @var User 
     */
    private $user;

    /**
        *
        * @var User
        */
    private $friend;

    /**
        *
        * @var Relationship
        */
    private $relationship;

    /**
     * 
     * @param Relationship $relationship
     */
    public function __construct($relationship) {
        $this->relationship = $relationship;
        if ($relationship->getApplicant()->getId() == User::getUser()->getId()) {
            $this->user = "A";
            $this->friend = "R";
        } else {
            $this->user = "R";
            $this->friend = "A";
        }
    }

    public function getUser() {
        return ( $this->user == "A") ? $this->relationship->getApplicant() : $this->relationship->getRequested();
    }

    public function getFriend() {
        return ( $this->friend == "A") ? $this->relationship->getApplicant() : $this->relationship->getRequested();
    }

    public function getRelationship() {
        return $this->relationship;
    }
    
    public function Blocks()
    {
        $method= "d". $this->user."BlockedAction";
        $this->relationship->$method();
                
    }
    
    public function isBlocked()
    {
        $method= "get".$this->user."BlockedAction";
        return $this->relationship->$method();
    }


   /**
        * 
        * @param type $user
        * @return \User
        */
    public static function getRandomNotFriends($user)
    {
        return Relationship::getRandomNotFriends($user->getID());
    }
    
    /**
     * 
     * @param type $user
     * @return \Friendship
     */
    public static function getRandomFriendship($user)
    {
        $relation = Relationship::getRandomFriend($user->getID());
        return (isset($relation)) ?  new Friendship($relation) : NULL  ;
    }
    
}
