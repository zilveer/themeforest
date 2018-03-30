<?php
/*
 * Create a preview of a font
 */

if (!isset($_GET['f']) || !isset($_GET['s'])) die('missing parameters');
if (!isset($_GET['t']) || !trim($_GET['t'])) {
    $_GET['t'] = "AaBbCcDdEeFfGgHhIiJjKkLl1234567890<br>[]{};:'\",.?!@#\$%^&*ÀËÔÙáéóûæ€£¥©®™";
}
$_GET['t'] = urldecode($_GET['t']);

?>
<html>
    <head>
        <script type="text/javascript" src="<?php echo $_GET['s'] ?>"></script>
        <script type="text/javascript" src="<?php echo $_GET['f'].".font.js" ?>"></script>
        <script type="text/javascript">
            Cufon.replace('p, h1, h2, h3, h4, h5, h6');
        </script>
    </head>
    <body>
        <h3 style="line-height: 50px;"><?php echo $_GET['t'] ?></h3>
    </body>
</html>