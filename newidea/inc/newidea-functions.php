<?php
/**
 * Here are all newidea custom common function
 *
 * @subpackage newidea
 * @since newidea 4.0
 */
			
/**
 * get Custom Font For google font	
 *
 * @since newidea 1.0
 */
function newidea_get_custom_font(){
	global $newidea_options,$google_fonts,$google_load_fonts,$google_custom_fonts;
	
	$google_load_fonts = "";
	$google_custom_fonts = array();
	
 	$general_font 				= 'Helvetica Neue';
	$general_font_size 			= '12px';
	
	$menu_font					= 'Ropa Sans';
	$menu_font_size				= '16px';
	
	$footer_menu_font			= 'Helvetica';
	$footer_menu_font_size		= '8px';
	
	$title_font					= 'Ropa Sans';
	
	$font_names = array();
	$load = false;

	$array = explode("|",$google_fonts);
	
	if( newidea_get_options_key('custom-general-font') !="0"){
		$font_name = $array[intval($newidea_options['custom-general-font'])-1];
		$general_font = get_current_font_name($font_name.':400,700,400italic,700italic');
		array_push($font_names,$font_name);
	}
	
	if( newidea_get_options_key('custom-general-font-size') !=""){
		$general_font_size = intval($newidea_options['custom-general-font-size']).'px';
	}
		
	if( newidea_get_options_key('menu-font','',false,'0') !="0"){
		$font_name = $array[intval($newidea_options['menu-font'])-1];
		$menu_font = get_current_font_name($font_name);
		array_push($font_names,$font_name.':400,700,400italic,700italic');
	}else{
		$load = true;
	}
	if( newidea_get_options_key('menu-font-size') !=""){
		$menu_font_size = intval($newidea_options['menu-font-size']).'px';
	}
	
	if( newidea_get_options_key('footer-copyright-font','',false,'0') !="0"){
		$font_name = $array[intval($newidea_options['footer-copyright-font'])-1];
		$footer_menu_font = get_current_font_name($font_name);
		array_push($font_names,$font_name.':400,700,400italic,700italic');
	}
	if( newidea_get_options_key('footer-copyright-font-size') !=""){
		$footer_menu_font_size = intval($newidea_options['footer-copyright-font-size']).'px';
	}
	
	if( newidea_get_options_key('custom-title-font','',false,'0') !="0"){
		$font_name = $array[intval($newidea_options['custom-title-font'])-1];
		$title_font = get_current_font_name($font_name);
		array_push($font_names,$font_name.':400,700,400italic,700italic');
	}else{
		$load = true;
	}

	if($load == true) {
		array_push($font_names,'Ropa+Sans:400,700,400italic,700italic');
	}
	
	$google_custom_fonts['general_font']					= $general_font;
	$google_custom_fonts['general_font_size']				= $general_font_size;
	$google_custom_fonts['menu_font']						= $menu_font;
	$google_custom_fonts['menu_font_size']					= $menu_font_size;
	$google_custom_fonts['footer_menu_font']				= $footer_menu_font;
	$google_custom_fonts['footer_menu_font_size']			= $footer_menu_font_size;
	$google_custom_fonts['title_font']						= $title_font;

	$google_load_fonts = implode("|",array_unique($font_names));
}

/**
 * Get current font name
 *
 * @since newidea 1.0
 */
function get_current_font_name($font_name){
	$arr = explode(":", str_replace("+"," ",$font_name) );
	return $arr[0];
}

/**
 * Get custom option key value
 *
 * @since newidea 1.0
 */
function newidea_get_options_key($key,$options = '',$rebool = false,$default = ''){
	global $newidea_options;
	
	if($options == '') $options = $newidea_options;
	
	if(isset($options[$key])){
		if($rebool) return true;
		return $options[$key];
	}else{
		if($rebool) return false;
	}
	return $default;
}

/**
 * Get post custom option key value
 *
 * @since newidea 4.0
 */
function newidea_get_post_meta_key($key, $ID = 0, $default = ''){
	if($ID == 0){ $ID = get_the_ID(); }
	if($ID <= 0){ return $default;}
	$result = get_post_meta($ID , $key , true);
	if($result){ return $result; }
	return $default;
}

if ( ! function_exists( 'newidea_get_post_gallery_ids' ) ) :
/**
 * Get Page,Post custom gallery ids
 *
 * @since newidea 4.0
 */
function newidea_get_post_gallery_ids($gallery_images){
	$ids = array();
	$list = explode("{|}",$gallery_images);
	foreach($list as $item){
		$img_data = explode("<|>",$item);
		if(count($img_data) > 1 && isset($img_data[1])){
			$ids[] = $img_data[1];
		}
	}
	return $ids;
}
endif;


