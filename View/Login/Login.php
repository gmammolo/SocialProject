<div class="container">
                <header>
                    <h2>Login Visual</h2>
                </header>
                <form method="POST" name="login" class="pure-form pure-form-aligned">
                    <fieldset>
                        <div class="pure-control-group">
                            <label>Username</label>
                            <input type="text" name="Username" pattern="[^'\x22]+" placeholder="Username"/> 
                        </div>
                        <div class="pure-control-group">
                            <label>Password</label>
                            <input type="password" name="Password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,16}" title="Deve contenere almeno un carattere Maiuscolo, uno minuscolo e un numero. (4-16 caratteri)." /> 
                        </div>
                        <div class="pure-control-group">
                            <input type="submit" name="Login" value="Login" onclick="loginAction()"/>
                        </div>
                    </fieldset>
                </form>
                <footer>footer della sezione</footer>

</div>