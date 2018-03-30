<?php
/**
 * VideoTube Video Table Custom
 * Add LIKES AND VIEWED column in VIDEO table.
 *
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !class_exists('Mars_Video_Table') ){
	class Mars_Video_Table {
		function __construct() {
			add_filter('manage_edit-video_columns' , array($this,'cpt_columns'));
			add_action( "manage_video_posts_custom_column", array($this,'modify_column'), 10, 2 );
		}
		function cpt_columns($columns){
			$new_columns = array(
				'user'	=>	__('Author','mars'),
				'likes'	=>	__('Likes','mars'),
				'views'	=>	__('Views','mars'),
				'layout'	=>	__('Layout','mars')
			);
			unset( $columns['author'] );
		    return array_merge($columns, $new_columns);			
		}
		function modify_column($column, $post_id){
			switch ($column) {
				case 'user':
					$video = get_post( $post_id );
					print get_avatar( $video->post_author, 64 );
				break;
				case 'likes':
					print mars_get_like_count($post_id);
				break;
				case 'views':
					//print mars_get_count_viewed();
					print get_post_meta($post_id,'count_viewed',true) ? get_post_meta($post_id,'count_viewed',true) : 1;
				break;
				case 'layout':
					$layout = get_post_meta($post_id,'layout',true) ? get_post_meta($post_id,'layout',true) : 'small';
					print $layout;
				break;
			}	
		}	
	}
	new Mars_Video_Table();
}