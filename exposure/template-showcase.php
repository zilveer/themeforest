<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 * Template name: Showcase
 */
get_header(); ?>

	<?php
		$slideshow = new THB_Slideshow( thb_get_page_ID() );
		$slides = $slideshow->getSlides();
		$more_than_one_slide = count($slides) > 1;

		$nav = array();

		if( $more_than_one_slide ) {
			$nav[] = 'drawer';
		}

		$nav[] = 'fit';

		if( $more_than_one_slide ) {
			$nav[] = 'prev';
			$nav[] = 'next';
		}

		thb_get_template_part('part-nav', array(
			'controls' => $nav
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