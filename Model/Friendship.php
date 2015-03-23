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
class Friendship extends Model {
    //put your code here
    
    protected $applicant;
    protected $requested;
    /**
     * Variabile che indica se la relazione è bloccata o meno:
     * lavora per flag binario:
     * x^0: applicant ha bloccato requested (1 0 0)
     * x^1: requested ha bloccato applicant (2 o 0)
     * @var int 
     */
    protected $blocked;
    /**
     *  Indica se requested ha accettato la richiesta.
     *  E' sufficiente farlo solo in un verso in quanto una volta che applicant 
     * fa la richiesta ha accettato  implicitamente una risposta positiva
     * @var boolean
     */
    protected $accepted;
    
    protected $requestDate;
    protected $acceptedDate;
    protected $blockedDateapllicant;
    protected $blockedDaterequested;
    
    
    public function getApplicant() {
        return $this->applicant;
    }

    public function getRequested() {
        return $this->requested;
    }

    public function getAccepted() {
        return $this->accepted;
    }

    public function getRequestDate() {
        return $this->requestDate;
    }

    public function getAcceptedDate() {
        return $this->acceptedDate;
    }

    public function getBlockedDateapllicant() {
        return $this->blockedDateapllicant;
    }

    public function getBlockedDaterequested() {
        return $this->blockedDaterequested;
    }

    public function setApplicant($applicant) {
        $this->applicant = $applicant;
    }

    public function setRequested($requested) {
        $this->requested = $requested;
    }

    public function setAccepted($accepted) {
        $this->accepted = $accepted;
    }

    public function setRequestDate($requestDate) {
        $this->requestDate = $requestDate;
    }

    public function setAcceptedDate($acceptedDate) {
        $this->acceptedDate = $acceptedDate;
    }

    public function setBlockedDateapllicant($blockedDateapllicant) {
        $this->blockedDateapllicant = $blockedDateapllicant;
    }

    public function setBlockedDaterequested($blockedDaterequested) {
        $this->blockedDaterequested = $blockedDaterequested;
    }

    /**
     * 
     * @return boolean TRUE se Applicant è bloccato, FALSE Altrimenti
     */
    public function IsApplicantBlocked()
    {
        return $this->blocked & 2 === 2;
    }
    
    /**
     * Blocca e sblocca il Requested
     */
    public function ApplicantBlockedAction()
    {
        $this->blocked = $this->blocked xor 1;
        Update();
    }
    
    /**
     * 
     * @return boolean TRUE se Requested è bloccato, FALSE altrimenti
     */
    public function IsRequestedBlocked()
    {
        return $this->blocked & 1 === 1;
    }
    
    /**
     * Blocca e sblocca l'applicant
     */
    public function RequestedBlockedAction()
    {
         $this->blocked = $this->blocked xor 2;
        Update();
    }

    public function __construct($ar = array()) {
        parent::__construct();
        $this->applicant = GetUserByID($ar["applicant"]);
        $this->requested = GetUserByID($ar["requested"]);
        $this->blocked = $ar['blocked'];
        $this->accepted = $ar['accepted'];
        $this->requestDate= $ar['requestDate'];
        $this->acceptedDate = $ar['acceptedDate'];
        $this->blockedDateapllicant = $ar['blockedDateapllicant'];
        $this->blockedDaterequested = $ar['blockedDaterequested'];
        
    }

    public function Update() {
        throw new Exception("Not Implement Yet!");
    }

}
