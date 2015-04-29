/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function  sendRequestFriend(id) {
    $.ajax({
      url: "?formValidate=sendFriendRequest&friendId="+id,
      dataType: "json",
      success: function(risposta){
        if(risposta)
            $(".pid"+id).html('<input type="button" value="Richiesta Inviata" disabled="true"/>');
      }
    });
}

function acceptRequestFriend(id) {
    $.ajax({
      url: "?formValidate=acceptRequest&friendId="+id,
      dataType: "json",
      success: function(risposta){
        if(risposta)
            $(".pid"+id).html('<input type="button" value="Richiesta Inviata" disabled="true"/>');
      }
    });
}