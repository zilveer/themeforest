<?php

//Textdomain
define('SG_TDN', 'jad');

//Add features or post thumbnail sizes here
function sg_user_theme_setup()
{
	/* Add theme-supported features. */
	/* add_theme_support(''); */

	/* Add images sizes */
	/* Please use 'cm_' prefix to name */
	/* add_image_size('cm_myimage', 100, 100, true); */
}

//Theme Setup
require_once get_template_directory() . '/functions/init.php';