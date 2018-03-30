<?php
/**
 *  Register and config widgets for the theme
 * 
 * @package toranj
 * @author owwwlab
 */


/**
 * ----------------------------------------------------------------------------------------
 * Register the widget areas.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owlab_widget_init' ) ) {
	function owlab_widget_init() {
		if ( function_exists( 'register_sidebar' ) ) {
			register_sidebar(
				array(
					'name' => __( 'Main Widget Area', 'toranj' ),
					'id' => 'sidebar-1',
					'description' => __( 'Appears on posts and pages.', 'toranj' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div> <!-- end widget -->',
					'before_title' => '<h5 class="widgettitle">',
					'after_title' => '</h5>',
				)
			);

			register_sidebar(
				array(
					'name' => __( 'Footer Widget Area', 'toranj' ),
					'id' => 'sidebar-2',
					'description' => __( 'Appears on the footer.', 'toranj' ),
					'before_widget' => '<div id="%1$s" class="%2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h5 class="widget-title">',
					'after_title' => '</h5>',
				)
			);

			register_sidebar(
				array(
					'name' => __( 'WooCommerce sidebar', 'toranj' ),
					'id' => 'shop-sidebar-1',
					'description' => __( 'Appears on WooCommerce pages', 'toranj' ),
					'before_widget' => '<div id="%1$s" class="widget  %2$s">',
					'after_widget' => '</div> <!-- end widget -->',
					'before_title' => '<h5 class="widget-title lined">',
					'after_title' => '</h5>',
				)
			);

			/**
			 * add dynamic sidebars
			 */
			if (ot_get_option('incr_sidebars')){
			    $pp_sidebars = ot_get_option('incr_sidebars');
			    foreach ($pp_sidebars as $pp_sidebar) {

			        register_sidebar(array(
			            'name' => $pp_sidebar["title"],
			            'id' => $pp_sidebar["id"],
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
			            'after_widget' => '</div></div>',
			            'before_title' => '<h3 class="widgettitle lined">',
			            'after_title' => '</h3><div class="widget-contents">',
			        ));
			    }
			}
		}
	}

	add_action( 'widgets_init', 'owlab_widget_init' );
}