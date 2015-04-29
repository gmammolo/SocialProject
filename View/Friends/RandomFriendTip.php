<div class="tipfiend">
    <?php
     $utente = User::getUser();
     $find_profile = Friendship::getRandomNotFriends($user);
     var_dump($find_profile);
    ?>
</div>