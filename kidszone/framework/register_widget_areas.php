<?php 
	#Display Everywhere Left
	register_sidebar(array(
		'name' 			=>	__('Display Everywhere Left', 'iamd_text_domain'),
		'id'			=>	'display-everywhere-sidebar-left',
		'description'	=>	__("Common sidebar that appears on the left.","iamd_text_domain"),
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	'<h3 class="widgettitle"><span>',
		'after_title' 	=> 	'</span></h3>'));

	#Display Everywhere Right
	register_sidebar(array(
		'name' 			=>	__('Display Everywhere Right', 'iamd_text_domain'),
		'id'			=>	'display-everywhere-sidebar-right',
		'description'	=>	__("Common sidebar that appears on the right.","iamd_text_domain"),
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	'<h3 class="widgettitle"><span>',
		'after_title' 	=> 	'</span></h3>'));
		
	#Custom Widgetarea
	$custom_widgetarea = dt_theme_option('widgetarea','custom');
	$custom_widgetarea = is_array($custom_widgetarea) ? array_unique($custom_widgetarea) : array();
    $custom_widgetarea = array_filter($custom_widgetarea);
    foreach ($custom_widgetarea as $key => $value) {
    	$id = mb_convert_case($value, MB_CASE_LOWER, "UTF-8");
    	$id = str_replace(" ", "-", $id);

    	register_sidebar(array(
		'name' 			=>	$value,
		'id'			=>	$id,
		'description'   =>  __("A unique sidebar that is created in Admin panel for custom sidebar","iamd_text_domain"),
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	'<h3 class="widgettitle"><span>',
		'after_title' 	=> 	'</span></h3>'));
    }

	#Events Everywhere Sidebar
	if( class_exists('Tribe__Events__Main')	):
		#Left Sidebar
		register_sidebar(array(
			'name' 			=>	__('Events Everywhere Left', 'iamd_text_domain'),
			'id'			=>	'events-everywhere-sidebar-left',
			'description'   =>  __("Events page unique sidebar that appears on the left.","iamd_text_domain"),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle"><span>',
			'after_title' 	=> 	'</span></h3>'));
			
		#Right Sidebar
		register_sidebar(array(
			'name' 			=>	__('Events Everywhere Right', 'iamd_text_domain'),
			'id'			=>	'events-everywhere-sidebar-right',
			'description'   =>  __("Events page unique sidebar that appears on the right.","iamd_text_domain"),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle"><span>',
			'after_title' 	=> 	'</span></h3>'));
	endif;

	#Shop Everywhere Sidebar
	if( class_exists('woocommerce')	):
		#Left Sidebar
		register_sidebar(array(
			'name' 			=>	__('Shop Everywhere Left', 'iamd_text_domain'),
			'id'			=>	'shop-everywhere-sidebar-left',
			'description'   =>  __("Shop page unique sidebar that appears on the left.","iamd_text_domain"),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle"><span>',
			'after_title' 	=> 	'</span></h3>'));
			
		#Right Sidebar
		register_sidebar(array(
			'name' 			=>	__('Shop Everywhere Right', 'iamd_text_domain'),
			'id'			=>	'shop-everywhere-sidebar-right',
			'description'   =>  __("Shop page unique sidebar that appears on the right.","iamd_text_domain"),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle"><span>',
			'after_title' 	=> 	'</span></h3>'));
	endif;

	#Post Archives Sidebar
	$post_archives_layout = dt_theme_option('specialty','archives-layout');
	$post_archives_layout = !empty($post_archives_layout) ? $post_archives_layout : "content-full-width";
	if( $post_archives_layout != "content-full-width" ){
		if( $post_archives_layout == "with-left-sidebar" ){
			register_sidebar(array(
				'name' 			=>	__("Archives Sidebar Left",'iamd_text_domain'),
				'id'			=>	'post-archives-sidebar-left',
				'description'   =>  __("Archives sidebar that appears on the left.","iamd_text_domain"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle"><span>',
				'after_title' 	=> 	'</span></h3>'));
		}
		if( $post_archives_layout == "with-right-sidebar" ){
			register_sidebar(array(
				'name' 			=>	__("Archives Sidebar Right",'iamd_text_domain'),
				'id'			=>	'post-archives-sidebar-right',
				'description'   =>  __("Archives sidebar that appears on the right.","iamd_text_domain"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle"><span>',
				'after_title' 	=> 	'</span></h3>'));
		}
	}

	#Search Page Layout
	$search_layout = dt_theme_option('specialty','search-layout');
	$search_layout = !empty($search_layout) ? $search_layout : "content-full-width";
	if( $search_layout != "content-full-width" ){
		if( $search_layout == "with-left-sidebar" ){
			register_sidebar(array(
				'name' 			=>	__("Search Sidebar Left",'iamd_text_domain'),
				'id'			=>	'search-sidebar-left',
				'description'   =>  __("Search page sidebar that appears on the left.","iamd_text_domain"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle"><span>',
				'after_title' 	=> 	'</span></h3>'));
        }
		if( $search_layout == "with-right-sidebar" ){
			register_sidebar(array(
				'name' 			=>	__("Search Sidebar Right",'iamd_text_domain'),
				'id'			=>	'search-sidebar-right',
				'description'   =>  __("Search page sidebar that appears on the right.","iamd_text_domain"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle"><span>',
				'after_title' 	=> 	'</span></h3>'));
		}
	}

	#404 Page Layout
	$layout_404 = dt_theme_option('specialty','404-layout');
	$layout_404 = !empty($layout_404) ? $layout_404 : "content-full-width";
	if( $layout_404 != "content-full-width" ){
		if( $layout_404 == "with-left-sidebar" ){
			register_sidebar(array(
				'name' 			=>	__('Not Found ( 404 ) Sidebar Left','iamd_text_domain'),
				'id'			=>	'not-found-404-sidebar-left',
				'description'   =>  __("404 page sidebar that appears on the left.","iamd_text_domain"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle"><span>',
				'after_title' 	=> 	'</span></h3>'));
        }
		if( $layout_404 == "with-right-sidebar" ){
			register_sidebar(array(
				'name' 			=>	__('Not Found ( 404 ) Sidebar Right','iamd_text_domain'),
				'id'			=>	'not-found-404-sidebar-right',
				'description'   =>  __("404 page sidebar that appears on the right.","iamd_text_domain"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle"><span>',
				'after_title' 	=> 	'</span></h3>'));
		}
	}

	#Footer Columnns
	$footer_columns =  dt_theme_option('general','footer-columns');
	dt_theme_footer_widgetarea($footer_columns);

if( class_exists('woocommerce')	):

	// custom left sidebars for product
	$layout = dt_theme_option('woo','product-layout');
	$layout = !empty($layout) ? $layout : "content-full-width";
	switch($layout) :
		case 'with-left-sidebar':
			register_sidebar(array(
				'name' 			=>  __("Product Detail | Left Sidebar", 'iamd_text_domain'),
				'id'			=>	"product-detail-sidebar-left",
				'description'	=>  __("Appears in the Left side of Product details Page.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle"><span>',
				'after_title' 	=> 	'</span></h3>'));
		break;
	
		case 'with-right-sidebar':
			register_sidebar(array(
				'name' 			=>	__("Product Detail | Right Sidebar", 'iamd_text_domain'),
				'id'			=>	"product-detail-sidebar-right",
				'description'	=>  __("Appears in the Right side of Product details Page.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle"><span>',
				'after_title' 	=> 	'</span></h3>'));
		break;
	endswitch;
	
	// custom left sidebars for product category
	$layout = dt_theme_option('woo','product-category-layout');
	$layout = !empty($layout) ? $layout : "content-full-width";
	switch($layout) :
		case 'with-left-sidebar':
			register_sidebar(array(
				'name' 			=>	__("Product Category | Left Sidebar", 'iamd_text_domain'),
				'id'			=>	"product-category-sidebar-left",
				'description'	=>  __("Appears on Left side of Product Category Page.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle"><span>',
				'after_title' 	=> 	'</span></h3>'));
		break;
	
		case 'with-right-sidebar':
			register_sidebar(array(
				'name' 			=>	__("Product Category | Right Sidebar", 'iamd_text_domain'),
				'id'			=>	"product-category-sidebar-right",
				'description'	=>  __("Appears on Right side of Product Category Page.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle"><span>',
				'after_title' 	=> 	'</span></h3>'));
		break;
	endswitch;
	
	// custom left sidebars for product tag
	$layout = dt_theme_option('woo','product-tag-layout');
	$layout = !empty($layout) ? $layout : "content-full-width";
	switch($layout) :
		case 'with-left-sidebar':
			register_sidebar(array(
				'name' 			=>	__("Product Tag | Left Sidebar", 'iamd_text_domain'),
				'id'			=>	"product-tag-sidebar-left",
				'description'	=>  __("Appears on Left side of Product Tag Page.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle"><span>',
				'after_title' 	=> 	'</span></h3>'));
		break;
	
		case 'with-right-sidebar':
			register_sidebar(array(
				'name' 			=>	__("Product Tag | Right Sidebar", 'iamd_text_domain'),
				'id'			=>	"product-tag-sidebar-right",
				'description'	=>  __("Appears on Right side of Product Tag Page.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle"><span>',
				'after_title' 	=> 	'</span></h3>'));
		break;
	endswitch;

endif;?>