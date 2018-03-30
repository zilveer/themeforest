<?php
/**
 * VideoTube Video Shortcode
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !class_exists('Mars_VideoShortcode') ){
	class Mars_VideoShortcode {
		function __construct() {
			add_action('init', array($this,'add_shortcodes'));
		}
		function add_shortcodes(){
			add_shortcode('nocode', array($this,'nocode'));
			add_shortcode('myoutube', array($this,'myoutube'));
			add_shortcode('mvimeo', array($this,'mvimeo'));
		}
		function myoutube( $attr, $content ){
			global $videotube;
			$autoplay = isset( $videotube['autoplay'] ) ? $videotube['autoplay'] : 0;
			$width = isset( $attr['width'] ) ? $attr['width'] : 300;
			$height = isset( $attr['height'] ) ? $attr['height'] : 300;			
			$video_id = $attr['video_id'];
			$frame = '<iframe class="frmvideo" width="'.$width.'" height="'.$height.'" src="//www.youtube.com/embed/'.$video_id.'?autoplay='.$autoplay.'" frameborder="0" allowfullscreen></iframe>';
			return do_shortcode($frame);
		}
		function mvimeo( $attr, $content ){
			global $videotube;
			$autoplay = isset( $videotube['autoplay'] ) ? $videotube['autoplay'] : 0;	
			$width = isset( $attr['width'] ) ? $attr['width'] : 300;
			$height = isset( $attr['height'] ) ? $attr['height'] : 300;			
			$video_id = $attr['video_id'];
			$frame = '<iframe class="frmvideo" src="//player.vimeo.com/video/'.$video_id.'?portrait=0&autoplay='.$autoplay.'" width="'.$width.'" height="'.$height.'" frameborder="0" allowfullscreen></iframe>';
			return do_shortcode($frame);
		}
		function nocode( $attr, $content = null ){
			return '<div class="alert alert-info">' . $content . '</div>';
		}
	}
	new Mars_VideoShortcode();
}
