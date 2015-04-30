/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function searchRequest() {
    if(/['\x22]+/.test($("input[name='search']").val()))
        return null;
    window.location.href = "?ajaxRequest=search";
//    $.ajax({
//      type: "POST",
//      url: "?ajaxRequest=search",
//      data: {search : $("input[name='search']").val()  },
//      dataType: "html",
//      success: function(risposta){
//        console.log(risposta);
//      },
//      error: alert("fallito")
//    });
}