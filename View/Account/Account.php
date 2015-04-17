<div class="container">
    <header>
        <h2>Welcome to SocialWork!</h2>
    </header>
    <div id="account-form"> 
        <div class="div-menu">
            <ul class="tab-ul">
                <li id="button_login" class="tab-li no-touch selected">Login</li>               
                <li id="button_join" class="tab-li" >Join</li>
            </ul>
<!--            <button id="button_login" class="tabmenu" disabled="" style="background-color: #888;">Login</button>
            <button id="button_join" class="tabmenu" >Join</button>-->
        </div>
        <div class="tab-contents" >
            <div id="login"></div>
            <div id="join"></div>
        </div>
        <script>
            $("#login").load(__LOGIN_URL__);
            $("#join").hide();
            $("#join").load(__JOIN_URL__);
            $( "#button_login" ).on( "click", function( event ) { 
                $("#login").show(); 
                $("#join").hide(); 
                $( "#button_login" ).prop("disabled",true);  
                $( "#button_login" ).css("background-color", "#888");
                $( "#button_join" ).prop("disabled",false);  
                $( "#button_join" ).css("background-color", "");
                
            });
            $( "#button_join" ).on( "click", function( event ) { 
                $("#join").show(); 
                $("#login").hide();  
                $( "#button_join" ).prop("disabled",true); 
                $( "#button_join" ).css("background-color", "#888");
                $( "#button_login" ).prop("disabled", false);  
                $( "#button_login" ).css("background-color", "");
            });
        </script>   
     <footer>footer della sezione</footer>

</div>
    
    