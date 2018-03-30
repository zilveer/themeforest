<?php

## Main Widgets ------------------------------------------------------------
add_action( 'widgets_init', 'tie_widgets_init' );
function tie_widgets_init() {
	$before_widget =  '<div id="%1$s" class="widget %2$s">';
	$after_widget  =  '</div></div><!-- .widget /-->';
	$before_title  =  '<div class="widget-top"><h4>';
	$after_title   =  '</h4><div class="stripe-line"></div></div>
						<div class="widget-container">';
					
	register_sidebar( array(
		'name' =>  __( 'Primary Widget Area', 'tie' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The Primary widget area', 'tie' ),
		'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
	) );

	if (class_exists('Woocommerce')){
		register_sidebar( array(
			'name' =>  __( 'Shop - For WooCommerce Pages', 'tie' ),
			'id' => 'shop-widget-area',
			'description' => __( 'This widget area uses in the WooCommerce pages .', 'tie' ),
			'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
		) );
	}
	
	//Custom Sidebars
	$sidebars = tie_get_option( 'sidebars' ) ;
	if($sidebars){
		foreach ($sidebars as $sidebar) {
			register_sidebar( array(
				'name' => $sidebar,
				'id' => sanitize_title($sidebar),
				'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
			) );
		}
	}
	
## Footer Widgets ------------------------------------------------------------
	$footer_before_widget =  '<div id="%1$s" class="footer-widget %2$s">';
	$footer_after_widget  =  '</div></div><!-- .widget /-->';
	$footer_before_title  =  '<div class="footer-widget-top"><h4>';
	$footer_after_title   =  '</h4></div>
						<div class="footer-widget-container">';
						
	$footer_widgets = tie_get_option( 'footer_widgets' );
	if( $footer_widgets != 'disable' ){
	
		register_sidebar( array(
			'name' =>  __( 'First Footer Widget Area', 'tie' ),
			'id' => 'first-footer-widget-area',
			'description' => __( 'The first footer widget area', 'tie' ),
			'before_widget' => $footer_before_widget , 'after_widget' => $footer_after_widget , 'before_title' => $footer_before_title , 'after_title' => $footer_after_title ,
		) );

		if( $footer_widgets == 'footer-2c' || $footer_widgets == 'narrow-wide-2c' || $footer_widgets == 'wide-narrow-2c' || $footer_widgets == 'footer-3c' || $footer_widgets == 'wide-left-3c' || $footer_widgets == 'wide-right-3c' || $footer_widgets == 'footer-4c' ){
			register_sidebar( array(
				'name' =>  __( 'Second Footer Widget Area', 'tie' ),
				'id' => 'second-footer-widget-area',
				'description' => __( 'The Second footer widget area', 'tie' ),
				'before_widget' => $footer_before_widget , 'after_widget' => $footer_after_widget , 'before_title' => $footer_before_title , 'after_title' => $footer_after_title ,
			) );
		}
	
		if( $footer_widgets == 'footer-3c' || $footer_widgets == 'wide-left-3c' || $footer_widgets == 'wide-right-3c' || $footer_widgets == 'footer-4c' ){
			register_sidebar( array(
				'name' =>  __( 'Third Footer Widget Area', 'tie' ),
				'id' => 'third-footer-widget-area',
				'description' => __( 'The Third footer widget area', 'tie' ),
				'before_widget' => $footer_before_widget , 'after_widget' => $footer_after_widget , 'before_title' => $footer_before_title , 'after_title' => $footer_after_title ,
			) );
		}
		
		if( $footer_widgets == 'footer-4c' ){
			register_sidebar( array(
				'name' => __( 'Fourth Footer Widget Area', 'tie' ),
				'id' => 'fourth-footer-widget-area',
				'description' => __( 'The Fourth footer widget area', 'tie' ),
				'before_widget' => $footer_before_widget , 'after_widget' => $footer_after_widget , 'before_title' => $footer_before_title , 'after_title' => $footer_after_title ,
			) );
		}
	}
}

## Custom Widgets ------------------------------------------------------------
locate_template ('framework/widgets/widget-ads.php',			true, true);
locate_template ('framework/widgets/widget-video.php',			true, true);
locate_template ('framework/widgets/widget-posts.php',			true, true);
locate_template ('framework/widgets/widget-login.php',			true, true);
locate_template ('framework/widgets/widget-google.php',			true, true);
locate_template ('framework/widgets/widget-tabbed.php',			true, true);
locate_template ('framework/widgets/widget-flickr.php',			true, true);
locate_template ('framework/widgets/widget-author.php',			true, true);
locate_template ('framework/widgets/widget-social.php',			true, true);
locate_template ('framework/widgets/widget-search.php',			true, true);
locate_template ('framework/widgets/widget-slider.php',			true, true);
locate_template ('framework/widgets/widget-weather.php',		true, true);
locate_template ('framework/widgets/widget-youtube.php',		true, true);
locate_template ('framework/widgets/widget-twitter.php',		true, true);
locate_template ('framework/widgets/widget-timeline.php',		true, true);
locate_template ('framework/widgets/widget-facebook.php',		true, true);
locate_template ('framework/widgets/widget-category.php',		true, true);
locate_template ('framework/widgets/widget-news-pic.php',		true, true);
locate_template ('framework/widgets/widget-text-html.php',		true, true);
locate_template ('framework/widgets/widget-feedburner.php',		true, true);
locate_template ('framework/widgets/widget-soundcloud.php',		true, true);
locate_template ('framework/widgets/widget-author-custom.php',	true, true);
locate_template ('framework/widgets/widget-custom-author.php',	true, true);
locate_template ('framework/widgets/widget-authors-posts.php',	true, true);
locate_template ('framework/widgets/widget-comments-avatar.php',true, true);
?>