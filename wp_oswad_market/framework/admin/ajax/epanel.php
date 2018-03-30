<?php 
class AjaxEpanel extends AdminTheme
{
	public function __construct(){
		add_action('wp_ajax_general_config', array($this,'saveGeneralConfig'));
		
		add_action('wp_ajax_custom_interface_config', array($this,'saveCustomInterfaceConfig'));
		
		add_action('wp_ajax_custom_advertisement', array($this,'saveCustomadvertisement'));
		
		add_action('wp_ajax_mega_menu_config', array($this,'saveMegaMenuConfig'));

		add_action('wp_ajax_sidebar_manager_config', array($this,'saveSidebarManagerConfig'));
		add_action('wp_ajax_custom_code_area_config', array($this,'saveCustomCodeAreaConfig'));
		
		add_action('wp_ajax_config_single', array($this,'config_single'));
		add_action('wp_ajax_config_archive_page', array($this,'config_archive_page'));
		add_action('wp_ajax_config_product_category', array($this,'config_product_category'));
		add_action('wp_ajax_config_product_single', array($this,'config_product_single'));
		
	}
	
	
	public function config_product_category(){
		if ( !empty($_POST) && wp_verify_nonce($_POST['config_product_category_nonce'],'config_product_category') ){
			$category_product_config = array(
				'cat_columns' 			=> ( isset($_POST['cat_columns']) ? absint($_POST['cat_columns']) : 0 )
				,'cat_layout'			=> ( isset($_POST['cat_layout']) ? $_POST['cat_layout'] : 0 )
				,'cat_left_sidebar' 	=> ( isset($_POST['cat_left_sidebar']) ? $_POST['cat_left_sidebar'] : 0 )
				,'cat_right_sidebar' 	=> ( isset($_POST['cat_right_sidebar']) ? $_POST['cat_right_sidebar'] : 0 )					
			);
			$category_product_config = wd_array_atts(
				array(
					'cat_columns' 				=> 3
					,'cat_layout' 				=> "1-1-0"
					,'cat_left_sidebar' 		=> "product-category-widget-area-left"
					,'cat_right_sidebar' 		=> "product-category-widget-area-right"			
				),$category_product_config);	
					
			update_option(THEME_SLUG.'category_product_config',serialize($category_product_config));
		}
	}
	
