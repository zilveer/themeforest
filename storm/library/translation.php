<?php
// Adding Translation Option
load_theme_textdomain( 'bkninja', get_template_directory() .'/languages' );

$locale = get_locale();
$locale_file = get_template_directory() ."/library/$locale.php";

if ( is_readable($locale_file) ) {
     require_once($locale_file); 
}

?>