<?php

$post_css = '';
if ( ( is_home() || is_archive() || is_search() ) && have_posts()  || is_404() || is_single() ||
		( is_page() && (
			wp_basename( get_page_template() ) == 'blog.php' ||
			wp_basename( get_page_template() ) == 'archives.php'
		) )
	) {

	if( is_single() )
		{
			global $related_posts;
			$tags = wp_get_post_tags($post->ID);
			$tag_ids = array();
			foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
			$related_post_args =array(
	    			'tag__in' => $tag_ids,
	    			'post__not_in' => array($post->ID),
				'posts_per_page'=> 3, // Number of related posts to display.
				'ignore_sticky_posts'=>1
	    		);
			$related_posts = new WP_Query( $related_post_args );
			$wp_query = $related_posts;
		}
	if( is_404() )
		{ $wpquery = new WP_Query( array('post_type' => 'post') ); }
	elseif( is_page() && wp_basename( get_page_template() ) == 'blog.php' )
		{ $wpquery = new WP_Query( array('post_type' => 'post', "paged" => $paged ) ); }
	elseif( is_page() && wp_basename( get_page_template() ) == 'archives.php' )
		{ $wpquery = new WP_Query( array( 'posts_per_page' => 30 ) ); }
	else
		{ global $wp_query; $wpquery = $wp_query; }

	while ( $wpquery->have_posts() ) : $wpquery->the_post(); setup_postdata($post);

		$background_css = the_writer_post_background_css( $post->ID );

		if( '' != $background_css ){
			$post_css .= '
			#post-' . $post->ID . ' div.book-cover { ' . $background_css . ' } ';
		}

		$title_css = the_writer_post_title_css( $post->ID );

		if( '' != $title_css ){
			$post_css .= '
			#post-' . $post->ID . ' .book-cover h2.post-title a, #post-' . $post->ID . ' .book-cover h5.post-author, #post-' . $post->ID . ' .book-cover h5.post-author a, #post-' . $post->ID . ' .book-cover h6.list-meta, #post-' . $post->ID . ' .book-cover h6.list-meta a { ' . $title_css . ' } ';

		}
	endwhile;
	rewind_posts();
	wp_reset_query();
}

if ( is_page() || is_single() ) {
	global $post;

	$custom_css = get_post_meta( $post->ID , "custom_css", true);
	if( '' != $custom_css ){
		$post_css .= $custom_css;
	}

	$background_css = the_writer_post_background_css( $post->ID );
	if( '' != $background_css ) {
		$post_css .= '.title-container{' . $background_css . ';}';
	}

	$title_css = the_writer_post_title_css( $post->ID );
	if( '' != $title_css ) {
		$post_css .= '
			.title-container .post-title a  { ' . $title_css . ' }
			.title-container .post-author, .title-container .sub-title, .title-container .post-author a { ' . $title_css . ' } ';
	}

}

if( '' != $post_css ) {
	echo '<style>' . $post_css . '</style>';
}