	public function config_product_single(){
		if ( !empty($_POST) && wp_verify_nonce($_POST['config_product_single_nonce'],'config_product_single') ){
			$single_product_config = array(
				'show_image' 			=> ( isset($_POST['show_image']) 			? absint($_POST['show_image']) 						: 0 )
				,'show_label'			=> ( isset($_POST['show_label']) 			? absint($_POST['show_label']) 						: 0 )
				,'show_title' 			=> ( isset($_POST['show_title']) 			? absint($_POST['show_title']) 						: 0 )
				,'show_email' 			=> ( isset($_POST['show_email']) 			? absint($_POST['show_email']) 						: 0 )
				,'show_sku' 			=> ( isset($_POST['show_sku']) 				? absint($_POST['show_sku']) 						: 0 )
				,'show_rating' 			=> ( isset($_POST['show_rating']) 				? absint($_POST['show_rating']) 						: 0 )
				,'show_view' 			=> ( isset($_POST['show_view']) 			? absint($_POST['show_view']) 						: 0 )
				,'show_review' 			=> ( isset($_POST['show_review']) 			? absint($_POST['show_review']) 					: 0 )
				,'show_availability' 	=> ( isset($_POST['show_availability']) 	? absint($_POST['show_availability']) 				: 0 )
				,'show_add_to_cart' 	=> ( isset($_POST['show_add_to_cart']) 		? absint($_POST['show_add_to_cart']) 				: 0 )
				,'show_price' 			=> ( isset($_POST['show_price']) 			? absint($_POST['show_price']) 						: 0 )
				,'show_short_desc' 		=> ( isset($_POST['show_short_desc']) 		? absint($_POST['show_short_desc']) 				: 0 )			
				,'show_meta' 			=> ( isset($_POST['show_meta']) 			? absint($_POST['show_meta']) 						: 0 )
				,'show_related' 		=> ( isset($_POST['show_related']) 			? absint($_POST['show_related']) 					: 0 )
				,'related_title' 		=> ( isset($_POST['related_title']) 		? wp_kses_data($_POST['related_title']) 			: '' )
				,'show_sharing' 		=> ( isset($_POST['show_sharing']) 			? absint($_POST['show_sharing']) 					: 0 )
				,'sharing_title' 		=> ( isset($_POST['sharing_title']) 		? wp_kses_data($_POST['sharing_title']) 			: '' )
				,'sharing_intro' 		=> ( isset($_POST['sharing_intro']) 		? htmlspecialchars($_POST['sharing_intro']) 		: '' )
				,'sharing_custom_code' 	=> ( isset($_POST['sharing_custom_code']) 	? htmlspecialchars($_POST['sharing_custom_code']) 	: '' )
				,'show_ship_return' 	=> ( isset($_POST['show_ship_return']) 		? absint($_POST['show_ship_return']) 				: 0 )
				,'ship_return_title' 	=> ( isset($_POST['ship_return_title']) 	? $_POST['ship_return_title'] 						: '' )
				,'ship_return_content' 	=> ( isset($_POST['ship_return_content']) 	? htmlspecialchars($_POST['ship_return_content']) 	: '' )
				,'show_tabs' 			=> ( isset($_POST['show_tabs']) 			? absint($_POST['show_tabs']) 						: 0 )
				,'show_custom_tab' 		=> ( isset($_POST['show_custom_tab']) 		? absint($_POST['show_custom_tab']) 				: 0 )
				,'custom_tab_title' 	=> ( isset($_POST['custom_tab_title']) 		? $_POST['custom_tab_title'] 						: '' )		
				,'custom_tab_content' 	=> ( isset($_POST['custom_tab_content']) 	? htmlspecialchars($_POST['custom_tab_content']) 	: '' )
				,'show_upsell' 			=> ( isset($_POST['show_upsell']) 			? absint($_POST['show_upsell']) 					: 0 )
				,'upsell_title' 		=> ( isset($_POST['upsell_title']) 			? wp_kses_data($_POST['upsell_title'])				: '' )
				,'layout' 				=> ( isset($_POST['layout']) 				? $_POST['layout'] 									: '0-1-0' )
				,'left_sidebar' 		=> ( isset($_POST['left_sidebar']) 			? $_POST['left_sidebar'] 							: '' )
				,'right_sidebar' 		=> ( isset($_POST['right_sidebar']) 		? $_POST['right_sidebar'] 							: '' )						
			);
			
			
			
			$single_product_config = wd_array_atts(
				array(
					'show_image' 			=> 1
					,'show_label' 			=> 1
					,'show_title' 			=> 1
					,'show_email' 			=> 1
					,'show_sku' 			=> 1
					,'show_rating' 			=> 1
					,'show_view' 			=> 1
					,'show_review' 			=> 1
					,'show_availability' 	=> 1
					,'show_add_to_cart' 	=> 1
					,'show_price' 			=> 1
					,'show_short_desc'		=> 1
					,'show_meta' 			=> 1
					,'show_related' 		=> 1
					,'show_sharing'			=> 1
					,'related_title' 		=> __("Related Products","wpdance")
					,'sharing_title' 		=> "Share this"
					,'sharing_intro' 		=> "Love it?Share with your friend"
					,'sharing_custom_code' 	=> ""
					,'show_ship_return' 	=> 1				
					,'ship_return_title' 	=> 'FREE SHIPPING & RETURN'	
					,'ship_return_content' 	=>  htmlentities('<a href="#"><img src="http://demo.wpdance.com/imgs/woocommerce/return_shipping.png" alt="free shipping and return" title="free shipping and return"></a><div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry'."'".'s standard dummy text ever since the 1500s</div>')
					,'show_tabs' 			=> 1
					,'show_custom_tab' 		=> 1	
					,'custom_tab_title' 	=> "Custom Title"				
					,'custom_tab_content' 	=> "<div>Table content goes here</div>"				
					,'show_upsell' 			=> 1
					,'upsell_title'			=> __("YOU MAY ALSO BE INTERESTED IN THE FOLLOWING PRODUCT(S)",'wpdance')
					,'layout' 				=> '0-1-0'
					,'left_sidebar' 		=> 'product-widget-area-left'
					,'right_sidebar' 		=> 'product-widget-area-right'				
					)
					,$single_product_config);	
					
			update_option(THEME_SLUG.'single_product_config',serialize($single_product_config));
		}	
	}
	
	
	public function saveMegaMenuConfig(){
		if( (int)$_POST['edit-mega_menu'] == 1 ){
			$thumbnail_width = (int)$_POST['thumbnail_width'] > 0 ? (int)$_POST['thumbnail_width'] : 16;
			$thumbnail_height = (int)$_POST['thumbnail_height'] > 0 ? (int)$_POST['thumbnail_height'] : 16;
			$area_number = (int)$_POST['area_number'] > 0 ? (int)$_POST['area_number'] : 1;
			$menu_text = strlen(trim($_POST['menu_text'])) > 0 ? wp_kses_data($_POST['menu_text']) : "Menu";
			$disabled_on_phone = (int)$_POST['disabled_on_phone'] > 0 ? (int)$_POST['disabled_on_phone'] : 0;

			
			
			$wd_mega_menu_config_arr = array(
				'area_number' => $area_number
				,'thumbnail_width' => $thumbnail_width
				,'thumbnail_height' => $thumbnail_height
				,'menu_text' => $menu_text
				,'disabled_on_phone' => $disabled_on_phone
			);
			update_option(THEME_SLUG.'wd_mega_menu_config',serialize($wd_mega_menu_config_arr));
		}
	}
	
