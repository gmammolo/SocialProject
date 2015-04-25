<?php 
if(!User::getUser()->hasAccess(Role::Moderator))
{
    Utility::RedMessage("Non hai i permessi per visualizzare questa pagina.");
    header("location: " . _HOME_URL_ . ""  );
    die();
}
?>

<script>
    var userList = [];
    <?php foreach($userList as $element ) {
      echo ('userList[userList.lenght]=new userList("'.$element->getUsername().'", "'.$element->getProfile()->getNome()+'"  ,"'.$element->getProfile()->getAvatar().'","'.$element->getId().'");');
    } ?>
</script>

<form name="cerca_account" method="POST" action="?formValidate=getAccountList">
    <input type="search" name="search_cerca_account" onkeyup="load_search_user(event)"/><span class="cerca_icon" ></span>
</form>

<div id="accountList">
</div>

<script>
    loadAccountList();
</script>