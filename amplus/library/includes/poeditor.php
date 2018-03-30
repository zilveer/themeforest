<?php
/*
 * .PO file editor
 */

// find wp-load.php
$wpLoad = 'wp-load.php';
for ($i = 0; $i < 8; $i++) {
    if (file_exists($wpLoad)) {
        require_once($wpLoad);
        break;
    }
    $wpLoad = '../'.$wpLoad;
}

function error($msg = '') {
    if ($msg) $msg = ': ' . $msg;
    echo "An error occurred{$msg}.";
    exit();
}

if (!isset($_GET['l'])) {
    error("no locale specified");
}

$locale = $_GET['l'];
$poFile = BFI_LANGUAGESPATH.$locale.".po";
$moFile = BFI_LANGUAGESPATH.$locale.".mo";
if (!file_exists($poFile)) {
    error("cannot find ".$poFile);
}
if (!is_readable($poFile)) {
    error("cannot read ".$poFile.". Please make this file readable then try again");
}
if (!is_writable($poFile)) {
    error("cannot modify ".$poFile.". Please make this file writable then try again");
}
if (!file_exists($moFile)) {
    error("cannot find ".$moFile);
}
if (!is_readable($moFile)) {
    error("cannot read ".$moFile.". Please make this file readable then try again");
}
if (!is_writable($moFile)) {
    error("cannot modify ".$moFile.". Please make this file writable then try again");
}


/*
 * Save the changes
 */
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "save") {    
    // go through all the translation texts
    $lines = array();
    $strings = array();
    foreach ($_REQUEST as $key => $value) {
        if (preg_match('/^line\_/', $key)) {
            $lines[] = (int)preg_replace('/^line\_/', '', $key);
            $strings[] = $value;
        }
    }
    
    // generate the contents for the new po file (based on its contents and the REQUEST we got) and put
    // the data in an array for later writing
    $fh = @fopen($poFile, "r");
    $lineNum = 0;
    $newLines = array();
    while(!feof($fh)) {
        $line = trim(fgets($fh));
        $lineNum++;
        if (array_search($lineNum, $lines) !== false) {
            $newLines[] = "msgstr \"".htmlentities2($strings[array_search($lineNum, $lines)])."\"";
        } else {
            $newLines[] = $line;
        }
    }
    fclose($fh);
    
    // create the new PO file
    $fh = @fopen($poFile, "w");
    foreach ($newLines as $line) {
        fwrite($fh, $line."\n");
    }
    fclose($fh);
    
    // convert the PO file to MO file
    require_once(BFI_LIBRARYPATH.'includes/php-mo.php');
    phpmo_convert($poFile, $moFile);
    
    // close the window when we're done
    ?>
    <html>
        <body>
            <script>
                window.close();
            </script>
        </body>
    </html>
    <?php
    exit();
}

// get the contents of the PO file
$data = array();
$fh = @fopen($poFile, "r");
$lineNum = 0;
$tmpData = array();
while(!feof($fh)) {
    $line = trim(fgets($fh));
    $lineNum++;
    
    // get the string id
    if (preg_match('/^msgid\s/', $line)) {
        $line = preg_replace('/^msgid\s(\'|\")/', '', $line);
        $line = preg_replace('/(\'|\")$/', '', $line);
        if ($line == "") continue;
        $tmpData['id'] = $line;
        
    // get the string value 
    } else if (preg_match('/^msgstr\s/', $line)) {
        if (!array_key_exists('id', $tmpData)) continue;
        if ($tmpData['id'] == "") continue;
        $line = preg_replace('/^msgstr\s(\'|\")/', '', $line);
        $line = preg_replace('/(\'|\")$/', '', $line);
        $tmpData['line'] = $lineNum;
        $tmpData['str'] = $line;
        $data[] = $tmpData;
        $tmpData = array();
    }
}
fclose($fh);
unset($tmpData);
unset($fh);


