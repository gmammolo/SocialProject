<?php 
$utente =  Session::get('utente', 'User'); 
?>

<div class="container">
    <div class="profile">    
        <div class="avatar">
            <img src="<?php echo $utente->getProfile()->getAvatar(); ?>" alt="photo">
        </div>
        <div class="username"> <?php echo $utente->getProfile()->getNome(); ?></div>
        
    </div>
</div>
