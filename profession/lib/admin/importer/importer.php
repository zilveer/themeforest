<?php

if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

//check if wordpress-importer plugin exist, otherwise include it
if ( !function_exists( 'wordpress_importer_init' ) ) {
	require_once(THEME_ADMIN . '/importer/wordpress-importer/wordpress-importer.php');
}

?>