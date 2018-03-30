<?php
/*
 * Create a preview of a font
 */
// var_dump($_GET['f']);
if (!isset($_GET['f'])) die('missing parameters');
if (!isset($_GET['t']) || !trim($_GET['t'])) {
    $_GET['t'] = "AaBbCcDdEeFfGgHhIiJjKkLl1234567890[]{};:'\",.?!@#\$%^&*ÀËÔÙáéóûæ€£¥©®™";
}
$_GET['t'] = urldecode($_GET['t']);

$f = unserialize(stripslashes($_GET['f']));
$src = $f['src'];
$css = $f['css'];

$_GET['t'] = preg_replace("<br>", "", $_GET['t']);

?>
<html>
    <head>
        <link rel='stylesheet' href="http://fonts.googleapis.com/css?family=<?php echo $src ?>&subset=latin,cyrillic-ext,greek-ext,greek,latin-ext,vietnamese,cyrillic" type='text/css' media='all' />
        <style>
            p, h1, h2, h3, h4, h5, h6 {
                <?php echo $css ?>
            }
        </style>
    </head>
    <body>
        <h3 style="line-height: 50px;"><?php echo $_GET['t'] ?></h3>
    </body>
</html>