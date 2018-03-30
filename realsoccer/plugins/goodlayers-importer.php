<?php
	/*	
	*	Goodlayers Import Variable Setting
	*/

	if( is_admin() ){
		add_filter('gdlr_nav_meta', 'gdlr_add_import_nav_meta');
		add_action('gdlr_import_end', 'gdlr_add_import_action');
	}
	
	if( !function_exists('gdlr_add_import_nav_meta') ){
		function gdlr_add_import_nav_meta( $array ){
			return array('_gdlr_menu_icon', '_gdlr_mega_menu_item', '_gdlr_mega_menu_section');
		}
	}
	
	if( !function_exists('gdlr_add_import_action') ){
		function gdlr_add_import_action(){
			
			// setting > reading area
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', 3220 );
			update_option( 'page_for_posts', 0 );
			
			// menu to themes location
			$nav_id = 0;
			$navs = get_terms('nav_menu', array( 'hide_empty' => true ));
			foreach( $navs as $nav ){
				if($nav->name == 'Main menu'){
					$nav_id = $nav->term_id; break;
				}
			}
			set_theme_mod('nav_menu_locations', array('main_menu' => $nav_id));		

			// import the widget
			$widget_file = GDLR_LOCAL_PATH . '/plugins/goodlayers-importer-widget.txt';
			$widget_data = unserialize(file_get_contents($widget_file));
			
			// retrieve widget data
			foreach($widget_data as $key => $value){
				update_option( $key, $value );
			}
			
		}
	}
	
	//$widget_data = array();
	//$widget_list = array('sidebars_widgets', 'widget_archives', 'widget_calendar', 
	//	'widget_categories', 'widget_gdlr-flickr-widget', 
	//	'widget_gdlr-popular-post-widget', 'widget_gdlr-port-slider-widget', 
	//	'widget_gdlr-post-slider-widget', 'widget_gdlr-recent-comment-widget', 'widget_gdlr-recent-portfolio-widget', 
	//	'widget_gdlr-recent-portfolio2-widget', 'widget_gdlr-recent-post-widget', 'widget_gdlr-top-rated-post-widget',
	//	'widget_gdlr-twitter-widget', 'widget_gdlr-video-widget', 'widget_layerslider_widget', 
	//  'widget_master-slider-main-widget', 'widget_meta', 'widget_nav_menu', 'widget_pages',
	//	'widget_price_filter', 'widget_product_categories', 'widget_product_search', 
	//	'widget_product_tag_cloud', 'widget_recent-comments', 'widget_recent-posts', 
	//	'widget_recently_viewed_products', 'widget_recent_reviews', 'widget_rss', 'widget_search', 'widget_soundcloud_is_gold_widget',
	//	'widget_shopping_cart', 'widget_tag_cloud', 'widget_text', 'widget_top-rated-products', 
	//	'widget_woocommerce_layered_nav', 'widget_woocommerce_layered_nav_filters', 'widget_woocommerce_product_search',
	//	'widget_woocommerce_price_filter', 'widget_woocommerce_products',
	//	'widget_woocommerce_product_categories', 'widget_woocommerce_random_products', 'widget_woocommerce_top_rated_products',
	//  'widget_woocommerce_product_tag_cloud', 'widget_woocommerce_recently_viewed_products', 'widget_woocommerce_recent_reviews',
	//  'widget_woocommerce_widget_cart', 'widget_wpgmp_google_map_widget');
	// foreach($widget_list as $widget){
	//	$widget_data[$widget] = get_option($widget);
	// }
	//$widget_file = GDLR_LOCAL_PATH . '/plugins/goodlayers-importer-widget.txt';
	//$file_stream = @fopen($widget_file, 'w');
	//fwrite($file_stream, serialize($widget_data));
	//fclose($file_stream);	
	
	
?>