<?php $utente = User::getUser(); ?>

<div id="profile">    
    <div class="tab-profile">
    <img class="avatar" src="<?php echo $utente->getProfile()->getAvatar(); ?>" alt="photo">
    <div class="generalita">
        <div class="label-field  name"> <?php echo $utente->getProfile()->getNome(); ?></div>
        <div class="label-field  username"> @<?php echo $utente->getUsername(); ?></div>
    </div>
    <div class="label-field  email down-avatar"><div class="label-info">email:</div> <?php echo $utente->getProfile()->getEmail(); ?></div>
    <div class="label-field  residenza down-avatar"><div class="label-info">residente:</div> <?php echo $utente->getProfile()->getResidenza(); ?></div>
        <div class="label-field  data down-avatar"> <div class="label-info">Data di Nascita:</div> <?php echo $utente->getProfile()->getData(); ?></div>
    </div>
    <input name="buttom" type="button" value="Modifica" onclick="addForm(event)"/>
</div>
