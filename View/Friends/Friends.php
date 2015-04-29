<div id="friend_list">
    
</div>

<div id="possible_friend">
    Amici che potresti conoscere:
    <div id="possible_friend_list"></div>
</div>

<script>
    num= 0;
    range = 30;
    infLimit = num;
    supLimit = num + range;
    $.ajax({
      type: "POST",
      url: "?formValidate=getFriends",
      data: {"infLimit" : infLimit , "supLimit" : supLimit },
      dataType: "html",
      success: function(risposta){
        $("#friend_list").html(risposta);
      }
    });
    
    $.ajax({
      type: "POST",
      url: "?formValidate=getPossibleFriends",
      dataType: "html",
      success: function(risposta){
        $("#possible_friend_list").html(risposta);
      }
    });
    
</script>