<div class="tipfiend">
    <?php
     $utente = User::getUser();
     $find_profile = Friendship::getRandomNotFriend($user);
     var_dump($find_profile);
    ?>
</div>