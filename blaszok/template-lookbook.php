<?php
/**
 * Template Name: Lookbook
 * The Page base for MPC Themes
 *
 * Displays single page.
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 */

get_header();

global $page_id;
global $paged;

$header_content = get_field('mpc_header_content');
$hide_title = get_field('mpc_hide_title');

?>

<div id="mpcth_main">
	<div id="mpcth_main_container">
		<div id="mpcth_content_wrap">
			<div id="mpcth_content">
				<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
						<?php if ($header_content != '') { ?>
						<div class="mpcth-page-custom-header">
							<?php echo do_shortcode($header_content); ?>
						</div>
						<?php } ?>
						<?php
						$hide_article = true;
						if (comments_open() || !$hide_title || $post->post_content != '')
							$hide_article = false;
						?>
						<?php if (! $hide_article) { ?>
						<article id="page-<?php the_ID(); ?>" <?php post_class('mpcth-page'); ?> >
							<?php if (! $hide_title) { ?>
							<header class="mpcth-page-header">
								<?php mpcth_breadcrumbs(); ?>
								<h1 class="mpcth-page-title mpcth-deco-header">
									<span class="mpcth-color-main-border">
										<?php the_title(); ?>
									</span>
								</h1>
							</header>
							<?php } ?>
							<section class="mpcth-page-content">
								<?php the_content(); ?>
							</section>
							<footer class="mpcth-page-footer">
								<?php if (comments_open()) { ?>
									<div id="mpcth_comments">
										<?php comments_template('', true); ?>
									</div>
								<?php } ?>
							</footer>
						</article>
						<?php } ?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div><!-- end #mpcth_content -->
		</div><!-- end #mpcth_content_wrap -->
	</div><!-- end #mpcth_main_container -->
</div><!-- end #mpcth_main -->

<?php get_footer();