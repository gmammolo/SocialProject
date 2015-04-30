<?php

if($ajaxRequest === "FormProfile" && User::hasAccess(Role::Register) )
{
    require_once _DIR_VIEW_ . 'PrivateArea/FormProfile.php';
    
}

else if($ajaxRequest == "search" && User::hasAccess(Role::Register)  ) {
    $search = filter_input(INPUT_POST, "search" );
    require_once _DIR_VIEW_ . 'SearchBar/search.php';
}

else if($ajaxRequest == "getAccountList" && User::hasAccess(Role::Register)  ) {
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
    
    
else if( $ajaxRequest == "getShowcase" && User::hasAccess(Role::Register) ) {
    
    require_once _DIR_VIEW_ .  'Home/Showcase.php';
    MenageTemplate::resize();
    die();
}
    
else if( $ajaxRequest == "getFriendNews" && User::hasAccess(Role::Register) ) {
        require_once _DIR_VIEW_ . 'News/NewsList.php';
        MenageTemplate::resize();
        die();
}