<?php $user = Session::get('user', 'User'); ?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Social Project</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <?php
        foreach (GestoreTemplate::getJavascript() as $js) {
            echo "<script src=\"$js\"></script>". PHP_EOL;
        }
        echo '<style type="text/css">';
            
            foreach (GestoreTemplate::getCss() as $css)
            {
                echo("@import \"$css\";");
            }
        echo '</style>';
        
        ?>
    </head>
    <body>

        <!-- Header -->
        <header>
            //TODO: BArra di ricerca
        </header>
       
        <aside class="skel-layers-fixed">

            <div class="top">

                <!-- Logo -->
                <div id="logo">
                    <span id="avatar"><img src="Template/images/avatar.jpg" /></span>
                    <div>
                        <h1 class="name"><?php echo $user->getProfile()->getNome(); ?></h1>
                        <p class="username">@<?php echo $user->getUsername(); ?></p>
                    </div>

                </div>

                <!-- Nav -->
                <nav id="nav">


                    <?php
                    echo "<ul>";
//                    print_r(GestoreTemplate::getMenu());
                    foreach (GestoreTemplate::getMenu() as $key => $submenues) {
                        if(User::hasAccess($submenues->getAccessLevel())) :
                            $chiave = $key;
                            if (is_a($submenues, "Menu") && !is_null($submenues->getParam())) {
                                $chiave = 'onclick="jsRedirect(\''.$submenues->getParam().'\')" ';
                            }
                            echo "<li class = \"menutab\" $chiave>".$submenues->getIcon()." $key.</li>" . PHP_EOL;
                            if (is_array($submenues)) :
                                echo "<ol>" . PHP_EOL;
                                foreach ($submenues as $alias => $submen) {
                                    if(User::hasAccess($submen->getAccessLevel()))
                                        echo "<li class = \"menutab submenutab\" onclick=\"jsRedirect(\"".$submenues->getParam()."\")\" > ".$submenues->getIcon().$alias."</li>";
                                }
                                echo"</ol>" . PHP_EOL;
                                $i++;
                            endif;
                        endif;
                    }
                    ?>
                    
                </nav>

            </div>

        </aside>

        <!-- Main -->
        <div id="container">
            <main>
                <?php print_r(User::getUser()); ?>
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
                foreach (GestoreTemplate::getContents() as $content)
                {
                    echo '<section class="">'.PHP_EOL;
                    include $content;
                    echo '</section>'.PHP_EOL;
                }
                ?>

            </main>
        </div>
       
        <footer>

            <!-- Copyright -->
            <div class="copyright">
                <p>GPL 2 License - Mammolo Giuseppe</p>
            </div>

        </footer>
    </body>
</html>