<?php
/**
 * The Sidebar for single listing items.
 *
 * @package Listify
 */

$defaults = array(
	'before_widget' => '<aside class="widget widget-job_listing">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title widget-title-job_listing %s">',
	'after_title'   => '</h3>',
	'widget_id'     => ''
);
?>
	<div id="secondary" class="widget-area col-md-4 col-sm-5 col-xs-12" role="complementary">
		<?php if ( ! dynamic_sidebar( 'single-job_listing' ) ) : ?>

			<?php
				global $listify_strings;

				the_widget(
					'Listify_Widget_Listing_Author',
					array(
						'descriptor' => sprintf( __( '%s Owner', 'listify' ), $listify_strings->label( 'singular' ) ),
						'biography' => true,
						'image' => 'avatar',
						'display-contact' => true,
						'display-profile' => true
					),
					$defaults
				);

				the_widget(
					'Listify_Widget_Listing_Gallery',
					array(
						'title' => __( 'Photo Gallery', 'listify' ),
						'icon'  => 'android-camera',
						'limit' => 8
					),
					wp_parse_args( array(
						'before_widget' => '<aside class="widget widget-job_listing listify_widget_panel_listing_gallery">',
					), $defaults )
				);

				the_widget(
					'Listify_Widget_Listing_Business_Hours',
					array(
						'title' => __( 'Hours of Operation', 'listify' ),
						'icon'  => 'clock'
					),
					wp_parse_args( array(
						'before_widget' => '<aside class="widget widget-job_listing listify_widget_panel_listing_business_hours">',
					), $defaults )
				);
			?>

		<?php endif; ?>
	</div><!-- #secondary -->
