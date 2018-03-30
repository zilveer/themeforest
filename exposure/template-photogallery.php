<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 * Template name: Photogallery
 */
get_header(); ?>

	<?php thb_page_before(); ?>

		<?php thb_page_start(); ?>

			<div class="thb-content-wrapper">

				<?php
					$page_id = thb_get_page_ID();

					$slideshow = new THB_Slideshow( $page_id );
					$slideshow->setSize( thb_get_post_meta($page_id, 'slides_size') );
					$slides = $slideshow->getSlides();

					$slides_per_page = thb_get_post_meta($page_id, 'slides_per_page');
					$ajaxloading = !empty($slides_per_page);
					$offset = 0;

					if( $ajaxloading ) {
						$total_slides = count($slides);
						$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

						$slides = array_slice($slides, $offset * $slides_per_page, $slides_per_page);
					}
				?>

				<?php if( count($slides) > 0 ) : ?>
					<ul class="thb-photogallery-container" data-url="<?php echo add_query_arg('offset', $offset+1); ?>">
						<?php foreach( $slides as $slide ) : ?>
						<li>
							<a href="<?php echo $slide['full']; ?>" class="item-thumb" rel="prettyPhoto[gal]" title="<?php echo $slide['caption']; ?>">
								<span class="thb-overlay"></span>
								<img src="<?php echo $slide['url']; ?>" alt="">
							</a>
						</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<?php if( $ajaxloading == 1 && (($offset+1) * $slides_per_page < $total_slides) ) : ?>
					<a href="#" id="thb-infinite-scroll-button">
						<?php echo __('Load more', 'thb_text_domain'); ?>
					</a>
				<?php endif; ?>
			</div>

		<?php thb_page_end(); ?>

	<?php thb_page_after(); ?>

<?php if( function_exists('dynamic_sidebar') && is_active_sidebar(thb_get_page_sidebar()) ) : ?>
	<div class="thb-main-sidebar">
		<div class="thb-main-sidebar-wrapper">
			<?php thb_page_sidebar(); ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>