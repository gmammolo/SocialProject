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
        ?>
        <?php
//        echo "<noscript>".PHP_EOL;
//            foreach (GestoreTemplate::getCss() as $css) {
//                echo("<link rel=\"stylesheet\" href=\"$css\" />"). PHP_EOL;
//            }
//	echo "</noscript>".PHP_EOL;
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
        <div id="header" class="skel-layers-fixed">

            <div class="top">

                <!-- Logo -->
                <div id="logo">
                    <span class="image avatar48"><img src="Template/images/avatar.jpg" alt="" /></span>
                    <h1 id="title"><?php echo $user->getProfile()->getNome(); ?></h1>
                    <p><?php echo $user->getUsername(); ?></p>
                </div>

                <!-- Nav -->
                <nav id="nav">
                    <!--
                    
                            Prologue's nav expects links in one of two formats:
                            
                            1. Hash link (scrolls to a different section within the page)
                            
                               <li><a href="#foobar" id="foobar-link" class="icon fa-whatever-icon-you-want skel-layers-ignoreHref"><span class="label">Foobar</span></a></li>

                            2. Standard link (sends the user to another page/site)

                               <li><a href="http://foobar.tld" id="foobar-link" class="icon fa-whatever-icon-you-want"><span class="label">Foobar</span></a></li>
                    
                    -->
<!--                    <ul>
                        <li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Intro</span></a></li>
                        <li><a href="#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Portfolio</span></a></li>
                        <li><a href="#about" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">About Me</span></a></li>
                        <li><a href="#contact" id="contact-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Contact</span></a></li>
                    </ul>-->

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

            <div class="bottom">

                <!-- Social Icons -->
                <ul class="icons">
                    <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                    <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                    <li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
                    <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
                    <li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
                </ul>

            </div>

        </div>

        <!-- Main -->
        <div id="main">

            <!-- Intro -->
            <section id="top" class="one dark cover">
                <div class="container">

                    <header>
                        <h2 class="alt">Hi! I'm <strong>Prologue</strong>, a <a href="http://html5up.net/license">free</a> responsive<br />
                            site template designed by <a href="http://html5up.net">HTML5 UP</a>.</h2>
                        <p>Ligula scelerisque justo sem accumsan diam quis<br />
                            vitae natoque dictum sollicitudin elementum.</p>
                    </header>

                    <footer>
                        <a href="#portfolio" class="button scrolly">Magna Aliquam</a>
                    </footer>

                </div>
            </section>

            
                <?php
                foreach (GestoreTemplate::getContents() as $content)
                {
                    echo '<section id="portfolio" class="two">'.PHP_EOL;
                    include $content;
                    echo '</section>'.PHP_EOL;
                }
                ?>

        </div>

        <!-- Footer -->
        <div id="footer">

            <!-- Copyright -->
            <ul class="copyright">
                <li>GPL 2 License </li><li>Mammolo Giuseppe</li>
            </ul>

        </div>

    </body>
</html>