	public function saveGeneralConfig(){
		update_option('text_logo',wp_kses_data($_POST['logo_text']) );
		
		
		if( $_POST['wd_custom_logo'] ){
			update_option(THEME_SLUG.'logo',wp_kses_data($_POST['wd_custom_logo']));
		}
		if( $_POST['wd_custom_iconlogo'] ){
			update_option(THEME_SLUG.'icon',wp_kses_data($_POST['wd_custom_iconlogo']));
		}	
   
		if( $_POST['contact_content'] ){
			update_option(THEME_SLUG.'contact_content',htmlspecialchars($_POST['contact_content']));
		}		
	  
		$_new_size_arr = array(
			array( absint($_POST['custom-width-1']) > 0 ? absint($_POST['custom-width-1']) : 1200 , absint($_POST['custom-height-1']) > 0 ? absint($_POST['custom-height-1']) : 450 )
			,array( absint($_POST['custom-width-2']) > 0 ? absint($_POST['custom-width-2']) : 960 , absint($_POST['custom-height-2']) > 0 ? absint($_POST['custom-height-2']) : 350 )
			,array( absint($_POST['custom-width-3']) > 0 ? absint($_POST['custom-width-3']) : 190 , absint($_POST['custom-height-3']) > 0 ? absint($_POST['custom-height-3']) : 122 )
		);
	  
		update_option( THEME_SLUG.'custom_size',serialize($_new_size_arr) );
		
		update_option(THEME_SLUG.'facebok_link', $_POST['facebok_link']);
		update_option(THEME_SLUG.'twitter_link', $_POST['twitter_link']);
		update_option(THEME_SLUG.'rss_link', $_POST['rss_link']);
		update_option(THEME_SLUG.'pinterest_link', $_POST['pinterest_link']);
		update_option(THEME_SLUG.'google_link', $_POST['google_link']);
		
		update_option(THEME_SLUG.'visa_link', $_POST['visa_link']);
		update_option(THEME_SLUG.'mastercard_link', $_POST['mastercard_link']);
		update_option(THEME_SLUG.'americanexpress_link', $_POST['americanexpress_link']);
		update_option(THEME_SLUG.'paypal_link', $_POST['paypal_link']);
		
		update_option(THEME_SLUG.'copyright_text', wp_kses_data($_POST['copyright_text']));
		require_once THEME_ADMIN_TPL.'/epanel/general.php';
	}
	
