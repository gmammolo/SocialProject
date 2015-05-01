<?php

/**
 * Description of Comment
 *
 * @author Giuseppe
 */
class Comment extends Model {
    
    /**
     *
     * @var \Post
     */
    protected $post;
    protected $text;
    /**
     *
     * @var \User 
     */
    protected $author;
    protected $likeit;
    protected $date;
    
    public function __construct($a) {
        $this->id=$a["id"];
        $this->text=$a["text"];
        $this->author=User::getUserByID($a["author"]);
        $this->likeit=$a["likeit"];
        $this->date=$a["date"];
        $this->post=Post::getPostByID( $a["idpost"] );
    }
    
    public function Update() {

    }
    
    function getPost() {
        return $this->post;
    }

    function getText() {
        return $this->text;
    }

    function getAuthor() {
        return $this->author;
    }

    function getLikeit() {
        return $this->likeit;
    }

    function getDate() {
        return $this->date;
    }

    function setText($text) {
        $this->text = $text;
    }


    function setLikeit($likeit) {
        $this->likeit = $likeit;
    }

    function setDate($date) {
        $this->date = $date;
    }

    
    public static function getCommentByID($id) {
        $sql = "SELECT * FROM Comment Where id = :id ";
        $ris = self::ExecuteQuery($sql, array(":id" => $id) );
        return ($ris->rowCount() > 0) ? new Comment($ris->fetch()) : null;
    }
    
    
    /**
     * 
     * @param type $postId
     * @return \Comment[]
     */
    public static function  getCommentsByPostID($postId) {
        $sql = "SELECT * FROM Comment Where idpost = :id ";
        $ris = self::ExecuteQuery($sql, array(":id" => $postId) );
        $list= array();
        while($row = $ris->fetch()) {
            $list[] = new Comment($row);
        }
        return $list;
    }

    
    public static function addComment($idpost, $idauthor, $text) {
        
        $sql = "INSERT INTO `socialproject`.`Comment` ( `idpost`, `text`, `author`, `date`) VALUES (:idp , :text,  :author, :date);";
        return  self::InsertQuery($sql, array(":idp" => $idpost, ":author" => $idauthor, ":text" => $text, ":date" => date("y-m-d G:i:s"))) > 0;
        
    }
    
    public static function delete($id) {
        $sql ="DELETE FROM `Comment` WHERE `id` = ?";
        return self::ExecuteQuery($sql, array($id))->rowCount()==1; 
    }
    
}
