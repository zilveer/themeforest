<?php
/**
 * @package WordPress
 * @subpackage One
 * @since One 1.0
 */
get_header(); ?>

	<?php thb_page_before(); ?>

		<?php thb_page_start(); ?>

		<div id="page-content">

			<div class="thb-section-container <?php echo thb_pagecontent_skin(); ?>">

				<div id="main-content">

					<?php get_template_part('loop/blog', 'classic'); ?>

				</div>

				<?php thb_display_sidebar('post-sidebar', 'main'); ?>

			</div>

		</div>

		<?php thb_page_end(); ?>

	<?php thb_page_after(); ?>

<?php get_footer(); ?>