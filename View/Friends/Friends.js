/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function  sendRequestFriend(id) {
    $.ajax({
      type: "POST",
      url: "?formValidate=sendFriendRequest",
      data: {"friendId" : id},
      dataType: "html",
      success: function(risposta){
        $(".pid"+id).html('<input type="button" value="Richiesta Inviata" disabled="true"/>');
      }
    });
}