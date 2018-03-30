<?php

/*-----------------------------------------------------------------------------------*/
/*	Paths Defenitions
/*-----------------------------------------------------------------------------------*/

define('ICY_TINYMCE_PATH', ICY_FILEPATH . '/tinymce');
define('ICY_TINYMCE_URI', ICY_DIRECTORY . '/tinymce');


/*-----------------------------------------------------------------------------------*/
/*	Load TinyMCE dialog
/*-----------------------------------------------------------------------------------*/

require_once( ICY_TINYMCE_PATH . '/tinymce.class.php' );		// TinyMCE wrapper class
new icy_tinymce();											// do the magic

?>