<?php

switch($formValidate)
{
    case "FormProfile" :
    {     
        $id = filter_input(INPUT_GET, 'id');
        if(!isset($id) || !User::hasAccess(Role::Register))
        {
            header("location: " . _HOME_URL_ . "?page=profile"  );
            die();
        }

        $modUser = User::getUserByID($id);
        if(!isset($modUser) || !(User::getUser()->hasAccess(Role::Moderator) || User::getUser() != $modUser ))
        {
            header("location: " . _HOME_URL_ . "?page=profile"  );
            die();
        }
        $username = filter_input(INPUT_POST, 'Username');
        $email = filter_input(INPUT_POST, 'Email');
        $residenza = filter_input(INPUT_POST, 'Residenza');
        $data = filter_input(INPUT_POST, 'Data');
        $gender = filter_input(INPUT_POST, 'Gender');
        if(filter_input(INPUT_POST, 'Update') && 
                (!preg_match("/['\x22]+/", $username) && 
                preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/',$email) && 
                !preg_match("/['\x22]+/", $residenza) &&
                preg_match("/(0000-00-00)|(((19|20)\d\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01]))$/", $data) &&
                ($gender == "nessuno" || $gender == "uomo" || $gender == "donna" || $gender == "altro")
                ) )
        {
          $modUser->getProfile()->setNome($username);
          $modUser->getProfile()->setEmail($email);
          $modUser->getProfile()->setResidenza($residenza);
          if($gender != "nessuno")
            $modUser->getProfile()->setGeneralita($gender);
          $modUser->getProfile()->setData($data);
          $modUser->getProfile()->Update();
          Utility::GreenMessage("Aggiornamento profilo effettuato!");

        }
        else
        {
            Utility::RedMessage("Modifiche al profilo fallite!");
        }

        header("location: " . _HOME_URL_ . "?page=profile&id=".$id  );
        break;
    }
    case "FormChangeAvatar":
    {
        $id = filter_input(INPUT_GET, 'id');
        if(!isset($id) || !User::hasAccess(Role::Register))
                header("location: " . _HOME_URL_ . "?page=profile"  );
        
        $modUser = User::getUserByID($id);
        if(!isset($modUser) || !(User::getUser()->hasAccess(Role::Moderator) || User::getUser() != $modUser ))
        {
            header("location: " . _HOME_URL_ . "?page=profile"  );
            die();
        }
        
        $choose = filter_input(INPUT_POST, 'choose');
        $avatar = filter_input(INPUT_POST, $choose);
        if(preg_match('/http(s{0,1})\:\/\/[\w\/\-\.]*\.(jpg|bmp|gif|png|jpeg)/i', $avatar))
        {
            $modUser->getProfile()->setAvatar($avatar);
            $modUser->getProfile()->Update();
            Utility::GreenMessage("Avatar Aggiornato con successo!");
        }
        else
        {
             Utility::RedMessage("Avatar non accettabile!");
        }
        header("location: " . _HOME_URL_ . "?page=profile&id=".$id  );
        break;
    }
    case "FormChangePwd" :
    {
        $id = filter_input(INPUT_GET, 'id');
        if(!isset($id) || !User::hasAccess(Role::Register))
        {
            header("location: " . _HOME_URL_ . "?page=profile"  );
            die();
        }

        $modUser = User::getUserByID($id);
        $oldPass = filter_input(INPUT_POST, 'oldPass');
        $newPass = filter_input(INPUT_POST, 'newPass');
        $cNewPass = filter_input(INPUT_POST, 'cNewPass');
                
        if(isset($oldPass) && isset($newPass) && $newPass == $cNewPass &&  User::checkUserValid($modUser->getUsername(), $oldPass))
        {
            if( User::changePassword($modUser->getId(), $newPass))
               Utility::GreenMessage ("Password Cambiarta con successo!");
            else
                Utility::RedMessage ("Impossibile cambiare la passeword");
        }
        else
        {
            Utility::RedMessage("Password Errata");
        }
        
        
        header("location: " . _HOME_URL_ . "?page=profile&id=".$id  );
        break;
    }

    case "updateAccount":
    {
        $id = filter_input(INPUT_GET, 'id');
        if(!isset($id) || !User::hasAccess(Role::Register))
        {
            header("location: " . _HOME_URL_ . "?page=profile"  );
            die();
        }
        $modUser= User::getUserByID($id);
        $newAccLevel = filter_input(INPUT_GET, 'ruolo');
        if(!isset($newAccLevel) && !Role::isValidName($newAccLevel)) {
//            Utility::RedMessage("Nuovo livello di accesso non accettabile");
            header("location: " . _HOME_URL_ . "?page=admin" );
            die();
        }
        if(isset($modUser)  && User::getUser()!= $modUser && User::getUser()->getAccessLevel() > constant('Role::'. $newAccLevel) ) {
            $modUser->setAccessLevel(constant('Role::'. $newAccLevel));
            if($modUser->Update()){
                Utility::GreenMessage("Aggiornameto Utente effettuato con successo");
            }
            else {
                Utility::YellowMessage("Utente non aggiornato");
            }
        }
        else {
            Utility::RedMessage("Non hai i permessi per fare questo!");
        }
        header("location: " . _HOME_URL_ . "?page=admin" );
        break;
    }
    case "deleteAccount":
    {
        $id = filter_input(INPUT_GET, 'id');
        if(!isset($id) || !User::hasAccess(Role::Register))
        {
            header("location: " . _HOME_URL_ . "?page=admin"  );
            die();
        }
        
        $modUser= User::getUserByID($id);
        //se l'accesslevel è minore automaticamente non sta cercando di eliminare se stesso!
        if(isset($modUser) && $modUser->getAccessLevel() < User::getUser()->getAccessLevel())
        {
            if(User::deleteAccount($id)) {
                Utility::GreenMessage("Account Eliminato con Successo");
            }
            else {
                Utility::RedMessage("Impossibile eliminare questo account");
            }
        }

        
        header("location: " . _HOME_URL_ . "?page=admin" );
        break;
    }   
    case "newComment":
    {
        if(!User::hasAccess(Role::Register))
        {
            header("location: " . _HOME_URL_  );
            die();
        }
        $switchUpload = filter_input(INPUT_POST, 'switchUpload');
        $image = ( $switchUpload == "p_url" )  ?   filter_input(INPUT_POST, 'p_url') :   filter_input(INPUT_POST, 'p_file') ;

        if($switchUpload == "p_file") {
            //TODO: caricamento immagine sul server (compresi di controlli)
            Utility::YellowMessage("Funzione Disabilitata");
            header("location: " . _HOME_URL_ );
            die();
        }
        
        if($switchUpload == 'p_url' && $image != "" && !preg_match('/http(s{0,1})\:\/\/[\w\/\-\.]*\.(jpg|bmp|gif|png|jpeg)/i', $image) )
        {
            Utility::RedMessage("Immagine non valida!");
            header("location: " . _HOME_URL_ );
            die();
        }
        
        $testo = filter_input(INPUT_POST, 'text');
        preg_match_all('/#[A-Za-z0-9]+/', $testo, $hashtag);
        $hashtag = $hashtag[0];
        $locate = filter_input(INPUT_POST, 'luogo');
        $privacy = constant("Privacy::" . filter_input(INPUT_POST, 'privacy') );
        
        preg_match_all('/(?<=@)[A-Za-z0-9]+/', $testo,$other);
        $other = $other[0];
        if(preg_match("/['\x22]+/", $locate))
        {
            Utility::RedMessage("Dati non ammissibili");
            header("location: " . _HOME_URL_ );
            die();
        }
        $post = Post::createNewPost(User::getUser()->getId(),$testo, $image ,$locate , $hashtag, $privacy );
        if(isset($post)) {
            Utility::GreenMessage("Post inviato correttamente");
            Showcase::insertPost(User::getUser()->getId(), $post->getId());
            foreach($other as $user_name) {
                $user_taggato = User::getUserByUsername($user_name);
                if(isset($user_taggato)) {
                    Showcase::insertPost($user_taggato->getId(), $post->getId());
                }
                    
            }
        }
        else {
            Utility::RedMessage("Post non inviato correttamente");
        }
        header("location: " . _HOME_URL_ );
        break;
    }
    
    case "deletePost" : 
    {
        $id = filter_input(INPUT_POST, 'id');
        $post = Post::getPostByID($id);
        $baseurl = filter_input(INPUT_POST, 'baseurl');
        $ris = preg_match( '/(?<=page=)[^&]*/' , $baseurl , $pages  );
        $page="";
        if($ris)
            $page="?page=" . $pages[0];
        if(!isset($post))
        {
            Utility::RedMessage("Errore nell' eliminazione del post");
            header("location: " . _HOME_URL_ .$page );
            die();
        }
        if($post->getAuthor() == User::getUser() || User::hasAccess(Role::Moderator)) {
            //Rimozione POST
            if(Post::delete($id)) {
                Utility::GreenMessage("Post Eliminato Correttamente");
            }
            else {
                Utility::RedMessage("Impossibile rimuovere il post");
            }
        }
        else {
            //Rimozione Dalla Bacheca
            if(Showcase::delete(User::getUser()->getId(), $post->getId() )) {
                Utility::GreenMessage("Non Visualizzerai più questo contenuto");
            }
            else {
                Utility::RedMessage("Impossibile rimuovere il post dalla bacheca");
            }
        }
        
        header("location: " . _HOME_URL_ .$page);
        die();
    }
    
    case "UserList":
    {
        $search =  filter_input(INPUT_GET, 'seach');
        $art = Friendship::getFriendsListWithSearch(User::getUser(), $search);
        echo json_encode($art);
        die();
    }
     
    case "getFriends":
    {
        if(!User::hasAccess(Role::Register))
        {
            header("location: " . _HOME_URL_  );
            die();
        }
        $inf = filter_input(INPUT_POST, "infLimit");
        $sup = filter_input(INPUT_POST, "supLimit");
        $friendRequestList = Relationship::getFriendshipRequest(User::getUser()->getId(), $inf, $sup); 
        foreach($friendRequestList as $friendship) { 
            $pf = $friendship->getApplicant();?>
            <div class="rfriend">
                <a href="?page=profile&AMP;id=<?php echo $pf->getId(); ?>">
                    <div class="row image"><img src="<?php echo $pf->getProfile()->getAvatar(); ?>" alt="" /></div>
                    <div class="row nome"><?php echo $pf->getProfile()->getNome(); ?></div>
                </a>
                <div class="row">
                    <div class="username"><?php echo $pf->getUsername(); ?></div>
                    <div class="sesso">
                        <?php 
                            $sesso = $pf->getProfile()->getGeneralita();
                            switch ($sesso) {
                                case "uomo" :
                                    echo "<img src=\"/SocialProject/Template/images/man.jpg\" ALT='sesso' />";
                                    break;
                                case "donna":
                                    echo "<img src=\"/SocialProject/Template/images/woman.jpg\" ALT='sesso'/>";
                                default:
                                    echo "<img src=\"/SocialProject/Template/images/man.jpg\"  ALT='sesso'/>";
                            }
                        ?>
                    </div>
                </div>
                <div class="row buttonRequest pid<?php echo $pf->getId(); ?>"><input type="button" value="Accetta Richiesta" onclick="acceptRequestFriend(<?php echo $pf->getId(); ?>)" /></div>
            </div>
        <?php }
        $friendList = Friendship::getFriendsList(User::getUser(), $inf, $sup);
        foreach($friendList as $friendship) { 
            $pf = $friendship->getFriend();?>
            <div class="friend">
                <a href="?page=profile&AMP;id=<?php echo $pf->getId(); ?>">
                    <div class="row image"><img src="<?php echo $pf->getProfile()->getAvatar(); ?>" alt="" /></div>
                    <div class="row nome"><?php echo $pf->getProfile()->getNome(); ?></div>
                </a>
                <div class="row">
                    <div class="username"><?php echo $pf->getUsername(); ?></div>
                    <div class="sesso">
                        <?php 
                            $sesso = $pf->getProfile()->getGeneralita();
                            switch ($sesso) {
                                case "uomo" :
                                    echo "<img src=\"/SocialProject/Template/images/man.jpg\" ALT='sesso' />";
                                    break;
                                case "donna":
                                    echo "<img src=\"/SocialProject/Template/images/woman.jpg\" ALT='sesso'/>";
                                default:
                                    echo "<img src=\"/SocialProject/Template/images/man.jpg\"  ALT='sesso'/>";
                            }
                        ?>
                    </div>
                </div>
                
            </div>
        <?php }
        die();
    }
    
    case "getPossibleFriends" : 
    {
        if(!User::hasAccess(Role::Register))
        {
            header("location: " . _HOME_URL_  );
            die();
        }
        
        $possFriends = Relationship::getRandomNotRelated(User::getUser()->getId());
        foreach($possFriends as $pf) {
        ?>
            <div class="pfriend">
                <a href="?page=profile&AMP;id=<?php echo $pf->getId(); ?>">
                    <div class="row image"><img src="<?php echo $pf->getProfile()->getAvatar(); ?>" alt="" /></div>
                    <div class="row nome"><?php echo $pf->getProfile()->getNome(); ?></div>
                </a>
                <div class="row">
                    <div class="username"><?php echo $pf->getUsername(); ?></div>
                    <div class="sesso">
                        <?php 
                            $sesso = $pf->getProfile()->getGeneralita();
                            switch ($sesso) {
                                case "uomo" :
                                    echo "<img src=\"/SocialProject/Template/images/man.jpg\" ALT='sesso' />";
                                    break;
                                case "donna":
                                    echo "<img src=\"/SocialProject/Template/images/woman.jpg\" ALT='sesso'/>";
                                default:
                                    echo "<img src=\"/SocialProject/Template/images/man.jpg\"  ALT='sesso'/>";
                            }
                        ?>
                    </div>
                </div>
                <div class="row buttonRequest pid<?php echo $pf->getId(); ?>"><input type="button" value="Invia Richiesta" onclick="sendRequestFriend(<?php echo $pf->getId(); ?>)" /></div>
            </div>
        <?php
        }
        die();
        
    }
    
    case "sendFriendRequest" :
    {
        $idf =  filter_input(INPUT_GET, 'friendId');
        $pf = User::getUserByID($idf);
        if(User::hasAccess(Role::Register) && isset($pf))
        {
            $ris =Relationship::addFriendRequest(User::getUser()->getId(), $pf->getId());
            echo json_encode($ris);
            
            
        }
         
        die();
    }
    case "acceptRequest" : 
    {
        $idf =  filter_input(INPUT_GET, 'friendId');
        $friendship = Relationship::getRelationship(User::getUser()->getId(), $idf);
        if(isset($friendship) && $friendship->getRequested() == User::getUser() && $friendship->getApplicant()->getId() ===  $idf){
            $friendship->acceptFriendship();
            echo json_encode("{true}");
            
        }
        else
        {
            echo json_encode("{false}");
        }
        die();
    }
    
    case "addComment" :
    {
        $idpost = filter_input(INPUT_POST, 'postid');
        $baseurl = filter_input(INPUT_POST, 'baseurl');
        $ris = preg_match( '/(?<=page=)[^&]*/' , $baseurl , $pages  );
        $page="";
        if($ris)
            $page="?page=" . $pages[0];
        $commentText = filter_input(INPUT_POST, 'commentText');
        
        if(is_numeric($idpost) && !preg_match("/['\x22]/", $commentText)) {
            Comment::addComment($idpost, User::getUser()->getId(), $commentText);
        }
        
        header("location: " . _HOME_URL_ .$page );
        die();
    }
    case "deleteComment" : 
    {
        $id = filter_input(INPUT_POST, 'id');
        $baseurl = filter_input(INPUT_POST, 'baseurl');
        $ris = preg_match( '/(?<=page=)[^&]*/' , $baseurl , $pages  );
        $page="";
        if($ris)
              $page="?page=" . $pages[0];
            
        $comment = Comment::getCommentByID($id);
        if(!isset($comment))
        {
            Utility::RedMessage("Errore nell' eliminazione del commento");
            header("location: " . _HOME_URL_ .$page  );
            die();
        }
       if(User::getUser()==$comment->getAuthor() || User::getUser() == $comment->getPost()->getAuthor()   || User::hasAccess(Role::Moderator) ) {
            //Rimozione POST
            if(Comment::delete($id)) {
                Utility::GreenMessage("Commento Eliminato Correttamente");
            }
            else {
                Utility::RedMessage("Impossibile rimuovere il Commento");
            }
        }

        
        header("location: " . _HOME_URL_ .$page  );
        die();
    }
}
