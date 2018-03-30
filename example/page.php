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

global $mpcth_options;
global $ID;

// get page meta
$page_meta = get_post_custom($ID);

// get sidebar position
if(isset($page_meta['custom_sidebar_position']) && $page_meta['custom_sidebar_position'][0] == 'on' && isset($page_meta['sidebar_position']))
	$sidebar_position = $page_meta['sidebar_position'][0]; /* right, left or none */
elseif(isset($mpcth_options) && isset($mpcth_options['mpcth_sidebar']))
	$sidebar_position = $mpcth_options['mpcth_sidebar'];
else
	$sidebar_position = 'none';

?>

	<!-- Display menu on the side and logo (if set in settings ) -->
	<?php get_template_part('mpc-wp-boilerplate/php/parts/side-menu'); ?>

	<div id="mpcth_page_container" class="mpcth-sidebar-<?php echo $sidebar_position ?>">

		<div id="mpcth_page_content">

			<div id="mpcth_page_articles">

				<?php if (have_posts()) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>"  <?php post_class('blog-post'); ?> >
							<?php mpcth_add_corners(); ?>
							<?php the_content('', true, ''); ?>
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
				<div class="mpcth-clear-fix"></div>
				<?php if(comments_open()) comments_template('', true); ?>
			</div> <!-- end #mpcth_page_articles -->

			<?php if($sidebar_position != "none")
				get_sidebar(); ?>
		</div><!-- end #mpcth_page_content -->

	</div><!-- #mpcth_page_container -->

<?php get_footer(); ?>