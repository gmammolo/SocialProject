
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