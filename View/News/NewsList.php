<?php
    $infLimit = filter_input(INPUT_POST, 'infLimit');
    $supLimit = filter_input(INPUT_POST, 'supLimit');
    $showcase = Post::getFriendPostList($infLimit, $supLimit ); 
    foreach($showcase as $showcasePost ) {  ?>

        <div class="post" id="idpost<?php echo $showcasePost->getId(); ?>">
            <div class="Author">Postato da : <span class="AuthorName"><a href="?page=profile&AMP;id=<?php echo $showcasePost->getAuthor()->getId(); ?>"><?php echo $showcasePost->getAuthor()->getProfile()->getNome(); ?></a></span></div>
            <div class="delete" onclick="News.deletePost(event)"> X </div>
            <?php $image = $showcasePost->getImage(); 
            if($image != "") { ?>
            <div class="Image" onclick="News.zoomPhoto(event)"><img class="Image" src="<?php echo $image; ?>" alt=""/></div>
            <?php } ?>
            <div class="Testo"> 
                <?php
                    $text = $showcasePost->getText();
                    foreach($showcasePost->getHashtag() as $hash){
                       $text =  str_replace($hash, "<a href = '?page=hashtag&amp;hashtag=$hash'>".$hash."</a>", $text);
                    }
                    echo  $text;   
                ?>
            </div>
            <div class="row">
                <div class="luogo"><?php echo $showcasePost->getLocate(); ?></div>
                <div class="data"><?php echo $showcasePost->getDate(); ?></div>
                <div class="privacy">
                    <?php 
                        $pri = $showcasePost->getPrivacy(); 
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
    <?php } ?>