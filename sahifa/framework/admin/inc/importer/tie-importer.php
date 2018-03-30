<?php
function tie_set_demo_data(){
	$theme_options = get_option( 'tie_options' );
	
	$theme_options['social']['facebook'] 	= 'https://www.facebook.com/TieLabs';
	$theme_options['social']['twitter'] 	= 'https://twitter.com/TieLabs';
	$theme_options['social']['dribbble'] 	= 'http://dribbble.com/mo3aser';
	$theme_options['social']['foursquare'] 	= 'https://foursquare.com/mo3aser';
	$theme_options['social']['Pinterest'] 	= 'http://www.pinterest.com/mo3aser/';
	$theme_options['social']['instagram'] 	= 'http://instagram.com/imo3aser';
	
	$theme_options['footer_widgets'] 	= 'footer-4c';
	$theme_options['banner_top'] 		= $theme_options['banner_bottom'] 		= true;
	$theme_options['banner_top_img'] 	= $theme_options['banner_bottom_img'] 	= 'http://themes.tielabs.com/data/banners/sahifa-728.jpg';
	$theme_options['banner_top_url'] 	= $theme_options['banner_bottom_url'] 	= 'http://themeforest.net/item/sahifa-responsive-wordpress-news-magazine-blog-theme/2819356?ref=tielabs';
	
	update_option( 'tie_options' , $theme_options );

//Import Menus
	$top_menu 	= get_term_by('name', 'top', 'nav_menu');
	$main_menu 	= get_term_by('name', 'Main Menu', 'nav_menu');
	set_theme_mod( 'nav_menu_locations' , array('top-menu' => $top_menu->term_id , 'primary' => $main_menu->term_id ) );
	
//HomePage
	$cat1 = $cat2 = $cat3 = $cat4 = $cat5 = 1;
	$cat1 = get_cat_ID( 'World' );
	$cat2 = get_cat_ID( 'Fashion' );
	$cat3 = get_cat_ID( 'Photography' );
	$cat4 = get_cat_ID( 'Sports' );
	$cat5 = get_cat_ID( 'Tech' );
	
	$home_cats = array(
		  array (
		    'id' 		=> $cat1,
		    'order' 	=> 'latest',
		    'number' 	=> '5',
		    'offset' 	=> '',
		    'style' 	=> 'li',
		    'type' 		=> 'n',
		  ),

		  array (
		    'id' 		=> $cat2,
		    'order' 	=> 'latest',
		    'number' 	=> '3',
		    'offset' 	=> '',
		    'style' 	=> '2c',
		    'type' 		=> 'n',
		  ),

		  array (
		    'id' 		=> $cat3,
		    'order' 	=> 'latest',
		    'number' 	=> '3',
		    'offset' 	=> '',
		    'style' 	=> '2c',
		    'type' 		=> 'n',
		  ),

		  array (
		    'id' 		=> $cat4,
		    'title' 	=> 'Scrolling Block',
		    'number' 	=> '6',
		    'offset' 	=> '',
		    'boxid' 	=> 's_1441',
		    'type' 		=> 's',
		  ),

		  array (
		    'id' 		=> $cat1,
		    'title' 	=> 'News In Picture',
		    'offset' 	=> '',
		    'boxid' 	=> 'news-pic_1915',
		    'style' 	=> 'default',
		    'type' 		=> 'news-pic',
		  ),

		  array (
		    'id' 		=> $cat5,
		    'order' 	=> 'latest',
		    'number' 	=> '5',
		    'offset' 	=> '',
		    'style' 	=> '1c',
		    'type' 		=> 'n',
		  ),

		  array (
		    'id' 		=> $cat1,
		    'title' 	=> 'Grid',
		    'offset' 	=> '',
		    'boxid' 	=> 'news-pic_1594',
		    'style' 	=> 'row',
		    'type' 		=> 'news-pic',
		  ),

		  array (
		    'cat' 		=> array ( $cat5, $cat1, $cat4),
		    'boxid' 	=> 'tabs_11027',
		    'type' 		=> 'tabs',
		  ),

		  array (
		    'title' 	=> 'Recent Posts',
		    'number' 	=> '3',
		    'offset' 	=> '',
		    'pagi' 		=> 'true',
		    'boxid' 	=> 'recent_1562',
		    'display'	=> 'blog',
		    'type' 		=> 'recent',
		  )
	);


	$homepage = array(
		'post_name'      => 'tiehome',
		'post_title'     => 'TieLabs HomePage',
		'post_status'    => 'publish',
		'post_type'      => 'page',
		'comment_status' => 'closed'
	); 

	$homepage_id = wp_insert_post( $homepage );

	if( !empty( $homepage_id ) ){

		//Set the page as a homepage
		update_option ( 'show_on_front', 'page' );
		update_option ( 'page_on_front', $homepage_id );

		//Store the page builder elements
		update_post_meta( $homepage_id, 'tie_builder_active',	'yes' );
		update_post_meta( $homepage_id, 'tie_builder',		 	 $home_cats );

		//Blocks Meta options
		update_post_meta( $homepage_id, 'home_exc_length',		'15'   );
		update_post_meta( $homepage_id, 'box_meta_score',		'true' );
		update_post_meta( $homepage_id, 'box_meta_date',		'true' );
		update_post_meta( $homepage_id, 'box_meta_comments',	'true' );

		//Slider
		update_post_meta( $homepage_id, 'featured_posts' , 		'true' );
		update_post_meta( $homepage_id, 'featured_auto',		'true' );
		update_post_meta( $homepage_id, 'featured_posts_speed',	'7000' );
		update_post_meta( $homepage_id, 'featured_posts_time',	'600'  );					
		update_post_meta( $homepage_id, 'featured_posts_number', 10    );
		update_post_meta( $homepage_id, 'featured_posts_query',	'category' );
		update_post_meta( $homepage_id, 'featured_posts_cat',	 array( $cat1, $cat2, $cat3, $cat4, $cat5 ) );

	}


	//Import Widgets
	update_option('sidebars_widgets', '');
	
	//tie_addWidgetToSidebar( 'primary-widget-area' , 'counter-widget', 0, array('facebook' => 'https://www.facebook.com/TieLabs','youtube' => 'http://www.youtube.com/user/TEAMMESAI','vimeo' => 'http://vimeo.com/channels/kidproof'));
	tie_addWidgetToSidebar( 'primary-widget-area' , 'widget_tabs', 0);
	tie_addWidgetToSidebar( 'primary-widget-area' , 'facebook-widget', 0, array('title' => 'Find us on Facebook', 'page_url' => 'https://www.facebook.com/TieLabs'));
	tie_addWidgetToSidebar( 'primary-widget-area' , 'social', 0, array('title' => 'Social', 'tran_bg' => true, 'icons_size' => 32 ));
	tie_addWidgetToSidebar( 'primary-widget-area' , 'ads300_250-widget', 0, array( 'tran_bg' => true, 'new_window' => true, 'ads1_url' => 'http://themeforest.net/item/sahifa-responsive-wordpress-news-magazine-blog-theme/2819356?ref=tielabs', 'ads1_img' => 'http://themes.tielabs.com/data/banners/sahifa-300.jpg' ));
	tie_addWidgetToSidebar( 'primary-widget-area' , 'youtube-widget', 0, array('title' => 'Subscribe to our Channel', 'page_url' => 'TEAMMESAI'));
	tie_addWidgetToSidebar( 'primary-widget-area' , 'login-widget', 0, array('title' => ' Login'));
	
	tie_addWidgetToSidebar( 'first-footer-widget-area'  , 'posts-list-widget', 0, array('title' => 'Popular Posts', 'no_of_posts' => 5, 'thumb' => true , 'posts_order' => 'popular'));
	tie_addWidgetToSidebar( 'second-footer-widget-area' , 'posts-list-widget', 0, array('title' => 'Random Posts', 'no_of_posts' => 5, 'thumb' => true , 'posts_order' => 'random'));
	tie_addWidgetToSidebar( 'third-footer-widget-area'  , 'posts-list-widget', 0, array('title' => 'Latest Posts', 'no_of_posts' => 5, 'thumb' => true ,  'posts_order' => 'latest'));
	tie_addWidgetToSidebar( 'fourth-footer-widget-area' , 'comments_avatar-widget', 0, array('title' => 'Recent Comments', 'thumb' => true , 'no_of_comments' => 5, 'avatar_size' => 50));
	

	tie_addWidgetToSidebar( 'shop-widget-area' , 'woocommerce_widget_cart', 0, array('title' => 'Cart'));
	tie_addWidgetToSidebar( 'shop-widget-area' , 'woocommerce_layered_nav', 0, array('title' => 'Filter by'));
	tie_addWidgetToSidebar( 'shop-widget-area' , 'woocommerce_layered_nav_filters', 0, array('title' => 'Active Filters'));
	tie_addWidgetToSidebar( 'shop-widget-area' , 'woocommerce_price_filter', 0, array('title' => 'Filter by price'));
	tie_addWidgetToSidebar( 'shop-widget-area' , 'woocommerce_product_search', 0, array('title' => 'Search Products'));
	tie_addWidgetToSidebar( 'shop-widget-area' , 'woocommerce_product_tag_cloud', 0, array('title' => 'Product Tags'));
	tie_addWidgetToSidebar( 'shop-widget-area' , 'woocommerce_recently_viewed_products', 0, array('title' => 'Recently Viewed Products', 'number' => 10 ));
	tie_addWidgetToSidebar( 'shop-widget-area' , 'woocommerce_recent_reviews', 0, array('title' => 'Recent Reviews', 'number' => 10 ));
	tie_addWidgetToSidebar( 'shop-widget-area' , 'woocommerce_top_rated_products', 0, array('title' => 'Top Rated Products', 'number' => 5 ));

	//Menus
	$home_page = get_page_by_title( 'home', OBJECT, 'nav_menu_item' );
	update_post_meta( intval( $home_page->ID ) , '_menu_item_url', home_url() );
}

