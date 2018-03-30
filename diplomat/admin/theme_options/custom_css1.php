<?php
$directory = TMM_THEME_PATH."/scss/";
require TMM_THEME_PATH.'/admin/theme_options/scss.inc.php';

$scss = new scssc();

if (TMM::get_option('compress_css')){
    $scss->setFormatter("scss_formatter_compressed");
}

$scss->setImportPaths($directory);

// will search for `assets/stylesheets/mixins.scss'
echo $scss->compile('@import "styles.scss"');