<?php

if ( ! function_exists( 'unicase_dokan_scripts' ) ) {
	function unicase_dokan_scripts() {
		global $unicase_version;

		wp_enqueue_style( 'unicase-dokan-style', get_template_directory_uri() . '/assets/css/dokan.css', '', $unicase_version );
	}
}

if( ! function_exists( 'unicase_dokan_get_sidebar' ) ) {
	function unicase_dokan_get_sidebar() {
		$store_user   = get_userdata( get_query_var( 'author' ) );
		$store_info   = dokan_get_store_info( $store_user->ID );
		$map_location = isset( $store_info['location'] ) ? esc_attr( $store_info['location'] ) : '';
		$scheme       = is_ssl() ? 'https' : 'http';

		if ( dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' ) == 'off' ) {
			?>
	        <div id="dokan-secondary" class="dokan-clearfix dokan-store-sidebar" role="complementary" style="margin-right:3%;">
	            <div class="dokan-widget-area widget-collapse">
	                 <?php do_action( 'dokan_sidebar_store_before', $store_user, $store_info ); ?>
	                <?php
	                if ( ! dynamic_sidebar( 'sidebar-store' ) ) {

	                    $args = array(
	                        'before_widget' => '<aside class="widget">',
	                        'after_widget'  => '</aside>',
	                        'before_title'  => '<h3 class="widget-title">',
	                        'after_title'   => '</h3>',
	                    );

	                    if ( class_exists( 'Dokan_Store_Location' ) ) {
	                        the_widget( 'Dokan_Store_Category_Menu', array( 'title' => __( 'Store Category', 'unicase' ) ), $args );
	                        if( dokan_get_option( 'store_map', 'dokan_general', 'on' ) == 'on' ) {
	                            the_widget( 'Dokan_Store_Location', array( 'title' => __( 'Store Location', 'unicase' ) ), $args );
	                        }
	                        if( dokan_get_option( 'contact_seller', 'dokan_general', 'on' ) == 'on' ) {
	                            the_widget( 'Dokan_Store_Contact_Form', array( 'title' => __( 'Contact Seller', 'unicase' ) ), $args );
	                        }
	                    }

	                }
	                ?>

	                <?php do_action( 'dokan_sidebar_store_after', $store_user, $store_info ); ?>
	            </div>
	        </div><!-- #secondary .widget-area -->
	    	<?php
	    } else {
	        get_sidebar( 'store' );
	    }
	}
}

if( ! function_exists( 'unicase_dokan_layout_args' ) ) {
	function unicase_dokan_layout_args( $args ) {
		if( dokan_is_store_page() ){
			$args['sidebar_action'] = 'unicase_dokan_sidebar';
		}

		return $args;
	}
}