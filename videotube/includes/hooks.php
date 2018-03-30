<?php
/**
 * VideoTube Common Hooks
 *
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists('mars_blog_metas') ){
	/**
	 * Display Blog meta as Author, Date, Category
	 */
	function mars_blog_metas() {
		global $post;
		$output = '';
		$author = get_the_author_meta('display_name', mars_get_post_authorID($post->ID));
		$category = get_the_category($post->ID); 
		$output .= '
			<span class="post-meta"><i class="fa fa-user"></i> <a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.$author.'</a> <span class="sep">/</span> 
			<i class="fa fa-clock-o"></i> '.get_the_date().' <span class="sep">/</span>';
			if( has_category('', $post->ID) ):
				$output .= '<i class="fa fa-folder-open"></i> '. get_the_category_list(', ', '', $post->ID) .'</span>';	
			endif;
		print $output;
	}
	add_action('mars_blog_metas', 'mars_blog_metas', 10);
}
if( !function_exists('mars_post_meta') ){
	/**
	 * Display Blog meta as Author, Date, Category
	 */
	function mars_post_meta() {
		$views = apply_filters( 'postviews' , mars_get_count_viewed() );
		$output = '
			<div class="meta">
				<span class="date">'. sprintf( __('%s ago','mars'), human_time_diff( get_the_time('U'), current_time('timestamp') ) ).'</span>';
				if( isset( $views ) && $views > 0 ){
					$output .= '<span class="views"><i class="fa fa-eye"></i>'.$views.'</span>';
				}
				$output .= '
			</div>		
		';
		return $ouput;		
	}
	add_filter('mars_post_meta', 'mars_post_meta', 10);
}

if( !function_exists('mars_video_meta') ){
	/**
	 * Display Video Meta as Viewed, Liked
	 */
	function mars_video_meta(){
		global $post, $videotube;
		if( get_post_type( $post->ID ) != 'video' )
			return;
		$views = apply_filters( 'postviews' , mars_get_count_viewed() );
		$datetime_format = isset( $videotube['datetime_format'] ) ? $videotube['datetime_format'] : 'videotube';
		$comments = wp_count_comments( $post->ID );
		$output = '
			<div class="meta">';
				// insert the code here
				
				if( $datetime_format != 'videotube' ){
					$output .= '<span class="date">'.get_the_date().'</span>';
				}
				else{
					$output .= '<span class="date">'.sprintf( __('%s ago','mars'), human_time_diff( get_the_time('U'), current_time('timestamp') ) ).'</span>';
				}
				
				if( isset( $views ) && $views > 0 ){
					$output .= '<span class="views"><i class="fa fa-eye"></i>'.$views.'</span>';
				}
				
				if(function_exists('mars_get_like_count')) { 
					$output .= '<span class="heart"><i class="fa fa-heart"></i>'.mars_get_like_count($post->ID).'</span>';
				}
				$output .= '
					<span class="fcomments"><i class="fa fa-comments"></i>'.$comments->approved.'</span>
				';
				// video category.
				if( has_term( '', 'categories', $post->ID ) && apply_filters( 'mars_post_meta_category' , false) === true ){
					$output .= '<span class="fcategory"><i class="fa fa-folder-open"></i>';
						$output .= get_the_term_list( $post->ID , 'categories');
					$output .= '</span>';
				}

				$output .= '
			</div>
		';
		print $output;
	}
	add_action('mars_video_meta', 'mars_video_meta', 10);
}

if( !function_exists('mars_copyright') ){
	/**
	 * Dislay Copyright in Footer.
	 */
	function mars_copyright(){
		global $videotube;
		if( isset( $videotube['copyright_text'] ) ){
			print '<p>'.$videotube['copyright_text'].'</p>';
		}
		else{
			print '<p>Copyright 2015 &copy; MarsTheme All rights reserved. Powered by WordPress & MarsTheme</p>';	
		}
	}
	add_action('mars_copyright', 'mars_copyright', 1);
}