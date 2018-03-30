<?php
/**
 * Template Name: Double sidebar Page Template
 *
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */

get_header(); ?>

	<?php get_template_part( 'title', '' ); ?>

	<?php $archive_list = is_home() ? 'archive-list' : ''; ?>

	<div class="site-content cf site-main double-side-template <?php echo $archive_list; ?>">
		<?php geode_sidebar('left'); ?>

		<div id="primary" class="alignleft" data-delay="0">
			<div id="content" role="main">

			<?php if (is_home() || is_category()) { ?>
				<?php
				$layout = apply_filters('geode_loop_category_data','masonry');
				$datagrid = '';
				if ( $layout == 'masonry' ) {
					$datagrid = 'data-grid="' . $layout .'"';
				}
				?>
				<div class="blog-isotope-grid archive-list" <?php echo $datagrid; ?>>
			<?php } ?>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php if ( is_home() || is_category() ) {

							get_template_part( 'content', get_post_format() );

						} elseif ( is_search() ) {

							get_template_part( 'content', '' );

						} else {
							get_template_part( 'content', 'page' );
							comments_template( '', true );
						} ?>
						<?php endwhile; ?>

					<?php else :

					if ( is_home() || is_search() || is_category() ) get_template_part( 'content', 'none' );

					endif; ?>

			<?php if (is_home() || is_category()) { ?>
				</div><!-- .blog-isotope-grid -->
			<?php } ?>
				
				<?php geode_pagenavi(); ?>
						
			</div><!-- #content -->
		</div><!-- #primary -->

		<?php geode_sidebar('right'); ?>
	</div><!-- .site-content -->

<?php get_footer(); ?>