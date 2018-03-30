<?php

/*-----------------------------------------------------------------------------------*/
/*	Paths Defenitions
/*-----------------------------------------------------------------------------------*/

define('TZ_TINYMCE_PATH', TZ_FILEPATH . '/tinymce');
define('TZ_TINYMCE_URI', TZ_DIRECTORY . '/tinymce');


/*-----------------------------------------------------------------------------------*/
/*	Load TinyMCE dialog
/*-----------------------------------------------------------------------------------*/

require_once( TZ_TINYMCE_PATH . '/tinymce.class.php' );		// TinyMCE wrapper class
new tz_tinymce();											// do the magic

?>