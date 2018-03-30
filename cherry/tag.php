<?php
/**
 * The template for displaying Tag Archive pages.
 */

get_header();
st_before_content($columns='');

?>
<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
get_template_part( 'loop', 'tag' );
st_after_content();
get_sidebar();
get_footer();
?>