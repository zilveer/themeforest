<?php
/* 3D Tag Cloud by FiveSquared - Original Plugin info Below:

	Plugin Name: WP-Cumulus
	Plugin URI: http://www.roytanck.com/2008/03/15/wp-cumulus-released
	Description: Flash based Tag Cloud for WordPress
	Version: 1.23
	Author: Roy Tanck
	Author URI: http://www.roytanck.com
	
	Copyright 2009, Roy Tanck

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
class fivesquared_tag_cloud extends WP_Widget {
	function fivesquared_tag_cloud() {
		$widget_ops = array('classname' => 'fivesquared_tag_cloud', 'description' => __('Display a 3D tag cloud on your site.','tt_theme_framework'));
		$this->WP_Widget('fivesquared_tag_cloud', __('Custom 3D Tag Cloud','tt_theme_framework'), $widget_ops);
	}

	function widget($args, $instance){
		extract($args);
		
		$title = $instance['title'];
		$speed = $instance['speed'];
		ob_start();	
		wp_tag_cloud( $options['args'] );
		$tagcloud = urlencode( str_replace( "&nbsp;", " ", ob_get_clean() ) );
		
		
		echo $before_widget;
		if($title != ""){
			echo $before_title . $title . $after_title; 
		}
		
		echo '<div id="tagcloud"></div>';
$soname = rand(0,9999999);
$movie = '?r=' . rand(0,9999999);
$divname = rand(0,9999999);
$movie = get_template_directory_uri() . '/framework/extended/3d-tag-cloud/tagcloud.swf';
$path = get_template_directory_uri() . '/framework/extended/3d-tag-cloud/';

$flashtag =  '';
$flashtag .= '<script type="text/javascript" src="'.$path.'swfobject.js"></script>';
$flashtag .= '<script type="text/javascript">';
$flashtag .= 'var so = new SWFObject("'.$movie.'", "tagcloudflash", "160", "160", "9", "#F4F4F2");';
$flashtag .= 'so.addParam("wmode", "transparent");';
$flashtag .= 'so.addParam("allowScriptAccess", "always");';
$flashtag .= 'so.addVariable("tcolor", "0x333333");';
$flashtag .= 'so.addVariable("tcolor2", "0x333333");';
$flashtag .= 'so.addVariable("hicolor", "0x000000");';
$flashtag .= 'so.addVariable("tspeed", "'.$speed.'");';
$flashtag .= 'so.addVariable("distr", "true");';
$flashtag .= 'so.addVariable("mode", "tags");';
$flashtag .= 'so.addVariable("tagcloud", "'.urlencode('<tags>') . $tagcloud . urlencode('</tags>').'");';
$flashtag .= 'so.write("tagcloud")';
$flashtag .= '</script>';
echo $flashtag;



echo $after_widget;

}

function update($newInstance, $oldInstance){
		$instance = $oldInstance;
		$instance['title'] = strip_tags($newInstance['title']);
		$instance['speed'] = $newInstance['speed'];

		return $instance;
	}

	function form($instance){
		echo '<p><label for="'.$this->get_field_id('title').'">' . __('Title:','tt_theme_framework') . '</label><input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$instance['title'].'" /></p>';

		echo '<p><label for="'.$this->get_field_id('speed').'">' . __('Speed:', 'tt_theme_framework') . '</label><input class="widefat" id="'.$this->get_field_id('speed').'" name="'.$this->get_field_name('speed').'" type="text" value="'.$instance['speed'].'" /><br /><em style="font-size:11px;color:#999;">(recommended speed between 100-300)</em></p>';

		echo '<input type="hidden" id="custom_recent" name="custom_recent" value="1" />';
	}
}

add_action('widgets_init', create_function('', 'return register_widget("fivesquared_tag_cloud");'));
?>