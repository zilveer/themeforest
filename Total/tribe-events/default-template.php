<?php
/**
 * Default Page Template for "The Events Calendar Plugin"
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.0
 */

get_header(); ?>

	<div id="content-wrap" class="container clr">

		<?php wpex_hook_primary_before(); ?>

		<section id="primary" class="content-area clr">

			<?php wpex_hook_content_before(); ?>

			<main id="content" class="clr site-content" role="main">

				<?php wpex_hook_content_top(); ?>

				<article class="clr">

					<div id="tribe-events-pg-template">
						<?php tribe_events_before_html(); ?>
						<?php tribe_get_view(); ?>
						<?php tribe_events_after_html(); ?>
					</div> <!-- #tribe-events-pg-template -->

				</article><!-- #post -->

				<?php wpex_hook_content_bottom(); ?>

			</main><!-- #content -->

			<?php wpex_hook_content_after(); ?>

		</section><!-- #primary -->

		<?php wpex_hook_primary_after(); ?>

	</div><!-- #content-wrap -->

<?php get_footer(); ?>