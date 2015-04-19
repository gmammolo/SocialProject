<?php $user = Session::get('user', 'User'); 
// var_dump(Role::getConstant($user->role[0]));
?>
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
    echo '<div class="section">'.PHP_EOL;
    include $content;
    echo '</div>'.PHP_EOL;
}

?>
        </div>
    </body>
</html>