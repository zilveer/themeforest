<?php
/**
 * Search - this is the page that displays the search results.
 */

get_header();
//get all the page data needed and set it to an object that can be used in other files
$pexeto_page=array();
$pexeto_page['title'] = __( 'Search results for', 'pexeto' ).' "'.get_search_query().'"';
$pexeto_page['sidebar'] = pexeto_option( 'archive_sidebar' );
$pexeto_page['slider'] = 'none';
$pexeto_page['layout'] = pexeto_option( 'archive_layout' );
$pexeto_page['excerpt'] = true;

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
	echo '<p>'.__( 'No results found', 'pexeto' ).'</p><div class="aligncenter" id="not-found">';
	//include the search template
	locate_template( array( 'searchform.php' ), true, true );
	echo '</div>';
}

//include the after content template
locate_template( array( 'includes/html-after-content.php' ), true, true );

get_footer();
?>
