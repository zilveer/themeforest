<?php
/**
 * @package WordPress
 * @subpackage One
 * @since One 1.0
 */
$thb_title = __('404', 'thb_text_domain');
$thb_subtitle = __('Page not found', 'thb_text_domain');

get_header(); ?>

<?php thb_page_before(); ?>

<div id="page-content">

<?php thb_page_start(); ?>

	<?php thb_get_template_part('partials/partial-pageheader', array( 'thb_title' => $thb_title, 'thb_subtitle' => $thb_subtitle, 'show_featured_image' => false ) ); ?>

		<div class="thb-section-container <?php echo thb_pagecontent_skin(); ?>">

			<div id="main-content">

				<div class="thb-text">
					<p>
						<?php _e( 'Apologies, but the page you requested could not be found.', 'thb_text_domain' ); ?><br />
						<?php _e( 'Perhaps searching will help.', 'thb_text_domain' ); ?>
					</p>

					<?php get_search_form(); ?>
					<script type="text/javascript">
						// focus on search field after it has loaded
						document.getElementById('s') && document.getElementById('s').focus();
					</script>
				</div>

			</div>

		</div>

	<?php thb_page_end(); ?>

	</div>

<?php thb_page_after(); ?>

<?php get_footer(); ?>