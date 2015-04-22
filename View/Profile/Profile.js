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


function sendForm(profilo)
{
    var update = false;
    
    var username = document.forms["mod-profile"].Username;
    var email = document.forms["mod-profile"].Email;
    var gender = document.forms["mod-profile"].Gender;
    var residenza = document.forms["mod-profile"].Residenza;
    var data = document.forms["mod-profile"].Data;
    
//    throw new Error("Something went badly wrong!");
    if(profilo.username !== username.value || profilo.email !== email.value || profilo.gender != gender.value || profilo.residenza != residenza.value || profilo.data != data.value ) 
        update = true;
    
    if(!/[^'\x22]+/.test(username.value))
    {
        alert("username non accettabile");
        username.focus();
        return false;
    }
    
    if(!/[^'\x22]+/.test(residenza.value))
    {
        alert("Residenza non accettabile");
        residenza.focus();
        return false;
    }
    
    if(!/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/.test(email.value))
    {
        alert("email non accettabile");
        email.focus();
        return false;
    }
    
    if(!/(0000-00-00)|(((19|20)\d\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01]))$/.test(data.value))
    {
        alert("Data di Nascita non accettabile");
        data.focus();
        return false;
    }

    if(!( gender.value === "uomo" || gender.value === "donna" || gender.value === "nessuno" || gender.value === "altro"))
    {
         alert("Problemi di manipolazione pagina");
         return false;
    }
    
    if(update)
    {
        document.forms["mod-profile"].action = "?formValidate=FormProfile&Update="+update;
        document.forms["mod-profile"].submit();
    }
}


function changeAvatar()
{
    alert("Da implementare");
}


function Profile (username , avatar, email, residenza, data, sesso) {
    this.username = username;
    this.avatar = avatar;
    this.email = email;
    this.residenza= residenza;
    this.data = data;
    this.sesso = sesso;
}