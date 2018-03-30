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

<?php if ( geode_get_page_template()!='default' ) {
	locate_template( geode_get_page_template(), true );
} else { ?>
	<?php get_template_part( 'title', '' ); ?>
	<div class="site-content cf site-main side-template archive-list">
		<div id="primary" class="align<?php echo $align; ?>" data-delay="0">
			<div id="content" role="main">

				<div class="archive-list">
				<?php
				$layout = apply_filters('geode_loop_category_data','masonry');
				$datagrid = '';
				if ( $layout == 'masonry' ) {
					$datagrid = 'data-grid="' . $layout .'"';
				}
				?>
					<div class="blog-isotope-grid" <?php echo $datagrid; ?>>
						<?php if ( have_posts() ) :
							// Start the Loop.
							while ( have_posts() ) : the_post();

								if ( is_search() )
									get_template_part( 'content', '' );
								else
									get_template_part( 'content', get_post_format() );

							endwhile;

						else :
							get_template_part( 'content', 'none' );

						endif; ?>
					</div><!-- .blog-isotope-grid -->

					<?php geode_pagenavi(); ?>
							
				</div><!-- .archive-list -->

			</div><!-- #content -->
		</div><!-- #primary -->

		<?php geode_sidebar('right'); ?>
	</div><!-- .site-content -->
	<?php get_footer(); ?>
<?php } ?>
