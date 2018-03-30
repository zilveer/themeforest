<?php
	global $default_sidebars, $default_widgetareas;
	
	$default_sidebars = array(

						array(
							'name' => __( 'Primary Widget Area Left', 'wpdance' ),
							'id' => 'primary-widget-area-left',
							'description' => __( 'The primary left sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Primary Widget Area Right', 'wpdance' ),
							'id' => 'primary-widget-area-right',
							'description' => __( 'The primary right sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Blog Widget Area Left', 'wpdance' ),
							'id' => 'blog-widget-area-left',
							'description' => __( 'The left widget area for blog page', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Blog Widget Area Right', 'wpdance' ),
							'id' => 'blog-widget-area-right',
							'description' => __( 'The right widget area for blog page', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Product Category Widget Area Left', 'wpdance' ),
							'id' => 'product-category-widget-area-left',
							'description' => __( 'The Product Category left sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Product Category Widget Area Right', 'wpdance' ),
							'id' => 'product-category-widget-area-right',
							'description' => __( 'The Product Category right sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Product Detail Widget Area Left', 'wpdance' ),
							'id' => 'product-widget-area-left',
							'description' => __( 'The Product detail left sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Product Detail Widget Area Right', 'wpdance' ),
							'id' => 'product-widget-area-right',
							'description' => __( 'The Product detail right sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)						
						,array(
							'name' => __( 'Secondary Widget Area', 'wpdance' ),
							'id' => 'secondary-widget-area',
							'description' => __( 'The secondary sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
	);
	
	if( class_exists('bbPress') ){
		$default_sidebars[] = array(
							'name' => __( 'Forum Widget Area Left', 'wpdance' ),
							'id' => 'forum-widget-area-left',
							'description' => __( 'The forum widget area left', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						);
						
		$default_sidebars[] = array(
							'name' => __( 'Forum Widget Area Right', 'wpdance' ),
							'id' => 'forum-widget-area-right',
							'description' => __( 'The forum widget area right', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						);
						
	}
	
	$default_widgetareas = array(
							array(
							'name' => __( 'Top Content Widget Area', 'wpdance' ),
							'id' => 'top-content-widget-area',
							'description' => __( 'The widget area top content', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
							)
							,array(
								'name' => __( 'Banner Top Content Widget Area', 'wpdance' ),
								'id' => 'banner-top-content-widget-area',
								'description' => __( 'The widget area banner top content', 'wpdance' ),
								'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
								'after_widget' => '</li>',
								'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
								'after_title' => '</h3></div>',
							)
							,array(
								'name' => __( 'First Footer Widget Area', 'wpdance' ),
								'id' => 'first-footer-widget-area-1',
								'description' => __( 'The first footer widget area 1', 'wpdance' ),
								'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
								'after_widget' => '</li>',
								'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
								'after_title' => '</h3></div>',
							)						
							,array(
								'name' => __( 'Second Footer Widget Area', 'wpdance' ),
								'id' => 'second-footer-widget-area-1',
								'description' => __( 'The second footer widget area 1', 'wpdance' ),
								'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
								'after_widget' => '</li>',
								'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
								'after_title' => '</h3></div>',
							)
							,array(
								'name' => __( 'Third Footer Widget Area', 'wpdance' ),
								'id' => 'third-footer-widget-area-1',
								'description' => __( 'The third footer widget area 1 (Footer Subscrible)', 'wpdance' ),
								'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
								'after_widget' => '</li>',
								'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
								'after_title' => '</h3></div>',
							)
							,array(
								'name' => __( 'Fourth Footer Widget Area', 'wpdance' ),
								'id' => 'fourth-footer-widget-area-1',
								'description' => __( 'The fourth footer widget area 1', 'wpdance' ),
								'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
								'after_widget' => '</li>',
								'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
								'after_title' => '</h3></div>',
							)
							,array(
								'name' => __( 'Fifth Footer Widget Area 1', 'wpdance' ),
								'id' => 'fifth-footer-widget-area-1',
								'description' => __( 'The fifth footer widget area 1', 'wpdance' ),
								'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
								'after_widget' => '</li>',
								'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
								'after_title' => '</h3></div>',
							)
							,array(
								'name' => __( 'Fifth Footer Widget Area 2', 'wpdance' ),
								'id' => 'fifth-footer-widget-area-2',
								'description' => __( 'The fifth footer widget area 2', 'wpdance' ),
								'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
								'after_widget' => '</li>',
								'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
								'after_title' => '</h3></div>',
							)
							,array(
								'name' => __( 'Fifth Footer Widget Area 3', 'wpdance' ),
								'id' => 'fifth-footer-widget-area-3',
								'description' => __( 'The fifth footer widget area 3', 'wpdance' ),
								'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
								'after_widget' => '</li>',
								'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
								'after_title' => '</h3></div>',
							)
							,array(
								'name' => __( 'Fifth Footer Widget Area 4', 'wpdance' ),
								'id' => 'fifth-footer-widget-area-4',
								'description' => __( 'The fifth footer widget area 4', 'wpdance' ),
								'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
								'after_widget' => '</li>',
								'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
								'after_title' => '</h3></div>',
							)
							,array(
								'name' => __( 'Sixth Footer Widget Area', 'wpdance' ),
								'id' => 'sixth-footer-widget-area-1',
								'description' => __( 'The sixth footer widget area 1', 'wpdance' ),
								'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
								'after_widget' => '</li>',
								'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
								'after_title' => '</h3></div>',
							)
						);

function wpdance_widgets_init() {
	global $default_sidebars, $default_widgetareas;
	
	$custom_sidebar_str = get_option(THEME_SLUG.'areas');
	if($custom_sidebar_str){
		$custom_sidebar_arr = json_decode($custom_sidebar_str);		
	}else{
		$custom_sidebar_arr = array();
	}	

		
	$_init_sidebar_array = array();	
	if( count($custom_sidebar_arr) > 0 ){
		
			foreach( $custom_sidebar_arr as $_area ){
				$_area_name = stripslashes(esc_html (ucwords( str_replace("-"," ",$_area) ) ));
				$_init_sidebar_array[] = array(
							'name' => sprintf( __( '%s Widget Area','wpdance' ), $_area_name ) //__( "{$_area_name} Widget Area", 'wpdance' )
							,'id' => strtolower( str_replace(" ","-",$_area) )
							,'description' => sprintf( __( '%s sidebar widget area','wpdance' ), $_area_name ) //__( "{$_area_name} sidebar widget area", 'wpdance' )
							,'before_widget' => '<li id="%1$s" class="widget-container %2$s">'
							,'after_widget' => '</li>'
							,'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">'
							,'after_title' => '</h3></div>'
				);	
				
			}	
	}
	
	$default_sidebar = array_merge($default_sidebars,$default_widgetareas);
	$default_sidebar = array_merge($default_sidebar,$_init_sidebar_array);
	
	foreach( $default_sidebar as $sidebar ){
		register_sidebar($sidebar);
	}	
}
/** Register sidebars by running wpdance_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'wpdance_widgets_init' );
?>