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

    
    /**
     * 
     * @param type $id
     * @return \Comment[]
     */
    public static function  getCommentsByPostID($id) {
        $sql = "SELECT * FROM Comment Where idpost = :id ";
        $ris = self::ExecuteQuery($sql, array(":id" => $id) );
        $list= array();
        while($row = $ris->fetch()) {
            $list[] = new Post($row);
        }
        return $list;
    }

}
