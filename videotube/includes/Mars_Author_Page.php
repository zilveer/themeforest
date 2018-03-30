<?php
if( !defined('ABSPATH') ) exit;
if( !class_exists( 'Mars_Author_Page' ) ){
	class Mars_Author_Page {
		function __construct() {
			add_filter('videotube_author_header', array( &$this , 'videotube_author_header' ) , 10);
			add_filter('videotube_author_loop_content', array( &$this,'videotube_author_loop_content' ), 10);
			add_filter('videotube_author_loop_before', array( &$this,'videotube_author_loop_before' ), 10);
			add_filter('videotube_author_loop_after', array( &$this,'videotube_author_loop_after' ), 20);
			add_filter('pre_get_posts', array( &$this,'pre_get_posts' ),10 );
		}
		function videotube_author_header(){
			global $videotube, $wp_query;
			//print_r( $wp_query );
			$header = null;
			$user_id = isset( $wp_query->query_vars['author'] ) ? $wp_query->query_vars['author'] : null;
			$user_data = get_user_by('id', $user_id);
			if( $videotube['enable_channelpage'] == 0 || !isset( $videotube['enable_channelpage'] ) ){
				$header .= '<h3>'.$user_data->display_name.'</h3>';
			}
			else{
				$header .= '
                    <div class="channel-header">
						
						<div class="channel-image">'.get_avatar($user_id).'</div>
						
						<div class="channel-info">
							<h3>'.$user_data->display_name.'</h3>
							
							<span class="channel-item"><strong>'.__('Videos:','mars').'</strong> '.mars_get_user_postcount($user_id).'</span>
							<span class="channel-item"><strong>'.__('Likes:','mars').'</strong> '.mars_get_user_metacount($user_id, 'like_key').'</span>
							<span class="channel-item"><strong>'.__('Views:','mars').'</strong> '.mars_get_user_metacount($user_id, 'count_viewed').'</span>
							';
							if( $user_data->user_url ){
								$header .= '<span class="channel-item"><a ref="nofollow" href="'.$user_data->user_url.'"><i class="fa fa-home"></i></a></span>';
							}
							$header .= '
						</div>
						<div class="channel-description">'.wp_kses_data( nl2br($user_data->description) ).'</div>
					</div>
					
					<h3>Videos by: '.$user_data->display_name.'</h3>
				';
			}
			return $header;
		}
		function videotube_author_loop_content(){
			if( is_author() ){
				global $videotube;
				if( $videotube['enable_channelpage'] == 0 || !isset( $videotube['enable_channelpage'] ) ){
					get_template_part('loop','post');
				}
				else{
					get_template_part('loop','video');
				}
			}
		}
		function videotube_author_loop_before(){
			global $videotube;
			if( $videotube['enable_channelpage'] == 1 ){
				return '<div class="row video-section meta-maxwidth-230">';	
			}			
		}
		function videotube_author_loop_after(){
			global $videotube;
			if( $videotube['enable_channelpage'] == 1 ){	
				return '</div>';
			}
		}
		function pre_get_posts( &$query ){
			global $videotube;
			if(  $query->is_author && $videotube['enable_channelpage'] == 1 && $query->is_main_query() ){
				$query->set( 'post_type', 'video' );
			}
			return $query;
		}
	}
	new Mars_Author_Page();
}