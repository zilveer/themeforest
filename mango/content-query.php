<?php
/**
 * The template for generating query
 *
 * Used for index/archive/blog.
 *
 * @package WordPress
 * @subpackage Mango
 * @since Mango 1.0
 */
?>

<?php
		global $mango_settings, $blog_settings,$args;
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged'); 
		}elseif ( get_query_var('page') ) {
			$paged = get_query_var('page'); 
		
		}else {
			$paged = 1;
		}
		
		$args["post_type"] = "post";
		if( $blog_settings['exclude_posts'] ){
			$args['post__not_in'] = explode( ',', $blog_settings['exclude_posts'] );
		}
		if($blog_settings["blog_pagination_type"]=="infinite_scroll"){
			$args['posts_per_page'] = '-1';
		}else{
			$args['paged'] = $paged;
			$args['posts_per_page'] =  $blog_settings['posts_per_page'];
}
?>