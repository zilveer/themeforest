<?php
/**
 * Template Name: Blog page
 */
get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		//get all the page meta data (settings) needed (function located in functions/meta.php)
		$pexeto_page = pexeto_get_post_meta( $post->ID, array( 'slider', 'blog_layout', 
			'show_title', 'sidebar', 'post_number', 'exclude_cats' ) );


		$column_options = array(
			'twocolumn' => array('columns'=>2, 'layout'=>'full'),
			'threecolumn' => array('columns'=>3, 'layout'=>'full'),
			'twocolumn-left' => array('columns'=>2, 'layout'=>'left'),
			'twocolumn-right' => array('columns'=>2, 'layout'=>'right')
		);

		if ( isset($column_options[$pexeto_page['blog_layout']]) ) {
			global $pexeto_scripts;
			$pexeto_masonry = true;
			$pexeto_scripts['blog_masonry']=true;
			$layout_opts = $column_options[$pexeto_page['blog_layout']];
			$pexeto_scripts['blog_masonry_cols'] = $layout_opts['columns'];
			$pexeto_page['layout'] = $layout_opts['layout'];
			$pexeto_page['columns'] = $layout_opts['columns'];
		}else {
			$pexeto_masonry = false;
			$pexeto_page['layout']=$pexeto_page['blog_layout'];
		}

		//include the before content template
		locate_template( array( 'includes/html-before-content.php' ), true, true );

		the_content();
	}
}

//set the main post arguments
$args = array(
	'post_type'=>'post',
	'posts_per_page'=>$pexeto_page['post_number']
);

$paged = get_query_var( 'paged' );
if(empty($paged)){
	$paged = get_query_var( 'page' );
}

if(!empty($paged)){
	$args['paged'] = $paged;
}

if ( isset( $pexeto_page['exclude_cats'] ) && !empty( $pexeto_page['exclude_cats'] ) ) {
	$exclude_cats = explode( ',', $pexeto_page['exclude_cats'] );
	$args['category__not_in'] = $exclude_cats;
}
$args = apply_filters('pexeto_blog_query_args', $args);
query_posts( $args );

if ( have_posts() ) {

	if ( $pexeto_masonry ) {
		//it is a multi-column layout, wrap the content into a masonry div
		?><div id="blog-masonry" class="page-masonry"><?php
	}
	while ( have_posts() ) {
		the_post();
		global $more;
		$more = 0;

		//include the post template
		locate_template( array( 'includes/post-template.php' ), true, false );
	}

	if ( $pexeto_masonry ) {
		?></div><?php
	}


	locate_template( array( 'includes/post-pagination.php' ), true, false );

}else {
	_e( 'No posts available', 'pexeto' );
}

//reset the inital page query
wp_reset_query();
wp_reset_postdata();

//include the after content template
locate_template( array( 'includes/html-after-content.php' ), true, true );

get_footer();
?>
