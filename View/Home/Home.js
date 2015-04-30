
function Home() {}


    Home.switchUploadFunction = function () {
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


    Home.sendComment = function () {
    
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
    };




    Home.showOther =function () {
        numrow = $(".post").size();
        rangeLimit= 30;
        infLimit = numrow; 
        supLimit = numrow + rangeLimit;
         $.ajax({
          type: "POST",
          data: { "ajaxRequest" : "getShowcase" , "infLimit" : infLimit , "supLimit" : supLimit },
          dataType: "html",
          success: function(risposta){
            old =  $("#Showcase-div").html();
            var oldNum= $(".post").size();
            $("#Showcase-div").html(old+risposta);
            if(oldNum == $(".post").size() )
                $("#Showcase-other").hide();
          }
        });
    };

    Home.zoomPhoto = function (event)
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

    };

    Home.deletePost = function (event) {
        var pseudoID = event.target.parentElement.id;
        var id = pseudoID.replace("idpost","");
        window.location.href= "?formValidate=deletePost&idpost="+id;

    };


    Home.abilityHelpUser = function (event)
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

    Home.ricercaUtenti = function (event) {
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