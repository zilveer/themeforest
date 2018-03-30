<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */

get_header();
st_before_content($columns='');

?>
	
<h1><?php
		printf( __( '%s', 'grace' ), single_cat_title( '', false ) );
	?></h1>
	<?php
	get_template_part( 'loop', 'category' );
	st_after_content();
	get_sidebar();
	get_footer();
?>
