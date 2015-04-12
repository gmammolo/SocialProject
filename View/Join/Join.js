/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function joinAction()
{

    if (checkFields())
    {
        document.forms["join"].action = getHome() + "?Join=true";
        document.forms["join"].submit();
    }
    
}

function checkFields()
{
    var username = document.forms["join"].username;
    var password = document.forms["join"].password;
    var cpassword = document.forms["join"].cpassword;
    if(!validateRegularString(username.value)) { 
        alert("Errore: campo Username non accettabile!"); 
        username.focus(); 
        return false; 
    }
    if(password.value !== cpassword.value) { 
        alert("Errore: Le Password non coincidono"); 
        password.focus(); 
        return false; 
    }
    if(password.value === username.value) { 
        alert("Errore: La Password deve essere diversa dall' Username"); 
        password.focus(); 
        return false; 
    }
    
    re = /^\w+$/; 
    if(!re.test(username.value)) {
        alert("Errore: l'username può contenere solo caratteri, numeri e underscore "); 
        username.focus();
        return false;
    }
    
    if(password.value.length <= 4 || password.value.length >= 16  ) { 
        alert("Errore: La Password deve essere inclusa tra 4 e 16 caratteri");
        password.focus(); 
        return false;
    }
    
    re = /[0-9]/;
    if(!re.test(password.value)) { 
        alert("Errore: La password deve contenere almeno un numero (0-9)!");
        password.focus(); 
        return false; 
    }
    re = /[a-z]/; 
    if(!re.test(password.value)) {
        alert("Errore: La password deve contenere almeno una lettera minuscola (a-z)!");
        password.focus();
        return false;
    }
    re = /[A-Z]/; 
    if(!re.test(password.value)) {
        alert("Errore: La password deve contenere almeno una lettere maiuscola (A-Z)!");
        password.focus(); 
        return false;
    }
   
    return true;
}