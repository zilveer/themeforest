<?php
global $oswcPostTypes;

//this is the folder that houses the function files to include
define('functions', TEMPLATEPATH . '/functions');

function fixObject (&$object)
{
    if (!is_object ($object) && gettype ($object) == 'object')
        return ($object = unserialize (serialize ($object)));
    return $object;
}

$lang = TEMPLATEPATH . '/lang';
//load_theme_textdomain('made', $lang); // pre-2.0
load_theme_textdomain('made');
load_textdomain('made', TEMPLATEPATH.'/lang/made.mo' );

//Get the post type functions
require_once(functions . '/oswc-post-types.php');

//Get the theme options
require_once(functions . '/theme-options.php');

//Get the review options
require_once(functions . '/review-options.php');

//Get the widgets
require_once(functions . '/widgets.php');

//Get the custom functions
require_once(functions . '/custom.php');

//Get the shortcodes
require_once(functions . '/shortcodes.php');

//Get the post type functions
require_once(functions . '/post-types.php');

//Get the post & page meta boxes
require_once(functions . '/meta-boxes.php');

?>