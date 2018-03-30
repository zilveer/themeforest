<?php
/**
* Skeleton WordPress Theme Framework
* Author: Simple Themes
* URL: www.simplethemes.com
 * The template for displaying 404 pages (Not Found).
 *
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */

get_header();
st_before_content($columns='');
?>
	<h1><?php echo __( 'Not Found', 'grace' ); ?></h1>
	<p><?php echo __( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'grace' ); ?></p>
	<?php get_search_form(); ?>
	
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php
st_after_content();
get_sidebar();
get_footer();
?>