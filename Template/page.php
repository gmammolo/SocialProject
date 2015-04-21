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
                    <input id="bar_search" type="text" name="search" pattern="[^'\x22]+" placeholder="Cerca" />
                    <input id="button_search" type="button" onclick="search()" />
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
                <h1>Social Project</h1>
            </header>
            <main>
                <div id="message">
                    <?php
                    $redmessage = &Session::get('redmessage', 'array');
                    foreach ($redmessage as $message) {
                        echo '<div class="message-field redmessage">'.$message.'</div>';
                    }
                    $redmessage = array();

                    $yellowmessage = &Session::get('yellowmessage', 'array');
                    foreach ($yellowmessage as $message) {
                        echo '<div class="message-field yellowmessage">'.$message.'</div>';
                    }
                    $yellowmessage = array();

                    $greenmessage = &Session::get('greenmessage', 'array');
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
                       var document_height = $( document ).height();
                       $("#container").height(document_height);
                       $("aside").height(document_height );
                       $("footer").css("top", document_height-15);
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