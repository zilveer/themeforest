<?php
/**
 * Registers widget areas.
 *
 * 1. One sidebar called 'sidebar-1'.
 * 2. Multiple footer widget areas based on user configuration
 * in admin panel.
 *
 * @return void
 */
function flow_widgets_init() {

	// Create Sidebar Widget Area
	$args = array(
		'name'          => sprintf( __('Sidebar %d', 'flowthemes'), 1 ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	);
	register_sidebars( 1, $args );
	
	// Create Footer Widget Areas
	$footer_col_countcustom = get_option( 'footer_col_countcustom' );
	$footer_columns_count_t = array();
	if ( $footer_col_countcustom ) {
		$footer_columns_count_t = explode( ',', $footer_col_countcustom );
	}
	
	$r = $footer_columns_count_t;
	$r_items_count = count( $r );
	
	for ( $i = 1; $r_items_count >= $i; $i++ ) {
		$args = array(
			'name'          => sprintf( __('Footer %d', 'flowthemes'), $i ),
			'id'            => "flow-footer-$i",
			'description'   => sprintf( __( 'This footer column has the following CSS classes: %s', 'flowthemes' ), $r[ $i - 1 ] ),
			'class'         => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>' 
		);
		
		register_sidebar( $args );
	}
}
add_action( 'widgets_init', 'flow_widgets_init' );
