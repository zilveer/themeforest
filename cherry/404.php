<?php
/**
 * The template for displaying 404 pages (Not Found).
*/

get_header();
st_before_content($columns='');
?>
	<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'cherry' ); ?></p>
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