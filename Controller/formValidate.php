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
                        <select name="ruolo"> 
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
                        <a href="?formValidate=updateAccount&AMP;id=<?php echo $userList[$i]->getId(); ?>"> Update </a>
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
        
         if( User::changeAccessRole($modUser->getId(), $newPass))
               Utility::GreenMessage ("Password Cambiarta con successo!");
            else
                Utility::RedMessage ("Impossibile cambiare la passeword");
        
        header("location: " . _HOME_URL_ . "?page=profile&id=".$id  );
        break;
    }
    case "deleteAccount":
    {
        $id = filter_input(INPUT_GET, 'id');
        if(!isset($id) || !User::hasAccess(Role::Register))
        {
            header("location: " . _HOME_URL_ . "?page=profile"  );
            die();
        }
        
        header("location: " . _HOME_URL_ . "?page=profile&id=".$id  );
        break;
    }
        
    
    
}




