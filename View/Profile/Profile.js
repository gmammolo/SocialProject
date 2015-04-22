/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function addForm(event)
{
    $.ajax({
        type: "POST",
        data: {"ajaxRequest" : "FormProfile"},
        dataType: "html",
        success: function(risposta){
            $("#profile").html(risposta);
        },
        error: function(){
            alert("Chiamata fallita!!!");
        }
    });
}


function sendForm(event)
{
    alert("Da implementare");
}


function changeAvatar()
{
    alert("Da implementare");
}