<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page' );
}
?>
<?php

// Register widgetized areas

if (!function_exists( 'the_widgets_init')) {
	function the_widgets_init() {
		
	    if ( !function_exists( 'register_sidebar') )
	    return;

	    $df_options = get_theme_mod( 'df_options' );
	
	    register_sidebar( array( 'name' => 'Primary','id' => 'primary','description' => __('Normal full width sidebar', 'woothemes'), 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	    register_sidebar( array( 'name' => __( 'Secondary', 'woothemes' ), 'id' => 'secondary', 'description' => __( 'A secondary sidebar for your website, used in three-column layouts.', 'woothemes' ), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3>', 'after_title' => '</h3>' ) );

	    // Footer sidebar
	    $total = ( isset( $df_options[ 'footer_sidebars' ] ) ) ? $df_options[ 'footer_sidebars' ] : NULL;

		if ( $total != 0 ) {
			for ( $i = 1; $i <= intval( $total ); $i++ ) {
				register_sidebar( array( 'name' => sprintf( __( 'Footer %d', 'woothemes' ), $i ), 'id' => sprintf( 'footer-%d', $i ), 'description' => sprintf( __( 'Widgetized Footer Region %d.', 'woothemes' ), $i ), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3>', 'after_title' => '</h3>' ) );
			}
		}

	if(is_woocommerce_activated()) {
	     register_sidebar(array( 'name' => 'Shop','id' => 'shop', 'description' => __('A Shop Sidebar for your website', 'woothemes') , 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	 	}

	     register_sidebar( array( 'name' => __( 'Contact', 'woothemes' ), 'id' => 'contact', 'description' => __( 'A contact sidebar for your website, used in two or three-column layouts.', 'woothemes' ), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3>', 'after_title' => '</h3>' ) );	
	}
}

add_action( 'init', 'the_widgets_init' );
    
?>