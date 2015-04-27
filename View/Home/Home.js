
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
    
    //TODO: valutare la necessità di mettere controlli per il textarea
    $("form[name='newComment']").submit();
}