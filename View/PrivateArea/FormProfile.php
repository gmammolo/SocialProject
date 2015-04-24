    <?php
    $id = filter_input(INPUT_GET, 'id');
        if(is_null($id))
        $id = User::getUser ()->getId (); 
    $utente = User::getUserByID($id);
    if(is_null($utente))
    {
        Utility::RedMessage("Utente non disponibile");
        header("location: " . _HOME_URL_ . "?page=home"  );
        die();
    }
    
    if(User::getUser() !== $utente && !User::checkAccessLevel(Role::Moderator) )
    {
        Utility::RedMessage("Non hai i permessi per visualizzare questo utente");
        header("location: " . _HOME_URL_ . "?page=home"  );
        die();
    }
    
    ?>
<script>
    var profilo = new Profile("<?php echo $utente->getProfile()->getNome(); ?>", "<?php echo $utente->getProfile()->getAvatar(); ?>" ,"<?php echo $utente->getProfile()->getEmail(); ?>", "<?php echo $utente->getProfile()->getResidenza(); ?>", "<?php echo $utente->getProfile()->getData(); ?>" , "<?php echo $utente->getProfile()->getGeneralita(); ?>");
</script>

<div id="change-photo" class="hidden">
    <form name="change-photo-form" method="POST" action="?formValidate=FormChangeAvatar&id=<?php echo $utente->getId() ?>">
        <div class="change-avatar-url"><input type="radio" name="choose" value="image_url"><input type="url" name="image_url" placeholder="http://"  onclick="selectURL();" /></div>
        <div class="change-avatar-url"><input type="radio" name="choose" value="image_file"><input type="file" name="image_file" onclick="selectFILE();"/></div>
        <input type="button" value="Cambia" onclick="sendPhotoRequest()" />
        <input type="button" value="Cancel" onclick="closeFormAvatar()" />
    </form>
    
</div>

<form method="POST" name="mod-profile" class="mod-profile" action="?formValidate=FormProfile&id=<?php echo $utente->getId() ?>" >
        <div class="tab-profile">
            <div class="mod-avatar" >
                <img class="avatar" src="<?php echo $utente->getProfile()->getAvatar(); ?>" alt="photo">
                <input type="button" name="avatar" value="cambia Avatar" onclick="changeAvatar()" />
            </div>
            <div class="generalita">
                <div class="label-field  name"><input type="text" name="Username" value="<?php echo $utente->getProfile()->getNome(); ?>" placeholder="Username" pattern="[^'\x22]+" /></div>
                <div class="label-field  username"> @<?php echo $utente->getUsername(); ?></div>
            </div>
            <div class="label-field  sesso down-avatar"><div class="label-info">sesso:</div> <select name="Gender"> <option value="nessuno">Nessuno</option> <option value="uomo">Uomo</option> <option value="donna">Donna</option> <option value="altro">Altro</option> </select> </div>
            <div class="label-field  email down-avatar"><div class="label-info">email:</div><input type="email" name="Email" placeholder="Email" value="<?php echo $utente->getProfile()->getEmail(); ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"/></div>
            <div class="label-field  residenza down-avatar"><div class="label-info">residente:</div><input type="text" name="Residenza" placeholder="Residenza" value="<?php echo $utente->getProfile()->getResidenza();  ?>" pattern="[^'\x22]+"/></div>
                <div class="label-field  data down-avatar"> <div class="label-info">Data di Nascita:</div><input type="text" name="Data" placeholder="Data di Nascita" value="<?php echo $utente->getProfile()->getData(); ?>" pattern="(0000-00-00)|(((19|20)\d\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01]))$" title="Inserire la data nel formato aaaa-mm-gg (da 1900-01-01 a 2099-12-31)" /></div>
        </div>
        <input name="submit" type="submit" value="Invia" onclick="sendForm(profilo)"/>
    </form>

