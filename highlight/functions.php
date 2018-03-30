<?php
/**
 * Functions
 * 
 * This is the main functions file that can add some additional functionality to the theme.
 * It calls an object from a manager class that inits all the needed functionality.
 */

require_once (TEMPLATEPATH . '/lib/classes/pexeto-functions-manager.php'); 

if(is_admin() && basename($_SERVER["PHP_SELF"]) != 'update-core.php'){
	require('update-notifier.php');
}

//declare some global variables that will be used everywhere
$new_meta_boxes=array();
$new_meta_post_boxes=array();
$new_meta_portfolio_boxes=array();
$pexeto_buttons=array();

//init the theme functionality
$pexeto_manager = new PexetoFunctionsManager();
$pexeto_manager->init();


?>