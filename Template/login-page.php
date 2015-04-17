<?php $user = Session::get('user', 'User'); 
var_dump($user)?>
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
                echo("@import \"$css\";".PHP_EOL);
            }
        echo '</style>';
        
        ?>
    </head>
    <body>
        <div id="main">
<?php

foreach (GestoreTemplate::getContents() as $content)
{
    echo '<div class="section">'.PHP_EOL;
    include $content;
    echo '</div>'.PHP_EOL;
}

?>
        </div>
    </body>
</html>