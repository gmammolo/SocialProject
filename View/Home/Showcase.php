<?php       
    $infLimit = filter_input(INPUT_POST, 'infLimit');
    $supLimit = filter_input(INPUT_POST, 'supLimit');
    $showcase = Showcase::getLimitShowcase(User::getUser()->getId(),$infLimit, $supLimit ); 
    foreach($showcase as $showcasePost ) { ?>
        <div class="post">
            <div class="Author">Postato da : <span class="AuthorName"><a href="?page=profile&AMP;id=<?php echo $showcasePost->getPost()->getAuthor()->getId(); ?>"><?php echo $showcasePost->getPost()->getAuthor()->getProfile()->getNome(); ?></a></span></div>
            <form name ="removePost" method="POST" action="?formValidate=deletePost">
                <div class="delete" onclick="Showcase.deletePost(this)"> X </div>
                <input type="hidden" name="baseuri" value="" />
                <input type="hidden" name="id" value="<?php echo $showcasePost->getPost()->getId(); ?>" />
            </form>
            <?php $image = $showcasePost->getPost()->getImage(); 
            if($image != "") { ?>
            <div class="Image" onclick="Showcase.zoomPhoto(event)"><img class="Image" src="<?php echo $image; ?>" alt=""/></div>
            <?php } ?>
            <div class="Testo"> 
                <?php
                    $text = $showcasePost->getPost()->getText();
                    foreach($showcasePost->getPost()->getHashtag() as $hash){
                       $text =  str_replace($hash, "<a href = '?page=hashtag&amp;hashtag=$hash'>".$hash."</a>", $text);
                    }
                    echo  $text;   
                ?>
            </div>
            <div class="row">
                
                <div class="luogo"><?php echo $showcasePost->getPost()->getLocate(); ?></div>
                <div class="data"><?php echo $showcasePost->getPost()->getDate(); ?></div>
                <div class="privacy">
                    <?php 
                        $pri = $showcasePost->getPost()->getPrivacy(); 
                        switch ($pri) {
                            case Privacy::privato :
                                echo '<img src="/SocialProject/Template/images/private_fb.png" alt=" "/>';
                                break;
                            case Privacy::amici :
                                echo '<img src="/SocialProject/Template/images/friend_fb2.png" alt=" "/>';
                                break;
                            case Privacy::amiciplus :
                                echo '<img src="/SocialProject/Template/images/friend_fb2.png" alt=" "/>';
                                break;
                            case Privacy::globale :
                                echo '<img src="/SocialProject/Template/images/global_fb.png" alt=" "/>';
                                break;
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="comments">
            <?php $comments = Comment::getCommentsByPostID($showcasePost->getPost()->getId());
            foreach ($comments as $comment) {  ?>
                <div class="comment">
                    <div>
                        <img class="Avatar" src="<?php echo $comment->getAuthor()->getProfile()->getAvatar();  ?>" alt="" >
                        <span class="Author"><?php echo $comment->getAuthor()->getProfile()->getNome(); ?>:</span>
                        <p><?php echo $comment->getText(); ?><p>
                    </div>
                    <?php if(User::getUser()==$comment->getAuthor() || User::getUser() == $showcasePost->getPost()->getAuthor()   || User::hasAccess(Role::Moderator) ) { ?>
                    <form name="deleteComment" method="POST" action="?formValidate=deleteComment">    
                        <div class="delete" onclick="Showcase.deleteComment(this)"> X </div>
                        <input type="hidden" name="baseuri" value="" />
                        <input type="hidden" name="id" value="<?php echo $comment->getId(); ?>" />
                    </form>  
                    <div class="data"><?php echo $comment->getDate() ?> </div>
                    <?php }   ?>
                </div>    
            <?php } ?>
            <form name="sendComment" method="POST" action="?formValidate=addComment">
               <textarea name="commentText"  value="" draggable="false" />
                <input type="button" name="Invia" value="Invia" onclick="Showcase.sendComment(this)" />
                <input type="hidden" name="postid" value="<?php echo $showcasePost->getPost()->getId(); ?>" />
               <input type="hidden" name="baseurl" value="" />
            </form>
        </div>

    <?php } ?>