	public function saveCustomInterfaceConfig(){

		$enable_custom_preview = (int) $_POST['enable-custom-preview'];
		$enable_custom_font = (int) $_POST['enable-custom-font'];
		$enable_custom_color = (int) $_POST['enable-custom-color'];
			
		global $default_custom_style_config;
		
		$body_font_weight = wp_kses_data($_POST['body_font_style_str']);
		$body_font_weight = ( strcmp( $body_font_weight,"regular" ) == 0 ) ? '400' : $body_font_weight;
		$body_font_weight = ( strcmp( $body_font_weight,'italic' ) == 0 ) ? '400italic' : $body_font_weight;
		
		$heading_font_weight = wp_kses_data($_POST['heading_font_style_str']);
		$heading_font_weight = ( strcmp( $heading_font_weight,'regular' ) == 0 ) ? '400' : $heading_font_weight;
		$heading_font_weight = ( strcmp( $heading_font_weight,'italic' ) == 0 ) ? '400italic' : $heading_font_weight;	

		$menu_font_weight = wp_kses_data($_POST['menu_font_style_str']);
		$menu_font_weight = ( strcmp( $menu_font_weight,'regular' ) == 0 ) ? '400' : $menu_font_weight;
		$menu_font_weight = ( strcmp( $menu_font_weight,'italic' ) == 0 ) ? '400italic' : $menu_font_weight	;	
		
		$sub_menu_font_weight = wp_kses_data($_POST['sub_menu_font_style_str']);
		$sub_menu_font_weight = ( strcmp( $sub_menu_font_weight,'regular' ) == 0 ) ? '400' : $sub_menu_font_weight;
		$sub_menu_font_weight = ( strcmp( $sub_menu_font_weight,'italic' ) == 0 ) ? '400italic' : $sub_menu_font_weight	;
		
		$body_font_style = strpos($body_font_weight, 'italic') == false ? 'normal' : 'italic';
		$heading_font_style = strpos($heading_font_weight, 'italic') == false ? 'normal' : 'italic';	
		$menu_font_style = strpos($menu_font_weight, 'italic') == false ? 'normal' : 'italic';	
		$sub_menu_font_style = strpos($sub_menu_font_weight, 'italic') == false ? 'normal' : 'italic';	

		$body_font_weight = str_replace( "italic", "", $body_font_weight );		
		$heading_font_weight = str_replace( "italic", "", $heading_font_weight );
		$menu_font_weight = str_replace( "italic", "", $menu_font_weight );
		$sub_menu_font_weight = str_replace( "italic", "", $sub_menu_font_weight );
		
		$save_datas = array(			
			'enable_custom_preview' 				=> $enable_custom_preview
			,'enable_custom_font' 					=> $enable_custom_font
			,'enable_custom_color' 					=> $enable_custom_color
			,'page_layout' 							=> wp_kses_data($_POST['page_layout'])


			,'font_sort' =>  $_POST['font_sort']

			/******** Body font *******/
			,"body_font_name" 						=> wp_kses_data($_POST['body_font'])
			,"body_font_style" 						=> $body_font_style
			,"body_font_style_str" 					=> wp_kses_data($_POST['body_font_style_str'])
			,"body_font_weight" 					=> $body_font_weight

			/******** Heading font *******/
			,"heading_font_name" 					=> wp_kses_data($_POST['heading_font'])
			,"heading_font_style"					=> $heading_font_style
			,"heading_font_style_str"				=> wp_kses_data($_POST['heading_font_style_str'])
			,"heading_font_weight" 					=> $heading_font_weight

			/******** Menu font *******/
			,"menu_font_name" 						=> wp_kses_data($_POST['menu_font'])
			,"menu_font_style" 						=> $menu_font_style
			,"menu_font_style_str" 					=> wp_kses_data($_POST['menu_font_style_str'])
			,"menu_font_weight" 					=> $menu_font_weight		
			
			/********Sub Menu font *******/
			,"sub_menu_font_name" 						=> wp_kses_data($_POST['sub_menu_font'])
			,"sub_menu_font_style" 						=> $sub_menu_font_style
			,"sub_menu_font_style_str" 					=> wp_kses_data($_POST['sub_menu_font_style_str'])
			,"sub_menu_font_weight" 					=> $sub_menu_font_weight

			,"primary_color" 							=> ( wd_valid_color($_POST['primary_color']) ? $_POST['primary_color'] : '' ) 
			,"secondary_color" 							=> ( wd_valid_color($_POST['secondary_color']) ? $_POST['secondary_color'] : '' ) 
			
			,"header_top_background" 				=> ( wd_valid_color($_POST['header_top_background']) ? $_POST['header_top_background'] : '' ) 
			,"header_top_text_color" 				=> ( wd_valid_color($_POST['header_top_text_color']) ? $_POST['header_top_text_color'] : '' ) 
			,"header_top_link_color" 				=> ( wd_valid_color($_POST['header_top_link_color']) ? $_POST['header_top_link_color'] : '' ) 
			,"header_top_social_background_hover" 	=> ( wd_valid_color($_POST['header_top_social_background_hover']) ? $_POST['header_top_social_background_hover'] : '' ) 
			,"header_menu_text_color" 				=> ( wd_valid_color($_POST['header_menu_text_color']) ? $_POST['header_menu_text_color'] : '' ) 
			,"header_menu_active_text_color" 		=> ( wd_valid_color($_POST['header_menu_active_text_color']) ? $_POST['header_menu_active_text_color'] : '' ) 
			,"header_submenu_text_color" 			=> ( wd_valid_color($_POST['header_submenu_text_color']) ? $_POST['header_submenu_text_color'] : '' ) 
			,"header_submenu_link_color" 			=> ( wd_valid_color($_POST['header_submenu_link_color']) ? $_POST['header_submenu_link_color'] : '' ) 
			,"header_submenu_border_top_color" 		=> ( wd_valid_color($_POST['header_submenu_border_top_color']) ? $_POST['header_submenu_border_top_color'] : '' ) 
			,"header_submenu_border_color" 			=> ( wd_valid_color($_POST['header_submenu_border_color']) ? $_POST['header_submenu_border_color'] : '' ) 
			,"header_submenu_hover_item_color" 		=> ( wd_valid_color($_POST['header_submenu_hover_item_color']) ? $_POST['header_submenu_hover_item_color'] : '' ) 

			
			,"footer_first_area_background_color" 	=> ( ($_POST['footer_first_area_background_color']) ? $_POST['footer_first_area_background_color'] : '' ) 
			,"footer_first_area_text_color" 		=> ( wd_valid_color($_POST['footer_first_area_text_color']) ? $_POST['footer_first_area_text_color'] : '' ) 
			,"footer_first_area_link_color" 		=> ( wd_valid_color($_POST['footer_first_area_link_color']) ? $_POST['footer_first_area_link_color'] : '' ) 
			,"footer_first_area_link_color_hover" 	=> ( wd_valid_color($_POST['footer_first_area_link_color_hover']) ? $_POST['footer_first_area_link_color_hover'] : '' ) 
			,"footer_first_area_heading_color" 		=> ( wd_valid_color($_POST['footer_first_area_heading_color']) ? $_POST['footer_first_area_heading_color'] : '' ) 
			,"footer_first_area_border_color" 		=> ( wd_valid_color($_POST['footer_first_area_border_color']) ? $_POST['footer_first_area_border_color'] : '' ) 
			
			,"footer_second_area_background_color" 	=> ( wd_valid_color($_POST['footer_second_area_background_color']) ? $_POST['footer_second_area_background_color'] : '' ) 
			,"footer_second_area_text_color" 		=> ( wd_valid_color($_POST['footer_second_area_text_color']) ? $_POST['footer_second_area_text_color'] : '' ) 
			,"footer_second_area_link_color" 		=> ( wd_valid_color($_POST['footer_second_area_link_color']) ? $_POST['footer_second_area_link_color'] : '' ) 
			,"footer_second_area_link_color_hover" 	=> ( wd_valid_color($_POST['footer_second_area_link_color_hover']) ? $_POST['footer_second_area_link_color_hover'] : '' ) 
			,"footer_second_area_heading_color" 	=> ( wd_valid_color($_POST['footer_second_area_heading_color']) ? $_POST['footer_second_area_heading_color'] : '' ) 
			,"footer_second_area_border_color" 		=> ( wd_valid_color($_POST['footer_second_area_border_color']) ? $_POST['footer_second_area_border_color'] : '' ) 
			
			,"footer_thrid_area_background_color" 	=> ( wd_valid_color($_POST['footer_thrid_area_background_color']) ? $_POST['footer_thrid_area_background_color'] : '' ) 
			,"footer_thrid_area_text_color" 		=> ( wd_valid_color($_POST['footer_thrid_area_text_color']) ? $_POST['footer_thrid_area_text_color'] : '' ) 
			,"footer_thrid_area_link_color" 		=> ( wd_valid_color($_POST['footer_thrid_area_link_color']) ? $_POST['footer_thrid_area_link_color'] : '' ) 
			,"footer_thrid_area_link_color_hover" 	=> ( wd_valid_color($_POST['footer_thrid_area_link_color_hover']) ? $_POST['footer_thrid_area_link_color_hover'] : '' ) 
			,"footer_thrid_area_border_color" 		=> ( wd_valid_color($_POST['footer_thrid_area_border_color']) ? $_POST['footer_thrid_area_border_color'] : '' ) 
			
			,"sidebar_text_color" 					=> ( wd_valid_color($_POST['sidebar_text_color']) ? $_POST['sidebar_text_color'] : '' ) 
			,"sidebar_link_color" 					=> ( wd_valid_color($_POST['sidebar_link_color']) ? $_POST['sidebar_link_color'] : '' ) 
			,"sidebar_link_color_hover" 			=> ( wd_valid_color($_POST['sidebar_link_color_hover']) ? $_POST['sidebar_link_color_hover'] : '' ) 
			,"sidebar_heading_color" 				=> ( wd_valid_color($_POST['sidebar_heading_color']) ? $_POST['sidebar_heading_color'] : '' ) 
			,"sidebar_border_color" 				=> ( wd_valid_color($_POST['sidebar_border_color']) ? $_POST['sidebar_border_color'] : '' ) 
			
			,"primary_text_color" 					=> ( wd_valid_color($_POST['primary_text_color']) ? $_POST['primary_text_color'] : '' ) 
			,"primary_link_color" 					=> ( wd_valid_color($_POST['primary_link_color']) ? $_POST['primary_link_color'] : '' ) 
			,"primary_link_color_hover" 							=> ( wd_valid_color($_POST['primary_link_color_hover']) ? $_POST['primary_link_color_hover'] : '' ) 
			,"primary_heading_color" 				=> ( wd_valid_color($_POST['primary_heading_color']) ? $_POST['primary_heading_color'] : '' ) 
			,"primary_button_background_color" 						=> ( wd_valid_color($_POST['primary_button_background_color']) ? $_POST['primary_button_background_color'] : '' ) 
			,"primary_button_border_color" 			=> ( wd_valid_color($_POST['primary_button_border_color']) ? $_POST['primary_button_border_color'] : '' ) 			
			,"primary_button_text_color" 					=> ( wd_valid_color($_POST['primary_button_text_color']) ? $_POST['primary_button_text_color'] : '' ) 	
			,"primary_button_background_color_hover" 						=> ( wd_valid_color($_POST['primary_button_background_color_hover']) ? $_POST['primary_button_background_color_hover'] : '' ) 	
			,"primary_button_border_color_hover" 					=> ( wd_valid_color($_POST['primary_button_border_color_hover']) ? $_POST['primary_button_border_color_hover'] : '' ) 
			,"primary_button_text_color_hover" 					=> ( wd_valid_color($_POST['primary_button_text_color_hover']) ? $_POST['primary_button_text_color_hover'] : '' ) 
			,"secondary_button_background_color" 							=> ( wd_valid_color($_POST['secondary_button_background_color']) ? $_POST['secondary_button_background_color'] : '' ) 
			,"secondary_button_border_color" 				=> ( wd_valid_color($_POST['secondary_button_border_color']) ? $_POST['secondary_button_border_color'] : '' ) 
			,"secondary_button_text_color" 						=> ( wd_valid_color($_POST['secondary_button_text_color']) ? $_POST['secondary_button_text_color'] : '' ) 
			,"secondary_button_background_color_hover" 						=> ( wd_valid_color($_POST['secondary_button_background_color_hover']) ? $_POST['secondary_button_background_color_hover'] : '' )
			,"secondary_button_border_color_hover" 						=> ( wd_valid_color($_POST['secondary_button_border_color_hover']) ? $_POST['secondary_button_border_color_hover'] : '' )
			,"secondary_button_text_color_hover" 						=> ( wd_valid_color($_POST['secondary_button_text_color_hover']) ? $_POST['secondary_button_text_color_hover'] : '' )
			
			,"primary_border_color" 			=> ( wd_valid_color($_POST['primary_border_color']) ? $_POST['primary_border_color'] : '' ) 			
			,"primary_border_color_hover" 					=> ( wd_valid_color($_POST['primary_border_color_hover']) ? $_POST['primary_border_color_hover'] : '' ) 	
			,"secondary_border_color" 						=> ( wd_valid_color($_POST['secondary_border_color']) ? $_POST['secondary_border_color'] : '' ) 		
			,"secondary_border_color_hover" 						=> ( wd_valid_color($_POST['secondary_border_color_hover']) ? $_POST['secondary_border_color_hover'] : '' ) 
			,"primary_tab_background_color" 			=> ( wd_valid_color($_POST['primary_tab_background_color']) ? $_POST['primary_tab_background_color'] : '' ) 			
			,"primary_tab_border_color" 					=> ( wd_valid_color($_POST['primary_tab_border_color']) ? $_POST['primary_tab_border_color'] : '' ) 	
			,"primary_tab_text_color" 						=> ( wd_valid_color($_POST['primary_tab_text_color']) ? $_POST['primary_tab_text_color'] : '' ) 	
			,"primary_tab_active_text_color" 						=> ( wd_valid_color($_POST['primary_tab_active_text_color']) ? $_POST['primary_tab_active_text_color'] : '' ) 	
			
			,"cart_icon_color" 	=> ( wd_valid_color($_POST['cart_icon_color']) ? $_POST['cart_icon_color'] : '' ) 	
			,"cart_background_color" 		=> ( wd_valid_color($_POST['cart_background_color']) ? $_POST['cart_background_color'] : '' ) 
			,"cart_background_color_hover" 			=> ( wd_valid_color($_POST['cart_background_color_hover']) ? $_POST['cart_background_color_hover'] : '' ) 
			,"feedback_background"		=> ( wd_valid_color($_POST['feedback_background']) ? $_POST['feedback_background'] : '' ) 
			,"feedback_background_hover" 			=> ( wd_valid_color($_POST['feedback_background_hover']) ? $_POST['feedback_background_hover'] : '' ) 
			,"totop_background" 				=> ( wd_valid_color($_POST['totop_background']) ? $_POST['totop_background'] : '' ) 
			,"totop_background_hover" 			=> ( wd_valid_color($_POST['totop_background_hover']) ? $_POST['totop_background_hover'] : '' ) 			
			,"scollbar" 	=> ( wd_valid_color($_POST['scollbar']) ? $_POST['scollbar'] : '' ) 	
			,"rating_color" 			=> ( wd_valid_color($_POST['rating_color']) ? $_POST['rating_color'] : '' ) 		
			,"quickshop_text_color" 	=> ( wd_valid_color($_POST['quickshop_text_color']) ? $_POST['quickshop_text_color'] : '' ) 
			,"quickshop_background_color" 	=> ( wd_valid_color($_POST['quickshop_background_color']) ? $_POST['quickshop_background_color'] : '' ) 			
			,"quickshop_background_color_hover" 		=> ( wd_valid_color($_POST['quickshop_background_color_hover']) ? $_POST['quickshop_background_color_hover'] : '' ) 
		);	
		global $default_custom_style_config,$wd_custom_style_config;
		$save_datas = wd_array_atts($default_custom_style_config,$save_datas);
		$save_datas_2 = wd_array_atts_str($default_custom_style_config,$save_datas);
		$wd_custom_style_config = $save_datas_2;
		update_option(THEME_SLUG.'custom_style_config',serialize($save_datas_2));
		
		save_custom_style($save_datas_2);
	}
	



