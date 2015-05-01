function WriteComment() {}

    WriteComment.switchUploadFunction = function () {
       val = $("select[name='switchUpload']").val();
       if(val === "p_file") {
            $("input[name='p_file']").show();
            $("input[name='p_url']").hide();
       }
       else if(val === "p_url") {
            $("input[name='p_url']").show();
            $("input[name='p_file']").hide();
       }
    };




    WriteComment.abilityHelpUser = function (event)
    {
        if(event.charCode === 64) { //@
            ascolto= true;
        }
        else if(event.charCode === 32) { //space
            ascolto= false;
            $(".help_input").html("");
            search ="";
        }
    };

    WriteComment.ricercaUtenti = function (event) {
        event.stopPropagation();   
        if(ascolto) {
            reg = $('textarea[name="text"]').val().match(/@[A-Za-z0-9]*$/g);
            if(reg ===null) {
                ascolto=false;
                return;
            }
            search= reg[reg.length-1];
            search = search.substr(1);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "?formValidate=UserList&seach="+search,
                success:function(risposta){
                    $(".help_input").html("");
                    for(i = 0; i < risposta.length && i< 5; i++ )
                    {
                        $(".help_input").append("<div>"+risposta[i].profile.nome+"     -->   "+risposta[i].username+"</div>");
                    }
                },
                error: function(){
                    alert("Chiamata fallita!!!");
                }
            });
        }
    };