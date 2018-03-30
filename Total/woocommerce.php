<?php
/**
 * WooCommerce Default template
 *
 * @package Total WordPress Theme
 * @subpackage Templates
 */

get_header(); ?>

	<div id="content-wrap" class="container clr">

		<?php wpex_hook_primary_before(); ?>

		<div id="primary" class="content-area clr">

			<?php wpex_hook_content_before(); ?>

			<div id="content" class="clr site-content">

				<?php wpex_hook_content_top(); ?>

				<article class="entry-content entry clr">

					<?php woocommerce_content(); // WooCommerce content is added here ?>
					
				</article><!-- #post -->

				<?php wpex_hook_content_bottom(); ?>

			</div><!-- #content -->

			<?php wpex_hook_content_after(); ?>

		</div><!-- #primary -->

		<?php wpex_hook_primary_after(); ?>

	</div><!-- #content-wrap -->

<?php get_footer(); ?>