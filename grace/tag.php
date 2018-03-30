<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage grace
 * 
 */

get_header();
st_before_content($columns='');

?>
<h1><?php printf( __( 'Tag Archives: %s', 'grace' ), '<span class="bolder">' . single_tag_title( '', false ) . '</span>' );?></h1>
<?php
get_template_part( 'loop', 'tag' );
st_after_content();
get_sidebar();
get_footer();
?>