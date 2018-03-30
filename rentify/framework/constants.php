<?php

if(!defined('RENTIFY_THEME_NAME')){
	define('RENTIFY_THEME_NAME', "simplebuilder");
}
if(!defined('RENTIFY_SHORT_NAME')){
	define('RENTIFY_SHORT_NAME', "simplebuilder");
}
if(!defined('RENTIFY_THEME_NICE_NAME')){
	define('RENTIFY_THEME_NICE_NAME', "simplebuilder_wp");
}

if(!defined('RENTIFY_THEME_HAS_PANEL')){
	define('RENTIFY_THEME_HAS_PANEL', TRUE);
}


/*-------------------------------------------------------------------------
  START JS CSS IMG & VIDEO CONSTANT PATH DEFINED
------------------------------------------------------------------------- */

if(!defined('RENTIFY_JS')){

	define('RENTIFY_JS', get_template_directory_uri().'/assets/js/' );
}
if(!defined('RENTIFY_JS_PLUGINS')){

	define('RENTIFY_JS_PLUGINS', get_template_directory_uri().'/assets/js/plugins/' );
}
if(!defined('RENTIFY_CSS')){

	define('RENTIFY_CSS', get_template_directory_uri().'/assets/css/' );
}

if(!defined('RENTIFY_IMAGE')){

	define('RENTIFY_IMAGE', get_template_directory_uri().'/assets/img/');
}

if(!defined('rentify_VIDEO')){

	define('rentify_VIDEO', get_template_directory_uri().'/assets/media/');

}

/*-------------------------------------------------------------------------
  END JS CSS AND IMG CONSTANT PATH DEFINED
------------------------------------------------------------------------- */

?>
