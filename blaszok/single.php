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
global $mpcth_options;
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

						$hide_thumbnail = get_field('mpc_hide_post_thumbnail');
						$show_author_box = get_field('mpc_show_author_box');

						if( empty( $show_author_box ) )
							$show_author_box = $mpcth_options['mpcth_enable_author_box'];
					?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('mpcth-post'); ?> >
							<header class="mpcth-post-header">
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
								<?php if (! $hide_thumbnail) { ?>
									<div class="mpcth-post-thumbnail">
										<?php get_template_part('post-format', $post_format); ?>
									</div>
								<?php } ?>
							</header>
							<section class="mpcth-post-content">
								<div class="mpcth-post-content-wrap">
									<?php the_content(); ?>
								</div>
								<?php wp_link_pages(); ?>
								<div class="mpcth-post-meta">
									<?php mpcth_add_meta(); ?>
								</div>
								<?php
									$tags = get_the_tag_list('', __(', ', 'mpcth'));
									if ($tags) {
										echo '<div class="mpcth-post-tags">';
											echo __('Tagged as ', 'mpcth') . $tags;
										echo '</div>';
									}
								?>
								<?php
									if( $show_author_box ) {
										$author		= get_the_author_meta( 'ID' );
										$author_bio = get_the_author_meta( 'description' );
									?>
									<div class="mpcth-post-author-box">
										<div class="mpcth-author-box-wrapper">
										<?php echo get_avatar( $author, '480' ); ?>
											<h4><a href="<?php echo get_author_posts_url( $author ); ?>"><?php the_author(); ?></a></h4>
											<p class="mpcth-author-box-bio">
												<?php echo $author_bio; ?>
											</p>
										</div>
									</div>
								<?php } ?>
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