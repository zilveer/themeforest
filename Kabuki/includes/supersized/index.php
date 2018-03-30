<?php
/* 
Plugin Name: WP-Supersized
Plugin URI: http://www.worldinmyeyes.be/2265/wp-supersized-wordpress-plugin/
Version: 3.1.1
Author: <a href="http://www.worldinmyeyes.be/about/">Benoit De Boeck</a>
Description: Installs the full screen slideshow background <a href="http://www.buildinternet.com/project/supersized/">Supersized 3.2.7</a> in your current theme. Many options are available.
 
Copyright 2012  Benoit De Boeck  (email : ben [a t ] worldinmyeyes DOT be)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/

include_once('includes/PHPVersionTest.php');
include_once('includes/CustomMetabox.php');
include_once('includes/WPSupersized.php');

add_action('init', array('WPSupersized','install'));
add_action('init', array('WPSupersized','initialize'));
add_action('admin_menu', array('WPSupersized','add_menu_item'));
add_filter('plugin_action_links_wp-supersized/index.php',array('WPSupersized','add_plugin_settings_link'), 10, 2 );
add_action('wp_print_scripts', array('WPSupersized','_Supersized_scripts'));
add_action('wp_print_styles', array('WPSupersized','_Supersized_styles'));
add_action('wp_head', array('WPSupersized','addHeaderCode'));
add_action('wp_footer', array('WPSupersized','addFooterCode'), 15);
add_action('add_meta_boxes', array('WPSupersized_Metabox','custom_meta_box')); // adds a custom meta box in the page/post admin
add_action('save_post', array('WPSupersized_Metabox','save_custom_meta'), 10, 2); // saves the custom field data when the post/page is saved

global $customOptions; // makes the array $customOptions a global variable; necessary to avoid parsing several times the optional xml file
global $xmlSlidesArray; // same for xmlSlidesArray
$customOptions = array();
$xmlSlidesArray = array();
/* EOF */