<?php
/**
 * Archive page - displays posts in a blog format, filtered by category, date created, etc.
 */
get_header();
//get all the page data needed and set it to an object that can be used in other files
$pexeto_page=array();
$pexeto_page['sidebar']=pexeto_option( 'archive_sidebar' );
$pexeto_page['slider']='none';
$pexeto_page['layout']=pexeto_option( 'archive_layout' );

if ( is_category() ) {
	$pexeto_cat = get_category( get_query_var( "cat" ) );
	$pexeto_page['title'] = $pexeto_cat->name;
} elseif ( is_tag() ) {
	$pexeto_tag = get_term_by( "slug", get_query_var( "tag" ), "post_tag" );
	$pexeto_page['title'] =$pexeto_tag->name;
} elseif ( is_day() ) {
	$pexeto_page['title'] = get_the_time( 'F jS, Y' );
} elseif ( is_month() ) {
	$pexeto_page['title'] = get_the_time( 'F Y' );
} elseif ( is_year() ) {
	$pexeto_page['title'] = get_the_time( 'Y' );
} elseif ( is_author() ) {
	$pexeto_page['title'] = get_the_author();
}

//include the before content template
locate_template( array( 'includes/html-before-content.php' ), true, true );

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		global $more;
		$more = 0;

		//include the post template
		locate_template( array( 'includes/post-template.php' ), true, false );
	}

	locate_template( array( 'includes/post-pagination.php' ), true, false );

}else {
	_e( 'No posts available', 'pexeto' );
}

//include the after content template
locate_template( array( 'includes/html-after-content.php' ), true, true );

get_footer();
?>