	public function saveSidebarManagerConfig(){
		if(count($_POST['areas'])){
			$_sidebar_array = array();
			foreach( $_POST['areas'] as $_area ){
				$_area = sanitize_text_field($_area);
				$_sidebar_array[] = strtolower( str_replace(" ","-",$_area) );
				$_area_name = stripslashes(esc_html(ucwords($_area)));
				$_init_sidebar_array[] = array(
							'name' => sprintf( __( '%s Widget Area','wpdance' ), $_area_name )
							,'id' => stripslashes(esc_html(strtolower( str_replace(" ","-",$_area) ) ) )
							,'description' => sprintf( __( '%s sidebar widget area','wpdance' ), $_area_name ) //__( "{$_area_name} sidebar widget area", 'wpdance' )
							,'before_widget' => '<li id="%1$s" class="widget-container %2$s">'
							,'after_widget' => '</li>'
							,'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">'
							,'after_title' => '</h3></div>'
				);	
				
			}
			update_option(THEME_SLUG.'areas',json_encode($_sidebar_array));
		}
		
		
		
		global $default_sidebars;
		$default_sidebars = array_merge($default_sidebars,$_init_sidebar_array);
		foreach( $default_sidebars as $sidebar ){
			register_sidebar($sidebar);
		}			
		
	
	}
	
