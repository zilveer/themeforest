<?php
/**
 * The Archive base for MPC Themes
 *
 * Displays all archive posts.
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 */

get_header();

global $page_id;
global $paged;
global $wp_query;
global $mpcth_options;

$query = $wp_query;

$blog_layout = $mpcth_options['mpcth_archive_layout'] = 'full';

if (get_field('mpc_blog_layout'))
	$blog_layout = get_field('mpc_blog_layout');

$blog_columns = 3;
if (get_field('mpc_blog_columns'))
	$blog_columns = get_field('mpc_blog_columns');

if ($blog_layout == 'small') {
	function mpcth_excerpt_length($length) {
		return 125;
	}
	add_filter('excerpt_length', 'mpcth_excerpt_length', 999);
}
if ($blog_layout == 'masonry' || $blog_layout == 'masonry_load_more') {
	function mpcth_excerpt_length($length) {
		return 40;
	}
	add_filter('excerpt_length', 'mpcth_excerpt_length', 999);
}

$blog_load_more = false;
if ($blog_layout == 'masonry_load_more') {
	$blog_layout = 'masonry';
	$blog_load_more = true;
}

//if (isset($mpcth_options['mpcth_enable_large_archive_thumbs']) && $mpcth_options['mpcth_enable_large_archive_thumbs']) $layout = 'full';

?>

<div id="mpcth_main">
	<div id="mpcth_main_container">
		<?php get_sidebar(); ?>
		<div id="mpcth_content_wrap" class="<?php if ($blog_layout == 'masonry') echo 'mpcth-masonry-blog' ?> <?php if ($blog_load_more) echo 'mpcth-load-more' ?>">
			<header id="mpcth_archive_header">
				<?php mpcth_breadcrumbs(); ?>
				<h3 id="mpcth_archive_title" class="mpcth-deco-header"><span>
				<?php
					echo __('Archives', 'mpcth');
					if (is_day())
						echo __(' for ', 'mpcth') . '<em class="mpcth-color-main-color">' . get_the_date() . '</em>';
					elseif (is_month())
						echo __(' for ', 'mpcth') . '<em class="mpcth-color-main-color">' . get_the_date('F Y') . '</em>';
					elseif (is_year())
						echo __(' for ', 'mpcth') . '<em class="mpcth-color-main-color">' . get_the_date('Y') . '</em>';
				?>
				</span></h3>
			</header>
			<div id="mpcth_content" class="mpcth-blog-layout-<?php echo $blog_layout; ?><?php if ($blog_layout == 'masonry') echo ' mpcth-blog-columns-' . $blog_columns; ?>">
				<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post();
						global $more;
						$more = 0;

						$post_meta = get_post_custom($post->ID);
						$post_format = get_post_format();

						if($post_format === false)
							$post_format = 'standard';

						$url = get_permalink();
						$link = get_field('mpc_link_url');
						$banner = get_field('mpc_use_as_banner');

						if($post_format == 'link' && isset($link))
							$url = $link;

					?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('mpcth-post mpcth-waypoint'); ?> >
							<div class="mpcth-post-wrap">
								<header class="mpcth-post-header">
									<?php if( $post_format == 'link' && $banner == 'true' ) { ?>
										<a href="<?php echo esc_url( $url ); ?>" title="<?php the_title(); ?>">
											<div class="mpcth-post-thumbnail">
												<?php get_template_part('post-format', $post_format); ?>
											</div>
										</a>
									<?php } else { ?>
										<?php if ($blog_layout == 'masonry') { ?>
											<div class="mpcth-post-thumbnail">
												<?php get_template_part('post-format', $post_format); ?>
												<?php mpcth_add_lightbox(); ?>
											</div>
										<?php } ?>

										<?php if ($blog_layout != 'full-alt') { ?>
											<h4 class="mpcth-post-title">
												<a href="<?php echo esc_url( $url ); ?>" class="mpcth-color-main-color-hover mpcth-color-main-border" title="<?php the_title(); ?>"><?php the_title(); ?><?php echo $post_format == 'link' ? '<i class="fa fa-external-link"></i>' : ''; ?></a>
											</h4>
										<?php } ?>

										<?php if ($blog_layout != 'masonry') { ?>
											<div class="mpcth-post-thumbnail">
												<?php get_template_part('post-format', $post_format); ?>
												<?php mpcth_add_lightbox(); ?>
											</div>
										<?php } ?>

										<?php if ($blog_layout == 'full-alt') { ?>
											<h4 class="mpcth-post-title">
												<a href="<?php echo esc_url( $url ); ?>" class="mpcth-color-main-color-hover mpcth-color-main-border" title="<?php the_title(); ?>"><?php the_title(); ?><?php echo $post_format == 'link' ? '<i class="fa fa-external-link"></i>' : ''; ?></a>
											</h4>
											<span class="mpcth-post-meta">
												<?php mpcth_add_meta(); ?>
											</span>
										<?php } ?>
									<?php } ?>
								</header>

								<?php if( !( $post_format == 'link' && $banner == 'true' ) ) { ?>
								<section class="mpcth-post-content">
									<?php the_excerpt(); ?>
								</section>
								<footer class="mpcth-post-footer">
									<?php if ($blog_layout != 'full-alt') { ?>
										<span class="mpcth-post-meta">
											<?php mpcth_add_meta(); ?>
										</span>
									<?php } ?>
									<a class="mpcth-read-more mpcth-color-main-background-hover" href="<?php the_permalink(); ?>"><?php _e('Continue Reading', 'mpcth'); ?><i class="fa fa-angle-<?php echo is_rtl() ? 'left' : 'right'; ?>"></i></a>
								</footer>
								<?php } ?>
							</div>
						</article>
					<?php endwhile; ?>
				<?php else : ?>
					<article id="post-0" class="mpcth-post mpcth-post-not-found">
						<header class="mpcth-post-header">
							<h3 class="mpcth-post-title">
								<?php _e('Nothing Found', 'mpcth'); ?>
							</h3>
							<div class="mpcth-post-thumbnail">

							</div>
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
			<?php if ($query->max_num_pages > 1) { ?>
			<div id="mpcth_pagination">
				<?php
					if ($blog_load_more)
						mpcth_display_load_more($query);
					else
						mpcth_display_pagination($query);
				?>
			</div>
			<?php } ?>
		</div><!-- end #mpcth_content_wrap -->
	</div><!-- end #mpcth_main_container -->
</div><!-- end #mpcth_main -->

<?php get_footer();