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
			'header_display', 'sidebar', 'post_number', 'exclude_cats', 'filter_action' ) );
		$pexeto_blog = new stdClass();


		$pexeto_blog->column_options = array(
			'twocolumn' => array('columns'=>2, 'layout'=>'full'),
			'threecolumn' => array('columns'=>3, 'layout'=>'full'),
			'twocolumn-left' => array('columns'=>2, 'layout'=>'left'),
			'twocolumn-right' => array('columns'=>2, 'layout'=>'right')
		);

		if ( isset($pexeto_blog->column_options[$pexeto_page['blog_layout']]) ) {
			global $pexeto_scripts;
			$pexeto_blog->masonry = true;
			$pexeto_scripts['blog_masonry']=true;
			$pexeto_blog->layout_opts = $pexeto_blog->column_options[$pexeto_page['blog_layout']];
			$pexeto_scripts['blog_masonry_cols'] = $pexeto_blog->layout_opts['columns'];
			$pexeto_page['layout'] = $pexeto_blog->layout_opts['layout'];
			$pexeto_page['columns'] = $pexeto_blog->layout_opts['columns'];
		}else {
			$pexeto_blog->masonry = false;
			$pexeto_page['layout']=$pexeto_page['blog_layout'];
		}

		//include the before content template
		locate_template( array( 'includes/html-before-content.php' ), true, true );

		the_content();
	}
}

//set the main post arguments
$pexeto_blog->args = array(
	'post_type'=>'post',
	'posts_per_page'=>$pexeto_page['post_number']
);

$pexeto_blog->paged = get_query_var( 'paged' );
if(empty($pexeto_blog->paged)){
	$pexeto_blog->paged = get_query_var( 'page' );
}

if(!empty($pexeto_blog->paged)){
	$pexeto_blog->args['paged'] = $pexeto_blog->paged;
}

if ( isset( $pexeto_page['exclude_cats'] ) && !empty( $pexeto_page['exclude_cats'] ) ) {
	//include or exclude categories
	//we use exclude_cats key because the first version of the theme used to support
	//exclude only and we use the same option for backwards compatibility
	$pexeto_tax_query = array(
		'taxonomy' => 'category',
		'field' => 'id'
	);
	
	$pexeto_tax_query['terms'] = explode( ',', $pexeto_page['exclude_cats'] );
	$pexeto_tax_query['operator'] = isset($pexeto_page['filter_action']['type']) && 
		$pexeto_page['filter_action']['type'] == 'include' ? 'IN' : 'NOT IN';
	$pexeto_tax_query['include_children'] = isset($pexeto_page['filter_action']['include_children']) && 
		$pexeto_page['filter_action']['include_children'] == 'true' ? true : false;
	
	$pexeto_blog->args['tax_query'] = array($pexeto_tax_query);
}

$pexeto_blog->args = apply_filters('pexeto_blog_args', $pexeto_blog->args);
query_posts( $pexeto_blog->args );

if ( have_posts() ) {

	if ( $pexeto_blog->masonry ) {
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

	if ( $pexeto_blog->masonry ) {
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
