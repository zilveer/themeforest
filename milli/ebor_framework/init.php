<?php 

/**
 * Ebor Framework
 * Init
 * @since version 1.0
 * @author TommusRhodus
 */
 
//MENUS & WIDGETS
require_once ( "menus_widgets.php");

//STYLES & SCRIPTS
require_once ( "styles_scripts.php" );

//THEME FUNCTIONS
require_once ( "theme_functions.php" );

//THEME OPTIONS
require_once ( "theme_options.php" );

//THEME SUPPORT
require_once ( "theme_support.php" );

//THEME CUSTOM FILTERS
require_once ( "theme_filters.php" );

//METABOXES
require_once ( "metaboxes.php" );

//IMAGE RESIZER
require_once( 'aq_resizer.php' );

//COLOURS
require_once ( 'custom_colours.php' );

//REQUIRED PLUGINS
require_once ( 'class-tgm-plugin-activation.php' );
	
//PLUGINS LOAD
require_once ( 'theme_plugins.php' );

//IMAGE REORDER
require_once ( 'image_order.php' );