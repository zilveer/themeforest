<?php
/**
 * The template for displaying Category Archive pages.
 */

get_header();
st_before_content($columns='');

?>
	<?php
 
	/* Run the loop for the category page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-category.php and that will be used instead.
	 */
	get_template_part( 'loop', 'category' );
	st_after_content();
	get_sidebar();
	get_footer();
?>
