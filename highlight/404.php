<?php
/**
 * This is the page template for 404 Page not found response.
 */
get_header();

		$subtitle='';
		$slider='none';
		$layout=get_opt('_blog_layout');
		$sidebar=get_opt('_blog_sidebar');
		
		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true ); ?>

		<h2><?php echo pex_text('_404_text'); ?></h2>
		
<?php 
		
//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );
get_footer();

?>

