<?php

/*-----------------------------------------------------------------------------------*/
/*	Define File Paths
/*-----------------------------------------------------------------------------------*/

define('TT_FILEPATH', get_template_directory());
define('TT_DIRECTORY', get_template_directory_uri());

define('TT_TINYMCE_PATH', TT_FILEPATH . '/framework/theme-specific/tinymce');
define('TT_TINYMCE_URI', TT_DIRECTORY . '/framework/theme-specific/tinymce');


/*-----------------------------------------------------------------------------------*/
/*	Load TinyMCE dialog
/*-----------------------------------------------------------------------------------*/

require_once( TT_TINYMCE_PATH . '/tinymce.class.php' ); // TinyMCE wrapper class
new tt_tinymce(); // Main Functionality

?>