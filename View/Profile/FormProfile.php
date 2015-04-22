    <?php $utente = User::getUser() ;?>
    <form method="POST">
        <div class="tab-profile">
            <div class="mod-avatar" >
                <img class="avatar" src="<?php echo $utente->getProfile()->getAvatar(); ?>" alt="photo">
                <input type="button" name="avatar" value="cambia Avatar" onclick="changeAvatar()" />
            </div>
            <div class="generalita">
                <div class="label-field  name"><input type="text" name="Username" value="<?php echo $utente->getProfile()->getNome(); ?>" placeholder="Username" /></div>
                <div class="label-field  username"> @<?php echo $utente->getUsername(); ?></div>
            </div>
            <div class="label-field  email down-avatar"><div class="label-info">email:</div><input type="text" name="Email" placeholder="Email" value="<?php echo $utente->getProfile()->getEmail(); ?>"/></div>
            <div class="label-field  residenza down-avatar"><div class="label-info">residente:</div><input type="text" name="Residenza" placeholder="Residenza" value="<?php echo $utente->getProfile()->getResidenza(); ?>" /></div>
            <div class="label-field  data down-avatar"> <div class="label-info">Data di Nascita:</div><input type="text" name="Data" placeholder="Data di Nascita" value="<?php echo $utente->getProfile()->getData(); ?>"/></div>
        </div>
        <input name="submit" type="submit" value="Invia" onclick="sendForm(event)"/>
    </form>