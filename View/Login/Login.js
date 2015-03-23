/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function loginAction()
{
    checkFields();
}

function checkFields()
{
    var username = document.forms["login"].username;
    var password = document.forms["login"].password;
    if(!validateString(username.value)) { 
        alert("Errore: campo Username non accettabile!"); 
        username.focus(); 
        return false; 
    }
    
    if(!validateString(password.value)) { 
        alert("Errore: campo password non accettabile!"); 
        password.focus(); 
        return false; 
    }
    
    
    return true;
    /* SERVE PER LA REGISTRAZIONE*
     * http://www.the-art-of-web.com/javascript/validate-password/
     
    re = /^\w+$/; 
    if(!re.test(username.value)) {
        alert("Errore: l'username può contenere solo caratteri, numeri e underscore "); 
        username.focus();
        return false;
    }
    
    if(password.value.length <= 4 ) { 
        alert("Errore: La Password deve contenere almeno 4 caratteri");
        password.focus(); 
        return false;
    }
    if(password.value === username.value) { 
        alert("Errore: La Password deve essere diversa dall' Username"); 
        password.focus(); 
        return false; 
    }
    re = /[0-9]/;
    if(!re.test(password.value)) { 
        alert("Error: password must contain at least one number (0-9)!");
        password.focus(); 
        return false; 
    }
    re = /[a-z]/; 
    if(!re.test(password.value)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        password.focus();
        return false;
    }
    re = /[A-Z]/; 
    if(!re.test(password.value)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        password.focus(); 
        return false;
    }
    
    */
    
}