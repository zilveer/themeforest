<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 */

get_header(); ?>

<div class="wrapper">

	<header class="pageheader">
		<h1><?php _e('404', 'thb_text_domain'); ?></h1>
		<h2><?php _e('page not found', 'thb_text_domain'); ?></h2>
	</header><!-- /.pageheader -->

	<?php thb_page_before(); ?>

		<?php thb_page_start(); ?>

		<div class="thb-text">
			<p id="disclaimer"><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'thb_text_domain' ); ?></p>
			<?php get_search_form(); ?>
			<script type="text/javascript">
				// focus on search field after it has loaded
				document.getElementById('s') && document.getElementById('s').focus();
			</script>
		</div>

		<?php thb_page_end(); ?>

	<?php thb_page_after(); ?>

<?php get_footer(); ?>