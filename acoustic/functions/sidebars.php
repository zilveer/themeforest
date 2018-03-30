<?php
add_action( 'widgets_init', 'ci_widgets_init' );
if( !function_exists('ci_widgets_init') ):
function ci_widgets_init() {

	
	register_sidebar(array(
		'name' => __( 'Homepage sidebar #1', 'ci_theme'),
		'id' => 'homepage-sidebar-one',
		'description' => __( 'Place here the widgets that you want to display on your homepage sidebar #1', 'ci_theme'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Homepage sidebar #2', 'ci_theme'),
		'id' => 'homepage-sidebar-two',
		'description' => __( 'Place here the widgets that you want to display on your homepage sidebar #2', 'ci_theme'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Top Social Sidebar', 'ci_theme'),
		'id' => 'top-social-sidebar',
		'description' => sprintf(__( 'In this sidebar you can place only the Socials Ignited widget, downloadable from: %s', 'ci_theme'), 'http://wordpress.org/plugins/socials-ignited/'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
	
	register_sidebar(array(
		'name' => __( 'Pages Sidebar', 'ci_theme'),
		'id' => 'pages-sidebar',
		'description' => __( 'Place here the widgets that you want to display on your pages', 'ci_theme'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Events Sidebar', 'ci_theme'),
		'id' => 'events-sidebar',
		'description' => __( 'Place here the widgets that you want to display on your events sidebar', 'ci_theme'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
	
	register_sidebar(array(
		'name' => __( 'Album Sidebar', 'ci_theme'),
		'id' => 'album-sidebar',
		'description' => __( 'Place here the widgets that you want to display in the details page of each album under the featured image', 'ci_theme'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
	
	register_sidebar(array(
		'name' => __( 'Artist Sidebar', 'ci_theme'),
		'id' => 'artist-sidebar',
		'description' => __( 'Place here the widgets that you want to display in the details page of each artist under the featured image', 'ci_theme'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	if ( woocommerce_enabled() )
	{
		register_sidebar(array(
			'name' => __( 'e-Shop Sidebar', 'ci_theme'),
			'id' => 'eshop-sidebar',
			'description' => __( 'Place here the widgets that you want to display on your eshop pages', 'ci_theme'),
			'before_widget' => '<div id="%1$s" class="%2$s widget group"><div class="widget-content">',
			'after_widget' => '</div></div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		));
	}
	
	register_sidebar(array(
		'name' => __( 'Footer sidebar #1', 'ci_theme'),
		'id' => 'footer-sidebar-one',
		'description' => __( 'Place here the widgets that you want to display on your footer column #1', 'ci_theme'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Footer sidebar #2', 'ci_theme'),
		'id' => 'footer-sidebar-two',
		'description' => __( 'Place here the widgets that you want to display on your footer column #2', 'ci_theme'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Footer sidebar #3', 'ci_theme'),
		'id' => 'footer-sidebar-three',
		'description' => __( 'Place here the widgets that you want to display on your footer column #3', 'ci_theme'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __( 'Footer sidebar #4', 'ci_theme'),
		'id' => 'footer-sidebar-four',
		'description' => __( 'Place here the widgets that you want to display on your footer column #4', 'ci_theme'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

}
endif;

?>