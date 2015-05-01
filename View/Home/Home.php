<?php 
if(User::getUser()->hasAccess(Role::Register)) { ?>
<div id="newComment">
    <form name="newComment" method="POST" action="?formValidate=newComment">
        <div class="row">
            <span>
                <select name="switchUpload" onchange="Home.switchUploadFunction()">
                    <option value="p_url">URL</option>
                    <option value="p_file">Immagine</option>
                </select>
            </span>
            <span><input type="file" name="p_file" /></span>
            <span><input type="url" name="p_url" placeholder="http://" /></span>
        </div>
        <div class="row"></div>
        <div class="row"><textarea name="text" placeholder="A cosa stai pensando?" onKeyPress="Home.abilityHelpUser(event)" onkeyup="Home.ricercaUtenti(event)"></textarea></div>
        <div class="help_input"></div>
        <div class="row"><input type="text" name="luogo" title="Luogo dove è stata scattata" placeholder="Dove sei?" pattern="/[^'\x22]+/" /> </div>
        <div class="row">
            <span class="finalRow">
                Privacy:
                <select name="privacy">
                    <option value="privato">Privato</option>
                    <option value="amici" selected="selected">Amici</option>
                    <option value="amiciplus">Amici +</option>
                    <option value="globale">Pubblico</option>
                </select>
            </span>
            <input type="button" name="invia" value="Invia" onclick="Home.sendPost()" />
        </div>
    </form>
    
    <script>
        $("input[name='p_file']").hide();
    </script>
</div>


<div id="Showcase" >
    <div id="Showcase-div">
    </div>
    <div id="Showcase-other" onclick="Showcase.showOther()">Altro..</div>
</div>
<script>
    var ascolto= false;
    var search ="";
    Showcase.showOther();
</script>






<?php } else { ?>
    
<h3> Qui andrebbe scritto qualcosa di elegante, ed efficace per far capire che bisogna attendere 
    l'attivazione da parte di un moderatore... fino ad allora ci si becca un bellissimo pezzo di Lorem Ipsum!
</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean pulvinar neque nec lacus maximus, nec sodales nulla ornare. Ut id est mi. Sed a dui turpis. Fusce quis porta lectus, nec vehicula tortor. Mauris condimentum efficitur magna, vitae semper tellus blandit et. Nunc laoreet, nulla in auctor feugiat, dui urna sodales purus, non finibus nulla nunc in eros. In eu velit malesuada eros interdum commodo. Proin rutrum mattis mi nec pulvinar. Vestibulum ornare tincidunt mi id pretium. Suspendisse in quam in turpis lobortis accumsan. Pellentesque sit amet arcu nec sem lacinia luctus id scelerisque lorem.

In mattis, ex eget imperdiet vehicula, nisi sem aliquet orci, eget feugiat urna odio eget nibh. Donec dictum, nunc ut varius molestie, tellus urna euismod ex, non finibus nisl magna eget leo. Donec condimentum consequat luctus. Sed suscipit lorem nec varius maximus. Nam vitae massa posuere ligula aliquet semper. Praesent elementum quis justo a sollicitudin. In posuere lacus augue, vel semper magna tincidunt condimentum. Sed placerat magna tortor. Maecenas egestas augue et nisi condimentum, id laoreet nulla feugiat. Fusce sed neque et libero ultricies pulvinar nec eget risus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut posuere cursus leo, eu venenatis risus scelerisque ac.
</p>

<?php } ?>