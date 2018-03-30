<?php
/**
* @package   Master
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// load config    
require_once(dirname(__FILE__).'/config.php');

function add_remove_contactmethods( $contactmethods ) {
	$contactmethods['twitter'] = 'Twitter';
	$contactmethods['facebook'] = 'Facebook';
    $contactmethods['googleplus'] = 'Google +';
	$contactmethods['linkedin'] = 'Linked In';
	$contactmethods['flickr'] = 'Flickr';
        // this will remove existing contact fields
	unset($contactmethods['aim']);
	unset($contactmethods['yim']);
	unset($contactmethods['jabber']);
	return $contactmethods;
}
add_filter('user_contactmethods','add_remove_contactmethods',10,1);