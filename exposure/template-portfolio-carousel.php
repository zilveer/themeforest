<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 * Template name: Portfolio Carousel
 */
get_header(); ?>

	<?php thb_works_query( array( 'posts_per_page' => 3) ); ?>

	<script type="text/javascript" id="pager">
		var load_url = '<?php echo add_query_arg("paged", get_query_var("paged") + 1); ?>',
			total_posts = <?php echo $wp_query->found_posts; ?>
	</script>

	<?php thb_page_before(); ?>

		<?php thb_page_start(); ?>

			<div class="thb-content-wrapper">

			<?php
				if( have_posts() ) : $i=1; while( have_posts() ) : the_post();
			?>

				<?php
					global $post;

					$work_id = get_the_ID();

					$work_featured_image = thb_get_featured_image($work_id, 'large');
					$work_categories = wp_get_object_terms($work_id, 'portfolio_categories');

					$itemclass = $cats = array();
					// $itemclass = thb_get_post_classes( $i, array(''), $num_cols );

					if( empty($work_featured_image) ) {
						$itemclass[] = 'wout-featured-image';
					}

					foreach( $work_categories as $cat ) {
						$itemclass[] = $cat->slug;
						$cats[] = $cat->name;
					}

					$categories = join($cats, ", ");
				?>
				<?php thb_post_before(); ?>

				<div class="item <?php echo implode(" ", $itemclass); ?> hentry" data-pager="<?php echo add_query_arg("paged", get_query_var("paged") + 1); ?>">
					<?php thb_post_start(); ?>

					<?php if( !empty($work_featured_image) ) : ?>
						<a href="<?php the_permalink(); ?>" class="item-thumb-stretch" title="<?php echo get_the_title(); ?>">
							<span class="thb-overlay"></span>
							<div class="slide" data-type="image">
								<img src="<?php echo $work_featured_image; ?>" alt="">
							</div>
						</a>
					<?php endif; ?>

					<article class="data">
						<header class="item-header">
							<h1>
								<a href="<?php the_permalink(); ?>" rel="permalink">
									<?php the_title(); ?>
								</a>
							</h1>
						</header>
						<p class="item-footer">
							<?php echo $categories; ?>
						</p>
						<a class="thb-btn small" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('View', 'thb_text_domain'); ?></a>
					</article>

					<?php thb_post_end(); ?>
				</div>

				<?php thb_post_after(); ?>

			<?php $i++; endwhile; endif; ?>

			</div>

		<?php thb_page_end(); ?>

	<?php thb_page_after(); ?>

	<?php
		thb_get_template_part('part-nav', array(
			'controls'          => array('prev', 'next'),
			'disabled_controls' => true,
			'total_posts'       => $wp_query->found_posts
		));
	?>

<?php if( function_exists('dynamic_sidebar') && is_active_sidebar(thb_get_page_sidebar()) ) : ?>
	<div class="thb-main-sidebar">
		<div class="thb-main-sidebar-wrapper">
			<?php thb_page_sidebar(); ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>