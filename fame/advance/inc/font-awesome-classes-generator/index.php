<?php
/*
 * http://fortawesome.github.io/Font-Awesome/cheatsheet/
 */

$raw_fonts_names    = A13_FA_GENERATOR_DIR.'/font-awesome-icons';
$save_fonts_names   = A13_FA_GENERATOR_DIR.'/../font-awesome-icons';
$change_raw         = filectime($raw_fonts_names);
$change_saved       = file_exists($save_fonts_names)? filectime($save_fonts_names) : 0;
$names = array();

//if generated file is too old
if($change_raw > $change_saved){
    //get file contents
    if(file_exists($raw_fonts_names)){
        $content = file_get_contents($raw_fonts_names);
    }
    else{
        return $names;
    }

    $names = array();

    $convert = explode("\n", $content); //create array separate by new line

    for ($i=0;$i<count($convert);$i++){
        if (preg_match("/fa\-([a-zA-Z0-9\-_]+) ?/s", $convert[$i], $matches)){
            $names[] = $matches[1];
        }
    }

//    var_dump($names);

    //save new file
    $fp = fopen($save_fonts_names, 'w');
    fwrite($fp, implode(PHP_EOL, $names));
    fclose($fp);
    chmod($save_fonts_names, 0755);
}
else{
    $content = file_get_contents($save_fonts_names);
    $names = array();
    $names = explode("\n", $content); //create array separate by new line
}

return $names;
