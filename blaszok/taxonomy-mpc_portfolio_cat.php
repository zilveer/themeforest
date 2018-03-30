<?php
/**
 * The Category base for MPC Themes
 *
 * Displays all category posts.
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 */

get_header();

global $page_id;
global $paged;
global $wp_query;

$query = $wp_query;

$layout = 'small';
if (isset($mpcth_options['mpcth_enable_large_archive_thumbs']) && $mpcth_options['mpcth_enable_large_archive_thumbs']) $layout = 'full';

$term_title = $wp_query->queried_object->name;
$term_description = $wp_query->queried_object->description;

?>

<div id="mpcth_main">
	<div id="mpcth_main_container">
		<?php get_sidebar(); ?>
		<div id="mpcth_content_wrap">
			<header id="mpcth_archive_header">
				<h3 id="mpcth_archive_title" class="mpcth-deco-header"><span><?php echo __('Archives for ', 'mpcth') . '<em class="mpcth-color-main-color">' . $term_title . '</em>'; ?></span></h3>

				<?php if (!empty($term_description)) { ?>
					<div id="mpcth_archive_description"><?php echo $term_description; ?></div>
				<?php } ?>
			</header>
			<div id="mpcth_content" class="mpcth-blog-layout-<?php echo $layout; ?>">
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
						if($post_format == 'link' && isset($link))
							$url = $link;

					?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('mpcth-post mpcth-waypoint'); ?> >
							<header class="mpcth-post-header">
								<h4 class="mpcth-post-title">
									<a href="<?php echo $url; ?>" class="mpcth-color-main-color-hover mpcth-color-main-border" title="<?php the_title(); ?>"><?php the_title(); ?><?php echo $post_format == 'link' ? '<i class="fa fa-external-link"></i>' : ''; ?></a>
								</h4>
								<div class="mpcth-post-thumbnail">
									<?php get_template_part('post-format', $post_format); ?>
									<?php mpcth_add_lightbox(); ?>
								</div>
							</header>
							<section class="mpcth-post-content">
								<?php the_excerpt(); ?>
							</section>
							<footer class="mpcth-post-footer">
								<span class="mpcth-post-meta">
									<?php mpcth_add_meta(); ?>
								</span>
								<a class="mpcth-read-more mpcth-color-main-background-hover" href="<?php the_permalink(); ?>"><?php _e('Continue Reading', 'mpcth'); ?><i class="fa fa-angle-right"></i></a>
							</footer>
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
				<?php mpcth_display_pagination($query); ?>
			</div>
			<?php } ?>
		</div><!-- end #mpcth_content_wrap -->
	</div><!-- end #mpcth_main_container -->
</div><!-- end #mpcth_main -->

<?php get_footer();