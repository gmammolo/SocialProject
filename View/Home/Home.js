
function switchUploadFunction() {
   val = $("select[name='switchUpload']").val();
   if(val === "p_file") {
        $("input[name='p_file']").show();
        $("input[name='p_url']").hide();
   }
   else if(val === "p_url") {
        $("input[name='p_url']").show();
        $("input[name='p_file']").hide();
   }
}


function sendComment() {
    
    if($("select[name='switchUpload']").val() === "p_url"  && $("input[name='p_url']").val() != "" && !/http(s{0,1})\:\/\/[\w\/\-\.]*\.(jpg|bmp|gif|png|jpeg)/i.test($("input[name='p_url']").val()))
    {
        alert("immagine non valida");
        $("input[name='p_url']").focus();
        return false;
    }
    
    if($("select[name='switchUpload']").val() === "p_file"  &&  !/^.+\.(jpe?g|gif|png)$/i.test($("input[name='p_file']").val()))
    {
        alert("immagine non valida");
        $("input[name='p_file']").focus();
        return false;
    }
    
    if(/['\x22]+/.test($("input[name='luogo']").val()))
    {
         alert("Luogo non valido");
         $("input[name='luogo']").focus();
         return false;
    }
    
    //TODO: valutare la necessità di mettere controlli per il textarea
    $("form[name='newComment']").submit();
}




function showOther() {
    numrow = $(".post").size();
    rangeLimit= 30;
    infLimit = numrow; 
    supLimit = numrow + rangeLimit;
     $.ajax({
      type: "POST",
      url: "?formValidate=getShowcase",
      data: {"infLimit" : infLimit , "supLimit" : supLimit },
      dataType: "html",
      success: function(risposta){
        old =  $("#Showcase-div").html();
        $("#Showcase-div").html(old+risposta);
      }
    });
}

function zoomPhoto(event)
{
    var image = event.target;
    var divParent = image.parentElement;
    if ($(divParent).hasClass("zoomed")) {
        $(divParent).removeClass("zoomed");
        $(image).removeClass("zoomed");
    }
    else {
        $(divParent).addClass("zoomed");
        $(image).addClass("zoomed");
    }
    resize();
        
}

function deletePost(event) {
    var pseudoID = event.target.parentElement.id;
    var id = pseudoID.replace("idpost","");
    window.location.href= "?formValidate=deletePost&idpost="+id;
    
}