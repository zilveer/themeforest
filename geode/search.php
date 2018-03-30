<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
*/

get_header(); ?>

<?php
	$align = apply_filters('geode_sidebar_position', get_option('pix_style_main_sidebar_position')) == 'right'  ? 'left' : 'right';
?>

<?php get_template_part( 'title', '' ); ?>
<div class="site-content cf site-main side-template archive-list">
	<div id="primary" class="align<?php echo $align; ?>" data-delay="0">
		<div id="content" role="main">
			<div class="row" data-cols="1">
				<div class="row-inside">
					<div class="column" data-col="1">
					<?php if ( have_posts() ) : ?>
					<div class="blog-isotope-grid" data-grid="<?php echo apply_filters('geode_blog_grid', 'masonry'); ?>">
						<?php // Start the Loop.
						while ( have_posts() ) : the_post();

							if ( is_search() )
								get_template_part( 'content', '' );
							else
								get_template_part( 'content', get_post_format() );

						endwhile; ?>
					</div>

					<?php else : ?>

						<h4>
							<?php _e('Oops! That page can\'t be found.', 'geode'); ?>
						</h4>
						<p>
							<?php _e('It looks like nothing was found at this location. Maybe you want to try a search?', 'geode'); ?>
						</p>
						<hr>
						<p>&nbsp;</p>
						<?php if ( shortcode_exists( 'sc-searchform' ) )
							echo do_shortcode('[sc-searchform]'); ?>
					<?php endif; ?>
					</div>
				</div><!-- .row-inside -->
			</div><!-- .row -->
		</div><!-- #content -->
	</div><!-- #primary -->

<?php geode_sidebar('right'); ?>
</div><!-- .site-content -->

<?php get_footer(); ?>