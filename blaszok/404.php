<?php
/**
 * The 404 base for MPC Themes
 *
 * Displays 404 error.
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 */

get_header();

?>

<div id="mpcth_main">
	<div id="mpcth_main_container">
		<?php get_sidebar(); ?>
		<div id="mpcth_content_wrap">
			<div id="mpcth_content">
				<article id="post-0" class="mpcth-post mpcth-post-not-found">
					<header class="mpcth-post-header">
						<div class="mpcth-post-thumbnail">

						</div>
						<?php mpcth_breadcrumbs(); ?>
						<h3 class="mpcth-post-title">
							<?php _e('404 Error', 'mpcth'); ?>
						</h3>
						<div class="mpcth-post-meta">

						</div>
					</header>
					<section class="mpcth-post-content">
						<?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mpcth'); ?>
					</section>
					<footer class="mpcth-post-footer">

					</footer>
				</article>
			</div><!-- end #mpcth_content -->
		</div><!-- end #mpcth_content_wrap -->
	</div><!-- end #mpcth_main_container -->
</div><!-- end #mpcth_main -->

<?php get_footer();