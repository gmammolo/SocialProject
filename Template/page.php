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
                    <span class="image avatar48"><img src="Template/images/avatar.jpg" alt="" /></span>
                    <h1 id="title"><?php echo $user->getProfile()->getNome(); ?></h1>
                    <p><?php echo $user->getUsername(); ?></p>
                </div>

                <!-- Nav -->
                <nav id="nav">


                    <?php
                    echo "<ul>";
                    foreach (GestoreTemplate::getMenu() as $key => $submenues) {
                        $chiave = $key;
                        if (is_string($submenues)) {
                            $chiave = "<a href=\"$submenues\" target=\"_blank \" style=\"color: inherit;;\"> $key </a> ";
                        }
                        echo "<li>$chiave</li>" . PHP_EOL;
                        if (is_array($submenues)) :
                            echo "<ol>" . PHP_EOL;
                            foreach ($submenues as $alias => $url) {
                                echo "<li>$alias</li>";
                            }
                            echo"</ol>" . PHP_EOL;
                            $i++;
                        endif;
                    }
                    ?>
                </nav>

            </div>

        </aside>

        <!-- Main -->
        <div id="container">
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
                foreach (GestoreTemplate::getContents() as $content)
                {
                    echo '<section class="">'.PHP_EOL;
                    include $content;
                    echo '</section>'.PHP_EOL;
                }
                ?>

            </main>

            <!-- Footer -->
            <footer>

                <!-- Copyright -->
                <ul class="copyright">
                    <li>GPL 2 License </li><li>Mammolo Giuseppe</li>
                </ul>

            </footer>
        </div>
    </body>
</html>