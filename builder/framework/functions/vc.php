<?php
/* ------------------------------------------------------------------------ */
/* Include VC extends  */
/* ------------------------------------------------------------------------ */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('js_composer/js_composer.php')){
	include(get_template_directory().'/framework/vc_extend/vc.php'); //Theme Menu
};
?>