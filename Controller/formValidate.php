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
    case "getAccountList" :
    {
        $seach_string = filter_input(INPUT_POST, 'search_cerca_account') ; 
        if(preg_match("/['\x22]+/", $seach_string))
                die();
        $userList = User::getAllUserWithAccessLevel(User::getUser()->getAccessLevel(), $seach_string);
        for($i=0; $i< count($userList); $i++ ) {  ?>
            <div class="accountElement" >
                <div class="option-menu-list">
                    <div>
                        <select name="ruolo" class="u<?php echo $userList[$i]->getId(); ?>"> 
                            <option value="Nessuno" ><?php echo Role::getConstant($userList[$i]->getAccessLevel())  ?></option>
                            <option disabled="disabled">--------</option>
                            <?php
                                for($j = 1; $j < User::getUser()->getAccessLevel(); $j++)
                                {
                                    echo '<option value="'.Role::getConstant($j).'">'.Role::getConstant($j).'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <a id="updateAcLevel" class="u<?php echo $userList[$i]->getId(); ?>" href="?formValidate=updateAccount&AMP;id=<?php echo $userList[$i]->getId(); ?>" onclick="updateSendAcLevel('<?php echo $userList[$i]->getId(); ?>')"> Update </a>
                    </div>                   
                    <div>
                        <a href="?formValidate=deleteAccount&AMP;id=<?php echo $userList[$i]->getId(); ?>"> Delete </a>
                    </div>                   
                </div><!--
             --><div class="redirectElement"onclick=" window.location.href = '/SocialProject/index.php?page=profile&AMP;id=<?php echo $userList[$i]->getId(); ?>'">
                    <img class="avatar" src="<?php echo $userList[$i]->getProfile()->getAvatar(); ?>" alt="photo">
                    <div class="generalita">
                        <div class="row"><div class="label-field  name"> <?php echo $userList[$i]->getProfile()->getNome(); ?></div><span> Email Profilo:</span> <div class="profile-email"><?php echo $userList[$i]->getProfile()->getEmail(); ?> </div> </div>
                        <div class="row"><div class="label-field"><div class="username">@<?php echo $userList[$i]->getUsername(); ?></div><div id="gender" class="gender"></div> </div><span> Email Privata:</span> <div class="user-email"><?php echo $userList[$i]->getEmail(); ?> </div></div>
                    </div>
                </div>
            </div>
        <?php } 
        MenageTemplate::resize();
        die();
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
    
    case "getShowcase":
    {
    
        $infLimit = filter_input(INPUT_POST, 'infLimit');
        $supLimit = filter_input(INPUT_POST, 'supLimit');
        $showcase = Showcase::getLimitShowcase(User::getUser()->getId(),$infLimit, $supLimit ); 
        foreach($showcase as $showcasePost ) { ?>
            <div class="post" id="idpost<?php echo $showcasePost->getPost()->getId(); ?>">
                <div class="Author">Postato da : <span class="AuthorName"><a href="?page=profile&AMP;id=<?php echo $showcasePost->getAuthor()->getId(); ?>"><?php echo $showcasePost->getUser()->getProfile()->getNome(); ?></a></span></div>
                <div class="delete" onclick="deletePost(event)"> X </div>
                <?php $image = $showcasePost->getPost()->getImage(); 
                if($image != "") { ?>
                <div class="Image" onclick="zoomPhoto(event)"><img class="Image" src="<?php echo $image; ?>" alt=""/></div>
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
  
        <?php } MenageTemplate::resize();
        die();
    }
    
    case "deletePost" : 
    {
        $id = filter_input(INPUT_GET, 'idpost');
        $post = Post::getPostByID($id);
        if(!isset($post))
        {
            Utility::RedMessage("Errore nell' eliminazione del post");
            header("location: " . _HOME_URL_ );
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
        
        header("location: " . _HOME_URL_ );
        die();
    }
    
}