	public function saveCustomCodeAreaConfig(){
		update_option(THEME_SLUG.'code_to_top_post', htmlspecialchars($_POST['code_to_top_post']) );
		update_option(THEME_SLUG.'code_to_bottom_post', htmlspecialchars($_POST['code_to_bottom_post']) );
		update_option(THEME_SLUG.'code_before_end_body', htmlspecialchars($_POST['code_before_end_body']) );
		update_option(THEME_SLUG.'google_analytics', htmlspecialchars($_POST['google_analytics']) );
	}
	public function saveCustomadvertisement(){
		update_option(THEME_SLUG.'headerAdsEnable',sanitize_text_field($_POST['header-ads-enable']));
		update_option(THEME_SLUG.'headerAdsType',sanitize_text_field($_POST['ads-type']));
		update_option(THEME_SLUG.'headerAdsImg',wp_kses_data($_POST['image_url']));
		update_option(THEME_SLUG.'headerAdsUrl',wp_kses_data($_POST['banner_url']) );
		update_option(THEME_SLUG.'headerAdsTitle',wp_kses_data($_POST['banner_title']));
		update_option(THEME_SLUG.'headerAdsCode',htmlspecialchars($_POST['ads_code']));
	}
	public function config_single(){
		$single_post_config = array(
			'show_category' 				=> ( isset($_POST['show_category']) 				? 	absint($_POST['show_category'])						: 0 )
			,'show_author_post_link' 		=> ( isset($_POST['show_author_post_link']) 		? 	absint($_POST['show_author_post_link']) 			: 0 )
			,'show_time' 					=> ( isset($_POST['show_time']) 					? 	absint($_POST['show_time']) 						: 0 )
			,'show_tags' 					=> ( isset($_POST['show_tags']) 					? 	absint($_POST['show_tags']) 						: 0 )
			,'show_thumb' 					=> ( isset($_POST['show_thumb']) 					? 	absint($_POST['show_thumb']) 						: 0 )
			,'show_view_count' 				=> ( isset($_POST['show_view_count']) 				? 	absint($_POST['show_view_count']) 					: 0 )
			,'show_comment_count' 			=> ( isset($_POST['show_comment_count']) 			? 	absint($_POST['show_comment_count']) 				: 0 )
			,'show_social' 					=> ( isset($_POST['show_social']) 					? 	absint($_POST['show_social']) 						: 0 )
			,'show_author' 					=> ( isset($_POST['show_author']) 					? 	absint($_POST['show_author']) 						: 0 )
			,'show_related' 				=> ( isset($_POST['show_related']) 					? 	absint($_POST['show_related']) 						: 0 )
			,'related_label' 				=> ( isset($_POST['related_label']) 				? 	sanitize_text_field($_POST['related_label'])		: "Related Posts" )
			,'show_comment_list' 			=> ( isset($_POST['show_comment_list']) 			? 	absint($_POST['show_comment_list']) 				: 0 )
			,'comment_list_label' 			=> ( isset($_POST['comment_list_label']) 			? 	sanitize_text_field($_POST['comment_list_label'])	: "Responds" )
			,'num_post_related' 			=> ( isset($_POST['num_post_related']) 				? 	absint($_POST['num_post_related']) 					: 4 )		
			,'show_category_phone' 			=> ( isset($_POST['show_category_phone']) 			? 	absint($_POST['show_category_phone']) 				: 0 )
			,'show_author_post_link_phone' 	=> ( isset($_POST['show_author_post_link_phone']) 	? 	absint($_POST['show_author_post_link_phone']) 		: 0 )
			,'show_time_phone' 				=> ( isset($_POST['show_time_phone']) 				? 	absint($_POST['show_time_phone']) 					: 0 )
			,'show_tags_phone' 				=> ( isset($_POST['show_tags_phone']) 				? 	absint($_POST['show_tags_phone']) 					: 0 )
			,'show_thumb_phone' 			=> ( isset($_POST['show_thumb_phone']) 				? 	absint($_POST['show_thumb_phone']) 					: 0 )
			,'show_view_count_phone' 		=> ( isset($_POST['show_view_count_phone']) 		? 	absint($_POST['show_view_count_phone']) 			: 0 )
			,'show_comment_count_phone' 	=> ( isset($_POST['show_comment_count_phone']) 		? 	absint($_POST['show_comment_count_phone']) 			: 0 )
			,'show_social_phone' 			=> ( isset($_POST['show_social_phone']) 			? 	absint($_POST['show_social_phone']) 				: 0 )
			,'show_author_phone' 			=> ( isset($_POST['show_author_phone']) 			? 	absint($_POST['show_author_phone']) 				: 0 )
			,'show_related_phone' 			=> ( isset($_POST['show_related_phone']) 			? 	absint($_POST['show_related_phone']) 				: 0 )
			,'show_comment_list_phone' 		=> ( isset($_POST['show_comment_list_phone']) 		? 	absint($_POST['show_comment_list_phone']) 			: 0 )			
		);
		
		$single_post_config = wd_array_atts(
			array(
					'show_category' 						=> 1
					,'show_author_post_link' 				=> 1
					,'show_time' 							=> 1
					,'show_tags' 							=> 1
					,'show_thumb' 							=> 1
					,'show_view_count' 						=> 1
					,'show_comment_count' 					=> 1
					,'show_social' 							=> 1
					,'show_author' 							=> 1
					,'show_related' 						=> 1
					,'related_label' 						=> "Related Posts"
					,'show_comment_list' 					=> 1				
					,'comment_list_label' 					=> "Responds"				
					,'num_post_related' 					=> 4
					,'show_category_phone' 					=> 1
					,'show_author_post_link_phone' 			=> 1
					,'show_time_phone' 						=> 1
					,'show_tags_phone' 						=> 1
					,'show_thumb_phone' 					=> 1
					,'show_view_count_phone' 				=> 1
					,'show_comment_count_phone' 			=> 1
					,'show_social_phone' 					=> 1
					,'show_author_phone' 					=> 1
					,'show_related_phone' 					=> 1
					,'show_comment_list_phone' 				=> 1						
				)
				,$single_post_config);	
				
		update_option(THEME_SLUG.'single_post_config',serialize($single_post_config));
	}
	
