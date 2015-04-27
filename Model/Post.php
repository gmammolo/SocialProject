<?php

/**
 * Description of Post
 *
 * @author Giuseppe
 */
class Post extends Model {

    /**
     *
     * @var \User
     */
    protected $author;
    protected $text;
    protected $image;
    protected $hashtag;
    protected $date;
    protected $locate;

    /**
     *
     * @var \Privacy  
     */
    protected $privacy;

    public function __construct($ar = array()) {
        $this->id = $ar['id'];
        $this->author = User::getUserByID($ar['author']);
        $this->text = $ar['text'];
        $this->image = $ar['image'];
        $this->hashtag = unserialize($ar['hashtag']);
        $this->date = $ar['date'];
        $this->locate = $ar['locate'];
        $this->privacy = $ar['privacy'];
    }

    function getAuthor() {
        return $this->author;
    }

    function getText() {
        return $this->text;
    }

    function getImage() {
        return $this->image;
    }

    function getHashtag() {
        return $this->hashtag;
    }

    function getDate() {
        return $this->date;
    }

    function getLocate() {
        return $this->locate;
    }

    function getPrivacy() {
        return $this->privacy;
    }

    function setAuthor(\User $author) {
        $this->author = $author;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setImage($image) {
        $this->image = $image;
    }

    function setHashtag($hashtag) {
        $this->hashtag = $hashtag;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setLocate($locate) {
        $this->locate = $locate;
    }

    function setPrivacy($privacy) {
        $this->privacy = $privacy;
    }

    public function Update() {
        
    }

}
