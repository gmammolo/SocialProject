    <form method="POST" name="join" class="pure-form pure-form-aligned">
        <fieldset>
            <div class="pure-control-group">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" pattern="[^'\x22]+" placeholder="Username"/> 
            </div>
            <div class="pure-control-group">
                <label for="email">Email</label>
                <input id="email" placeholder="email@dominio.com" type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" /> 
            </div>
            <div class="pure-control-group">
                <label>Password</label>
                <input placeholder="Password" type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,16}" title="Deve contenere almeno un carattere Maiuscolo, uno minuscolo e un numero. (4-16 caratteri)."/> 
            </div>
            <div class="pure-control-group">
                <label>Confirm Password</label>
                <input placeholder="Password" type="password" name="cpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,16}" title="Deve contenere almeno un carattere Maiuscolo, uno minuscolo e un numero. (4-16 caratteri)."/> 
            </div>
            <div class="pure-control-group">
                <input class="pure-button pure-button-primary" type="submit" name="Join" value="Join" onclick="joinAction()"/>
            </div>    
        </fieldset>
    </form>