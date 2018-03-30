<?php
/**
 * The Single base for MPC Themes
 *
 * Displays single post.
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 */

get_header();

global $page_id;
global $paged;

?>

<div id="mpcth_main">
	<div id="mpcth_main_container">
		<?php get_sidebar(); ?>
		<div id="mpcth_content_wrap">
			<div id="mpcth_content">
				<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post();
						$post_meta = get_post_custom($post->ID);
						$post_format = get_post_format();

						if($post_format === false)
							$post_format = 'standard';

						$title = get_the_title();
						$link = get_field('mpc_link_url');
						if($post_format == 'link' && isset($link))
							$title = '<a href="' . $link . '" class="mpcth-color-main-color-hover" title="' . get_the_title() . '">' . get_the_title() . '<i class="fa fa-external-link"></i></a>';
					?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('mpcth-post'); ?> >
							<header class="mpcth-post-header">
								<div class="mpcth-top-side">
									<div class="mpcth-post-pagination">
									<?php
										if (! is_rtl()) {
											previous_post_link('%link', '<i class="fa fa-angle-left"></i>');
											next_post_link('%link', '<i class="fa fa-angle-right"></i>');
										} else {
											next_post_link('%link', '<i class="fa fa-angle-right"></i>');
											previous_post_link('%link', '<i class="fa fa-angle-left"></i>');
										}
									?>
									</div>
									<?php mpcth_breadcrumbs(); ?>
									<h1 class="mpcth-post-title">
										<span class="mpcth-color-main-border">
											<?php echo $title; ?>
										</span>
									</h1>
								</div>
								<?php if (! post_password_required()) { ?>
								<div class="mpcth-left-side">
									<div class="mpcth-post-thumbnail">
										<?php get_template_part('post-format', $post_format); ?>
									</div>
								</div>
								<?php } ?>
							</header>
							<section class="mpcth-post-content">
								<a class="mpcth-post-date mpcth-color-main-color-hover" href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><time datetime="<?php echo get_the_date('c'); ?>"><?php the_time(get_option('date_format')); ?></time></a>
								<?php the_content(); ?>
							</section>
							<footer class="mpcth-post-footer">
								<?php if (comments_open()) { ?>
									<div id="mpcth_comments">
										<?php comments_template('', true); ?>
									</div>
								<?php } ?>
							</footer>
						</article>
					<?php endwhile; ?>
				<?php else : ?>
					<article id="post-0" class="mpcth-post mpcth-post-not-found">
						<header class="mpcth-post-header">
							<div class="mpcth-post-thumbnail">

							</div>
							<h3 class="mpcth-post-title">
								<?php _e('Nothing Found', 'mpcth'); ?>
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
				<?php endif; ?>
			</div><!-- end #mpcth_content -->
		</div><!-- end #mpcth_content_wrap -->
	</div><!-- end #mpcth_main_container -->
</div><!-- end #mpcth_main -->

<?php get_footer();