/**
 * Get custom menu
 *
 * @since newidea 1.0
 */
 function newidea_get_menus($menu_name = 'newidea_primary'){
	 // Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)
    // This code based on wp_nav_menu's code to get Menu ID from menu slug
	$menu_array = array();

    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		if($menu != null) {
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			$k = 0;
			
			foreach ( (array) $menu_items as $key => $menu_item ) {
				$template_name = "";

				if($menu_item->type != 'custom'){
				   $template_name = get_post_meta( $menu_item->object_id, '_wp_page_template', true );
				}else{
					if(strpos(strtolower($menu_item->post_name),'ome-') == 1 && strpos(strtolower($menu_item->post_name),'home-') == 0){
						$menu_item->post_name = 'home';
					}
				}
				$menu_array[] = array('id'  => $k,
									'type' => $menu_item->type,
									'post_name'	=>	$menu_item->post_name,
									'template_name' => $template_name,
									'title'	 => $menu_item->title,
									'object_id' => $menu_item->object_id,
									'url' => $menu_item->url);
				$k++;
				
			}
		}
    }
    // $menu_list now ready to output
	return $menu_array;
 }
 
 
 /**
 * Get custom template title
 *
 * @since newidea 1.0
 */
 function newidea_get_template_name($template_name){
	 switch($template_name){
		case 'page-slide.php':
			$template_name = 'slide';
			break;
		case 'page-about.php':
			$template_name = 'about';
			break;
		case 'page-news.php':
			$template_name = 'news';
			break;
		case 'page-services.php':
			$template_name = 'services';
			break;
		case 'page-portfolio.php':
			$template_name = 'portfolio';
			break;
		case 'page-contact.php':
			$template_name = 'contact';
			break; 
		default:
			$template_name = 'page';
	}
	return $template_name;
 }
 
 
 /**
 * Get custom menu nav
 *
 * @since newidea 1.0
 */
 function newidea_get_menus_nav($menus){
 	global $newidea_options;
	$select = '<div class="menu-select"><div class="menu-select-top"><div class="menu-select-title"><span class="ms-title">'.newidea_get_options_key('mobile-menu-title').'</span><span class="ms-arrow menu-arrow"></span></div></div><ul>';
	$output = '';
	$output .= '<div id="navBg" data-align="'.$newidea_options['menu-align'].'" data-left="'.$newidea_options['menu-padding-left'].'"><nav id="nav">';
	if(count($menus) > 0){
		foreach($menus as $menu){
			$title = str_replace(' ','_',strtolower($menu['title']));
			$title = str_replace('&','_',$title);	
			if($menu['type'] == 'custom'){
				if(strtolower($menu['post_name']) == 'home'){
					//Default Home Page
					if(get_option('show_on_front') == 'posts' || intval(get_option('page_on_front')) == 0){
						$select .='<li data-value="#'.$title.'">'.$menu['title'].'</li>';
						$output .= '<a href="#'.$title.'">'.$menu['title'].'</a>';
					}else{
						$post_obj = get_post(get_option('page_on_front'));
						$output .= '<a href="#'.$title.'">'.$menu['title'].'</a>';
						$select .='<li data-value="#'.$title.'">'.$menu['title'].'</li>';
					}
				}else{
					$output .= '<a href="'.$menu['url'].'" target="_blank">'.$menu['title'].'</a>';
					$select .='<li data-value="'.$menu['url'].'">'.$menu['title'].'</li>';
				}
			}else{
				$output .= '<a href="#'.$title.'" data-id="'.$menu['object_id'].'">'.$menu['title'].'</a>';
				$select .='<li data-value="#'.$title.'">'.$menu['title'].'</li>';
			}
		}
		
	} else {
		$output .= __('Please open admin backend\'s <strong><em>Appearance -&gt; Menus</em></strong> and your menu with your pages for Primary menu (<em>Theme Locations</em>).','newidea');
	}
	$select .='</ul></div>';
	$output .= '</nav></div>'.$select;
	return $output;                                          
 }
 
 /**
 * Get background overlay
 *
 * @since newidea 1.0
 */
function newidea_get_background_overlay() {
	global $newidea_options;
	$dir = get_template_directory_uri().'/js/vegas/overlays/';
	$arr = array();
	switch(intval(newidea_get_options_key('home-background-overlay'))){
		case 1:	$arr[0] =  $dir.'01.png';break;
		case 2: $arr[0] =  $dir.'02.png';break;
		case 3: $arr[0] =  $dir.'03.png';break;
		case 4: $arr[0] =  $dir.'04.png';break;
		case 5: $arr[0] =  $dir.'05.png';break;
		case 6: $arr[0] =  $dir.'06.png';break;
		case 7: $arr[0] =  $dir.'07.png';break;
		case 8: $arr[0] =  $dir.'08.png';break;
		case 9: $arr[0] =  $dir.'09.png';break;
		case 10: $arr[0] =  $dir.'10.png';break;
		case 11: $arr[0] =  $dir.'11.png';break;
		case 12:$arr[0] =  $dir.'12.png';break;
		default: $arr[0] =  '';
	}
	$arr[1] = (intval(newidea_get_options_key('home-background-overlay-alpha')) / 100);
	return $arr;
}

 /**
 * Get social
 *
 * @since newidea 1.0
 */
