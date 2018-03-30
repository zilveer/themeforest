<?php 
	#Display Everywhere Left
	register_sidebar(array(
		'name' 			=>	'Display Everywhere Left',
		'id'			=>	'display-everywhere-sidebar-left',
		'description'	=>	__("Common sidebar that appears on the left.","dt_themes"),
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	'<h3 class="widgettitle">',
		'after_title' 	=> 	'<span></span></h3>'));

	#Display Everywhere Right
	register_sidebar(array(
		'name' 			=>	'Display Everywhere Right',
		'id'			=>	'display-everywhere-sidebar-right',
		'description'	=>	__("Common sidebar that appears on the right.","dt_themes"),
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	'<h3 class="widgettitle">',
		'after_title' 	=> 	'<span></span></h3>'));


	#Custom Widgets for Sidebars
	global $dt_allowed_html_tags;
	$widgets_sidebars = wp_kses(dttheme_option('widgetarea','sidebars'), $dt_allowed_html_tags);
	$widgets_sidebars = is_array($widgets_sidebars) ? array_unique($widgets_sidebars) : array();
    $widgets_sidebars = array_filter($widgets_sidebars);
    foreach ($widgets_sidebars as $key => $value) {
    	$id = mb_convert_case($value, MB_CASE_LOWER, "UTF-8");
    	$id = str_replace(" ", "-", $id);

    	register_sidebar(array(
		'name' 			=>	$value,
		'id'			=>	$id,
		'description'   =>  __("A unique sidebar that is created in Admin panel for left, right and both sidebars","dt_themes"),
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	'<h3 class="widgettitle">',
		'after_title' 	=> 	'</h3>'));
    }

	
	#Shop Everywhere Sidebar
	if( class_exists('woocommerce')	):
		#Left Sidebar
		register_sidebar(array(
			'name' 			=>	'Shop Everywhere Left',
			'id'			=>	'shop-everywhere-sidebar-left',
			'description'   =>  __("Shop page unique sidebar that appears on the left.","dt_themes"),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'<span></span></h3>'));
			
		#Right Sidebar
		register_sidebar(array(
			'name' 			=>	'Shop Everywhere Right',
			'id'			=>	'shop-everywhere-sidebar-right',
			'description'   =>  __("Shop page unique sidebar that appears on the right.","dt_themes"),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'<span></span></h3>'));
	endif;
	
	
	#Post Archives Sidebar
	$post_archives_layout = dttheme_option('specialty','post-archives-layout');
	$post_archives_layout = !empty($post_archives_layout) ? $post_archives_layout : "content-full-width";
	if( $post_archives_layout != "content-full-width" ){
		if( $post_archives_layout == "with-left-sidebar" || $post_archives_layout == "both-sidebar" ){
			register_sidebar(array(
				'name' 			=>	__("Post Archives Sidebar Left",'dt_themes'),
				'id'			=>	'post-archives-sidebar-left',
				'description'   =>  __("Tag archives sidebar that appears on the left.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}
		if( $post_archives_layout == "with-right-sidebar" || $post_archives_layout == "both-sidebar"){
			register_sidebar(array(
				'name' 			=>	__("Post Archives Sidebar Right",'dt_themes'),
				'id'			=>	'post-archives-sidebar-right',
				'description'   =>  __("Tag archives sidebar that appears on the right.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}
	}
	
	
	#Portfolio Archives Sidebar
	if( dttheme_is_plugin_active('designthemes-core-features/designthemes-core-features.php') ):
		$portfolio_archives_layout = dttheme_option('specialty','portfolio-archives-layout');
		$portfolio_archives_layout = !empty($portfolio_archives_layout) ? $portfolio_archives_layout : "content-full-width";
		if( $portfolio_archives_layout != "content-full-width" ){
			if( $portfolio_archives_layout == "with-left-sidebar" || $portfolio_archives_layout == "both-sidebar" ){
				register_sidebar(array(
					'name' 			=>	__("Portfolio Archives Sidebar Left",'dt_themes'),
					'id'			=>	'custom-post-portfolio-archives-sidebar-left',
					'description'   =>  __("Portfolio archives sidebar that appears on the left.","dt_themes"),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			}
			if( $portfolio_archives_layout == "with-right-sidebar" || $portfolio_archives_layout == "both-sidebar"){
				register_sidebar(array(
					'name' 			=>	__("Portfolio Archives Sidebar Right",'dt_themes'),
					'id'			=>	'custom-post-portfolio-archives-sidebar-right',
					'description'   =>  __("Portfolio archives sidebar that appears on the right.","dt_themes"),
					'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
					'after_widget' 	=> 	'</aside>',
					'before_title' 	=> 	'<h3 class="widgettitle">',
					'after_title' 	=> 	'</h3>'));
			}
			
		}
	endif;
	
	
	#Search Page Layout
	$search_layout = dttheme_option('specialty','search-layout');
	$search_layout = !empty($search_layout) ? $search_layout : "content-full-width";
	if( $search_layout != "content-full-width" ){
		if( $search_layout == "with-left-sidebar" || $search_layout == "both-sidebar" ){
			register_sidebar(array(
				'name' 			=>	__("Search Sidebar Left",'dt_themes'),
				'id'			=>	'search-sidebar-left',
				'description'   =>  __("Search page sidebar that appears on the left.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
        }
		if( $search_layout == "with-right-sidebar" || $search_layout == "both-sidebar"){
			register_sidebar(array(
				'name' 			=>	__("Search Sidebar Right",'dt_themes'),
				'id'			=>	'search-sidebar-right',
				'description'   =>  __("Search page sidebar that appears on the right.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}
		
	}
	
	
	#404 Page Layout
	$layout_404 = dttheme_option('specialty','not-found-404-layout');
	$layout_404 = !empty($layout_404) ? $layout_404 : "content-full-width";
	if( $layout_404 != "content-full-width" ){
		if( $layout_404 == "with-left-sidebar" || $layout_404 == "both-sidebar" ){
			register_sidebar(array(
				'name' 			=>	__('Not Found ( 404 ) Sidebar Left','dt_themes'),
				'id'			=>	'not-found-404-sidebar-left',
				'description'   =>  __("404 page sidebar that appears on the left.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
        }
		if( $layout_404 == "with-right-sidebar" || $layout_404 == "both-sidebar"){
			register_sidebar(array(
				'name' 			=>	__('Not Found ( 404 ) Sidebar Right','dt_themes'),
				'id'			=>	'not-found-404-sidebar-right',
				'description'   =>  __("404 page sidebar that appears on the right.","dt_themes"),
				'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
				'after_widget' 	=> 	'</aside>',
				'before_title' 	=> 	'<h3 class="widgettitle">',
				'after_title' 	=> 	'</h3>'));
		}
		
	}


if( class_exists('woocommerce')	):

	#Custom Left Sidebars for Product
	$products = dttheme_option("widgetarea","left-products");
	$products = !empty($products) ? $products : array();
	$widget_areas_for_products = array_filter(array_unique($products));
	foreach($widget_areas_for_products as $id):
		$title = get_the_title($id);
		register_sidebar(array(
			'name' 			=>	"Product: {$title} - Left",
			'id'			=>	"left-product-{$id}-sidebar",
			'description'	=> __("Individual product sidebar that appears on the left.","dt_themes"),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'<span></span></h3>'));
	endforeach;

	#Custom Right Sidebars for Product
	$products = dttheme_option("widgetarea","right-products");
	$products = !empty($products) ? $products : array();
	$widget_areas_for_products = array_filter(array_unique($products));
	foreach($widget_areas_for_products as $id):
		$title = get_the_title($id);
		register_sidebar(array(
			'name' 			=>	"Product: {$title} - Right",
			'id'			=>	"right-product-{$id}-sidebar",
			'description'	=> __("Individual product sidebar that appears on the right.","dt_themes"),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'<span></span></h3>'));
	endforeach;


	#Custom Left Sidebars for Product Category
	$product_categories = dttheme_option("widgetarea","left-product-category");
	$product_categories = !empty($product_categories) ? $product_categories : array();
	$widget_areas_for_product_categories = array_filter(array_unique($product_categories));
	
	foreach($widget_areas_for_product_categories as $id):
	
		$title = $wpdb->get_var( $wpdb->prepare("SELECT name FROM $wpdb->terms  WHERE term_id = %s",$id));
		$slug  = $wpdb->get_var( $wpdb->prepare("SELECT slug FROM $wpdb->terms  WHERE term_id = %s",$id));	
		
		register_sidebar(array(
			'name' 			=>	"Product Category: {$title} - Left ",
			'id'			=>	"left-product-category-{$slug}-sidebar",
			'description'	=> __("Individual product category sidebar that appears on the left.","dt_themes"),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'<span></span></h3>'));
	endforeach;
	
	#Custom Right Sidebars for Product Category
	$product_categories = dttheme_option("widgetarea","right-product-category");
	$product_categories = !empty($product_categories) ? $product_categories : array();
	$widget_areas_for_product_categories = array_filter(array_unique($product_categories));
	
	foreach($widget_areas_for_product_categories as $id):
	
		$title = $wpdb->get_var( $wpdb->prepare("SELECT name FROM $wpdb->terms  WHERE term_id = %s",$id));
		$slug  = $wpdb->get_var( $wpdb->prepare("SELECT slug FROM $wpdb->terms  WHERE term_id = %s",$id));	
		
		register_sidebar(array(
			'name' 			=>	"Product Category: {$title} - Right ",
			'id'			=>	"right-product-category-{$slug}-sidebar",
			'description'	=> __("Individual product category sidebar that appears on the right.","dt_themes"),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'<span></span></h3>'));
	endforeach;

	#Custom Left Sidebars for Product Tag
	$product_tags = dttheme_option("widgetarea","left-product-tag");
	$product_tags = !empty($product_tags) ? $product_tags : array();
	$widget_areas_for_product_tags = array_filter(array_unique($product_tags));
	foreach($widget_areas_for_product_tags as $id):
		$title = $wpdb->get_var( $wpdb->prepare("SELECT name FROM $wpdb->terms  WHERE term_id = %s",$id));
		$slug  = $wpdb->get_var( $wpdb->prepare("SELECT slug FROM $wpdb->terms  WHERE term_id = %s",$id));	
		register_sidebar(array(
			'name' 			=>	"Product Tag: {$title} - Left",
			'id'			=>	"left-product-tag-{$slug}-sidebar",
			'description'	=> __("Individual product tag sidebar that appears on the left.","dt_themes"),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'<span></span></h3>'));
	endforeach;

	#Custom Right Sidebars for Product Tag
	$product_tags = dttheme_option("widgetarea","right-product-tag");
	$product_tags = !empty($product_tags) ? $product_tags : array();
	$widget_areas_for_product_tags = array_filter(array_unique($product_tags));
	foreach($widget_areas_for_product_tags as $id):
		$title = $wpdb->get_var( $wpdb->prepare("SELECT name FROM $wpdb->terms  WHERE term_id = %s",$id));
		$slug  = $wpdb->get_var( $wpdb->prepare("SELECT slug FROM $wpdb->terms  WHERE term_id = %s",$id));	
		register_sidebar(array(
			'name' 			=>	"Product Tag: {$title} - Right",
			'id'			=>	"right-product-tag-{$slug}-sidebar",
			'description'	=> __("Individual product tag sidebar that appears on the right.","dt_themes"),
			'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</aside>',
			'before_title' 	=> 	'<h3 class="widgettitle">',
			'after_title' 	=> 	'<span></span></h3>'));
	endforeach;

endif;?>