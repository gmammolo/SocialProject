<?php
$user = User::getUser(); ?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Social Project</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <?php
        foreach (MenageTemplate::getJavascript() as $js) {
            echo "<script src=\"$js\"></script>". PHP_EOL;
        }
        echo '<style type="text/css">';
            
            foreach (MenageTemplate::getCss() as $css)
            {
                echo("@import \"$css\";");
            }
        echo '</style>';
        
        ?>
<!--  ABILITA TINYMCE  

<script type="text/javascript">
            tinymce.init({
                    selector: "textarea",
                    plugins: [
                            "advlist autolink autosave link lists charmap preview hr anchor ",
                            "wordcount visualblocks visualchars fullscreen insertdatetime nonbreaking",
                            "contextmenu directionality emoticons textcolor paste fullpage textcolor colorpicker textpattern"
                    ],

                    toolbar1: "newdocument | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect | cut copy paste | bullist numlist",
                    toolbar2: "outdent indent blockquote | undo redo | link unlink anchor | insertdatetime preview | forecolor backcolor | hr removeformat | subscript superscript | charmap emoticons | fullscreen | ltr rtl | visualchars visualblocks nonbreaking",
                    toolbar3: "",

                    menubar: false,
                    toolbar_items_size: 'small',

                    style_formats: [
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 1', inline: 'span', classes: 'example1'},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                    ],

                    templates: [
                            {title: 'Test template 1', content: 'Test 1'},
                            {title: 'Test template 2', content: 'Test 2'}
                    ]
            });</script>-->
    </head>
    <body>

       
        <aside class="skel-layers-fixed">

            <div class="top">

                <!-- Logo -->
                <div id="logo">
                    <span id="avatar"><img src="<?php echo $user->getProfile()->getAvatar();  ?>" alt="avatar" /></span>
                    <div>
                        <h1 class="name"><?php echo $user->getProfile()->getNome(); ?></h1>
                        <p class="username">@<?php echo $user->getUsername(); ?></p>
                    </div>

                </div>
                
                <div id="search">
                    <input id="bar_search" type="text" name="search" pattern="[^'\x22]+" placeholder="Cerca" value=""/>
                    <input id="button_search" type="button" onclick="search()" value=" " />
                </div>

                <!-- Nav id="nav"> -->
                <nav> 


                    <?php
                    echo "<ul>";
                    foreach (MenageTemplate::getMenu() as $key => $submenues) {
                            $chiave = $key;
                            if (is_a($submenues, "Menu") && !is_null($submenues->getHtml() && User::hasAccess($submenues->getAccessLevel()))) {
                                $chiave = '<a href="'.$submenues->getHtml().'" target="_self">'.$submenues->getIcon(). $key.' </a> ';
                                echo "<li class = \"menutab \">$chiave</li>" . PHP_EOL;   
                            }
                            else if (is_array($submenues)) :
                                $icon = "";
                                if(count($submenues) > 0 && is_string($submenues[0])  )
                                    $icon ='<img src="'.array_shift ($submenues).'"  alt=" " />';
                                echo "<li class = \"menutab-no-cursor \">".$icon.$key."</li>" . PHP_EOL;  
                                echo "<li class = \"no-visible\"><ol>" . PHP_EOL;
                                foreach ($submenues as $alias => $submen) {
                                    if(User::hasAccess($submen->getAccessLevel()))
                                        echo "<li class = \"submenutab hidden $key\"><a href=\"".$submen->getHtml()."\" > ".$submen->getIcon().$submen->getName()."</a></li>".PHP_EOL;
                                }
                                echo"</ol></li>" . PHP_EOL;
                            endif;
                    }
                    echo("</ul>");
                    ?>
                    <script>
                        var click = function(event){ window.location.href = $(this)[0].childNodes[0].href; 
                        };
                        $(".menutab").click(click);
                        $(".submenutab").click(click);
                        $(".menutab").mouseover(function(event){ event.stopPropagation(); $(this).addClass("empathize");   });
                        $(".menutab-no-cursor").mouseover(function(event){ event.stopPropagation(); $(this).addClass("empathize");   });
                        $(".submenutab").mouseover(function(event){ event.stopPropagation(); $(this).addClass("empathize");   });
                        $(".menutab").mouseout(function(event){ event.stopPropagation(); $(this).removeClass("empathize");   });
                        $(".submenutab").mouseout(function(event){ event.stopPropagation(); $(this).removeClass("empathize");   });
                        $(".menutab-no-cursor").mouseout(function(event){ event.stopPropagation(); $(this).removeClass("empathize");   });
                        $(".menutab-no-cursor").click(function(event){ 
                          var classe = $(this)[0].lastChild.data;       
                          if( $("."+classe).hasClass("hidden"))
                            $("."+classe).removeClass("hidden");
                          else
                            $("."+classe).addClass("hidden"); 
                        });
                    </script>
                </nav>

            </div>

        </aside>

        <!-- Main -->
        <div id="container">
            <header>
                <div id="title"><h1>Social Project</h1></div>
            </header>
            <main>
                <div id="message">
                    <?php
                    $redmessage = &Session::get('redMessage', 'array');
                    foreach ($redmessage as $message) {
                        echo '<div class="message-field redmessage">'.$message.'</div>';
                    }
                    $redmessage = array();

                    $yellowmessage = &Session::get('yellowMessage', 'array');
                    foreach ($yellowmessage as $message) {
                        echo '<div class="message-field yellowmessage">'.$message.'</div>';
                    }
                    $yellowmessage = array();

                    $greenmessage = &Session::get('greenMessage', 'array');
                    foreach ($greenmessage as $message) {
                        echo '<div class="message-field greenmessage">'.$message.'</div>';
                    }
                    $greenmessage = array();
                    ?>
                </div>

                <?php
                foreach (MenageTemplate::getContents() as $content)
                {
                    echo '<div class="section">'.PHP_EOL;
                    include $content;
                    echo '</div>'.PHP_EOL;
                }
                ?>
                
            </main>
            
            <script> 
                $(function(){
                    var $window = $(window).on('resize', function(){
                        //height
                       var document_height = $( document ).height();
                       $("#container").height(document_height);
                       $("aside").height(document_height );
                       $("footer").css("top", document_height-15);
                       
//                       //width
//                       var document_width = $( window ).width();
//                       $("#container").width(document_width);
//                       $("footer").width(document_width + $("aside").width() );
                    }).trigger('resize'); //on page load

                });
            </script>
        </div>
       
        <footer>

            <!-- Copyright -->
            <div class="copyright">
                <p>GPL 2 License - Mammolo Giuseppe</p>
            </div>

        </footer>
    </body>
</html>