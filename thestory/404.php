<?php
/**
 * This is the page template for 404 Page not found response.
 */
get_header();
//get all the page data needed and set it to an object that can be used in other files
$pexeto_page=array();
$pexeto_page['sidebar']=pexeto_option( 'archive_sidebar' );
$pexeto_page['slider']='none';
$pexeto_page['layout']=pexeto_option( 'archive_layout' );
$pexeto_page['title']=__('Page not found', 'pexeto');

//include the before content template
locate_template( array( 'includes/html-before-content.php'), true, true ); ?>

<div class="content-box">
	<div class="aligncenter" id="not-found">
		<h1>404</h1>
		<h2><?php _e('The requested page has not been found', 'pexeto'); ?></h2>
		<?php get_search_form(true); ?>
	</div>
</div>
		
<?php 
		
//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );
get_footer();

?>

