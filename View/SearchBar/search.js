/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function Search() {}

    Search.searchRequest = function () {
        var srch = $("input[name='search']").val();
        if(/['\x22]+/.test(srch))
            return null;
        $.ajax({
          type: "POST",
          url: "",
          data: {"ajaxRequest" : "search" , "search" : srch  },
          dataType: "html",
          success: function(risposta){
            $("#search-result").html(risposta);
            $("#search-result").show();
          }
        });
    };  

    Search.redirectUser = function(id) {
        window.location.href="?page=profile&id="+id;
    };
