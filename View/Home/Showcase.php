<?php       
    $infLimit = filter_input(INPUT_POST, 'infLimit');
    $supLimit = filter_input(INPUT_POST, 'supLimit');
    $showcase = Showcase::getLimitShowcase(User::getUser()->getId(),$infLimit, $supLimit ); 
    foreach($showcase as $showcasePost ) { ?>
        <div class="post" id="idpost<?php echo $showcasePost->getPost()->getId(); ?>">
            <div class="Author">Postato da : <span class="AuthorName"><a href="?page=profile&AMP;id=<?php echo $showcasePost->getPost()->getAuthor()->getId(); ?>"><?php echo $showcasePost->getPost()->getAuthor()->getProfile()->getNome(); ?></a></span></div>
            <div class="delete" onclick="Home.deletePost(event)"> X </div>
            <?php $image = $showcasePost->getPost()->getImage(); 
            if($image != "") { ?>
            <div class="Image" onclick="Home.zoomPhoto(event)"><img class="Image" src="<?php echo $image; ?>" alt=""/></div>
            <?php } ?>
            <div class="Testo"> 
                <?php
                    $text = $showcasePost->getPost()->getText();
                    foreach($showcasePost->getPost()->getHashtag() as $hash){
                       $text =  str_replace($hash, "<a href = '?hashtag=$hash'>".$hash."</a>", $text);
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

    <?php }