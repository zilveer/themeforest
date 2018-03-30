<?php
/*
Plugin Name: Sidebar Generator
Plugin URI: http://www.getson.info
Description: This plugin generates as many sidebars as you need. Then allows you to place them on any page you wish.
Version: 1.0.1
Author: Kyle Getson
Author URI: http://www.kylegetson.com
Copyright (C) 2009 Clickcom, Inc.
*/

/*
Copyright (C) 2009 Kyle Robert Getson, kylegetson.com and getson.info

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

class sidebar_generator_pix {
	
	function sidebar_generator_pix() {
		add_action('init',array('sidebar_generator_pix','init'));		
	}
	
	public static function init(){
		//go through each sidebar and register it
	    $sidebars = sidebar_generator_pix::get_sidebars();
	    

	    if(is_array($sidebars)){
			$z=1;
			foreach($sidebars as $sidebar){
				$sidebar_class = sidebar_generator_pix::name_to_class($sidebar);
				register_sidebar(array(
			    	'name'=>$sidebar,
					'id'=> "pix_sidebar-$z",
					'before_widget' => '<div data-id="%1$s" class="pix_widget cf ' . apply_filters('geode_fx_onscroll','') . ' %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h6>',
					'after_title' => '</h6>',
		    	));	 $z++;
			}
		}
	}
	
	/**
	 * called by the action get_sidebar. this is what places this into the theme
	*/
	public static function get_sidebar($index){
		//if(!is_singular()){
		//	dynamic_sidebar();
		//	return true;//dont do anything
		//}
		wp_reset_query();
		global $wp_query;
		$post = $wp_query->get_queried_object();
		$selected_sidebar = get_post_meta($post->ID, 'cpi_dropdown_options', true);
		if($selected_sidebar != '' && $selected_sidebar != "0"){
			echo "\n\n<!-- begin generated sidebar [$selected_sidebar] -->\n";
			//echo "<!-- selected: $selected_sidebar -->";
			dynamic_sidebar(strtolower($selected_sidebar));
			echo "\n<!-- end generated sidebar -->\n\n";			
		}else{
			dynamic_sidebar(strtolower($index));
		}
	}
	
	/**
	 * gets the generated sidebars
	 */
	public static function get_sidebars(){
		$sidebars = get_option( 'pix_sidebar_generator');
		return $sidebars;
	}
	public static function name_to_class($name){
		$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name);
		return $class;
	}
}
$sbg = new sidebar_generator_pix;

function generated_dynamic_sidebar_pix($index){
	sidebar_generator_pix::get_sidebar($index);	
	return true;
}
?>