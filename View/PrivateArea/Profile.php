<?php 
    $id = filter_input(INPUT_GET, 'id');
    if(is_null($id))
        $id = User::getUser()->getId(); 
    $utente = User::getUserByID($id);
    if(is_null($utente))
    {
        Utility::RedMessage("Utente non disponibile");
        header("location: " . _HOME_URL_ . "?page=home"  );
        die();
    }

// NON più necessario: l'accesso viene bloccato tramite .htaccess
//    if(User::getUser() !== $utente && !User::checkAccessLevel(Role::Moderator) )
//    {
//        Utility::RedMessage("Non hai i permessi per visualizzare questo utente");
//        header("location: " . _HOME_URL_ . "?page=home"  );
//        die();
//    }

?>

<div id="profile">  
    <?php
    if(User::getUser() !== $utente && User::checkAccessLevel(Role::Moderator) )
    {
        echo '<div class="retry" onclick ="window.location.href=\'/SocialProject/index.php?page=admin\' "><img src="Template/images/arrow%202.png" alt=" "> Torna Indietro</div>';
    }
    ?>
    <div class="tab-profile">
    <img class="avatar" src="<?php echo $utente->getProfile()->getAvatar(); ?>" alt="photo">
    <div class="generalita">
        <div class="label-field  name"> <?php echo $utente->getProfile()->getNome(); ?></div>
        <div class="label-field"><span class="username">@<?php echo $utente->getUsername(); ?></span><span id="gender" class="gender"></span> </div>
    </div>
    <div class="label-field  email down-avatar"><div class="label-info">email:</div> <?php echo $utente->getProfile()->getEmail(); ?></div>
    <div class="label-field  residenza down-avatar"><div class="label-info">residente:</div> <?php echo $utente->getProfile()->getResidenza(); ?></div>
        <div class="label-field  data down-avatar"> <div class="label-info">Data di Nascita:</div> <?php echo $utente->getProfile()->getData(); ?></div>
    </div>
    <input name="buttom" type="button" value="Modifica" onclick="addForm(event)"/>
</div>

<script>
  //get gender
  var gender = "<?php echo $utente->getProfile()->getGeneralita(); ?>";
  if(gender === "uomo")
        $("#gender").html("<img src=\"http://php.server/SocialProject/Template/images/man.jpg\" ALT='sesso' />");
  else if(gender === "donna")
        $("#gender").html("<img src=\"http://php.server/SocialProject/Template/images/woman.jpg\" ALT='sesso'/>");
  else
        $("#gender").html("<img src=\"http://php.server/SocialProject/Template/images/man.jpg\"  ALT='sesso'/>");
</script>