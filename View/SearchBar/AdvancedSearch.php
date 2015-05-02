<div id="search_gump">
    <form name="advancedSearch" method="POST" action="?formValidate=advancedSearch">
        <div>
            <input type="text" name="bar_search" placeholder="Cerca.." pattern="[^\22']" title="Cerca" />
            <input type="button" name="advcerca" value="Cerca" onclick="AdvancedSearch.advSearch()"/> 
        </div>
        <fieldset  class="field_check">
            <legend>Campo:</legend>
            <div class="checkbox_field"><input type="checkbox" name="tutti" value="tutti"/>Tutti</div>
            <div class="checkbox_field"><input type="checkbox" name="Utenti" value="utenti"/>Utenti</div>
            <div class="checkbox_field"><input type="checkbox" name="Amici" value="amici"/>Amici</div>
            <div class="checkbox_field"><input type="checkbox" name="Post" value="post"/>Post</div>
        </fieldset>
        <fieldset  class="field_order">
            <legend>Order By:</legend>
            <div class="checkbox_field"><input type="radio" name="order" value="normal"/>Nessuno</div>
            <div class="checkbox_field"><input type="radio" name="order" value="nome"/>Nome</div>
            <div class="checkbox_field"><input type="radio" name="order" value="data"/>Data</div>
        </fieldset>
    </form>
    
</div>

<div id="search_result">
    
</div>