function tie_addWidgetToSidebar($sidebarSlug, $widgetSlug, $countMod, $widgetSettings = array()){
	$sidebarOptions = get_option('sidebars_widgets');
	if(!isset($sidebarOptions[$sidebarSlug])){
	$sidebarOptions[$sidebarSlug] = array('_multiwidget' => 1);
	}
	$newWidget = get_option('widget_'.$widgetSlug);
	if(!is_array($newWidget))$newWidget = array();
	$count = count($newWidget)+1+$countMod;
	$sidebarOptions[$sidebarSlug][] = $widgetSlug.'-'.$count;

	$newWidget[$count] = $widgetSettings;

	update_option('sidebars_widgets', $sidebarOptions);
	update_option('widget_'.$widgetSlug, $newWidget);
}

function tie_demo_installer() { ?>  
	<div id="icon-tools" class="icon32"><br></div>
	<h2><?php _e( 'Import Demo Data', 'tie' ) ?></h2>
	<div style="background-color: #F5FAFD; margin:10px 0;padding: 10px;color: #0C518F;border: 3px solid #CAE0F3; claer:both; width:90%; line-height:18px;">
		<p class="tie_message_hint"><?php _e( 'Importing demo data (post, pages, images, theme settings, ...) is the easiest way to setup your theme. It will allow you to quickly edit everything instead of creating content from scratch. When you import the data following things will happen:', 'tie' ) ?></p>
	  
	  <ul style="padding-left: 20px;list-style-position: inside;list-style-type: square;}">
		  <li><?php _e( 'No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.', 'tie' ) ?></li>
		  <li><?php _e( 'About 10 posts, a few pages, 10+ images, some widgets and two menus will get imported.', 'tie' ) ?></li>
		  <li><?php _e( 'Images will be downloaded from our server, these images are copyrighted and are for demo use only.', 'tie' ) ?></li>
		  <li><?php _e( 'Please click import only once and wait, it can take a couple of minutes.', 'tie' ) ?></li>
	  </ul>
	 </div>
	<form method="post">
		<input type="hidden" name="demononce" value="<?php echo wp_create_nonce('tie-demo-code'); ?>" />
		<input name="reset" class="button" type="submit" value="<?php _e( 'Import Demo Data', 'tie' ) ?>" />
		<input type="hidden" name="action" value="demo-data" />
	</form>
	<br />
	<br />	
<?php
	if(  isset( $_REQUEST['action'] ) && 'demo-data' == $_REQUEST['action'] && check_admin_referer('tie-demo-code' , 'demononce')){
		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
			require_once ABSPATH . 'wp-admin/includes/import.php';
			$importer_error = false;
			if ( !class_exists( 'WP_Importer' ) ) {
				$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
				if ( file_exists( $class_wp_importer ) ){
					require_once($class_wp_importer);
				}
				else{
					$importer_error = true;
				}
			}
			
		if ( !class_exists( 'WP_Import' ) ) {
			$class_wp_import = get_template_directory() . '/framework/admin/inc/importer/wordpress-importer.php';
			if ( file_exists( $class_wp_import ) )
				require_once($class_wp_import);
			else
				$importerError = true;
		}
		if($importer_error){
			die("Error in import :(");
		}else{
			if(!is_file( get_template_directory() . '/framework/admin/inc/importer/sample.xml')){
				_e( "The XML file containing the dummy content is not available or could not be read .. You might want to try to set the file permission to chmod 755.<br/>If this doesn't work please use the WordPress importer and import the XML file (should be located in your download .zip: Sample Content folder) manually", "tie");
			}
			else{
				$wp_import = new WP_Import();
				$wp_import->fetch_attachments = true;
				$wp_import->import( get_template_directory() . '/framework/admin/inc/importer/sample.xml');
		  }
	  }
		tie_set_demo_data();
	}
}
?>