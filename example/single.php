<?php
/**
 *
 * The default page template.
 *
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 *
 */

get_header();

global $post;
global $mpcth_options;

/* Get custom post data */
$post_meta = get_post_custom($post->ID);
$post_type = $post->post_type;

// get sidebar position
if(isset($post_meta['sidebar_position']))
	$sidebar_position = $post_meta['sidebar_position'][0]; /* right, left or none */
elseif(isset($mpcth_options) && isset($mpcth_options['mpcth_blog_post_sidebar']))
	$sidebar_position = $mpcth_options['mpcth_blog_post_sidebar'];
else
	$sidebar_position = 'none';

// get post elements display order
if($post_type == 'portfolio')
	$postOrder = $mpcth_settings['portfolioPostLayoutOrder'];
else
	$postOrder = $mpcth_settings['blogPostLayoutOrder'];

?>

<!-- Display menu on the side and logo (if set in settings ) -->
<?php get_template_part('mpc-wp-boilerplate/php/parts/side-menu'); ?>

<div id="mpcth_page_container" class="mpcth-sidebar-<?php echo $sidebar_position ?> single-<?php echo $post_type; ?>">

		<div id="mpcth_page_content">

			<div id="mpcth_page_articles" class="mpcth-single-post">

				<?php //mpcth_add_corners(); ?>

				<?php if (have_posts()) : ?>
					<?php while ( have_posts() ) : the_post();
						$post_format = get_post_format();

						if($post_format == '')
							$post_format = 'standard'; ?>

						<article id="post-<?php the_ID(); ?>"  <?php post_class('blog-post'); ?> >
							<?php foreach($postOrder as $value) {
								switch($value) {
									case 'thumbnail':?>
										<div class="mpcth-post-thumbnail">
											<span class="mpcth-corner-tl"></span>
											<span class="mpcth-corner-tr"></span>
											<?php if(isset($post_meta['display_in_single_view']) && $post_meta['display_in_single_view'][0] == 'on') {
												get_template_part('mpc-wp-boilerplate/php/parts/post-formats');
											 } ?>
											<?php mpcth_add_fancybox($post_meta, 'blog'); ?>
										</div>

										<div class="mpcth-post-content <?php echo (has_post_thumbnail() ? 'mpcth-post-with-image' : ''); ?>">
										<span class="mpcth-corner-bl"></span>
										<span class="mpcth-corner-br"></span>
									<?php break;
									case 'title':?>
										<?php if($post_format != 'aside' && $post_format != 'link' && $post_format != 'quote') { ?>
											<header>
												<h2 class="mpcth-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
													<?php the_title(); ?>
												</a></h2>
											</header>
										<?php } ?>
									<?php break;
									case 'meta':?>
										<?php get_template_part('mpc-wp-boilerplate/php/parts/post-meta'); ?>

									<?php break;
									case 'content':?>
										<?php the_content(); ?>

										<?php if(function_exists('zilla_share') && $mpcth_options['mpcth_share'] == '1') { ?>
											<?php zilla_share(); ?>
										<?php } ?>

										<span class="mpcth-prev-post"><?php previous_post_link('<span></span> %link'); ?></span>
										<span class="mpcth-next-post"><?php next_post_link('%link <span></span>'); ?></span>
										</div>
									<?php break; ?>
							<?php } // end switch
							} // end foreach ?>

							<!-- Required by wordpress -->
							<div class="mpcth-clear-fix"></div>
							<?php next_posts_link(); ?>
							<?php previous_posts_link(); ?>

							<?php wp_link_pages(); ?>


							<?php if(comments_open()) comments_template('', true); ?>

						</article>
					<?php endwhile; ?>
				<?php else : ?>
					<article id="post-0" class="post no-results not-found ">
						<div class="mpcth-post-content">
							<header>
								<h3 class="mpcth-post-title"><?php _e('Nothing Found', 'mpcth'); ?></h3>
							</header><!-- end .entry-header -->
							<p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mpcth'); ?></p>
						</div><!-- end .entry-content -->
					</article><!-- end #post-0 -->
				<?php endif; ?>
			</div> <!-- end #mpcth_page_articles -->

			<?php if($sidebar_position != "none")
				get_sidebar(); ?>
		</div><!-- end #mpcth_page_content -->

	</div><!-- #mpcth_page_container -->

<?php get_footer(); ?>