<?php 
if(!User::getUser()->hasAccess(Role::Moderator))
{
    Utility::RedMessage("Non hai i permessi per visualizzare questa pagina.");
    header("location: " . _HOME_URL_ . ""  );
    die();
}
$userList = User::getAllUserWithAccessLevel(User::getUser()->getAccessLevel());
?>

<script>
    var userList = [];
    <?php foreach($userList as $element ) {
      echo ('userList[userList.lenght]=new userList("'.$element->getUsername().'", "'.$element->getProfile()->getNome()+'"  ,"'.$element->getProfile()->getAvatar().'","'.$element->getId().'");');
    } ?>
</script>

<form name="cerca_account">
    <input type="search" name="search_cerca_account" onchange="load_search_user(event)" onkeydown="load_search_user(event)"/><span class="cerca_icon" ></span>
</form>

<div id="accountList">
<?php for($i=0; $i< count($userList); $i++ ) { ?>
    <div class="accountElement">
        <img class="avatar" src="<?php echo $userList[$i]->getProfile()->getAvatar(); ?>" alt="photo">
        <div class="generalita">
            <div class="label-field  name"> <?php echo $userList[$i]->getProfile()->getNome(); ?></div>
            <div class="label-field"><span class="username">@<?php echo $userList[$i]->getUsername(); ?></span><span id="gender" class="gender"></span> </div>
        </div>
    </div>
<?php } ?>
</div>
