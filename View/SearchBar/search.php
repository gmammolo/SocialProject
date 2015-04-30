<?php
$search= "t";
    $friend = Relationship::getFriendsListWithSearch(User::getUser()->getId(), $search);
    $notFriend = Relationship::getNotFriendListWithSearch(User::getUser()->getId(), $search);
    $hashtag = "amici";
    $post = Post::getPostByHashTag($hashtag);
?>
<div class="search_Friend"></div>
<div class="search_OtherUser"></div>
<div class="search_HashTag"></div>