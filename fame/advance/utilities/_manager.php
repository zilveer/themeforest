<?php

$dir = A13_TPL_ADV_DIR . '/utilities';
$not_include = array('_manager.php');

if( is_dir( $dir ) ) {
    //The GLOB_BRACE flag is not available on some non GNU systems, like Solaris. So we use merge:-)
    foreach ( (array)glob($dir.'/*.php') as $file ){
        $name = basename($file);

        //include all files except those mentioned earlier:-)
        if(!in_array($name,$not_include)){
            require_once($dir.'/'.basename($file));
        }
    }
}