function newidea_get_social(){
	global $newidea_options;

	$social_list = array(	array('twitter','Twitter') ,
							array('facebook', 'Facebook') ,
							array('google', 'Google+') ,
							array('dribbble', 'Dribbble') ,
							array('pinterest', 'Pinterest') ,
							array('flickr', 'Flickr') ,
							array('youtube', 'Youtube') ,
							array('vimeo', 'Vimeo') ,
							array('linkedin', 'Linkedin'),
							array('tumblr', 'Tumblr') ,
							array('behence', 'Behence') ,
							array('forrst', 'Forrst') ,
							array('picasa', 'Picasa') ,
							array('lastfm', 'Lastfm') ,
							array('xing', 'XING'),
							array('instagram', 'instagram'),
							array('stumbleupon', 'StumbleUpon'),
						);
	
	$output = '<div class="social">';
	
	foreach($social_list as $social_item){
		
		if(newidea_get_options_key('social-'.$social_item[0]) != '') {
			$output .= '<a title="'.$social_item[1].'" href="'.newidea_get_options_key('social-'.$social_item[0]).'" target="_blank" class="'.$social_item[0].'"></a>';
		}
	}

	$output .= '</div>';
	return $output;
}

/**
 * Get option  for layerslider
 */
function newidea_get_layerslider(){
	
	$layerslider_slides = array();
	$layerslider_slides[0] = 'Select a slider';
	
	 // Get WPDB Object
    global $wpdb;
 
    // Table name
    $table_name = $wpdb->prefix . "layerslider";

	$sql = "show tables like '$table_name'";
	
	$table = $wpdb->get_var($sql);

	// have no rev slider 
	if($table != $table_name) return $layerslider_slides;
 
    // Get sliders
    $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                        WHERE flag_hidden = '0' AND flag_deleted = '0'
                                        ORDER BY date_c ASC LIMIT 100" );
 
    // Iterate over the sliders
    foreach($sliders as $key => $item) {
 		$layerslider_slides[$item->id] = '#'.$item->id . ' - ' .$item->name;
    }
	
	return $layerslider_slides;
}

/**
 * Get portfolio category  order by id
 */
function newidea_get_portfolio_sort_by_id($arr){
	$categories = $arr;
	$st = array();
					
	foreach($categories as $category){
		$order_id = get_tax_meta($category->term_id,'newidea_portfolio_order_id');
		$order_id = intval($order_id) == 0 ? 0 : intval($order_id);
		$st[] = $order_id;
	}
	
	array_multisort($st, $categories);
	
	return $categories;
}

/**
 * Generate Options CSS
 *
 */
function newidea_generate_options_css() {
	
	$options_update_name = 'newidea_options_update';
	//get theme update history
	$options_update = get_option($options_update_name);
	
	//get theme version
	$theme_old_version = get_option($options_update_name.'-ver');
	$theme_data = wp_get_theme();
	if(!$theme_old_version){
		$theme_old_version = $theme_data['Version'];
		update_option($options_update_name.'-ver', $theme_data['Version']);
	}
	
	/** Define some vars **/
	$uploads = wp_upload_dir();
	
	/** Save on different directory if on multisite **/
	if(is_multisite()) {
		$uploads_dir = $uploads['basedir'].'/'.Penguin::$THEME_NAME.'/';
	} else {
		$uploads_dir = $uploads['basedir'].'/'.Penguin::$THEME_NAME.'/';
	}
	
	if(!is_writable($uploads['basedir'])) {
		echo 'Your wp-content/uploads can\'t write theme style files.';
		return;
	}
	// Create necessary folders under /uploads
	if(!file_exists($uploads_dir)) { mkdir($uploads_dir, 0755); }

	if(isset($options_update['update'])){
		if($options_update['update'] == 'yes'){
			if(version_compare($theme_data['Version'], $theme_old_version, '>')){
				update_option($options_update_name.'-ver', $theme_data['Version']);
			}else{
				if (file_exists($uploads_dir . Penguin::$THEME_NAME.'-styles.css')) {
					return;
				}
			}
		}
		$update_data = array('update'=>'yes','version'=> (intval($options_update['version']) + 1) );
	}else{
		$update_data = array('update'=>'yes','version'=> 0 );
	}

	/** Capture CSS output **/
	ob_start();
	require(get_template_directory() . '/custom/custom-styles.php');
	$css = ob_get_clean();
	
	/** Write to file **/
	WP_Filesystem();
	global $wp_filesystem;
	if ( ! $wp_filesystem->put_contents( $uploads_dir .  Penguin::$THEME_NAME.'-styles.css', $css, 0644) ) {
		echo 'Your wp-content/uploads can\'t write theme style files.';
		return;
	}
	
	update_option($options_update_name ,$update_data);
}