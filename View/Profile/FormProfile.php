    <?php $utente = User::getUser() ;?>
<script>
    var profilo = new Profile("<?php echo $utente->getProfile()->getNome(); ?>", "<?php echo $utente->getProfile()->getAvatar(); ?>" ,"<?php echo $utente->getProfile()->getEmail(); ?>", "<?php echo $utente->getProfile()->getResidenza(); ?>", "<?php echo $utente->getProfile()->getData(); ?>" , "<?php echo $utente->getProfile()->getGeneralita(); ?>");
</script>
<form method="POST" name="mod-profile">
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

