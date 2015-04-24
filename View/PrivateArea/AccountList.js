/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//function loadAccountList(inf, sup)
//{
//    $.ajax({
//      type: "POST",
//      url: "?formValidate=getAccountList",
//      data: {'inf' : inf , 'sup' : sup},
//      dataType: "html",
//      success: function(risposta){
//        $("#accountList").html(risposta);
//      }
//    });
//}



function load_search_user(event)
{
    alert("ok");
    
    
}

function user_vista(username, name , icon, id )
{
    this.username = username;
    this.name= name;
    this.icon=icon;
    this.id=id;
}