	public function config_archive_page(){
		$archive_page_config = array(
			'show_category' 					=> ( isset($_POST['show_category']) 					? 	absint($_POST['show_category']) 				: 0 )
			,'show_author_post_link' 			=> ( isset($_POST['show_author_post_link']) 			? 	absint($_POST['show_author_post_link']) 		: 0 )
			,'show_time' 						=> ( isset($_POST['show_time']) 						? 	absint($_POST['show_time']) 					: 0 )
			,'show_tags' 						=> ( isset($_POST['show_tags']) 						? 	absint($_POST['show_tags']) 					: 0 )
			,'show_views_count' 				=> ( isset($_POST['show_views_count']) 					? 	absint($_POST['show_views_count']) 				: 0 )
			,'show_comment_count' 				=> ( isset($_POST['show_comment_count']) 				? 	absint($_POST['show_comment_count']) 			: 0 )
			,'show_excerpt' 					=> ( isset($_POST['show_excerpt']) 						? 	absint($_POST['show_excerpt']) 					: 0 )
			,'show_thumb' 						=> ( isset($_POST['show_thumb']) 						? 	absint($_POST['show_thumb']) 					: 0 )
			,'show_read_more' 					=> ( isset($_POST['show_read_more']) 					? 	absint($_POST['show_read_more']) 				: 0 )
			,'show_category_phone' 				=> ( isset($_POST['show_category_phone']) 				? 	absint($_POST['show_category_phone']) 			: 0 )
			,'show_author_post_link_phone' 		=> ( isset($_POST['show_author_post_link_phone']) 		? 	absint($_POST['show_author_post_link_phone']) 	: 0 )
			,'show_time_phone' 					=> ( isset($_POST['show_time_phone']) 					? 	absint($_POST['show_time_phone']) 				: 0 )
			,'show_tags_phone' 					=> ( isset($_POST['show_tags_phone']) 					? 	absint($_POST['show_tags_phone']) 				: 0 )
			,'show_views_count_phone' 			=> ( isset($_POST['show_views_count_phone']) 			? 	absint($_POST['show_views_count_phone']) 		: 0 )
			,'show_comment_count_phone' 		=> ( isset($_POST['show_comment_count_phone']) 			? 	absint($_POST['show_comment_count_phone']) 		: 0 )
			,'show_excerpt_phone' 				=> ( isset($_POST['show_excerpt_phone']) 				? 	absint($_POST['show_excerpt_phone']) 			: 0 )
			,'show_thumb_phone' 				=> ( isset($_POST['show_thumb_phone']) 					? 	absint($_POST['show_thumb_phone']) 				: 0 )
			,'show_read_more_phone' 			=> ( isset($_POST['show_read_more_phone']) 				? 	absint($_POST['show_read_more_phone']) 			: 0 )			
		);
		
		
		
		$archive_page_config = wd_array_atts(
			array(
					'show_category' 					=> 1
					,'show_author_post_link' 			=> 1
					,'show_time' 						=> 1
					,'show_tags' 						=> 1
					,'show_views_count' 				=> 1
					,'show_comment_count' 				=> 1
					,'show_excerpt' 					=> 1
					,'show_thumb' 						=> 1
					,'show_content' 					=> 1
					,'show_read_more' 					=> 1		
					,'show_category_phone' 				=> 1
					,'show_author_post_link_phone' 		=> 1
					,'show_time_phone' 					=> 1
					,'show_tags_phone' 					=> 1
					,'show_views_count_phone' 			=> 1
					,'show_comment_count_phone' 		=> 1
					,'show_excerpt_phone'				=> 1
					,'show_thumb_phone' 				=> 1
					,'show_content_phone' 				=> 1
					,'show_read_more_phone' 			=> 1						
				)
				,$archive_page_config);	
				
		update_option(THEME_SLUG.'archive_page_config',serialize($archive_page_config));
	}	
}
?>