?>
<html>
    <head>
        <script type="text/javascript">
            window.onbeforeunload = function (evt) {
                var message = "<?php _e("Are you sure you want to leave? Your translation changes will not be saved.", BFI_I18NDOMAIN) ?>";
                if (typeof evt == "undefined") {
                    evt = window.event;
                }
                if (evt) {
                    evt.returnValue = message;
                }
                return message;
            }
            
            function copyall() {
                <?php
                foreach ($data as $key => $trans) {
                    ?>document.getElementById('str_<?php echo $key ?>').value = document.getElementById('id_<?php echo $key ?>').value;<?php
                }
                ?>
            }
        </script>

        <style>
            body {
                font-family: "HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",sans-serif;
            }
            input, .header {
                width: 44%;
            }
            input {
                border-width: 1px;
                border-style: solid;
                -moz-border-radius: 3px;
                -khtml-border-radius: 3px;
                -webkit-border-radius: 3px;
                border-radius: 3px;
                border-color: #DFDFDF;
                background-color: white;
                padding: 8px;
                font-size: 13px;
                margin-bottom: 15px;
            }
            .left {
                float: left;
            }
            .right {
                float: right;
            }
            .mid {
                margin: 0 auto;
            }
            div {
                margin-bottom: 0;
                text-align: center;
            }
            h5 {
                text-align: center;
                font-weight: normal;
                font-size: 16px;
            }
            footer {
                position: fixed;
                bottom: 0;
                height: 40px;
                background: white;
                border-top: 1px solid #666;
                left: 0;
                right: 0;
                padding: 5px 20px;
            }
            form {
                margin-bottom: 90px;
            }
            button {
                text-decoration: none;
                font-size: 12px!important;
                line-height: 13px;
                padding: 3px 8px;
                cursor: pointer;
                border-width: 1px;
                border-style: solid;
                -moz-border-radius: 11px;
                -khtml-border-radius: 11px;
                -webkit-border-radius: 11px;
                border-radius: 11px;
                -moz-box-sizing: content-box;
                -webkit-box-sizing: content-box;
                -khtml-box-sizing: content-box;
                box-sizing: content-box;
                text-shadow: rgba(255, 255, 255, 1) 0 1px 0;
                background: #F2F2F2;
                padding: 8px 15px;
            }
            button:hover {
                color: black;
                border-color: #666;
            }
            button.save {
                font-weight: bold;
                background: #21759B;
                text-shadow: rgba(0, 0, 0, 0.3) 0 -1px 0;
                border-color: #298CBA;
                color: white; 
            }
            button.save:hover {
                border-color: #13455B;
                color: #EAF2FA;
            }
            footer button {
                margin-top: 5px;
            }
            p {
                font-size: 12px;
            }
            * {
                font-family: "HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",sans-serif;
            }
            h3 {
                text-shadow: rgba(255, 255, 255, 1) 0 1px 0;
                font-weight: normal;
                font-size: 20px;
                background: #DDD;
                border: 0 !important;
                padding: 10px 15px 10px !important;
                
                -moz-border-radius: 8px;
                -webkit-border-radius: 8px;
                border-radius: 8px;
                -moz-background-clip: padding;
                -webkit-background-clip: padding-box;
                background-clip: padding-box;
                text-align: center;
            }
            p {
                padding: 0 30px;
                font-size: 15px;
                text-shadow: rgba(150,230,250, 1) 0 1px 0 !important;
                font-family: "HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",sans-serif;
                color: #03a;
            }
        </style>
    </head>
    <body style="margin: 20px;">
        <form method="post">
            <h3>Editing Locale: <?php echo $locale ?></h3>
            <p><strong>Instructions:</strong> Fill out the translation text fields on the right side of the page. Use the individual arrow buttons to copy over the original text to the right side. To cancel your changes and stop editing, close this window. Don't forget to click the <strong>Save</strong> button below after translating! After saving, please wait for the window to close before continuing.</p>
            <div>
                <h5 class="header left">Original Text</h5>
                <h5 class="header right">Translation</h5>
                <div style="clear: both"></div>
            </div>
            <?php 
            foreach ($data as $key => $trans) {
                // if no translation has been made yet, use the default values as the starting point
                
                $translationValue = str_replace('"', '&quot;', htmlspecialchars_decode(stripslashes($trans['str'])));
                if (!$translationValue) {
                    $translationValue = str_replace('"', '&quot;', htmlspecialchars_decode(stripslashes($trans['id'])));
                }
            ?>
            <div>
                <input type="text" id="id_<?php echo $key ?>" class="left" value="<?php echo str_replace('"', '&quot;', stripslashes($trans['id'])) ?>"/>
                <button class="mid" style="margin-top: 3px;" onclick="document.getElementById('str_<?php echo $key ?>').value = document.getElementById('id_<?php echo $key ?>').value; return false;">&rarr;</button>
                <input type="text" id="str_<?php echo $key ?>" class="right" name="line_<?php echo $trans['line'] ?>" value="<?php echo $translationValue ?>"/>
                <div style="clear: both"></div>
            </div>
            <?php
            }
            ?>
            <footer>
                <span class="left">
                    <button onclick="copyall(); return false;">Copy all text to right side</button>
                </span>
                <span class="right">
                    <button name="action" value="save" class="save" id="save" onclick="document.getElementById('save').innerHTML = 'Please wait...'; window.onbeforeunload = null;">Save</button>
                </span>
            </footer>
        </form>
    </body>
</html>