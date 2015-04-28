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
    
    
    
    //###################################
    
    /**
     * 
     * @param type $author
     * @param type $text
     * @param type $image
     * @param type $locate
     * @param type $hashtag
     * @param type $privacy
     * @return \Post
     */
    public static function createNewPost($author, $text, $image, $locate , $hashtag, $privacy ) {
        $sql = "INSERT INTO `socialproject`.`Post` (`id`, `author`, `text`, `image`, `hashtag`, `date`, `locate`, `privacy`) VALUES (NULL, :author, :text, :image, :hashtag, :date, :loco, :privacy);";       
        $id = self::InsertQuery($sql, array(":author" => $author , ":text" => $text , ":image" => $image , ":hashtag" => serialize($hashtag), ":date" => date("y-m-d G:i:s"), ":loco" => $locate, ":privacy" => $privacy));
        return ($id > 0) ? Post::getPostByID($id) : null;
    }

    
    public static function getPostByID($id) {
       $sql = 'SELECT * FROM `Post` Where id = ? ';
       $ris = self::ExecuteQuery($sql, array($id));
        if ( $ris->rowCount() != 1 )
            return null;
        return new Post($ris->fetch());
    }
    
    public static function delete($id) {
        $sql ="DELETE FROM `Post` WHERE `Post`.`id` = ?";
        return self::ExecuteQuery($sql, array($id))->rowCount()==1; 
    }
    
}
