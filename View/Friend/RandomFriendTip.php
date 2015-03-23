<div class="tipfiend">
    <?php
     $utente =  Session::get('utente', 'User');
     if(!is_null($utente)) :
         $find_profile = $utente->GetRandomNotFriend();
     ?>    
     
     
         
     <?php    
     endif;
    ?>
</div>