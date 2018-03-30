<?php
		global $smof_data;
		if( !isset($data) ){
			if( defined( 'DOING_AJAX' ) && isset($custom_datas) ){
				$data = $custom_datas;
			}
			else{
				$data = $smof_data;
			}
		}
		
		$quickshop_ready = false;
		$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
		if( in_array( "wd_quickshop/wd_quickshop.php", $_actived ) ){	
			$quickshop_ready = true;
		}
		
		$data = wd_array_atts(	array(
				'wd_logo' 							=> get_stylesheet_directory_uri(). '/images/logo.png'
				,'wd_icon' 							=> get_stylesheet_directory_uri(). '/images/favicon.ico'
				,'wd_text_logo' 					=> "Oswad Market"
				,'wd_enable_banner_top_main_content' 	=> 0
				,'wd_banner_top_main_content' 			=> ""
				,'wd_payment_image_1'					=> get_stylesheet_directory_uri(). '/images/media/icon_payment_paypal.png'
				,'wd_payment_image_2'					=> get_stylesheet_directory_uri(). '/images/media/icon_payment_visa.png'
				,'wd_payment_image_3'					=> get_stylesheet_directory_uri(). '/images/media/icon_american_visa.png'
				,'wd_payment_image_4'					=> get_stylesheet_directory_uri(). '/images/media/icon_payment_master_card.png'
				,'wd_payment_image_5'					=> get_stylesheet_directory_uri(). '/images/media/icon_dhl_visa.png'
				,'wd_payment_image_6'					=> get_stylesheet_directory_uri(). '/images/media/icon_fed_visa.png'
				,'wd_enable_facebook' 				=> 1
				,'wd_facebook_id' 					=> ''
				,'wd_enable_twitter' 				=> 1
				,'wd_twitter_id' 					=> ''
				,'wd_enable_flickr' 				=> 1
				,'wd_flickr_id' 					=> ''
				,'wd_enable_google' 				=> 1
				,'wd_google_id' 					=> ''
				,'wd_enable_rss' 					=> 1
				,'wd_rss_id' 						=> ''
				,'wd_enable_vimeo' 					=> 1
				,'wd_vimeo_id' 						=> ''
				,'wd_text_shipping' 				=> 'Free shipping'
				,'wd_phone' 						=> '010 456 213 987'
				,'wd_hotline' 						=> '010 456 222 333'
				,'wd_show_feedback_button' 			=> 1
				,'wd_enable_top_content_widget_area'=> 1
				,'wd_feedback_button_text'			=> "feedback"
				,'wd_feedback_dialog_content' 		=> '[contact-form-7 id="4" title="Contact form 1"]'
				,'footer_text' 						=> 'Copyright &copy; 2014 Oswad . Designed by <a href="http://wpdance.com/" title=""> WPDance.com</a>'	
				,'wd_show_first_footer_widget_area' => 1
				,'wd_show_second_footer_widget_area' => 1
				,'wd_show_third_footer_widget_area' => 1
				,'wd_enable_bg_color_third_footer_widget_area' => 0
				,'wd_bg_third_footer_widget_area'	=> get_stylesheet_directory_uri(). '/images/media/bg-footer.jpg'
				,'wd_bg_color_third_footer_widget_area' => '#ffffff'
				,'wd_show_fourth_footer_widget_area' => 1
				,'wd_show_fifth_footer_widget_area' => 1
				,'wd_show_sixth_footer_widget_area' => 1
				,'wd_show_end_footer_area' 			=> 1
				,'wd_show_payment_image_1'			=> 1
				,'wd_show_payment_image_2'			=> 1
				,'wd_show_payment_image_3'			=> 1
				,'wd_show_payment_image_4'			=> 1
				,'wd_show_payment_image_5'			=> 1
				,'wd_show_payment_image_6'			=> 1
				,'wd_preview_panel' 				=> 0
				,'wd_nicescroll' 					=> 0
				,'wd_sticky_menu' 					=> 1
				,'wd_effect_product'				=> 1
				,'wd_effect_product_hover'			=> 1
				,'wd_layout_styles' 				=> "wide"	
				,'wd_theme_color_primary' 			=> "#3dbf91"
				,'wd_theme_color_secondary' 		=> "#333333"
				,'wd_background_blog_hover'			=> "#000000"
				,'wd_background_product_hover'		=> "#000000"
				,'wd_main_content_background' 		=> "#ffffff"
				,'wd_text_color' 					=> "#666666"
				,'wd_text_weak_color' 				=> "#999999"
				,'wd_link_color' 					=> "#3dbf91"
				,'wd_link_color_hover' 				=> "#3dbf91"
				,'wd_header_top_background' 		=> "#000000"
				,'wd_header_top_text_color' 		=> "#ffffff"	
				,'wd_header_top_text_hover' 		=> "#ffffff"
				,'wd_header_middle_background' 		=> "#ffffff"
				,'wd_header_middle_text_color' 		=> "#7a7a7a"
				,'wd_menu_background' 				=> "#ffffff"
				,'wd_menu_background_hover' 		=> "#3dbf91"
				,'wd_menu_border' 					=> "#e5e5e5"
				,'wd_menu_border_hover' 			=> "#3dbf91"
				,'wd_menu_border_top' 				=> "#c0c0c0"
				,'wd_menu_border_bottom' 			=> "#c0c0c0"
				,'wd_menu_text_color' 				=> "#333333"
				,'wd_menu_text_color_hover' 		=> "#ffffff"
				,'wd_sub_menu_background' 			=> "#ffffff"
				,'wd_sub_menu_border' 				=> "#e5e5e5"
				,'wd_sub_menu_text_color' 			=> "#666666"
				,'wd_sub_menu_text_color_hover' 	=> "#3dbf91"
				,'wd_phone_background' 				=> "#1d1f24"
				,'wd_phone_text_color' 				=> "#ffffff"
				,'wd_phone_background_hover' 		=> "#131519"
				,'wd_product_name_color' 			=> "#333333"
				,'wd_special_color' 				=> "#1bb289"
				,'wd_box_border_color' 				=> "#d9d9d9"
				,'wd_input_border_color' 			=> "#d9d9d9"
				,'wd_input_border_color_hover' 		=> "#aaaaaa"
				,'wd_title_border_color' 			=> "#e5e5e5"
				,'wd_button_slider_icon'			=> "#666666"
				,'wd_button_slider_background'		=> "#ffffff"
				,'wd_button_slider_border'			=> "#d9d9d9"
				,'wd_button_slider_icon_hover'		=> "#ffffff"
				,'wd_button_slider_border_hover'	=> "#000000"
				,'wd_button_slider_background_hover'=> "#000000"
				,'wd_button_slideshow_color'					=> "#ffffff"
				,'wd_button_slideshow_color_hover'				=> "#000000"
				,'wd_link_title_portfolio' 			=> "#333333"
				,'wd_link_title_portfolio_hover' 	=> "#000000"
				,'wd_portfolio_background_hover' 	=> "#000000"
				,'wd_portfolio_button_icon' 	=> "#ffffff"
				,'wd_portfolio_button_icon_hover' 	=> "#ffffff"
				,'wd_portfolio_button_background_hover' 	=> "#000000"
				,'wd_button_background' 		=> "#ffffff"
				,'wd_button_background_hover' 	=> "#3dbf91"
				,'wd_button_text' 				=> "#666666"
				,'wd_button_icon_color'			=> "#868686"
				,'wd_button_text_hover' 		=> "#ffffff"
				,'wd_button_border' 			=> "#cccccc"
				,'wd_text_price_color' 				=> "#3dbf91"
				,'wd_rating_color' 					=> "#999999"
				,'wd_rating_color_star' 			=> "#ffc600"
				,'wd_text_price_sale_color' 		=> "#888888"
				,'wd_tag_text'						=> "#999999"
				,'wd_tag_border'					=> "#ffffff"
				,'wd_tag_background'				=> "#ffffff"
				,'wd_tag_text_hover'				=> "#ffffff"
				,'wd_tag_border_hover'				=> "#383c48"
				,'wd_tag_background_hover'			=> "#383c48"
				,'wd_footer_background' 			=> "#ffffff"
				,'wd_footer_middle_background' 		=> "#1d1f24"
				,'wd_footer_end_background' 		=> "#22252c"
				,'wd_footer_middle_heading' 		=> "#ffffff"
				,'wd_footer_middle_text' 			=> "#999999"
				,'wd_footer_tag_text'				=> "#888a91"
				,'wd_footer_tag_border'				=> "#383c48"
				,'wd_footer_tag_background'			=> "#383c48"
				,'wd_footer_tag_text_hover'			=> "#ffffff"
				,'wd_footer_tag_border_hover'		=> "#383c48"
				,'wd_footer_tag_background_hover'	=> "#383c48"
				,'wd_feature_sale'					=> "#72b728"
				,'wd_feature_text_sale'				=> "#ffffff"
				,'wd_feature_hot'					=> "#f92136"
				,'wd_feature_text_hot'				=> "#ffffff"
				,'wd_feature_new'					=> "#00a2ff"
				,'wd_feature_text_new'				=> "#ffffff"
				,'wd_label_title_sale_background'	=> "#3dbf91"
				,'wd_label_title_sale_color'		=> "#ffffff"
				,'wd_label_title_hot_background'	=> "#ffb400"
				,'wd_label_title_hot_color'			=> "#ffffff"
				,'wd_label_title_new_background'	=> "#2cc005"
				,'wd_label_title_new_color'			=> "#ffffff"
				,'wd_label_title_feature_background'=> "#0072ff"
				,'wd_label_title_feature_color'		=> "#ffffff"
				,'wd_social_icon_color'				=> "#ffffff"
				,'wd_social_icon_color_hover'		=> "#ffffff"
				,'wd_social_icon_background'		=> "#383c48"
				,'wd_social_icon_background_hover'	=> "#3dbf91"
				,'wd_sidebar_border'			=> "#d9d9d9"
				,'wd_heading_sidebar_color'			=> "#000000"
				,'wd_heading_sidebar_line_top'	=> "#3dbf91"
				,'wd_label_top_recommend_background'	=> "#999999"
				,'wd_label_top_recommend_text'		=> "#ffffff"
				,'wd_body_font_googlefont_enable' 	=> 0
				,'wd_body_font_family' 				=> "Arial"
				,'wd_body_font_googlefont' 			=> "Open Sans"
				,'wd_body_second_font_googlefont_enable' 	=> 0
				,'wd_body_second_font_family' 				=> "Arial"
				,'wd_body_second_font_googlefont' 			=> "Roboto Condensed"
				,'wd_menu_font_googlefont_enable' 	=> 0
				,'wd_menu_fontfamily' 				=> "Arial"
				,'wd_menu_font_googlefont' 			=> "Roboto Condensed"
				,'wd_sub_menu_font_googlefont_enable' 	=> 0
				,'wd_sub_menu_fontfamily' 			=> 'Arial'
				,'wd_sub_menu_font_googlefont' 		=> "Open Sans"
				,'wd_price_font_googlefont_enable' 	=> 1
				,'wd_price_fontfamily' 				=> 'Arial'
				,'wd_price_font_googlefont' 		=> "Open Sans"
				,'wd_menu_thumb_width' 				=> 16
				,'wd_menu_thumb_height' 			=> 16
				,'wd_menu_num_widget' 				=> 5
				,'wd_qs_button_label' 				=> __("","wpdance")
				,'wd_qs_button_imgage' 				=> get_stylesheet_directory_uri(). '/images/quickshop.png'
				,'wd_quickshop_text_color' 			=> "#ffffff"
				,'wd_quickshop_background_hover' 			=> "#000000"
				,'wd_quickshop_text_color_hover' 			=> "#ffffff"
				,'wd_enable_header_middle_banner'	=> 1
				,'wd_header_middle_banner_code'			=> '<a class="wd-effect-mirror" title="oswad" href="#"><img src="http://demo2.wpdance.com/imgs/WP_Woo_OswadMarket/header-banner-middle.png" alt="oswad market" title="oswad market" /></a>'
				,'wd_top_blog_code' 				=> ""
				,'wd_bottom_blog_code' 				=> ""
				,'wd_before_body_end_code' 			=> ""
				,'wd_google_analytic_code' 			=> ""
				
				,'wd_shop_slider_slide_speed_pc' 	=> "800"
				,'wd_shop_slider_slide_speed_mobile'=> "200"
				,'wd_shop_slider_scroll_per_page' 	=> 0
				,'wd_shop_slider_rewind_nav' 		=> 0
				,'wd_shop_slider_auto_play' 		=> 0
				,'wd_shop_slider_stop_on_hover' 	=> 0
				,'wd_shop_slider_mouse_drag' 		=> 1
				,'wd_shop_slider_touch_drag' 		=> 1
				
				,'wd_prod_cat_column' 				=> 4
				,'wd_prod_cat_per_page' 			=> 16
				,'wd_prod_cat_layout' 				=> "1-1-0"
				,'wd_prod_cat_left_sidebar' 		=> "product-category-widget-area-left"
				,'wd_prod_cat_right_sidebar' 		=> "product-category-widget-area-right"
				,'wd_prod_cat_rating' 				=> 1
				,'wd_prod_cat_categories' 			=> 1
				,'wd_prod_cat_title' 				=> 1
				,'wd_prod_cat_sku' 					=> 0
				,'wd_prod_cat_disc_grid' 			=> 1
				,'wd_prod_cat_disc_list' 			=> 1
				,'wd_prod_cat_price' 				=> 1
				,'wd_prod_cat_add_to_cart' 			=> 1
				,'wd_prod_left_sidebar' 			=> "product-widget-area-left"
				,'wd_prod_right_sidebar' 			=> "product-widget-area-right"
				,'wd_prod_image' 					=> 1	
				,'wd_prod_cloudzoom' 				=> 1
				,'wd_prod_label' 					=> 1
				,'wd_prod_title' 					=> 1
				,'wd_prod_sku' 						=> 1
				,'wd_prod_rating' 					=> 1
				,'wd_prod_review' 					=> 1
				,'wd_prod_availability' 			=> 1
				,'wd_prod_cart' 					=> 1
				,'wd_prod_price' 					=> 1
				,'wd_prod_shortdesc' 				=> 1
				,'wd_prod_meta' 					=> 1
				,'wd_prod_related' 					=> 1
				,'wd_prod_related_title' 			=> __('RELATED ITEMS','wpdance')
				,'wd_prod_upsell' 					=> 1
				,'wd_prod_upsell_title' 			=> __('YOU MAY ALSO LIKE','wpdance')
				,'wd_prod_share' 					=> 1
				,'wd_prod_share_title' 				=> __('Share thist','wpdance')
				,'wd_prod_ship_return' 				=> 1	
				,'wd_prod_ship_return_title' 		=> ""	
				,'wd_prod_ship_return_content' 		=> '<div class="wd-bottom-banner-left one_half">
														<a class="wd-effect opacity"><img title="banner" alt="banner" src="http://demo2.wpdance.com/imgs/WP_Woo_OswadMarket/banner-bottom-product.jpg" />
														</a></div><div class="wd-bottom-banner-right one_half last">
														<a class="wd-effect opacity"><img title="banner" alt="banner" src="http://demo2.wpdance.com/imgs/WP_Woo_OswadMarket/banner-bottom-product.jpg" /></a></div>'	
				,'wd_prod_tabs' 					=> 1	
				,'wd_prod_customtab' 				=> 1
				,'wd_prod_customtab_title' 			=> __('Custom Tab','wpdance')
				,'wd_prod_customtab_content' 		=> "custom contents go here"
				,'wd_prod_layout' 					=> "1-1-0"
				,'wd_blog_categories' 				=> 1
				,'wd_blog_author' 					=> 1
				,'wd_blog_time' 					=> 1
				,'wd_blog_sharing' 					=> 1
				,'wd_blog_comment_number' 			=> 1
				,'wd_blog_excerpt' 					=> 1			
				,'wd_blog_thumbnail' 				=> 1
				,'wd_blog_readmore' 				=> 1
				,'wd_blog_details_categories' 		=> 1
				,'wd_blog_details_author' 			=> 1
				,'wd_blog_details_time' 			=> 1
				,'wd_blog_details_tags' 			=> 1
				,'wd_blog_details_thumbnail' 		=> 1
				,'wd_blog_details_comment' 			=> 1
				,'wd_blog_details_socialsharing' 	=> 1
				,'wd_blog_details_authorbox' 		=> 1
				,'wd_blog_details_related' 			=> 1
				,'wd_blog_details_relatedlabel' 	=> __("Related Posts","wpdance")
				,'wd_blog_details_commentlist' 		=> 1
				,'wd_blog_details_commentlabel' 	=> __("Comment","wpdance")	
			),
			$data
		);	

			
			
	/*******   Primary   *******/
	$wd_theme_color_primary						= esc_attr( $data['wd_theme_color_primary'] );
	$wd_theme_color_secondary					= esc_attr( $data['wd_theme_color_secondary'] );
	$wd_main_content_background					= esc_attr( $data['wd_main_content_background'] );
	$wd_text_color								= esc_attr( $data['wd_text_color'] );
	$wd_text_weak_color							= esc_attr( $data['wd_text_weak_color'] );
	$wd_link_color								= esc_attr( $data['wd_link_color'] );
	$wd_link_color_hover						= esc_attr( $data['wd_link_color_hover'] );

	// Font
	$font_body									= '"'.($data['wd_body_font_googlefont_enable'] == 1 ? esc_attr( $data['wd_body_font_family'] ) : esc_attr( $data['wd_body_font_googlefont'] )).'"'.' , Arial'; 										
	$font_body_second							= '"'.($data['wd_body_second_font_googlefont_enable'] == 1 ? esc_attr( $data['wd_body_second_font_family'] ) : esc_attr( $data['wd_body_second_font_googlefont'] )).'"'.' , sans-serif'; 	
	$font_menu									= '"'.($data['wd_menu_font_googlefont_enable'] == 1 ? esc_attr( $data['wd_menu_fontfamily'] ) : esc_attr( $data['wd_menu_font_googlefont'] )).'"'.' , sans-serif'; 								 		
	$font_sub_menu								= '"'.($data['wd_sub_menu_font_googlefont_enable'] == 1 ? esc_attr( $data['wd_sub_menu_fontfamily'] ) : esc_attr( $data['wd_sub_menu_font_googlefont'] )).'"'.' , Arial';									    									
	$font_price									= '"'.($data['wd_price_font_googlefont_enable'] == 1 ? esc_attr( $data['wd_price_fontfamily'] ) : esc_attr( $data['wd_price_font_googlefont'] )).'"'.' , sans-serif';


	/*******   Header   *******/
	$wd_header_top_background					= esc_attr( $data['wd_header_top_background'] );
	$wd_header_top_text_color					= esc_attr( $data['wd_header_top_text_color'] );
	$wd_header_top_text_hover					= esc_attr( $data['wd_header_top_text_hover'] );
	$wd_header_middle_background				= esc_attr( $data['wd_header_middle_background'] );
	$wd_header_middle_text_color				= esc_attr( $data['wd_header_middle_text_color'] );
	
	$wd_menu_background							= esc_attr( $data['wd_menu_background'] );
	$wd_menu_background_hover					= esc_attr( $data['wd_menu_background_hover'] );
	$wd_menu_border								= esc_attr( $data['wd_menu_border'] );
	$wd_menu_border_hover						= esc_attr( $data['wd_menu_border_hover'] );
	$wd_menu_border_bottom						= esc_attr( $data['wd_menu_border_bottom'] );
	$wd_menu_border_top							= esc_attr( $data['wd_menu_border_top'] );
	$wd_sub_menu_background						= esc_attr( $data['wd_sub_menu_background'] );
	$wd_sub_menu_border							= esc_attr( $data['wd_sub_menu_border'] );
	$wd_menu_text_color							= esc_attr( $data['wd_menu_text_color'] );
	$wd_menu_text_color_hover					= esc_attr( $data['wd_menu_text_color_hover'] );
	$wd_sub_menu_text_color						= esc_attr( $data['wd_sub_menu_text_color'] );
	$wd_sub_menu_text_color_hover				= esc_attr( $data['wd_sub_menu_text_color_hover'] );
	
	/******* Footer *******/
	$wd_footer_end_background					= esc_attr( $data['wd_footer_end_background'] );

	$wd_button_background					= esc_attr( $data['wd_button_background'] );
	$wd_button_background_hover				= esc_attr( $data['wd_button_background_hover'] );
	$wd_button_text							= esc_attr( $data['wd_button_text'] );
	$wd_button_icon_color					= esc_attr( $data['wd_button_icon_color'] );
	$wd_button_text_hover					= esc_attr( $data['wd_button_text_hover'] );
	$wd_button_border						= esc_attr( $data['wd_button_border'] );
	
	if($quickshop_ready == true):
		$wd_quickshop_text_color					= isset($data['wd_quickshop_text_color'])?esc_attr( $data['wd_quickshop_text_color'] ):"#ffffff";
		$wd_quickshop_background_hover				= isset($data['wd_quickshop_background_hover'])?esc_attr( $data['wd_quickshop_background_hover'] ):"#000000";
		$wd_quickshop_text_color_hover				= isset($data['wd_quickshop_text_color_hover'])?esc_attr( $data['wd_quickshop_text_color_hover'] ):"#ffffff";
	endif;


	$wd_phone_background						= esc_attr( $data['wd_phone_background'] );
	$wd_phone_text_color						= esc_attr( $data['wd_phone_text_color'] );
	$wd_phone_background_hover					= esc_attr( $data['wd_phone_background_hover'] );
	$wd_link_title_portfolio					= esc_attr( $data['wd_link_title_portfolio'] );
	$wd_link_title_portfolio_hover				= esc_attr( $data['wd_link_title_portfolio_hover'] );
	$wd_portfolio_background_hover				= esc_attr( $data['wd_portfolio_background_hover'] );

	$wd_portfolio_button_icon					= esc_attr( $data['wd_portfolio_button_icon'] );
	$wd_portfolio_button_icon_hover				= esc_attr( $data['wd_portfolio_button_icon_hover'] );
	$wd_portfolio_button_background_hover		= esc_attr( $data['wd_portfolio_button_background_hover'] );

	$wd_product_name_color						= esc_attr( $data['wd_product_name_color'] );
	$wd_special_color							= esc_attr( $data['wd_special_color'] );


	$wd_text_price_color						= esc_attr( $data['wd_text_price_color'] );
	$wd_rating_color							= esc_attr( $data['wd_rating_color'] );
	$wd_rating_color_star						= esc_attr( $data['wd_rating_color_star'] );
	$wd_text_price_sale_color					= esc_attr( $data['wd_text_price_sale_color'] );
	$wd_box_border_color						= esc_attr( $data['wd_box_border_color'] );
	$wd_input_border_color						= esc_attr( $data['wd_input_border_color'] );
	$wd_input_border_color_hover				= esc_attr( $data['wd_input_border_color_hover'] );
	$wd_title_border_color						= esc_attr( $data['wd_title_border_color'] );
	
	$wd_button_slider_icon						= esc_attr( $data['wd_button_slider_icon'] );
	$wd_button_slider_background				= esc_attr( $data['wd_button_slider_background'] );
	$wd_button_slider_border					= esc_attr( $data['wd_button_slider_border'] );
	$wd_button_slider_icon_hover				= esc_attr( $data['wd_button_slider_icon_hover'] );
	$wd_button_slider_border_hover				= esc_attr( $data['wd_button_slider_border_hover'] );
	$wd_button_slider_background_hover			= esc_attr( $data['wd_button_slider_background_hover'] );
	
	$wd_button_slideshow_color					= esc_attr( $data['wd_button_slideshow_color'] );
	$wd_button_slideshow_color_hover			= esc_attr( $data['wd_button_slideshow_color_hover'] );

	$wd_feature_sale							= esc_attr( $data['wd_feature_sale'] );
	$wd_feature_text_sale						= esc_attr( $data['wd_feature_text_sale'] );
	$wd_feature_hot								= esc_attr( $data['wd_feature_hot'] );
	$wd_feature_text_hot						= esc_attr( $data['wd_feature_text_hot'] );
	$wd_feature_new								= esc_attr( $data['wd_feature_new'] );
	$wd_feature_text_new						= esc_attr( $data['wd_feature_text_new'] );
	$wd_label_title_sale_background				= esc_attr( $data['wd_label_title_sale_background'] );
	$wd_label_title_sale_color					= esc_attr( $data['wd_label_title_sale_color'] );
	$wd_label_title_hot_background				= esc_attr( $data['wd_label_title_hot_background'] );
	$wd_label_title_hot_color					= esc_attr( $data['wd_label_title_hot_color'] );
	$wd_label_title_new_background				= esc_attr( $data['wd_label_title_new_background'] );
	$wd_label_title_new_color					= esc_attr( $data['wd_label_title_new_color'] );
	$wd_label_title_feature_background			= esc_attr( $data['wd_label_title_feature_background'] );
	$wd_label_title_feature_color				= esc_attr( $data['wd_label_title_feature_color'] );
	$wd_social_icon_color						= esc_attr( $data['wd_social_icon_color'] );
	$wd_social_icon_color_hover					= esc_attr( $data['wd_social_icon_color_hover'] );
	$wd_social_icon_background					= esc_attr( $data['wd_social_icon_background'] );
	$wd_social_icon_background_hover			= esc_attr( $data['wd_social_icon_background_hover'] );
	$wd_sidebar_border					= esc_attr( $data['wd_sidebar_border'] );
	$wd_heading_sidebar_color					= esc_attr( $data['wd_heading_sidebar_color'] );
	$wd_heading_sidebar_line_top				= esc_attr( $data['wd_heading_sidebar_line_top'] );
	$wd_label_top_recommend_background			= esc_attr( $data['wd_label_top_recommend_background'] );
	$wd_label_top_recommend_text				= esc_attr( $data['wd_label_top_recommend_text'] );
	
	$wd_footer_background						= esc_attr( $data['wd_footer_background'] );
	$wd_footer_middle_background				= esc_attr( $data['wd_footer_middle_background'] );
	$wd_footer_middle_heading					= esc_attr( $data['wd_footer_middle_heading'] );
	$wd_footer_middle_text						= esc_attr( $data['wd_footer_middle_text'] );
	$wd_background_product_hover				= esc_attr( $data['wd_background_product_hover'] );
	$wd_background_blog_hover					= esc_attr( $data['wd_background_blog_hover'] );
	
	$wd_tag_text								= esc_attr( $data['wd_tag_text'] );
	$wd_tag_border								= esc_attr( $data['wd_tag_border'] );
	$wd_tag_background							= esc_attr( $data['wd_tag_background'] );
	$wd_tag_text_hover							= esc_attr( $data['wd_tag_text_hover'] );
	$wd_tag_border_hover						= esc_attr( $data['wd_tag_border_hover'] );
	$wd_tag_background_hover					= esc_attr( $data['wd_tag_background_hover'] );
	
	$wd_footer_tag_text							= esc_attr( $data['wd_footer_tag_text'] );
	$wd_footer_tag_border						= esc_attr( $data['wd_footer_tag_border'] );
	$wd_footer_tag_background					= esc_attr( $data['wd_footer_tag_background'] );
	$wd_footer_tag_text_hover					= esc_attr( $data['wd_footer_tag_text_hover'] );
	$wd_footer_tag_border_hover					= esc_attr( $data['wd_footer_tag_border_hover'] );
	$wd_footer_tag_background_hover				= esc_attr( $data['wd_footer_tag_background_hover'] );
	$wd_bg_color_third_footer_widget_area		= esc_attr( $data['wd_bg_color_third_footer_widget_area'] );
	
	?>
	/* ====================================================================================================*/
	/* ======================================= CUSTOM FONT ============================================== */
	/* ====================================================================================================*/
	body,
	h1 > a,
	h2 > a,
	h3 > a,
	h4 > a,
	h3 > label,
	div.bbp-topic-tags p a,
	.tag_blog a,
	pre,blockquote,body code,
	h1.heading-title.page-title,
	.font-body{
		font-family:<?php echo $font_body; ?>;
	}
	pre,blockquote,body code{
		font-family:<?php echo $font_body; ?>;
	}
	/* BODY FONT THIRD */
	h1,h2,h3,h5,h4,h6{
		font-family:<?php echo $font_body_second; ?>;
	}
	#header .nav h1,#header .nav h2,#header .nav h3,#header .nav h5,#header .nav h4,#header .nav h6{
		font-family:<?php echo $font_sub_menu; ?>;
	}
	.related > .title,
	body .pp_woocommerce div.product .product_title,
	body.woocommerce #content div.product .product_title,
	body.woocommerce-page #content div.product .product_title,
	.single-content .single-post .post-title .heading-title,
	.price_table_inner ul li.table_title h4,
	.price_table_inner .period
	{
		font-family:<?php echo $font_body; ?>;
	}
	/* END BODY FONT THIRD */
	
	/* FONT MENU */
	#header .nav > .main-menu > ul.menu > li > a > span,
	#header .nav > .main-menu > div.menu > ul > li > a,
	.mobile-main-menu .menu > li a,
	body #header .wd_widget_product_categories h2.widgettitle{
		font-family:<?php echo $font_menu; ?>;
	}
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li a,
	#header .nav > .main-menu > ul.menu > li.wd-mega-menu a{
		font-family:<?php echo $font_sub_menu; ?>;
	}
	/* END FONT MENU */
	
	/* ================================= FONT PRICE ==================================== */
	.widget-container .price .amount,
	.widget-container .amount,
	span.amount{
		font-family:<?php echo $font_price; ?>;
	}
	/*  END FONT PRICE */
	
	/* BACKGROUND HOVER PRODUCT */
	.woocommerce ul.products li.product .product_thumbnail_wrapper > a:after,
	.woocommerce-page ul.products li.product .product_thumbnail_wrapper > a:after{
		background-color:<?php echo $wd_background_product_hover ?>
	}
	.list-posts li .thumbnail a .thumbnail-effect:after,
	.wd_meet_team > a.image .thumbnail-effect:after,
	.portfolio_slider_shortcode .thumbnail-effect:after,
	.related .related-item .thumbnail-effect:after,
	.shortcode-recent-blogs .thumbnail-effect:after,
	.banner_description_shortcode .banner_description_image .thumbnail-effect:after,
	.feature_thumbnail_image .thumbnail-effect:after,
	.wd-recent-blogs-video-wrapper .thumbnail:after{
		background-color:<?php echo $wd_background_blog_hover; ?>;
	}
	.list-posts li .thumbnail a .thumbnail-effect:before,.related .related-item .thumbnail-effect:before,.shortcode-recent-blogs .thumbnail-effect:before,.banner_description_shortcode .banner_description_image .thumbnail-effect:before,
	.portfolio_slider_shortcode .thumbnail-effect:before,
	.wd_meet_team > a.image .thumbnail-effect:before,
	.wd-recent-blogs-video-wrapper .thumbnail-effect:before{
		color:#fff;
	}
	.wd-recent-blogs-video-wrapper a.thumbnail:hover .thumbnail-effect:after{
		background-color:#fff;
	}
	
	/* PAGER */
	.page_navi .wp-pagenavi span, .page_navi .wp-pagenavi a,
	.page_navi > .nav-content > .pager span span,
	.page_navi > .nav-content a.first span span,
	.page_navi > .nav-content a.previous span span,
	.page_navi > .nav-content a.next span span,
	.page_navi > .nav-content a.last span span,
	body.woocommerce #content nav.woocommerce-pagination ul li, 
	body.woocommerce-page #content nav.woocommerce-pagination ul li,
	body.woocommerce #content nav.woocommerce-pagination ul li, 
	body.woocommerce-page #content nav.woocommerce-pagination ul li,
	/* END PAGER*/
	body.woocommerce-page #content table.shop_table thead th,
	body.woocommerce-page #content .cart-collaterals .cart_totals > table th,
	#header .nav > .main-menu > ul.menu > li.wd-mega-menu .wd-more,
	.wd-title-shortcode,
	ul.nav-tabs li a,
	body .wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a,
	body .wpb_content_element .wpb_accordion_header a,
	body .vc_progress_bar .vc_single_bar .vc_label,
	.woocommerce ul.products li.product .label_title,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories ul .link_cat,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories ul .link_cat,
	.widget-container.wd_widget_popular_product_by_categories .cat_name,
	.shopping-cart .wd_tini_cart_control a,
	.shopping-cart .wd_tini_cart_control,
	.shopping-cart .wd_tini_cart_control a,
	.mobile_cart_container,
	.cart_dropdown .total span.title,.cart_dropdown .total span.title,
	.cart_dropdown .go_to_shopping_cart a,
	.cart_dropdown .dropdown_body .head_msg,
	#footer .widget_subscriptions button.button span,
	.shortcode-recent-blogs .tag_blog,
	.wd-social-share > span,
	.woocommerce.woocommerce-result-count,
	.woocommerce-page .woocommerce-result-count,
	.tags_social .tags .tag-title,
	#comments .wd_title_comment h3,
	#respond .wd_title_respond h3,
	.wd_mobile_account a,
	.woocommerce .before_checkout_form form.checkout_coupon .question_coupon,
	.woocommerce-page .before_checkout_form form.checkout_coupon .question_coupon,
	body.woocommerce-page form.checkout table.shop_table tfoot th,
	.short-description-title,
	.tagcloud .tag_heading,
	.wd_product_tags_categoried .wd_product_categories span,
	body.woocommerce #content div.product .woocommerce-tabs ul.tabs li a,
	body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a,
	
	.wd_custom_category_shortcode .wd-custom-category-right-wrapper span.product_label,
	.wd_custom_category_shortcode .wd-custom-category-left-wrapper span.product_label,
	.wd_custom_category_shortcode .wp_title_shortcode_products .wd_list_categories ul li a,
	body div.pp_woocommerce .pp_nav, 
	body div.pp_woocommerce .pp_description,
	.woocommerce ul.cart_list li .total,
	.woocommerce ul.product_list_widget li .total,
	.widget_shopping_cart .total strong,
	.portfolio-filter-wrapper,
	#portfolio-container .count_project,
	body table.compare-list tr th,
	a.vc_read_more,
	.wpb_flickr_widget p.flickr_stream_wrap a,
	#bbpress-forums .bbp-header .forum-titles li,
	#bbpress-forums li.bbp-header > div,
	#bbpress-forums li.bbp-header,
	#bbpress-forums div.bbp-reply-author .bbp-author-role,
	#bbpress-forums div.bbp-topic-tags p,
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation li a,
	#subscription-toggle,
	.alphabet-products ul li a,
	.bbp-pagination-links a,
	.bbp-pagination-links span.current,
	#bbpress-forums ul.bbp-search-results .bbp-topic-title a,
	#bbpress-forums ul.bbp-search-results .bbp-forum-title a,
	#bbpress-forums ul.bbp-search-results .bbp-reply-title a,
	body .wd_child_categories_shortcode .child_categories ul li a,
	body .wd_child_categories_shortcode .cat_button,
	.wd_myaccount_menu a,
	.wd_myaccount_menu .title,
	.widget-container.widget_wd_recent_post_widget .date-time,
	.woocommerce-page #content .cart-collaterals .shipping_calculator .wd_title_cart .heading-title,
	.price_in_table *,
	.font_body_second,
	#footer .bg-full a.btn,
	.wd_milestone .number_wrapper,
	.wd_product_tab_by_category_shortcode .wd_list_categories ul li a,
	.wd_product_tab_by_category_shortcode .view_all a,
	.woocommerce .custom-product-shortcode.style-big ul.products li.product .product_item_wrapper .heading-title a,
	li.product-category .category-description,
	.vc_tta.vc_general.vc_tta-tabs .vc_tta-tabs-list a
	{
		font-family:<?php echo $font_body_second; ?>;
	}
	/* TITLE SLIDER */
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta h3.heading-title,
	.woocommerce-page .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta h3,
	.woocommerce .featured_product_wrapper .wp_title_shortcode_products h3,
	.woocommerce-page .featured_product_wrapper .wp_title_shortcode_products h3,
	.woocommerce .featured_product_slider_wrapper .featured_product_slider_wrapper_meta h3,
	.woocommerce-page .featured_product_slider_wrapper .featured_product_slider_wrapper_meta h3,
	.woocommerce .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta h3,
	.woocommerce-page .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta h3{
		font-weight:700;
	}
	
	/* ====================================================================================================*/
	/* ======================================= BACKGROUND COLOR =========================================== */
	/* ====================================================================================================*/
	/* COLOR SHADOW */
	.testimonial-item:hover .avatar a:before{
		box-shadow:0 0 15px <?php echo $wd_theme_color_secondary; ?> inset;
		-webkit-box-shadow:0 0 15px inset <?php echo $wd_theme_color_secondary; ?> inset;
		-moz-box-shadow:0 0 15px inset <?php echo $wd_theme_color_secondary; ?> inset;
	}
	#bbpress-forums .bbp-body div.bbp-topic-content,
	#bbpress-forums .bbp-body div.bbp-reply-content,
	#entry-author-info #author-description .author-desc,
	#comments .commentlist li .divcomment .divcomment-inner .comment-body,
	.woocommerce #reviews #comments ol.commentlist li .comment_container, 
	.woocommerce-page #reviews #comments ol.commentlist li .comment_container{
		box-shadow:0px 0 6px rgba(0,0,0,0.1);
		-webkit-box-shadow:0px 0 6px rgba(0,0,0,0.1);
		-moz-box-shadow:0px 0 6px rgba(0,0,0,0.1);
	}
	.widget-container.widget_recent_comments_custom .widget_per_slide ul li .comment-body,
	.widget-container.wd_widget_bbpress_recent_posts .wd_bbpress_recent_posts ul li .post_content,
	.testimonial-item,
	.wd_testimonial_wrapper.style-2 .testimonial-item .detail{
		box-shadow:0px 0 4px rgba(0,0,0,0.1);
		-webkit-box-shadow:0px 0 4px rgba(0,0,0,0.1);
		-moz-box-shadow:0px 0 4px rgba(0,0,0,0.1);
	}
	/* LABEL TITLE */
	.woocommerce ul.products li.product .label_title.lb_onsale{
		background-color:<?php echo $wd_label_title_sale_background; ?>;
		color:<?php echo $wd_label_title_sale_color; ?>;
	}
	.woocommerce ul.products li.product .label_title.lb_hot{
		background-color:<?php echo $wd_label_title_hot_background; ?>;
		color:<?php echo $wd_label_title_hot_color; ?>;
	}
	.woocommerce ul.products li.product .label_title.lb_new{
		background-color:<?php echo $wd_label_title_new_background; ?>;
		color:<?php echo $wd_label_title_new_color; ?>;
	}
	.woocommerce ul.products li.product .label_title.lb_feature{
		background-color:<?php echo $wd_label_title_feature_background; ?>;
		color:<?php echo $wd_label_title_feature_color; ?>;
	}
	/* END LABEL TITLE */
	#footer{
		background-color:<?php echo $wd_footer_background; ?>
	}
	.wd_top_content_widget_area_wrapper,
	#wd_container,
	#main-module-container > #container,
	#main-module-container > #main,
	.archive-page.archive-portfolio,
	.wd_top_content_widget_area_wrapper,
	body form.checkout .accordion-heading a.accordion-toggle.collapsed,
	body #accordion-checkout-details .accordion-heading a.accordion-toggle.collapsed,
	.wd_tini_account_wrapper .form_drop_down:before,
	.shopping-cart .cart_dropdown:before,
	.wd_banner_top_content_widget_area_wrapper,
	.feature.shortcode .feature_content_wrapper.style-2.has_icon a.wd-feature-icon:before,
	.testimonial-item,.wd_myaccount_menu,
	#main-module-container > .breadcrumb-title-wrapper,
	.price_table_inner.active_price > ul > li.content,
	.price_table_inner,
	#bbpress-forums .bbp-body div.bbp-topic-content, 
	#bbpress-forums .bbp-body div.bbp-reply-content,
	body .woocommerce  ul.products li.product:hover .product_item_wrapper, 
	.woocommerce-page  ul.products li.product:hover .product_item_wrapper,
	body.woocommerce ul.products li.product:hover .product_item_wrapper, 
	.woocommerce-page  ul.products li.product:hover .product_item_wrapper,
	body div.pp_woocommerce .pp_content_container,
	body .pp_woocommerce .quantity input.qty, 
	body.woocommerce #content .quantity input.qty, 
	body.woocommerce-page #content .quantity input.qty,
	input[type="color"], input[type="email"], 
	input[type="number"], input[type="password"], 
	input[type="tel"], input[type="text"], 
	textarea,
	select,
	.wd_widget_product_categories .wd_product_categories > ul.hover_mode > li ul.sub_cat,
	#cboxContent,
	.select2-drop,
	.select2-results,
	.select2-container .select2-choice
	{
		background-color:<?php echo $wd_main_content_background; ?>
	}
	.wd_custom_category_shortcode .wd-custom-category-right-wrapper .product .product_item_wrapper,
	.featured_product_slider_wrapper > div.featured_product_slider_wrapper_inner.loading:before,
	.featured_product_slider_wrapper.shortcode_slider .fredsel_slider_wrapper_inner.loading:before,
	.featured_categories_slider_wrapper .featured_product_slider_wrapper_inner.loading:before,
	.widget_recent_post_slider .wd_recent_post_widget_wrapper.loading:before,
	.woocommerce .related > .loading:before, 
	.woocommerce .upsells.products > .loading:before, 
	.woocommerce-page .related > .loading:before, 
	.woocommerce-page .upsells.products > .loading:before,
	.related_post_slider.loading:before, 
	.related_portfolio_slider.loading:before,
	.wp_title_shortcode_products .wd_list_categories.loading:before,
	.woocommerce.wd_widget_related_upsell_wrapper.loading:before,
	.thumbnails.list_carousel.loading:before,
	.wd_testimonial_wrapper.is_slider.loading:before,
	.portfolio_slider_shortcode .portfolio-content-wrapper.loading:before{
		background-color:<?php echo $wd_main_content_background; ?> !important;
	}
	.wd_product_tab_by_category_shortcode .featured_product_wrapper_inner.loading:before,
	.widget-container.wd_widget_tab_product .tab_content.loading:before,
	.featured_product_wrapper .featured_product_wrapper_inner.loading:before,
	.featured_product_slider_wrapper > div.featured_product_slider_wrapper_inner.loading:before,
	.featured_product_slider_wrapper.shortcode_slider .fredsel_slider_wrapper_inner.loading:before,
	.featured_categories_slider_wrapper .featured_product_slider_wrapper_inner.loading:before,
	.widget_recent_post_slider .wd_recent_post_widget_wrapper.loading:before,
	.woocommerce .related > .loading:before,
	.woocommerce .upsells.products > .loading:before,
	.woocommerce-page .related > .loading:before,
	.woocommerce-page .upsells.products > .loading:before,
	.related_post_slider.loading:before,
	.related_portfolio_slider.loading:before,
	.woocommerce.wd_widget_related_upsell_wrapper.loading:before,
	.thumbnails.list_carousel.loading:before,
	.wd_testimonial_wrapper.is_slider.loading:before{
		background-color:<?php echo $wd_main_content_background; ?> !important;
	}
	.widget-container.widget_recent_comments_custom .widget_per_slide ul li .comment-body:before,
	.widget-container.wd_widget_bbpress_recent_posts .wd_bbpress_recent_posts ul li .post_content:before,
	#comments .commentlist li .divcomment .divcomment-inner .comment-body:before,
	.woocommerce #reviews #comments ol.commentlist li .comment_container:before,
	.woocommerce-page #reviews #comments ol.commentlist li .comment_container:before{
		border-left-color:<?php echo $wd_main_content_background; ?>
	}
	body .woocommerce ul.products li.product .product_item_wrapper, 
	.woocommerce-page ul.products li.product .product_item_wrapper,
	body.woocommerce ul.products li.product .product_item_wrapper, 
	.woocommerce-page ul.products li.product .product_item_wrapper,
	body.woocommerce #content div.product div.images div.thumbnails .owl-carousel a img,
	body.woocommerce-page #content div.product div.images div.thumbnails .owl-carousel a img, 
	.woocommerce .wd_custom_category_shortcode ul.products li.left-wrapper .product_thumbnails a{
		border-color:transparent;
	}
	.wd_testimonial_wrapper.style-2 .testimonial-item:after,
	#bbpress-forums .bbp-body div.bbp-topic-content:after,
	#bbpress-forums .bbp-body div.bbp-reply-content:after,
	#entry-author-info #author-description .author-desc:after,
	.woocommerce ul.products li.product .product-meta-wrapper .review_count:before,
	body .pp_woocommerce div.product div.summary .review_count:before,
	body.woocommerce #content div.product div.summary .review_count:before,
	body.woocommerce-page #content div.product div.summary .review_count:before{
		color:<?php echo $wd_main_content_background; ?>
	}
	/* HEADER TOP */
	.wd_tini_account_wrapper .form_wrapper:before,
	.wd_tini_account_wrapper .form_drop_down:after{
		color:<?php echo $wd_header_top_background; ?>;
	}
	#header .header-top{
		background-color:<?php echo $wd_header_top_background; ?>;
		color:<?php echo $wd_header_top_text_hover; ?>;
	}
	/* HEADER MIDDLE */
	#header .header-middle,.phone-header .logo,
	.header-logo-bottom{
		background-color:<?php echo $wd_header_middle_background; ?>;
		color:<?php echo $wd_header_middle_text_color; ?>;
	}
	.sticky-wrapper.is-sticky #header .nav:after{
		background-color:<?php echo $wd_header_middle_background; ?>;
	}
	.shopping-cart .wd_tini_cart_control a{
		color:<?php echo $wd_theme_color_secondary; ?>;
	}
	#header .header-middle.v2 form[id^="searchform-"] .bg_search > div:before,
	#header .header-middle.v4 form[id^="searchform-"] .bg_search > div:before{
		color:<?php echo $wd_header_middle_text_color; ?>;
	}
	#header .header-middle.v2 .header_search:before{
		border-color:<?php echo $wd_header_middle_text_color; ?>;
	}
	.shopping-cart:hover .wd_tini_cart_control a,
	.wd_tini_cart_wrapper.loading-cart:hover:before,
	.shopping-cart:hover .wd_tini_cart_control a{
		color:<?php echo $wd_theme_color_secondary; ?>
	}
	
	/* ====================================================================================================*/
	/* ======================================= CUSTOM COLOR ============================================== */
	/* ====================================================================================================*/
	/* CUSTOM BUTTON SLIDER */
	.rev_slider_wrapper .tp-rightarrow,
	body * .ls-nav-next,.rev_slider_wrapper .tp-leftarrow,
	body * .ls-nav-prev,body .ls-v5 .ls-nav-start, body .ls-v5 .ls-nav-stop,
	body .slider-brand-full .slider_control .prev,
	body .slider-brand-full .slider_control .next,
	.blog-image-slider .owl-nav > div.owl-prev:after,
	.blog-image-slider .owl-nav > div.owl-next:after,
	.rev_slider_wrapper .persephone.tparrows:before,
	.rev_slider_wrapper .dione.tparrows:before,
	.rev_slider_wrapper .uranus.tparrows:before{
		color:<?php echo $wd_button_slideshow_color; ?>;
	}
	body * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a,
	#ls-global * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a,
	html * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a,
	.tp-bullets.simplebullets.round .bullet,
	body .flex-direction-nav a.flex-next,body .wd-content a.nivo-nextNav,
	body .flex-direction-nav a.flex-prev,body .wd-content a.nivo-prevNav,
	.blog-image-slider .owl-nav > div.owl-prev:after,
	.blog-image-slider .owl-nav > div.owl-next:after,
	.rev_slider_wrapper .persephone .tp-bullet,
	.rev_slider_wrapper .persephone.tparrows{
		border-color:<?php echo $wd_button_slideshow_color; ?>;
	}
	.rev_slider_wrapper .tparrows,
	.rev_slider_wrapper .hesperiden.tparrows,
	.rev_slider_wrapper .hades.tparrows,
	.rev_slider_wrapper .ares.tparrows,
	.rev_slider_wrapper .hebe.tparrows:before,
	.rev_slider_wrapper .hermes.tparrows,
	.rev_slider_wrapper .custom.tparrows,
	.rev_slider_wrapper .hephaistos.tparrows,
	.rev_slider_wrapper .erinyen.tparrows,
	.rev_slider_wrapper .zeus.tparrows,
	.rev_slider_wrapper .metis.tparrows{
		background-color:<?php echo $wd_button_slideshow_color; ?>;
	}
	.rev_slider_wrapper .tp-rightarrow:hover,
	body * .ls-nav-next:hover,
	.rev_slider_wrapper .tp-leftarrow:hover,
	body * .ls-nav-prev:hover,
	body .ls-v5 .ls-nav-start:hover, 
	body .ls-v5 .ls-nav-stop:hover,
	body .flex-direction-nav a.flex-next:hover,
	body .wd-content a.nivo-nextNav:hover,
	body .flex-direction-nav a.flex-prev:hover,
	body .wd-content a.nivo-prevNav:hover,
	body .slider-brand-full .slider_control .prev:hover,
	body .slider-brand-full .slider_control .next:hover{
		color:<?php echo $wd_button_slideshow_color; ?>;
		background-color:<?php echo $wd_button_slideshow_color_hover; ?>
	}
	body * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a:hover,
	#ls-global * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a:hover,
	html * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a:hover,
	.tp-bullets.simplebullets.round .bullet:hover,
	body * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a.ls-nav-active,
	#ls-global * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a.ls-nav-active,
	html * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a.ls-nav-active,
	body .tp-bullets.simplebullets.round .bullet.selected,
	body .tp-bullets.simplebullets.navbar .bullet.selected,
	body .flex-control-paging li a.flex-active,
	body .flex-control-paging li a.hover,
	body .theme-default .nivo-controlNav a.active,
	body .theme-default .nivo-controlNav a:hover,
	.blog-image-slider .owl-nav > div.owl-prev:hover:after,
	.blog-image-slider .owl-nav > div.owl-next:hover:after,
	.rev_slider_wrapper .persephone .tp-bullet:hover,
	.rev_slider_wrapper .persephone .tp-bullet.selected
	{
		border-color:<?php echo $wd_button_slideshow_color_hover; ?>;
	}
	body * .ls-nav-next:after,
	body * .ls-nav-prev:after,
	body .flex-direction-nav a.flex-next:after,
	body .wd-content a.nivo-nextNav:after,
	body .flex-direction-nav a.flex-prev:after,
	body .wd-content a.nivo-prevNav:after,
	.blog-image-slider .owl-nav > div:before,
	.rev_slider_wrapper .persephone.tparrows:hover,
	.rev_slider_wrapper .tparrows:hover,
	.rev_slider_wrapper .hesperiden.tparrows:hover,
	.rev_slider_wrapper .hades.tparrows:hover,
	.rev_slider_wrapper .tp-title-wrap,
	.rev_slider_wrapper .custom.tparrows:hover,
	.rev_slider_wrapper .hephaistos.tparrows:hover,
	.rev_slider_wrapper .erinyen.tparrows:hover,
	.rev_slider_wrapper .zeus.tparrows:hover,
	.rev_slider_wrapper .metis.tparrows:hover{
		background-color:<?php echo $wd_button_slideshow_color_hover; ?>
	}
	body .flex-direction-nav a.flex-next:before,
	body .wd-content a.nivo-nextNav:before,
	body .flex-direction-nav a.flex-prev:before,
	body .wd-content a.nivo-prevNav:before{
		color:<?php echo $wd_button_slideshow_color; ?>;
	}
	body,body code,.wd-text-color{
		color:<?php echo $wd_text_color; ?>;
	}
	
	pre,.woocommerce #reviews #comments ol.commentlist li .meta,
	.woocommerce-page #reviews #comments ol.commentlist li .meta,select{
		border-color:<?php echo $wd_input_border_color; ?>;
		color:<?php echo $wd_text_color; ?>;
	}
	
	textarea::-webkit-input-placeholder,
	textarea::-moz-placeholder,
	textarea:-moz-placeholder,
	textarea:-ms-input-placeholder,
	input::-webkit-input-placeholder,
	input::-moz-placeholder,
	input:-moz-placeholder,
	input:-ms-input-placeholder{
		color:<?php echo $wd_text_color; ?> !important;
	}
	
	pre:hover,body code:hover,blockquote:before{
		background:<?php echo $wd_input_border_color; ?>;
	}
	
	ul li,ol li{
		color:<?php echo $wd_text_color; ?>;
	}
	
	ul li li,
	ol li li,
	blockquote,
	ul li .textwidget,
	ol li .textwidget,
	strong,
	#header .v3 .select2-container .select2-choice .select2-arrow:before{
		color:<?php echo $wd_text_color; ?>;
	}

	/************** HEADER ********************/
	.wd_tini_account_wrapper .wd_tini_account_control > a,
	.regis-account-wrapper a,.regis-account-wrapper,
	#header .visible-phone.login-drop-icon:before,
	#header .left-header-top-content,
	#header .left-header-top-content:after,
	#header .wd_tini_wishlist_wrapper,
	#header .wd_tini_wishlist_wrapper a,
	#header .wd_tini_wishlist_wrapper:after{
		color:<?php echo $wd_header_top_text_color; ?>;
	}
	#header .header-top.v3:after{
		background-color:<?php echo $wd_header_top_text_color; ?>;
	}
	#header .left-header-top-content > div:before,
	#header .wd_tini_wishlist_wrapper:before,
	#header .v5 .left-header-top-content .wd_tini_wishlist_wrapper:before{
		background-color:<?php echo $wd_header_top_text_hover; ?>;
	}
	
	.wd_tini_account_wrapper .wd_tini_account_control > a:hover,
	.regis-account-wrapper a:hover,
	#header .header_search:hover span,
	#header .wd_tini_account_control:hover .visible-phone.login-drop-icon:before,
	#header .wd_tini_wishlist_wrapper, #header .wd_tini_wishlist_wrapper a:hover{
		color:<?php echo $wd_header_top_text_hover; ?>;
	}
	
	.shopping-cart .cart_dropdown:before{
		border-color:<?php echo $wd_input_border_color; ?>;
	}
	.cart_dropdown .dropdown_footer:after,
	.cart_dropdown ul.cart_list li:before{
		background-color:<?php echo $wd_input_border_color; ?>;
	}
	/* SHORTCODE RECENT BLOG */
	.social-share li a i{
		background-color:<?php echo $wd_input_border_color_hover; ?>;
		color:#fff;
	}
	.social-share li a:hover,
	.tags_social .tags .tag-links a:hover,
	div.product .tagcloud a:hover,
	.widget_tag_cloud .tagcloud a:hover,
	.widget_product_tag_cloud .tagcloud a:hover,
	#bbpress-forums div.bbp-topic-tags p a:hover,
	.price_table_inner ul li.table_title h4{
		background-color:<?php echo $wd_tag_background_hover; ?>;
		color:<?php echo $wd_tag_text_hover ?>;
		border-color:<?php echo $wd_tag_border_hover; ?>;
	}
	.tags_social .tags .tag-links a,
	#bbpress-forums div.bbp-topic-tags p a,
	div.product .tagcloud a,
	.widget_tag_cloud .tagcloud a,
	.widget_product_tag_cloud .tagcloud a{
		background-color:<?php echo $wd_tag_background; ?>;
		color:<?php echo $wd_tag_text ?>;
		border-color:<?php echo $wd_tag_border; ?>;
	}
	.shortcode-recent-blogs .tag_blog a,
	.shortcode-recent-blogs .info-detail > span:before,
	.list-posts .post-info-meta > span:before,
	.single-content .post-info-meta > span:before,
	.widget-container.widget_wd_recent_post_widget .info-detail > span:before,
	.wd_tag_cloud .wd_widget_tag_cloud a,
	.page-template-blog-personal-template .list-posts .sharing_blog ul li a{
		color:<?php echo $wd_text_weak_color; ?>;
	}
	.shortcode-recent-blogs .tag_blog a:hover,
	.wd_tag_cloud .wd_widget_tag_cloud a:hover{
		background-color:<?php echo $wd_tag_background_hover; ?>;
		color:<?php echo $wd_tag_text_hover ?>;
	}
	.shortcode-recent-blogs .heading-title a,
	.list-posts .post-title a,
	a.post-edit-link,
	.post-title a,
	.post-title a:hover{
		color:<?php echo $wd_theme_color_secondary; ?>;
	}
	.page-template-blog-personal-template .page_navi .nav-content .pager span span:hover,
	.page-template-blog-personal-template .page_navi > .nav-content a.next span span:hover,
	.page-template-blog-personal-template .page_navi > .nav-content a.previous span span:hover,
	.page-template-blog-personal-template .page_navi > .nav-content > .pager.current span span{
		background-color:<?php echo $wd_theme_color_secondary; ?>;
		color:#fff;
		border-color:<?php echo $wd_theme_color_secondary; ?>;
	}
	.shortcode-recent-blogs .bottom-share:before,
	.recent-blogs-sticky div.item .excerpt:before,
	.list-posts .post-info-meta:before,
	.single-content .post-info-meta:before,
	.tags_social:before,
	div.product .short-description-title:after,
	.wd_product_tags_categoried .wd_product_categories:before{
		background-color:<?php echo $wd_theme_color_secondary; ?>;
	}
	.woocommerce-page #content table.cart a.remove:hover{
		background-color:<?php echo $wd_theme_color_secondary; ?>;
		border-color:<?php echo $wd_theme_color_secondary; ?>;
	}
	/* SHORTCODE TAB AND ACCORDION*/
	.tab-content > .tab-pane,
	body .wpb_content_element .wpb_tour_tabs_wrapper .wpb_tab,
	body .wpb_content_element .wpb_accordion_wrapper .wpb_accordion_content,
	body .accordion-heading a.accordion-toggle,body .accordion-inner,
	body .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a,
	.tabbable > ul,body .wpb_content_element .wpb_tabs_nav,
	.vc_tta.vc_general .vc_tta-panel-title > a,
	.vc_tta.vc_general.vc_tta-tabs .vc_tta-tabs-list,
	.vc_tta.vc_general.vc_tta-tabs .vc_tta-panels-container,
	.vc_tta.vc_general.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-body,
	.vc_tta.vc_general.vc_tta-tabs.vc_tta-controls-align-left .vc_tta-tabs-list a,
	.vc_tta.vc_general.vc_tta-tabs.vc_tta-controls-align-right .vc_tta-tabs-list a{
		border-color:<?php echo $wd_title_border_color ?>;
	}
	body #accordion-checkout-details .accordion-heading a.accordion-toggle.collapsed{
		border-top-color:<?php echo $wd_title_border_color ?>;
	}
	.tabbable > ul,body .accordion-heading a.accordion-toggle,
	body .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a,
	.vc_tta.vc_general.vc_tta-accordion .vc_tta-panel-title > a{
		font-family:<?php echo $font_body_second; ?>;
	}
	ul.nav-tabs li a,
	body .wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a,
	body .wpb_content_element .wpb_accordion_header a,
	body .accordion-heading a.accordion-toggle.collapsed,
	body .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a,
	body form.checkout .accordion-heading a.accordion-toggle.collapsed h3,
	body #accordion-checkout-details .accordion-heading a.accordion-toggle.collapsed h3,
	.vc_tta.vc_general.vc_tta-accordion .vc_tta-panel-title > a,
	.vc_tta.vc_general.vc_tta-tabs .vc_tta-tabs-list a{
		color:<?php echo $wd_text_weak_color; ?>;
	}
	/*===*/
	.woocommerce ul.products li.product .product-meta-wrapper .review_count,
	body.woocommerce #content div.product div.summary .review_count,
	body.woocommerce-page #content div.product div.summary .review_count,
	body .pp_woocommerce div.product div.summary .review_count{
		color:<?php echo $wd_text_weak_color; ?>;
	}
	.woocommerce ul.products li.product .product-meta-wrapper .review_count,
	body.woocommerce #content div.product div.summary .review_count,
	body.woocommerce-page #content div.product div.summary .review_count,
	body .pp_woocommerce div.product div.summary .review_count,
	.archive-product-after-loop,
	#portfolio-container .end_content,
	body .woocommerce .wd_product_tab_by_category_shortcode ul.products li.product:before,
	body .woocommerce .wd_product_tab_by_category_shortcode ul.products li.product:after,
	#wp-calendar tbody tr:last-child td,
	#wp-calendar,
	.page-template-blog-personal-template .list-posts li.post .post-content,
	.page-template-blog-personal-template .page_navi .nav-content .pager span span,
	.page-template-blog-personal-template .page_navi > .nav-content a.next span span,
	.page-template-blog-personal-template .page_navi > .nav-content a.previous span span,
	.page-template-blog-personal-template .page_navi span.curent-total{
		border-color:<?php echo $wd_box_border_color; ?>
	}
	.woocommerce ul.products li.product .product-meta-wrapper .review_count:after,
	body .pp_woocommerce div.product div.summary .review_count:after,
	body.woocommerce #content div.product div.summary .review_count:after,
	body.woocommerce-page #content div.product div.summary .review_count:after{
		color:<?php echo $wd_box_border_color; ?>
	}
	/*==*/
	.nav-tabs > li.active > a, 
	.nav-tabs > li.active > a:hover,
	.nav-tabs > li.active > a:focus,
	body .accordion-heading a.accordion-toggle,
	body .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active a,
	body .wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a,
	ul.nav-tabs li a:hover,body .wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a:hover,
	body .wpb_content_element .wpb_accordion_header a:hover,
	.price_in_table *,
	ul.list-check li:before,
	.primary-color,
	.btn.button-primary-text,
	body.woocommerce .btn.button-primary-text,
	body.woocommerce-page .btn.button-primary-text,
	.bg-full-testimonial .testimonial-item a.title,
	.bg-full-testimonial .wd_testimonial_wrapper .testimonial-item .detail:before,
	.wd_meet_team .name-role,
	body.archive ul.products li.product.product-category:hover h3,
	ul.list-check li:after,
	.wd_individual_product_wrapper h3 > a:hover,
	.woocommerce .wd_individual_product_wrapper .add_to_cart_wrapper a:hover,
	.woocommerce-page .wd_individual_product_wrapper .add_to_cart_wrapper a:hover,
	#nav-below > span a:hover,
	#footer .widget-container.widget_text ul.wd-list-info li a:hover,
	#footer .first-footer-widget-area .wd_recent_posts_slider_widget > .item .entry-title a:hover,
	#footer .second-footer-widget-area .wd_recent_posts_slider_widget > .item .entry-title a:hover,
	#footer .third-footer-widget-area .wd_recent_posts_slider_widget > .item .entry-title a:hover,
	.page-template-blog-personal-template .list-posts .sharing_blog ul li a:hover,
	.page-template-blog-personal-template .list-posts .post-title h2 a:hover,
	li.product-category .min-price,
	.body-wrapper .woocommerce .product_categories_2_wrapper ul.products li.product.product-category a:hover h3, 
	.woocommerce-page .product_categories_2_wrapper ul.products li.product.product-category a:hover h3,
	.woocommerce ul.products li.product-category .min-price .amount,
	.woocommerce-page ul.products li.product-category .min-price .amount,
	.vc_tta.vc_general.vc_tta-accordion .vc_active .vc_tta-panel-title > a,
	.vc_tta.vc_general.vc_tta-tabs .vc_tta-tabs-list .vc_active a,
	.vc_tta.vc_general.vc_tta-tabs .vc_tta-tabs-list a:hover,
	.vc_tta.vc_general.vc_tta-accordion .vc_tta-panel-title > a:hover{
		color:<?php echo $wd_theme_color_primary; ?>;
	}
	.nav-tabs > li.active > a:after,
	body .wpb_content_element .wpb_tabs_nav li.ui-tabs-active a:after,
	body .accordion-heading a.accordion-toggle:after,
	body .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active a:after,
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a:after,
	#footer .first-footer-widget-area .widget-container.widget_wd_recent_post_widget .type-2 .date-time,
	#footer .second-footer-widget-area .widget-container.widget_wd_recent_post_widget .type-2 .date-time,
	#footer .third-footer-widget-area .widget-container.widget_wd_recent_post_widget .type-2 .date-time,
	.vc_tta.vc_general.vc_tta-accordion .vc_active .vc_tta-panel-title > a:after,
	.vc_tta.vc_general.vc_tta-tabs .vc_tta-tabs-list .vc_active a:after,
	.vc_tta.vc_general.vc_tta-tabs.vc_tta-controls-align-left .vc_tta-tabs-list .vc_active a:after,
	.vc_tta.vc_general.vc_tta-tabs.vc_tta-controls-align-right .vc_tta-tabs-list .vc_active a:after{
		background-color:<?php echo $wd_theme_color_primary; ?>;
	}
	.nav-tabs > li.active > a:before,
	body .wpb_content_element .wpb_tabs_nav li.ui-tabs-active a:before,
	.heading-title-block h1:after,
	.heading-title-block h2:after,
	body .accordion-heading a.accordion-toggle:before,
	body .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active a:before,
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a:before,
	.body-wrapper .woocommerce ul.products li.product a:hover img,
	.woocommerce-page .body-wrapper ul.products li.product a:hover img,
	#to-top a:hover:before,
	ul.archive-product-subcategories > .product a:hover img,
	.wd_price_table .price_in_table,
	.wd_product_tab_by_category_shortcode .wd_list_categories,
	.wd_product_tab_by_category_shortcode .wd_list_categories:before,
	.vc_tta.vc_general.vc_tta-accordion .vc_tta-panel-title > a:before,
	body .vc_tta.vc_general.vc_tta-tabs .vc_tta-tabs-list .vc_active a:before, 
	body .vc_tta.vc_general.vc_tta-tabs.vc_tta-tabs-position-top:not([class*="vc_tta-gap"]):not(.vc_tta-o-no-fill) .vc_tta-tab.vc_active > a:before,
	body .vc_tta-tabs.vc_tta-tabs-position-left:not([class*="vc_tta-gap"]):not(.vc_tta-o-no-fill) .vc_tta-tab.vc_active > a,
	body .vc_tta-tabs.vc_tta-tabs-position-right:not([class*="vc_tta-gap"]):not(.vc_tta-o-no-fill) .vc_tta-tab.vc_active > a{
		border-color:<?php echo $wd_theme_color_primary; ?>;
	}
	.product_categories_2_wrapper ul.products li.product.product-category a.label-link{
		border-top-color:<?php echo $wd_theme_color_primary; ?>;
	}
	/* END SHORTCODE TAB */
	
	.woocommerce #content ul.products li.product .onsale,
	.woocommerce-page #content ul.products li.product .onsale,
	.woocommerce ul.products li.product .onsale,
	.woocommerce .images span.onsale, 
	.woocommerce-page .images span.onsale,
	.pp_woocommerce .images span.onsale,
	body .shortcode_wd_banner .shortcode_banner_label.onsale{
		background-color:<?php echo $wd_feature_sale; ?>;
		color:<?php echo $wd_feature_text_sale; ?>;
	}
	.woocommerce .body-wrapper ul.products li.product .onsale:before, 
	.woocommerce-page .body-wrapper ul.products li.product .onsale:before,
	.body-wrapper .woocommerce ul.products li.product .onsale:before,
	
	.woocommerce .images span.onsale:before,
	.woocommerce-page .images span.onsale:before,
	.pp_woocommerce span.onsale:before
	{
		border-bottom-color:<?php echo $wd_feature_sale; ?>;
	}
	.woocommerce #content ul.products li.product span.featured, 
	.woocommerce-page #content ul.products li.product span.featured, 
	.woocommerce ul.products li.product span.featured,
	.woocommerce .images span.featured , 
	.woocommerce-page .images span.featured ,
	.pp_woocommerce .images span.featured,
	body .shortcode_wd_banner .shortcode_banner_label.featured{
		background-color:<?php echo $wd_feature_hot; ?>;
		color:<?php echo $wd_feature_text_hot; ?>;
	}
	.woocommerce .body-wrapper ul.products li.product .featured:before, 
	.body-wrapper .woocommerce ul.products li.product span.featured:before, 
	.woocommerce-page .body-wrapper ul.products li.product span.featured:before,
	.woocommerce .images span.featured:before , 
	.woocommerce-page .images span.featured:before ,
	.pp_woocommerce .images span.featured:before
	{
		border-bottom-color:<?php echo $wd_feature_hot; ?>;	
	}
	.body-wrapper .woocommerce ul.products li.product span.product_label.new, 
	.woocommerce-page .body-wrapper ul.products li.product span.product_label.new,
	.woocommerce .images span.new , 
	.woocommerce-page .images span.new ,
	.pp_woocommerce .images span.new,
	body .shortcode_wd_banner .shortcode_banner_label.new
	{
		background-color:<?php echo $wd_feature_new; ?>;
		color:<?php echo $wd_feature_text_new; ?>;	
	}
	.body-wrapper .woocommerce ul.products li.product span.product_label.new:before, 
	.woocommerce-page .body-wrapper ul.products li.product span.product_label.new:before,
	.woocommerce .images span.new:before , 
	.woocommerce-page .images span.new:before ,
	.pp_woocommerce .images span.new:before{
		border-bottom-color:<?php echo $wd_feature_new; ?>;	
	}
	.wd_custom_category_shortcode .wd-custom-category-right-wrapper span.product_label{
		color:<?php echo $wd_label_top_recommend_text; ?>;
		background-color:<?php echo $wd_label_top_recommend_background; ?>;
	}
	.shopping-cart .cart_text .total,
	.wd-text-weak-color,
	blockquote strong,
	em,
	/* PAGER */
	body.woocommerce #content nav.woocommerce-pagination ul li a,
	body.woocommerce-page #content nav.woocommerce-pagination ul li a,
	body.woocommerce #content nav.woocommerce-pagination ul li span,
	body.woocommerce-page #content nav.woocommerce-pagination ul li span,
	.page_navi .wp-pagenavi span, .page_navi .wp-pagenavi a,
	.page_navi > .nav-content > .pager span span,
	/* END PAGER */
	.product_list_widget li .quantity,
	.feature.shortcode .feature_excerpt,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories ul .link_cat,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories ul .link_cat,
	body .wd-content .wd_widget_testimonial .widget-title,
	body .wd-content .wd_widget_testimonial .testimonial-item .wd_info span.twitter a,
	.wd_testimonial_wrapper .testimonial-item .detail span.twitter a,
	.widget_recent_comments_custom .wd_info_comment > span.twitter a,
	.wd_widget_bbpress_recent_posts .post_user_info > span.twitter a,
	body.woocommerce .woocommerce-ordering select, 
	body.woocommerce-page .woocommerce-ordering select,
	.woocommerce .widget_price_filter .price_slider_amount .price_label,
	body.woocommerce ul.products li.product .loop-short-description,
	body.woocommerce-page ul.products li.product .loop-short-description,
	body .woocommerce ul.products li.product .loop-short-description,
	.woocommerce #main_content .products.grid div[itemprop="description"],
	body #main_content .products.grid div[itemprop="description"],
	body.woocommerce-page #main_content .products.grid div[itemprop="description"],
	.woocommerce #main_content .products.list div[itemprop="description"],
	body #main_content .products.list div[itemprop="description"],
	body.woocommerce-page #main_content .products.list div[itemprop="description"],
	.woocommerce #main_content .products div[itemprop="description"],
	body #main_content .products div[itemprop="description"],
	body.woocommerce-page #main_content .products div[itemprop="description"],
	
	.woocommerce ul.products li.product .wd_product_categories,
	#entry-author-info #author-description .role,
	#entry-author-info #author-description .author-desc,
	
	body.woocommerce-page form.login .lost_password a,
	body.woocommerce-page form.checkout_coupon .lost_password,
	body.woocommerce-page form.register .lost_password,
	.woocommerce-page #content table.shop_table thead th,
	.woocommerce-page #content table.shop_table tbody tr.cart_item td.product-title .wd_product_excerpt,
	body #accordion-checkout-details #collapse-login-regis .checkout-account-type label,
	body #accordion-checkout-details #collapse-login-regis .checkout-account-type .info-checkout,
	#collapse-login-regis form.login > p,
	body.woocommerce-page #collapse-login-regis form.login .lost_password,
	.woocommerce-page form .form-row#ship-to-different-address label,
	body.woocommerce-page #content form.checkout table.shop_table td.product-title .wd_product_excerpt,
	body.woocommerce-page #content form.cart table.shop_table td.product-title .wd_product_excerpt,
	
	body.woocommerce #content div.product .woocommerce-tabs ul.tabs li a,
	body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a,
	body.woocommerce #content div.product .nav.nav-tabs li a h2,
	body.woocommerce-page #content div.product .nav.nav-tabs li a h2,
	
	.wd_custom_category_shortcode .wp_title_shortcode_products .wd_list_categories ul li a,
	.widget_archive ul li a,
	/* ALL CATEGORIES UL LI */
	.widget_archive ul li a, .widget_meta ul li a, .widget_categories ul li a,
	.widget_nav_menu div ul li a,.widget_pages ul li a,
	.widget_product_categories ul li a,
	.widget_recent_entries ul li a ,
	/* PORTFOLIO */
	.portfolio-filter-wrapper,.portfolio-filter-wrapper li a,
	/* END PORTFOLIO */
	#bbpress-forums .bbp-header .forum-titles li,
	#bbpress-forums li.bbp-header > div,
	span.bbp-admin-links a,
	#bbpress-forums li.bbp-header,
	#bbpress-forums div.bbp-forum-author .bbp-author-role,
	#bbpress-forums div.bbp-topic-author .bbp-author-role,
	#bbpress-forums div.bbp-reply-author .bbp-author-role,
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation a,
	.bbp-forum-header a.bbp-forum-permalink,
	.bbp-topic-header a.bbp-topic-permalink,
	.bbp-reply-header a.bbp-reply-permalink,
	.banner_description_shortcode .banner_description_wrapper .banner_description,
	.woocommerce ul.products li.product .wd_product_categories a,
	.widget-container.wd_widget_tab_product .product_list_widget > li .wd_product_categories,
	.widget-container .wd_widget_product_slider_wrapper .product_per_slide ul > li .wd_product_categories a, 
	.widget-container .wd_widget_product_slider_wrapper .product_per_slide ul > li .wd_product_categories,
	.widget-container.wd_widget_tab_product .product_list_widget > li .wd_product_categories a,
	.widget_display_replies > ul li > div:before,
	.widget-container.widget_display_topics > ul li > div:before,
	.variation dd,
	.wd_product_tab_by_category_shortcode .wd_list_categories ul li a,
	.wd_product_tab_by_category_shortcode .view_all a,
	#container .gridlist-toggle a#list:before,
	#container .gridlist-toggle a#grid:before,
	.list-posts .post-info-meta a
	{
		color:<?php echo $wd_text_weak_color; ?>;
	}
	/* TEXT PRICE DEL SALE */
	body .pp_woocommerce div.product.wd_quickshop .entry-summary span.price del .amount,
	body .pp_woocommerce div.product.wd_quickshop .entry-summary p.price del .amount,
	body.woocommerce #content div.product .entry-summary span.price del .amount,
	body.woocommerce #content div.product .entry-summary p.price del .amount,
	body.woocommerce-page #content div.product .entry-summary span.price del .amount,
	body.woocommerce-page #content div.product .entry-summary p.price del .amount,
	body .pp_woocommerce div.product .entry-summary span.price del .amount,
	body .pp_woocommerce div.product.wd_quickshop .entry-summary span.price del .amount,
	body .pp_woocommerce div.product.wd_quickshop .entry-summary span.price del,
	body .pp_woocommerce div.product.wd_quickshop .entry-summary p.price del,
	body.woocommerce #content div.product .entry-summary span.price del,
	body.woocommerce #content div.product .entry-summary p.price del,
	body.woocommerce-page #content div.product .entry-summary span.price del,
	body.woocommerce-page #content div.product .entry-summary p.price del,
	body .pp_woocommerce div.product .entry-summary span.price del,
	/* END TEXT PRICE DEL SALE */
	.wd_tini_account_wrapper .form_wrapper_footer span,
	.comment-body p,.post_content p,
	.comment-body,
	#comments .commentlist li .divcomment .divcomment-inner .comment-meta a,
	.related .date-time,
	.woocommerce-page ul#shipping_method label,
	.woocommerce-page #content table.shop_table tbody tr.cart_item .product-thumbnail.product-name a,
	.price_slider_wrapper a,
	#footer ul.footer-contact li.contact-mobile,
	.wd_tini_account_wrapper .form_wrapper_body > a,
	p.excerpt,
	/* ALL WIDGET UL UL LI A */
	.widget_categories > ul > li > a ,
	.widget_nav_menu div > ul > li > a,
	.widget_pages > ul > li > a,
	.widget_product_categories > ul > li > a,
	.widget_recent_entries > ul > li > a,
	/* TEXT IN INPUT */
	.woocommerce-page #content .cart-collaterals .shipping_calculator select,
	/* END TEXT IN PUT */
	.woocommerce-page #payment ul.payment_methods li label,
	.widget-container .wd-categories li a,
	.widget_woothemes_features .feature-content,
	.woocommerce .widget_layered_nav ul small.count, 
	.woocommerce-page .widget_layered_nav ul small.count,
	.chosen-container-single .chosen-single,
	.subscribe-email input,
	.widget_recent_post_slider .entry-desc,
	.woocommerce-page .widget_layered_nav ul li a,
	#entry-author-info #author-description .description,
	.woocommerce-page ul#shipping_method span.amount,
	body.woocommerce #content div.product p.stock.availability,
	body.woocommerce-page #content div.product p.stock.availability,
	body .pp_woocommerce div.product p.stock.availability,
	.wd_product_tags_categoried .wd_product_categories a,
	
	body.woocommerce #content div.product form.cart .variations label, 
	body.woocommerce-page #content div.product form.cart .variations label,
	body .pp_woocommerce div.product form.cart .variations label,
	
	.woocommerce #reviews #comments h2, 
	.woocommerce-page #reviews #comments h2,
	
	.woocommerce #content table.shop_table.wishlist_table tr td,
	.woocommerce-page #content table.shop_table.wishlist_table tr td, 
	#content .woocommerce table.shop_table.wishlist_table tr td,table.compare-list th,
	body .wpb_teaser_grid .categories_filter li a,
	#bbpress-forums li.bbp-body .bbp-forum-freshness > a,
	#bbpress-forums li.bbp-body .bbp-topic-freshness > a,
	#bbpress-forums li.bbp-body .bbp-forum-freshness > a:before,
	.wd_widget_bbpress_forums ul.forum_list li a,
	.widget_display_topics ul li a,
	.widget_display_forums > ul li a,
	.widget_display_views > ul li a,
	.widget_recent_comments ul li a,
	.widget_display_replies > ul li a,
	.bbp_widget_login .bbp-login-form .bbp-remember-me label,
	.feature.shortcode .feature_content_wrapper.style-2 .feature_title,
	.select2-drop,
	.cart_dropdown .cart_dropdown_size label,
	.wd_myaccount_menu a,.wd_myaccount_menu a:hover,
	.wd_widget_product_categories .wd_product_categories .dropdown_mode .icon_toggle,
	.wd_widget_bbpress_forums .wd_bbpress_forums .icon_toggle,
	.widget-container.wd_widget_tab_product .wd_tab_product_title a,
	.wd_meet_team .social a,
	.container .vc_toggle_title h4:before,
	.container#content .vc_toggle_title h4:before,
	.container .vc_toggle_title h4, 
	.container#content .vc_toggle_title h4,
	.select2-container .select2-choice
	{
		color:<?php echo $wd_text_color; ?>;
	}
	/* FOR DESCRIPTION GRID LIST */
	body.woocommerce #main_content .products div[itemprop="description"], 
	body #main_content .products div[itemprop="description"], 
	body.woocommerce-page #main_content .products div[itemprop="description"],
	body.woocommerce #main_content .products div[itemprop="description"], 
	body #main_content .products div[itemprop="description"], 
	body.woocommerce-page #main_content .products div[itemprop="description"]{
		color:<?php echo $wd_text_color; ?>;
	}
	
	.price_slider_wrapper a:before{
		background-color:<?php echo $wd_text_color; ?>;
	}
	
	.wd-blog-ft .title a,
	.widget_recent_post_slider .entry-title > a{
		color:<?php echo $wd_text_weak_color; ?>;
	}
	/* PRODUCT NAME WIDGET LIST UL LI */
	.widget-container .wd_widget_product_slider_wrapper .product_per_slide ul > li > a,
	ul.product_list_widget li a, 
	.woocommerce ul.product_list_widget li a, 
	.woocommerce-page ul.product_list_widget li a, 
	ul.cart_list li a, 
	.woocommerce ul.cart_list li a, 
	.woocommerce-page ul.cart_list li a, 
	.widget_popular ul li .title a, 
	.woocommerce .widget_popular ul li .title a, 
	.widget_hot_product ul li .title a, 
	.woocommerce .widget_hot_product ul li .title a, 
	.widget_top_rated_products ul.product_list_widget li > a, 
	.woocommerce .widget_top_rated_products ul.product_list_widget li > a, 
	.widget_recent_reviews ul.product_list_widget li > a, 
	.woocommerce .widget_recent_reviews ul.product_list_widget li > a,
	/* END WIDGET */
	.woocommerce ul.products li.product .heading-title a,
	.summary.entry-summary .group_table td.label label a,
	.woocommerce-page #content table.shop_table tbody tr.cart_item td.product-title a,
	.recent-order-title,
	.my-address-title,
	body.woocommerce-page #content form.checkout table.shop_table td.product-title span.wd_product_title,
	body.woocommerce-page #content form.cart table.shop_table td.product-title span.wd_product_title,
	.woocommerce-page #content .order_details .product-name a,
	body table.compare-list tr.title td,strong.product-quantity,
	body .menu .woocommerce ul.products li.product .heading-title a,
	body.woocommerce-page .menu ul.products li.product .heading-title a,
	.woocommerce ul.cart_list li a, .woocommerce ul.product_list_widget li a, 
	.woocommerce-page ul.cart_list li a, 
	.woocommerce-page ul.product_list_widget li a,
	.variation dt
	{
		color:<?php echo $wd_product_name_color; ?>;
		font-weight:600;
	}
	/* PRODUCT CATEGORIES */
	woocommerce ul.products li.product .wd_product_categories a:hover,
	.widget-container.wd_widget_tab_product .product_list_widget > li .wd_product_categories a:hover,
	.widget-container .wd_widget_product_slider_wrapper .product_per_slide ul > li .wd_product_categories a:hover,
	.woocommerce ul.products li.product .wd_product_categories a:hover,
	.woocommerce ul.products li.product .wd_product_categories a:hover,
	.widget-container.wd_widget_tab_product .product_list_widget > li .wd_product_categories a:hover,
	.widget-container .wd_widget_product_slider_wrapper .product_per_slide ul > li .wd_product_categories a:hover,
	.woocommerce ul.products li.product .wd_product_categories a:hover{
		color:<?php echo $wd_product_name_color; ?>;
	}
	/* ====================================== SOCIAL ICON COLOR ================================= */
	.widget_social .social-icons li a:before,
	#header .social-share li a i,
	.social-share li a:hover i{
		color:<?php echo $wd_social_icon_color; ?>;
		background-color:<?php echo $wd_social_icon_background; ?>;
	}
	#header .social-share li a:hover i,
	.widget_social .social-icons li a:hover:before,
	.widget_social ul li a span.wd_tooltip{
		color:<?php echo $wd_social_icon_color_hover; ?>;
		background-color:<?php echo $wd_social_icon_background_hover; ?>;
	}
	.widget_social ul li a span.wd_tooltip:before{
		color:<?php echo $wd_social_icon_background_hover; ?>;
	}
	body .vc_progress_bar.has_border .vc_single_bar .vc_label,
	h2,.feature.shortcode .feature_content_wrapper.has_icon .feature_icon:before,
	.heading-title-block h1,.heading-title-block h2,.logo a,
	/* TITLE SLIDER */
	.woocommerce .featured_product_slider_wrapper .featured_product_slider_wrapper_meta h3,
	.woocommerce-page .featured_product_slider_wrapper .featured_product_slider_wrapper_meta h3,
	.woocommerce .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta h3,
	.woocommerce-page .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta h3,
	.woocommerce .featured_product_wrapper .wp_title_shortcode_products h3,
	.woocommerce-page .featured_product_wrapper .wp_title_shortcode_products h3,
	/* FILLTER COLOR SIZE */
	.woocommerce .widget_layered_nav_filters ul li.chosen a,
	.woocommerce-page .widget_layered_nav_filters ul li.chosen a,
	.woocommerce .widget-container.widget_layered_nav ul li.chosen a,
	.woocommerce-page .widget_layered_nav ul li.chosen a,
	.woocommerce .widget_layered_nav_filters ul li.chosen a,
	.woocommerce-page .widget_layered_nav_filters ul li a:hover,
	.woocommerce .widget-container.widget_layered_nav ul li.chosen a,
	/* ALL CATEGORIES UL LI */
	.widget_categories ul li > a:hover,
	.widget_nav_menu ul li > a:hover,
	.widget_pages ul li > a:hover,
	.widget_product_categories ul li > a:hover,
	.widget_product_categories ul li.current-cat > a,
	.widget_nav_menu ul li.current_page_item > a,
	.widget_pages ul li.current_page_item > a,
	.widget_categories li.current-cat > a,
	
	.wd_widget_product_categories .wd_product_categories > .dropdown_mode > li a:hover,
	.wd_widget_bbpress_forums .wd_bbpress_forums > .dropdown_mode > li a:hover,
	.wd_widget_product_categories .wd_product_categories > ul li:hover > a,
	.widget-container.widget_categories > ul li a:hover,
	.related > .title,
	.woocommerce-page #content .cart-collaterals .shipping_calculator .wd_shipping_last,
	.wd_tini_account_wrapper .form_wrapper_body label:after,
	#header .nav > .main-menu > ul.menu > li a.title,
	.woocommerce-page #content table.shop_table tbody tr.cart_item td.product-subtotal .amount,
	.woocommerce-page #content table.shop_table tbody tr.cart_item td.product-price .amount,

	.woocommerce-page td.product-name dl.variation dt,
	.woocommerce-page #content div.product .add_new_review:before,
	.woocommerce div.product .add_new_review:before,
	.pp_woocommerce div.product .add_new_review:before,
	.woocommerce .social_sharing.second .social_icon > div.pinterest span,
	.woocommerce-page .social_sharing.second .social_icon > div.pinterest span,
	.woocommerce .social_sharing.second .social_icon > div.mail span,
	.woocommerce-page .social_sharing.second .social_icon > div.mail span,
	
	#comments #comments-title,#respond #reply-title,.related .wd_title_related .heading-title,
	body.woocommerce-page table.shop_table tbody tr.checkout_table_item td.product-price,
	body.woocommerce-page table.shop_table tbody tr.checkout_table_item td.product-total,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .heading-title,
	.woocommerce-page #content .cart-collaterals .cross-sells .wd_title_cross_sells .heading-title,
	.comment .comment-author,
	#order_review .amount,
	.widget-container .wd-categories li a:hover,
	.wd-heading-title,
	.woocommerce-page #content .cart-collaterals .cart_totals > table tr.total th,
	.widget-container.widget_recent_entries a:hover,
	.wd_title_myaccount .heading-title,
	.cart_totals .amount,
	body form.checkout .accordion-toggle h3,
	body #accordion-checkout-details .accordion-heading a.accordion-toggle h3,
	body form.checkout .accordion-heading a.accordion-toggle.collapsed:hover h3,
	body #accordion-checkout-details .accordion-heading a.accordion-toggle.collapsed:hover h3,
	.woocommerce-page .before_checkout_form form.checkout_coupon .question_coupon,
	body.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a,
	body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a,
	body.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a:hover,
	body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a:hover,
	body.woocommerce #content div.product .nav.nav-tabs li.active a h2,
	body.woocommerce-page #content div.product .nav.nav-tabs li.active a h2,
	body.woocommerce #content div.product .nav.nav-tabs li.active:hover a h2,
	body.woocommerce-page #content div.product .nav.nav-tabs li.active:hover a h2,
	.wd_custom_category_shortcode .wp_title_shortcode_products h3,
	.widget_shopping_cart .total .amount,
	.woocommerce ul.products li.product .product-meta-wrapper .review_count span,
	body.woocommerce #content div.product div.summary .review_count span,
	body.woocommerce-page #content div.product div.summary .review_count span,
	body .pp_woocommerce div.product div.summary .review_count span,
	#footer .widget_twitterupdate.widget-container ul li.status-item .user a,
	#footer .widget_twitterupdate.widget-container ul li.status-item .user a:hover,
	#portfolio-galleries .portfolio-filter li.active a,
	body.wpb-js-composer h1,
	.widget_display_views > ul li a:hover,
	.widget_display_topics ul li a:hover,
	.widget_display_forums > ul li a:hover,
	.widget_display_replies > ul li a:hover,
	.widget_recent_comments ul li a:hover,
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation a:hover,
	body.woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover,
	body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a:hover,
	body.woocommerce #content div.product .nav.nav-tabs li:hover a h2,
	body.woocommerce-page #content div.product .nav.nav-tabs li:hover a h2,
	#bbpress-forums .bbp-header .forum-titles li.bbp-forum-info,
	.feature.shortcode .feature_content_wrapper.style-2:hover a.wd-feature-icon .feature_icon:before,
	#header .v1 .shopping-cart .cart_item:before,
	#header .v1 .shopping-cart:hover .wd_tini_cart_wrapper .cart_item .num_item,
	#header .v3 .shopping-cart .cart_item:before,
	#header .v3 .shopping-cart:hover .wd_tini_cart_wrapper .cart_item .num_item,
	#header .v4 .shopping-cart .cart_item:before,
	#header .v4 .shopping-cart:hover .wd_tini_cart_wrapper .cart_item .num_item,
	.wd_custom_category_shortcode .wp_title_shortcode_products .wd_list_categories ul li a.current:after,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories ul .link_cat.current:after,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories ul .link_cat.current:after,
	#header .header-middle.v1 .shopping-cart .cart_item .num_item:after,
	#header .header-middle.v4 .shopping-cart .cart_item .num_item:after,
	#header .header-middle.v3 .shopping-cart .cart_item .num_item:after,
	.body-wrapper .woocommerce ul.products li.product.product-category h3,
	.woocommerce-page ul.products li.product.product-category h3,
	.full_contact input[type="submit"]:hover,
	.wd_product_tab_by_category_shortcode .wd_list_categories ul li a:hover,
	.wd_product_tab_by_category_shortcode .wd_list_categories ul li a.current,
	.wd_product_tab_by_category_shortcode .view_all a:hover,
	#container .gridlist-toggle a#grid:hover:before,
	#container .gridlist-toggle a#list:hover:before,
	#container .gridlist-toggle a#grid.active:before,
	#container .gridlist-toggle a#list.active:before,
	.list-posts .post-info-meta a:hover
	{
		color:<?php echo $wd_theme_color_primary; ?>;
	}
	html .woocommerce #content table.cart input.button,
	button.button, a.button, input[type^=submit],
	html .woocommerce a.button,
	html .woocommerce button.button,
	html .woocommerce input.button,
	html .woocommerce #respond input#submit,
	html .woocommerce #content input.button,
	html .woocommerce-page a.button,
	html .pp_woocommerce a.button,
	html .woocommerce-page button.button,
	html .woocommerce-page input.button,
	html .woocommerce-page button.button.alt, 
	html .woocommerce-page input.button.alt,
	html .woocommerce-page a.button.alt,
	html .woocommerce-page #respond input#submit,
	html .woocommerce-page #content input.button,
	html input.button,
	#comments .commentlist li .divcomment .divcomment-inner .reply a,
	.woocommerce-page #customer_login.col2-set .col-1 form.login input.button:hover,
	body .wd_logout.btn,
	.woocommerce-page #payment #place_order,
	table.compare-list tr.remove td > a,
	.bbp_widget_login .bbp-login-form .bbp-login-links a,
	/* BUTTON COUP NGUOC MAU */
	body.woocommerce-page #content .before_checkout_form form.checkout_coupon input.button:hover,
	/* BUTTON LOGIN CHECKOUT NGUOC MAU */
	#accordion-checkout-details .accordion-inner form.login input.button:hover,
	/* BUTTON 3 BOX SHOPPING CART NGUOC MAU */
	.woocommerce-page #content .cart-collaterals input.button[type^=submit]:hover,
	.woocommerce-page #content .cart-collaterals .shipping_calculator .button:hover,
	#bbpress-forums #bbp-search-form input.button:hover,
	.widget_display_search #bbp-search-form input.button:hover,
	.individual_mini .woocommerce .wd_individual_product_wrapper .add_to_cart_wrapper a,
	.woocommerce .individual_mini .wd_individual_product_wrapper .add_to_cart_wrapper a,
	.woocommerce-page .individual_mini .wd_individual_product_wrapper .add_to_cart_wrapper a
	{
		background-color:<?php echo $wd_button_background; ?>;
		color:<?php echo $wd_button_text; ?>;
		border-color:<?php echo $wd_button_border; ?>;
	}
	.individual_mini .woocommerce .wd_individual_product_wrapper .add_to_cart_wrapper a,
	.woocommerce .individual_mini .wd_individual_product_wrapper .add_to_cart_wrapper a{
		background:transparent;
	}
	.feature.shortcode .feature_content_wrapper.has_icon:hover .feature_icon,
	html .woocommerce #content input.button:hover,
	html .woocommerce #respond input#submit:hover,
	html .woocommerce a.button:hover,
	html .woocommerce button.button:hover,
	html .woocommerce input.button:hover,
	html .woocommerce-page #content input.button:hover,
	html .woocommerce-page #respond input#submit:hover,
	html .woocommerce-page a.button:hover,
	html .woocommerce-page button.button:hover,
	html .woocommerce-page input.button:hover,
	html .woocommerce-page button.button.alt:hover, 
	html .woocommerce-page input.button.alt:hover,
	html .woocommerce-page a.button.alt:hover,
	html .woocommerce .woocommerce-message a.button,
	html .woocommerce-page .woocommerce-message a.button,
	html .woocommerce-message a.button,
	#comments .commentlist li .divcomment .divcomment-inner .reply a:hover,
	.woocommerce-page #customer_login.col2-set .col-1 form.login input.button,
	body .wd_logout.btn:hover,
	#footer .widget_subscriptions button.button:hover,
	.woocommerce-page #payment #place_order:hover,
	table.compare-list tr.remove td > a:hover,
	.bbp_widget_login .bbp-login-form .bbp-login-links a:hover,
	/* BUTTON COUP */
	body #content.woocommerce .before_checkout_form form.checkout_coupon input.button, 
	body.woocommerce-page #content .before_checkout_form form.checkout_coupon input.button,
	/* BUTTON LOGIN CHECKOUT NGUOC MAU */
	#accordion-checkout-details .accordion-inner form.login input.button,
	/* BUTTON 3 BOX SHOPPING CART NGUOC MAU */
	.woocommerce-page #content .cart-collaterals input.button[type^=submit],
	.woocommerce-page #content .cart-collaterals .shipping_calculator .button,
	#bbpress-forums #bbp-search-form input.button,
	.widget_display_search #bbp-search-form input.button,
	.wd_price_table .price_button .button,
	.individual_mini .woocommerce .wd_individual_product_wrapper .add_to_cart_wrapper a:hover,
	.woocommerce .individual_mini .wd_individual_product_wrapper .add_to_cart_wrapper a:hover,
	.woocommerce-page .individual_mini .wd_individual_product_wrapper .add_to_cart_wrapper a:hover
	{
		background-color:<?php echo $wd_button_background_hover; ?>;
		color:<?php echo $wd_button_text_hover; ?>;
		border-color:<?php echo $wd_button_background_hover; ?>;
	}
	.woocommerce .woocommerce-message a.button:hover, 
	.woocommerce-page .woocommerce-message a.button:hover,
	.woocommerce-message a.button:hover{
		color:<?php echo $wd_button_background_hover; ?>;
		border-color:<?php echo $wd_button_background_hover; ?>;
		background-color:<?php echo $wd_main_content_background ?>;
	}
	/* WISHLIST COMPARE DETAIL PRODUCT */
	.pp_woocommerce div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce #content div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce-page #content div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a,
	
	.pp_woocommerce div.product .summary.entry-summary .add_to_wishlist ,
	.woocommerce #content div.product .summary.entry-summary .add_to_wishlist ,
	.woocommerce-page #content div.product .summary.entry-summary .add_to_wishlist,

	.pp_woocommerce div.product .summary.entry-summary .add_to_wishlist.button ,
	.woocommerce #content div.product .summary.entry-summary .add_to_wishlist.button ,
	.woocommerce-page #content div.product .summary.entry-summary .add_to_wishlist.button,
	
	.pp_woocommerce div.product .summary.entry-summary .compare.button,
	.woocommerce #content div.product .summary.entry-summary .compare.button,
	.woocommerce-page #content div.product .summary.entry-summary .compare.button,
	
	.pp_woocommerce div.product .summary.entry-summary .compare,
	.woocommerce #content div.product .summary.entry-summary .compare,
	.woocommerce-page #content div.product .summary.entry-summary .compare,
	
	.pp_woocommerce div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce #content div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce-page #content div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a
	{
		background-color:<?php echo $wd_button_background; ?>;
		color:<?php echo $wd_text_weak_color; ?>;
		border-color:<?php echo $wd_button_border; ?> !important;
	}
	body #container-main .woocommerce .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a:hover.product_type_simple:before,
	body.woocommerce #container-main .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a:hover.product_type_simple:before,
	body.woocommerce-page #container-main .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a:hover.product_type_simple:before,
	body #container-main .woocommerce .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a:hover:before,
	body.woocommerce #container-main .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a:hover:before,
	body.woocommerce-page #container-main .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a:hover:before{
		background-color:<?php echo $wd_button_background_hover; ?>;
		color:<?php echo $wd_button_text_hover; ?>;
		border-color:<?php echo $wd_button_background_hover; ?>;
	}
	body #container-main .woocommerce .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a.product_type_simple:before,
	body.woocommerce #container-main .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a.product_type_simple:before,
	body.woocommerce-page #container-main .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a.product_type_simple:before,
	body #container-main .woocommerce .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a:before,
	body.woocommerce #container-main .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a:before,
	body.woocommerce-page #container-main .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a:before{
		background-color:<?php echo $wd_button_background; ?>;
		color:<?php echo $wd_button_icon_color; ?>;
		border-color:<?php echo $wd_button_background; ?>;
	}
	/* WISHLIST COMPARE DETAIL PRODUCT */
	.pp_woocommerce div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:hover,
	.woocommerce #content div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:hover,
	.woocommerce-page #content div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:hover,
	
	.pp_woocommerce div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a:hover,
	.woocommerce #content div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a:hover,
	.woocommerce-page #content div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a:hover,
	
	.pp_woocommerce div.product .summary.entry-summary .add_to_wishlist:hover ,
	.woocommerce #content div.product .summary.entry-summary .add_to_wishlist:hover ,
	.woocommerce-page #content div.product .summary.entry-summary .add_to_wishlist:hover,

	.pp_woocommerce div.product .summary.entry-summary .add_to_wishlist.button:hover ,
	.woocommerce #content div.product .summary.entry-summary .add_to_wishlist.button:hover ,
	.woocommerce-page #content div.product .summary.entry-summary .add_to_wishlist.button:hover,
	
	.pp_woocommerce div.product .summary.entry-summary .compare.button:hover,
	.woocommerce #content div.product .summary.entry-summary .compare.button:hover,
	.woocommerce-page #content div.product .summary.entry-summary .compare.button:hover,
	
	.pp_woocommerce div.product .summary.entry-summary .compare:hover,
	.woocommerce #content div.product .summary.entry-summary .compare:hover,
	.woocommerce-page #content div.product .summary.entry-summary .compare:hover
	{
		background-color:<?php echo $wd_button_background_hover; ?>;
		color:<?php echo $wd_button_text_hover; ?>;
		border-color:<?php echo $wd_button_background_hover; ?> !important;
	}
	/* PAGER */
	body.woocommerce-page nav.woocommerce-pagination ul li span a span span,
	/* END PAGER */
	body .vc_progress_bar .vc_single_bar:before,
	.archive-product-before-loop,
	.track_order p.note,
	.lost_reset_password p.note,
	body.woocommerce-page #content .shop_table.my_account_orders tbody tr td,
	.woocommerce-page #content .order_details .order_table_item td,
	.woocommerce-page #content .woocommerce > #order_review table td,
	.shopping-cart .cart_dropdown,
	.woocommerce-page #content table.cart a.remove,
	#entry-author-info #author-description .author-desc,
	body.woocommerce-page #payment ul.payment_methods,
	.woocommerce .wd_content_before_checkout .wd_content_before_checkout_wrapper:before,
	.wd_product_tags_categoried .wd_product_categories,
	
	body.woocommerce #content div.product div.images div.thumbnails .owl-carousel a img:hover,
	body.woocommerce-page #content div.product div.images div.thumbnails .owl-carousel a img:hover,
	#wp-calendar,
	
	.woocommerce #content div.product form.cart table div.quantity input.minus, 
	.woocommerce-page #content div.product form.cart table div.quantity input.minus, 
	body .pp_woocommerce div.product form.cart table div.quantity input.minus,
	.woocommerce #content div.product form.cart table div.quantity input.plus,
	.woocommerce-page #content div.product form.cart table div.quantity input.plus,
	body .pp_woocommerce div.product form.cart table div.quantity input.plus,
	#header .header-middle.v3 .middle-header-middle-content .header_search_categories:before,
	#header .v3 .header_search_categories .select2-container .select2-choice .select2-arrow,
	.container .vc_toggle_title h4, 
	.container#content .vc_toggle_title h4,
	.container .vc_toggle_active .vc_toggle_content,
	.select2-container-active .select2-choice, 
	.select2-container-active .select2-choices,
	body #header .v3 .header_search_categories select
	{
		border-color:<?php echo $wd_input_border_color; ?>;
	}
	table,
	table th, 
	table td,
	body .widget-container.widget_recent_comments_custom .widget_per_slide ul li .comment-body,
	#comments .commentlist li .divcomment .divcomment-inner .comment-body,
	.widget-container.wd_widget_bbpress_recent_posts .wd_bbpress_recent_posts ul li .post_content,
	.woocommerce #reviews #comments ol.commentlist li .comment_container,
	.woocommerce-page #reviews #comments ol.commentlist li .comment_container,
	#bbpress-forums .bbp-body div.bbp-topic-content,
	#bbpress-forums .bbp-body div.bbp-reply-content,
	body .wd-content .wd_widget_testimonial .widget_testimonial_list_inner.wp_slider,
	body .wd-content .wd_widget_testimonial .widget-title,
	.banner_description_shortcode .banner_description_content,
	.testimonial-item,.wd_myaccount_menu,
	.wd_price_table .price_table_inner,
	.wd_price_table,
	.price_table_inner ul li.content *,
	.box-heading,
	.wd_meet_team,
	.wd_meet_team > a.image:before,
	.wd_meet_team .description,
	.wd_testimonial_wrapper.style-2 .testimonial-item .detail,
	#bbpress-forums .bbp-forums-list{
		border-color:<?php echo $wd_box_border_color; ?>;
	}
	.widget-container.widget_recent_comments_custom .widget_per_slide ul li .comment-body:before,
	#comments .commentlist li .divcomment .divcomment-inner .comment-body:before,
	.woocommerce #reviews #comments ol.commentlist li .comment_container:before,
	.woocommerce-page #reviews #comments ol.commentlist li .comment_container:before,
	.widget-container.wd_widget_bbpress_recent_posts .wd_bbpress_recent_posts ul li .post_content:before{
		border-top-color:<?php echo $wd_box_border_color; ?>;
	}
	.wd_testimonial_wrapper.style-2 .testimonial-item:before,
	#bbpress-forums .bbp-body div.bbp-topic-content:before, 
	#bbpress-forums .bbp-body div.bbp-reply-content:before,
	#entry-author-info #author-description .author-desc:before{
		color:<?php echo $wd_box_border_color; ?>;
	}
	body .pp_woocommerce div.product div.images div.thumbnails .owl-carousel a img:hover{
		border-color:<?php echo $wd_theme_color_secondary; ?> !important;
	}
	.woocommerce .before_checkout_form form.checkout_coupon,
	.woocommerce-page .before_checkout_form form.checkout_coupon
	{
		border-color:<?php echo wd_calc_color($wd_input_border_color,'#0c0c0c'); ?>
	}
	
	.woocommerce .widget-container.widget_price_filter .ui-slider .ui-slider-range, 
	.woocommerce-page .widget-container.widget_price_filter .ui-slider .ui-slider-range,
	body .wpb_teaser_grid .categories_filter li:before,body .wpb_categories_filter li:before,
	#container .gridlist-toggle a#list,#container .gridlist-toggle a#grid,
	.woocommerce .social_sharing .social_icon > div a img,
	.woocommerce-page .social_sharing .social_icon > div a img,
	.woocommerce .social_sharing.second .social_icon > div.pinterest a:before,
	.woocommerce-page .social_sharing.second .social_icon > div.pinterest a:before,
	
	/* CHECK OUT */
	body.error404 .alert-info,
	.shopping-cart .cart_dropdown ul.cart_list li a.remove, 
	.woocommerce-page #content table.cart a.remove
	{
		background-color:<?php echo $wd_text_color; ?>;
	}
	
	.woocommerce .social_sharing .social_icon > div a:hover img, 
	.woocommerce-page .social_sharing .social_icon > div a:hover img,
	.woocommerce .social_sharing.second .social_icon > div.pinterest a:hover:before,
	.woocommerce-page .social_sharing.second .social_icon > div.pinterest a:hover:before{
		background-color:<?php echo $wd_input_border_color_hover; ?>;
	}

	body .accordion-heading,.related > .title,
	#comments #comments-title,#respond #reply-title, 
	body.woocommerce-page #content form.checkout table.shop_table td, 
	.wd_tini_account_wrapper .form_drop_down:before,
	.woocommerce-page #content .cart-collaterals .coupon_wrapper input#coupon_code,
	.woocommerce-page #content table.shop_table thead th, 
	.woocommerce-page #content table.shop_table tbody tr.cart_item td,
	.woocommerce-page #content table.shop_table tbody td.actions,
	.wd-heading-title,
	.cart_dropdown ul.cart_list,
	#bbpress-forums div.bbp-forum-header,
	#bbpress-forums div.bbp-topic-header,
	#bbpress-forums div.bbp-reply-header,
	#bbpress-forums ul.bbp-lead-topic,
	#bbpress-forums ul.bbp-topics,
	#bbpress-forums ul.bbp-forums,
	#bbpress-forums ul.bbp-replies,
	#bbpress-forums ul.bbp-search-results,
	#bbpress-forums fieldset.bbp-form,
	#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content,
	.single-topic #bbpress-forums .bbp-header .bbp-reply-content,
	#bbpress-forums .bbp-topic-content ul.bbp-topic-revision-log,
	#bbpress-forums .bbp-reply-content ul.bbp-topic-revision-log,
	#bbpress-forums .bbp-reply-content ul.bbp-reply-revision-log,
	.bbp-body .bbp-meta{
		border-color:<?php echo $wd_input_border_color; ?>;
	}
	
	body.woocommerce-page #content .shop_table.my_account_orders tbody tr.last td{
		border-bottom-color:<?php echo $wd_input_border_color; ?> !important;
	}
	
	.woocommerce #main_content ul.products.list .product .product_thumbnail_wrapper:hover, 
	.woocommerce-page #main_content ul.products.list .product .product_thumbnail_wrapper:hover,
	.related > .title:before{
		border-color:<?php echo $wd_input_border_color; ?>;
	}
	/* TITLE SLIDER */
	.woocommerce .featured_product_slider_wrapper .featured_product_slider_wrapper_meta h3:before,
	.woocommerce-page .featured_product_slider_wrapper .featured_product_slider_wrapper_meta h3:before,
	.woocommerce .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta h3:before,
	.woocommerce-page .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta h3:before,
	.woocommerce .featured_product_wrapper .wp_title_shortcode_products h3:before,
	.woocommerce-page .featured_product_wrapper .wp_title_shortcode_products h3:before,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wp_title_shortcode_products h3:before,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta h3:before,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta h3.heading-title:before,
	.wd_custom_category_shortcode .wp_title_shortcode_products h3:before,
	.woocommerce-page #content .cart-collaterals .cross-sells .wd_title_cross_sells .heading-title:before,
	/* END TITLE */
	body .vc_progress_bar.has_border .vc_single_bar .vc_bar,
	#container .gridlist-toggle a.active#grid:before,
	#container .gridlist-toggle a.active#list:before,
	#container .gridlist-toggle a#grid:hover:before,
	#container .gridlist-toggle a#list:hover:before,
	.featured_categories_slider_wrapper li a:hover img,
	div.wd-box-feature,
	#entry-author-info #author-description #author-avatar:hover img,
	#comments .commentlist li .divcomment .divcomment-inner .avatar:hover img,
	.featured_categories_slider_wrapper img:hover,
	.wd_title_myaccount,
	body form.checkout .accordion-heading a.accordion-toggle.collapsed:hover,
	body #accordion-checkout-details .accordion-heading a.accordion-toggle.collapsed:hover,
	body.wpb-js-composer h1:before,
	#bbpress-forums li.bbp-header,
	.feature.shortcode .feature_content_wrapper.style-2.has_icon:hover a.wd-feature-icon:after,
	.feature.shortcode .feature_content_wrapper.style-3.has_icon:hover a.wd-feature-icon:after,
	.wd_tini_cart_wrapper .cart_item{
		border-color:<?php echo $wd_theme_color_primary; ?>;
	}
	
	/*========================================= SIDEBAR =========================================================*/
	/* BORDER FOR UL LI PRODUCT WIDGET */
	.widget_popular ul li:after ,
	.widget_hot_product ul li:after,
	.widget-container.woocommerce ul.product_list_widget li:after,
	.woocommerce-page .widget-container ul.cart_list li:after,
	.woocommerce-page .widget-container ul.product_list_widget li:after,
	.woocommerce ul.cart_list li:after, 
	.woocommerce-page ul.cart_list li:after,
	.widget-container .wd_widget_product_slider_wrapper .product_per_slide ul > li:after,
	.widget_recent_comments ul li:after,.widget_display_views > ul li:after,
	.widget_display_forums > ul li:after,.widget_display_replies > ul li:after,
	.widget-container.widget_display_topics > ul li:after,
	.wd_widget_product_categories .wd_product_categories > ul.hover_mode > li ul.sub_cat:before,
	.wd_widget_product_categories .wd_product_categories:before,
	.widget-container.widget_categories > ul:before,
	body .wd_widget_bbpress_forums .wd_bbpress_forums > ul:before{
		background-color:<?php echo $wd_sidebar_border; ?>;
	}
	#footer .widget_popular ul li:after ,
	#footer .widget_hot_product ul li:after,
	#footer .widget-container.woocommerce ul.product_list_widget li:after,
	.woocommerce-page #footer .widget-container ul.cart_list li:after,
	.woocommerce-page #footer .widget-container ul.product_list_widget li:after,
	#footer .woocommerce ul.cart_list li:after, 
	.woocommerce-page #footer ul.cart_list li:after,
	#footer .widget-container .wd_widget_product_slider_wrapper .product_per_slide ul > li:after,
	.wd_widget_product_categories .wd_product_categories > ul,
	.wd_widget_product_categories .wd_product_categories > ul,
	.left-sidebar-content li.widget-container > div,
	.right-sidebar-content li.widget-container > div,
	#footer .footer-front li.widget-container > div,
	.widget-container.widget_archive > ul,
	.widget-container.widget_categories > ul,
	.widget-container.widget_display_stats > dl,
	.widget-container.widget_display_replies > ul,
	.widget-container.widget_display_views > ul,
	.widget-container.widget_display_search > form,
	.widget-container.widget_display_forums > ul,
	.widget-container.widget_meta > ul,
	.widget-container.widget_pages > ul,
	.widget-container.widget_recent_comments > ul,
	.widget-container.widget_recent_entries > ul,
	.widget-container.widget_search > form,
	.widget-container.widget_layered_nav > ul,
	.widget-container.widget_product_categories > ul,
	.widget-container.widget_sale_product > ul,
	.widget-container.widget_products > ul,
	.widget-container.widget_product_search > form,
	.widget-container.widget_recently_viewed_products > ul,
	.widget-container.widget_recent_reviews > ul,
	.widget-container.yith-woocompare-widget > ul,
	.widget-container.widget_layered_nav_filters > ul,
	.widget-container.widget_top_rated_products > ul,
	.widget-container.widget_display_topics > ul{
		border-color:<?php echo $wd_sidebar_border; ?>;
	}
	#footer .widget_popular ul li:hover:after ,
	#footer .widget_hot_product ul li:hover:after,
	#footer .widget-container.woocommerce ul.product_list_widget li:hover:after,
	.woocommerce-page #footer .widget-container ul.cart_list li:hover:after,
	.woocommerce-page #footer .widget-container ul.product_list_widget li:hover:after,
	#footer .woocommerce ul.cart_list li:hover:after, 
	.woocommerce-page #footer ul.cart_list li:hover:after,
	#footer .widget-container .wd_widget_product_slider_wrapper .product_per_slide ul > li:hover:after{
		border-color:<?php echo $wd_box_border_color; ?>;
	}
	.widget-container > .widget_title_wrapper,
	#footer .footer-front .widget-container .widget_title_wrapper,
	.wd_widget_product_categories,body .wd_widget_bbpress_forums,
	.wd_widget_product_categories .wd_product_categories > ul li,
	.wd_widget_bbpress_forums .wd_bbpress_forums > ul li,
	.wd_widget_product_categories .wd_product_categories > ul > li ul.sub_cat,
	.woocommerce .nav .wp_title_shortcode_products,
	.nav .wp_title_shortcode_products,
	.woocommerce-page #content .cart-collaterals .shipping_calculator .wd_title_cart,
	.woocommerce-page #content .cart-collaterals .cart_totals .wd_title_cart,
	.woocommerce-page #content .cart-collaterals .coupon_wrapper .wd_title_cart,
	.woocommerce .widget_shopping_cart .total,
	.woocommerce-page .widget_shopping_cart .total,
	.woocommerce.widget_shopping_cart .total,
	.widget-container.widget_wd_recent_post_widget .detail,
	.widget-container.wd_widget_popular_product_by_categories .cat_title
	{
		border-color:<?php echo $wd_sidebar_border; ?>;
	}
	.wd_widget_product_categories .wd_product_categories ul.hover_mode ul:before,
	.wd_widget_product_categories .wd_product_categories > .dropdown_mode > li > a:before,
	.wd_widget_bbpress_forums .wd_bbpress_forums > ul > li > span.cat_name:before{
		background-color:<?php echo $wd_sidebar_border; ?>;
	}
	body .wd-content .wd_widget_testimonial .testimonial-item .wd_info span.twitter:before,
	.widget_recent_comments_custom .wd_info_comment span.twitter:before,
	.wd_widget_bbpress_recent_posts .post_user_info > span.twitter:before,
	.alphabet-products ul li a,
	.wd_testimonial_wrapper .testimonial-item .detail span.twitter:before{
		color:<?php echo $wd_text_weak_color; ?>;
	}
	.left-sidebar-content h3.widget-title,
	.right-sidebar-content h3.widget-title,
	#footer .footer-front h3.widget-title,
	.woocommerce .nav .wp_title_shortcode_products .heading-title,
	.nav .wp_title_shortcode_products .heading-title,
	.widget-container.wd_widget_popular_product_by_categories .cat_name,
	#right-sidebar a.block-control,#left-sidebar a.block-control,
	.woocommerce-page #content .cart-collaterals .shipping_calculator .wd_title_cart .heading-title,
	.woocommerce-page #content .cart-collaterals .cart_totals .wd_title_cart .heading-title,
	.woocommerce-page #content .cart-collaterals .coupon_wrapper .wd_title_cart .heading-title,
	.widget-container.wd_widget_tab_product .wd_tab_product_title a.current,
	.widget-container.wd_widget_tab_product .wd_tab_product_title a:hover{
		color:<?php echo $wd_heading_sidebar_color; ?>;
	}
	.left-sidebar-content .widget_title_wrapper:before,
	.right-sidebar-content .widget_title_wrapper:before,
	#footer .footer-front .widget_title_wrapper:before,
	.nav .wp_title_shortcode_products .heading-title:before,
	.woocommerce .nav .wp_title_shortcode_products .heading-title:before,
	.nav .wp_title_shortcode_products .heading-title:after,
	.woocommerce .nav .wp_title_shortcode_products .heading-title:after,
	.woocommerce-page #content .cart-collaterals .shipping_calculator .wd_title_cart .heading-title:before,
	.woocommerce-page #content .cart-collaterals .cart_totals .wd_title_cart .heading-title:before,
	.woocommerce-page #content .cart-collaterals .coupon_wrapper .wd_title_cart .heading-title:before,
	.woocommerce-page #content .cart-collaterals .shipping_calculator .wd_title_cart .heading-title:after,
	.woocommerce-page #content .cart-collaterals .cart_totals .wd_title_cart .heading-title:after,
	.woocommerce-page #content .cart-collaterals .coupon_wrapper .wd_title_cart .heading-title:after,
	.woocommerce-page #content .cart-collaterals .cross-sells .wd_title_cross_sells .heading-title:after{
		background-color:<?php echo $wd_heading_sidebar_line_top; ?>;
	}
	body .wd-content .wd_widget_testimonial .testimonial-content:before,
	.quote-style:before,.wd_testimonial_wrapper .testimonial-item .detail:before{
		color:<?php echo $wd_text_weak_color; ?>;
	}
	.wd_widget_product_categories .wd_product_categories .dropdown_mode .icon_toggle.open,
	.wd_widget_product_categories .wd_product_categories > ul.dropdown_mode li:hover >.icon_toggle,
	.wd_widget_product_categories .wd_product_categories > .dropdown_mode ul.sub_cat li:hover > .icon_toggle:before,
	.wd_widget_product_categories .wd_product_categories .dropdown_mode ul.sub_cat li.has_sub > .icon_toggle:hover:before,
	.wd_widget_product_categories .wd_product_categories .dropdown_mode li.has_sub > span.icon_toggle.active:before,
	.wd_widget_product_categories .wd_product_categories .dropdown_mode li.has_sub > span.icon_toggle.active~a,
	.wd_widget_bbpress_forums .wd_bbpress_forums .dropdown_mode li.has_sub > span.icon_toggle.active~span,
	.wd_widget_bbpress_forums .wd_bbpress_forums .dropdown_mode li.has_sub > span.icon_toggle.active,
	.wd_widget_bbpress_forums .wd_bbpress_forums > .dropdown_mode .icon_toggle:hover,
	.wd_widget_bbpress_forums ul.forum_list li a:hover,
	.wd_widget_product_categories .wd_product_categories > ul.hover_mode li.has_sub:hover:after{
		color:<?php echo $wd_heading_sidebar_line_top; ?>;
	}
	/* COLOR BUTTON ADD TO CART */
	.woocommerce-page .widget-container .button,
	.woocommerce .widget-container .button,
	.woocommerce-page .widget-container input[type^=submit],
	.woocommerce .widget-container input[type^=submit],
	.woocommerce-page .widget-container.widget_shopping_cart .button.checkout:hover,
	.woocommerce .widget-container.widget_shopping_cart .button.checkout:hover,
	.woocommerce.widget-container.widget_shopping_cart .button.checkout:hover,
	
	.woocommerce ul.products li.product .product-meta-wrapper .list_add_to_cart a,
	.woocommerce ul.products li.product .product-meta-wrapper .list_add_to_cart a,
	.woocommerce-page ul.products li.product .product-meta-wrapper .list_add_to_cart a,
	.wd_tini_account_wrapper #wp-submit,
	.woocommerce ul.products li.product .product-meta-wrapper .added_to_cart.wc-forward:hover,
	.woocommerce #content table.shop_table.wishlist_table tr td.product-add-to-cart a.button,
	.woocommerce-page #content table.shop_table.wishlist_table tr td.product-add-to-cart a.button,
	#content .woocommerce table.shop_table.wishlist_table tr td.product-add-to-cart a.button,
	.woocommerce table.compare-list .add-to-cart td a,
	/* CART DROPDOWN */
	.cart_dropdown.drop_down_container a.button.checkout,
	/* BLOG PAGE */
	.list-posts .post-content-info .read-more,
	/* PRODUCT DETAIL BUTTON */
	.woocommerce-page #content div.product .button.alt, 
	.woocommerce #content div.product .button,
	.woocommerce #content div.product .button.alt, 
	.woocommerce-page #content div.product .button,
	/* END PRODUCT DETAIL */
	.woocommerce-page #content table.shop_table tbody td.actions a.button, 
	.woocommerce-page #content table.shop_table tbody td.actions input.button:hover
	{
		background-color:<?php echo $wd_button_background; ?>;
		color:<?php echo $wd_button_text; ?>;
		border-color:<?php echo $wd_button_border; ?>;
	}
	.alphabet-products ul li a{
		border-color:<?php echo $wd_button_border; ?>;
	}
	/* PRODUCT */
	ul.archive-product-subcategories > .product img,
	.woocommerce .products li.product.product-category a img, 
	.woocommerce-page .products li.product.product-category a img,
	body .woocommerce ul.products li.product:hover .product_item_wrapper, 
	.woocommerce-page ul.products li.product:hover .product_item_wrapper,
	body.woocommerce ul.products li.product:hover .product_item_wrapper, 
	.woocommerce-page ul.products li.product:hover .product_item_wrapper,
	body.woocommerce #main_content ul.products.list .product:hover .product_item_wrapper, 
	.woocommerce-page #main_content ul.products.list .product:hover .product_item_wrapper
	{
		border-color:<?php echo $wd_input_border_color; ?>;
	}
	.wd_custom_category_shortcode .wd-custom-category-right-wrapper .product .product_thumbnail_wrapper,
	.woocommerce .wd_custom_category_shortcode ul.products li.left-wrapper .product_thumbnails{
		border-color:<?php echo wd_calc_color($wd_input_border_color,'#191919') ?>;
	}
	.wd_custom_category_shortcode .wd-custom-category-right-wrapper .product .product_thumbnail_wrapper:hover{
		border-color:<?php echo $wd_input_border_color ?>;
	}
	.woocommerce-page .widget-container .button:hover,
	.woocommerce .widget-container .button:hover,
	.woocommerce-page .widget-container input[type^=submit]:hover,
	.woocommerce .widget-container input[type^=submit]:hover,
	
	.woocommerce-page .widget-container.widget_shopping_cart .button.checkout,
	.woocommerce .widget-container.widget_shopping_cart .button.checkout,
	.woocommerce.widget-container.widget_shopping_cart .button.checkout,
	
	.woocommerce ul.products li.product .product-meta-wrapper .list_add_to_cart a:hover,
	.woocommerce-page ul.products li.product .product-meta-wrapper .list_add_to_cart a:hover,
	.xoxo .woocommerce ul.products li.product .product-meta-wrapper .list_add_to_cart a,
	.woocommerce-page .xoxo ul.products li.product .product-meta-wrapper .list_add_to_cart a:hover,
	.wd_tini_account_wrapper #wp-submit:hover,
	.woocommerce ul.products li.product .product-meta-wrapper .added_to_cart.wc-forward,
	.woocommerce #content table.shop_table.wishlist_table tr td.product-add-to-cart a.button:hover,
	.woocommerce-page #content table.shop_table.wishlist_table tr td.product-add-to-cart a.button:hover,
	#content .woocommerce table.shop_table.wishlist_table tr td.product-add-to-cart a.button:hover,
	.woocommerce table.compare-list .add-to-cart td a:hover,
	/* BUTTON CART style-2 LAYOUT */
	body #container-main .woocommerce .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a:hover,
	body.woocommerce #container-main .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a:hover, 
	body.woocommerce-page #container-main .style-2 ul.products li.product .product-meta-wrapper .list_add_to_cart a:hover,
	/* CART DROPDOWN */
	.cart_dropdown.drop_down_container a.button.checkout:hover,
	/* BLOG PAGE */
	.list-posts .post-content-info .read-more:hover,
	/* PRODUCT DETAIL BUTTON */
	.woocommerce-page #content div.product .button.alt:hover, 
	.woocommerce #content div.product .button:hover,
	.woocommerce #content div.product .button.alt:hover, 
	.woocommerce-page #content div.product .button:hover,
	/* END PRODUCT DETAIL */
	.woocommerce-page #content table.shop_table tbody td.actions a.button:hover,
	.woocommerce-page #content table.shop_table tbody td.actions input.button,
	.alphabet-products ul li a:hover
	{
		color:<?php echo $wd_button_text_hover; ?>;
		background-color:<?php echo $wd_button_background_hover; ?>;
		border-color:<?php echo $wd_button_background_hover; ?>;
	}
	
	.woocommerce .widget_price_filter .price_slider_amount .button,
	.woocommerce-page .widget_price_filter .price_slider_amount .button{
		color:<?php echo $wd_button_text; ?> !important;
		background-color:<?php echo $wd_button_background; ?>!important;
		border-color:<?php echo $wd_button_border; ?>!important;
	}
	
	.woocommerce .widget_price_filter .price_slider_amount .button:hover,
	.woocommerce-page .widget_price_filter .price_slider_amount .button:hover{
		color:<?php echo $wd_button_text_hover; ?> !important;
		background-color:<?php echo $wd_button_background_hover; ?>!important;
		border-color:<?php echo $wd_button_background_hover; ?>!important;
	}
	
	#content ul.products li.product .product-meta-wrapper .loop-short-description:before,
	.woocommerce #content ul.products li.product .product-meta-wrapper .loop-short-description:before,
	.woocommerce-page #content ul.products li.product .product-meta-wrapper .loop-short-description:before,
	.woocommerce #main_content .products.grid div[itemprop="description"]:before,
	body #main_content .products.grid div[itemprop="description"]:before,
	body.woocommerce-page #main_content .products.grid div[itemprop="description"]:before,
	.woocommerce #main_content .products.list div[itemprop="description"]:before,
	body #main_content .products.list div[itemprop="description"]:before,
	body.woocommerce-page #main_content .products.list div[itemprop="description"]:before,
	.woocommerce #main_content .products div[itemprop="description"]:before,
	body #main_content .products div[itemprop="description"]:before,
	body.woocommerce-page #main_content .products div[itemprop="description"]:before
	{
		background-color:<?php echo $wd_button_border; ?>;
	}
	
	/* WISHLIST AND COMPARE */
	#content ul.products li.product .product-meta-wrapper .add_to_wishlist ,
	.woocommerce #content ul.products li.product .product-meta-wrapper .add_to_wishlist ,
	.woocommerce-page #content ul.products li.product .product-meta-wrapper .add_to_wishlist,

	#content ul.products li.product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce #content ul.products li.product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce-page #content ul.products li.product .product-meta-wrapper .add_to_wishlist.button,
	
	.body-wrapper ul.products li.product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce .body-wrapper ul.products li.product .product-meta-wrapper .add_to_wishlist ,
	.woocommerce-page .body-wrapper ul.products li.product .product-meta-wrapper .add_to_wishlist,

	.body-wrapper ul.products li.product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce .body-wrapper ul.products li.product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce-page .body-wrapper ul.products li.product .product-meta-wrapper .add_to_wishlist.button,
	
	.body-wrapper ul.products li.product .product-meta-wrapper .compare.button,
	.woocommerce .body-wrapper ul.products li.product .product-meta-wrapper .compare.button,
	.woocommerce-page .body-wrapper ul.products li.product .product-meta-wrapper .compare.button,
	
	.body-wrapper ul.products li.product .product-meta-wrapper .compare,
	.woocommerce .body-wrapper ul.products li.product .product-meta-wrapper .compare,
	.woocommerce-page .body-wrapper ul.products li.product .product-meta-wrapper .compare,
	
	.body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce .body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce-page .body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a,
	
	.body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce .body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce-page .body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a
	{
		color:<?php echo $wd_text_weak_color; ?> !important;
	}
	.body-wrapper ul.products li.product .product-meta-wrapper .wd_compare_wrapper:after,
	.woocommerce .body-wrapper ul.products li.product .product-meta-wrapper .wd_compare_wrapper:after,
	.woocommerce-page .body-wrapper ul.products li.product .product-meta-wrapper .wd_compare_wrapper:after{
		background-color:<?php echo $wd_text_weak_color; ?>;
	}
	#content ul.products li.product .product-meta-wrapper .add_to_wishlist:hover ,
	.woocommerce #contentul.products li.product .product-meta-wrapper .add_to_wishlist:hover ,
	.woocommerce-page #content ul.products li.product .product-meta-wrapper .add_to_wishlist:hover,

	#content ul.products li.product .product-meta-wrapper .add_to_wishlist.button:hover ,
	.woocommerce #content ul.products li.product .product-meta-wrapper .add_to_wishlist.button:hover ,
	.woocommerce-page #content ul.products li.product .product-meta-wrapper .add_to_wishlist.button:hover,
	
	.body-wrapper ul.products li.product .product-meta-wrapper .add_to_wishlist.button:hover ,
	.woocommerce .body-wrapper ul.products li.product .product-meta-wrapper .add_to_wishlist:hover ,
	.woocommerce-page .body-wrapper ul.products li.product .product-meta-wrapper .add_to_wishlist:hover,

	.body-wrapper ul.products li.product .product-meta-wrapper .add_to_wishlist.button:hover ,
	.woocommerce .body-wrapper ul.products li.product .product-meta-wrapper .add_to_wishlist.button:hover ,
	.woocommerce-page .body-wrapper ul.products li.product .product-meta-wrapper .add_to_wishlist.button:hover,
	
	.body-wrapper ul.products li.product .product-meta-wrapper .compare.button:hover
	.woocommerce .body-wrapper ul.products li.product .product-meta-wrapper .compare.button:hover,
	.woocommerce-page .body-wrapper ul.products li.product .product-meta-wrapper .compare.button:hover,
	
	.body-wrapper ul.products li.product .product-meta-wrapper .compare:hover,
	.woocommerce .body-wrapper ul.products li.product .product-meta-wrapper .compare:hover,
	.woocommerce-page .body-wrapper ul.products li.product .product-meta-wrapper .compare:hover,
	
	.body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a:hover,
	.woocommerce .body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a:hover,
	.woocommerce-page .body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a:hover,
	
	.body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a:hover,
	.woocommerce .body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a:hover,
	.woocommerce-page .body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a:hover
	{
		color:<?php echo $wd_button_background_hover; ?> !important;
	}
	
	.body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-add-to-wishlist:after,
	.woocommerce .body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-add-to-wishlist:after,
	.woocommerce-page .body-wrapper ul.products li.product .product-meta-wrapper .yith-wcwl-add-to-wishlist:after{
		background-color:<?php echo $wd_button_border; ?>;
	}
	<?php if($quickshop_ready == true): ?>
	/* QUICK SHOP COLOR */
	.em_quickshop_handler .qs_inner2.qs_text_btn,
	.em_quickshop_handler .qs_inner2.qs_img_btn{
		color:<?php echo $wd_quickshop_text_color; ?> !important;
		background:transparent !important;
	}
	.em_quickshop_handler .qs_inner2.qs_img_btn:hover,
	.em_quickshop_handler .qs_inner2.qs_img_btn:hover img,
	.em_quickshop_handler .qs_inner2.qs_text_btn:hover{
		color:<?php echo $wd_quickshop_text_color_hover; ?> !important;
		background:<?php echo $wd_quickshop_background_hover; ?> !important;
	}
	<?php endif ?>
	h1,h2,h3,h4,h5,h6,
	/* HOVER WIGET UL LI SIDEBAR */
	.widget_archive ul li > a:hover,
	.widget_meta ul li > a:hover,
	.widget_categories > ul > li > a:hover,
	.widget_nav_menu > ul > li > a:hover,
	.widget_product_categories > ul > li > a:hover,
	.widget_product_categories > ul > li.current-cat > a,
	.widget_nav_menu > ul > li.current_page_item > a,
	.widget_categories > ul >.current-cat > a,
	.widget-container #wp-calendar thead,
	#wp-calendar tbody tr td.today,
	.heading-title-block h3,
	.heading-title-block h4,
	.heading-title-block h5,
	.heading-title-block h6,
	
	/* PAGER */
	.page_navi .wp-pagenavi span:hover,
	.page_navi .wp-pagenavi a:hover,
	.page_navi > .nav-content > .pager:hover span span,
	.page_navi > .nav-content .next-phrase:hover,
	.page_navi > .nav-content .previous-phrase:hover,
	.page_navi > .nav-content a.first:hover span span,
	.page_navi > .nav-content a.previous:hover span span,
	.page_navi > .nav-content a.next:hover span span,
	.page_navi > .nav-content a.last:hover span span,
	.page_navi .wp-pagenavi span.current,
	.page_navi > .nav-content > .pager.current span span,
	body.woocommerce nav.woocommerce-pagination ul li span.current,
	body.woocommerce-page nav.woocommerce-pagination ul li span.current,
	body.woocommerce #content nav.woocommerce-pagination ul li span.current,
	body.woocommerce-page #content nav.woocommerce-pagination ul li span.current,
	body.woocommerce nav.woocommerce-pagination ul li a:hover,
	body.woocommerce-page nav.woocommerce-pagination ul li a:hover,
	body.woocommerce #content nav.woocommerce-pagination ul li a:hover,
	body.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
	body.woocommerce nav.woocommerce-pagination ul li a:focus,
	body.woocommerce-page nav.woocommerce-pagination ul li a:focus,
	body.woocommerce #content nav.woocommerce-pagination ul li a:focus,
	body.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
	/* TITLE NAME PRODUCT DETAIL */
	body .pp_woocommerce div.product .product_title,
	body.woocommerce #content div.product .product_title,
	body.woocommerce-page #content div.product .product_title,
	/* END TITLE NAME */
	.wd-title-shortcode,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories ul .link_cat:hover,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories ul .link_cat:hover,
	.cart_dropdown .dropdown_body .head_msg,
	.cart_dropdown .total span.title,
	.wd_tini_account_wrapper .form_wrapper_body label,
	.wd_tini_account_wrapper .form_wrapper_body > a:hover,
	#footer h3.widget-title,.ft-col h3,.wd-text-bold-color,
	body .wpb_categories_filter li a,
	.wpb_teaser_grid h2.post-title a,
	.testimonial-item a.title,
	.shortcode-recent-blogs .tag_blog,
	.wd-social-share > span,
	.widget_recent_post_slider .entry-title > a.read-more,
	#header .nav > .main-menu > ul.menu > li a.title:hover,
	.woocommerce-page #content table.my_account_orders td.order-status,
	#comments .commentlist li .divcomment .divcomment-inner .comment-author cite a,
	#comments .commentlist li .divcomment .divcomment-inner .comment-meta a:hover,
	#collapse-login-regis h4.heading-title,
	#footer .widget_recent_post_slider .entry-title > a.read-more,
	.widget_recent_post_slider .entry-title > a.read-more,
	.wishlist_table tr td.product-stock-status span.wishlist-in-stock,
	table.compare-list .stock td span,
	.woocommerce.woocommerce-result-count,
	.woocommerce-page .woocommerce-result-count,
	.woocommerce-page .widget_layered_nav ul li a:hover,
	.wd_quickshop .details_view a,
	.short-description-title,
	.widget-container.widget_wd_recent_post_widget .entry-title a,
	.widget-container.widget_wd_recent_post_widget .read-more,
	.single-content .single-post .post-title .heading-title,
	.tags_social .tags .tag-title,
	#entry-author-info #author-description .author-name [rel^=author],
	.related .related-item .title,#respond #commentform .label,#customer_login h2,
	body.woocommerce-page form.login .lost_password a:hover,
	body.woocommerce-page form.checkout_coupon .lost_password:hover,
	body.woocommerce-page form.register .lost_password:hover,
	.wd_mobile_account a,.mobile_cart_container .cart_text,
	body.woocommerce-page form.checkout table.shop_table tfoot th,
	.woocommerce-page #payment ul.payment_methods li.active label,
	.tagcloud .tag_heading,
	.wd_product_tags_categoried .wd_product_categories span,
	.wd_product_tags_categoried .wd_product_categories a:hover,
	#respond #commentform .logged-in-as a:first-child,
	#yith-wcwl-form h2,
	.wishlist_table td.product-name a,
	.wishlist_table td.product-price .amount,
	.myaccount_action a, .wd_mobile_account a:hover,body .wd_logout,
	body.woocommerce-page #content .shop_table.my_account_orders tbody tr.order td.order-number a,
	.order-detail-title, .custom-detail-title,
	
	.wd_custom_category_shortcode .wp_title_shortcode_products .wd_list_categories ul li a.current,
	.wd_custom_category_shortcode .wp_title_shortcode_products .wd_list_categories ul li a:hover,
	body div.pp_woocommerce .pp_nav,body div.pp_woocommerce .pp_description,
	#tab-additional_information h2,
	.woocommerce .widget_shopping_cart .total strong,
	.woocommerce-page .widget_shopping_cart .total strong,
	.woocommerce-page.widget_shopping_cart .total strong,
	.woocommerce.widget_shopping_cart .total strong,
	
	.widget_woothemes_features .feature-title a,
	.widget_flickr a.see-more,
	
	.woocommerce #content div.product .single_variation_wrap .stock,
	.woocommerce div.product .single_variation_wrap .stock,
	.woocommerce-page #content div.product .stock,
	.woocommerce-page div.product .single_variation_wrap .stock,
	a.vc_read_more,
	.wpb_flickr_widget p.flickr_stream_wrap a,
	.archive-content a,.sitemap-content a,
	#bbpress-forums .bbp-forum-info a.bbp-forum-title,
	#bbpress-forums .bbp-topics .bbp-body .bbp-topic-title a,
	#bbpress-forums #main_content li.bbp-forum-info ul.bbp-forums-list li.bbp-forum a,
	#bbpress-forums li.bbp-body .bbp-forum-freshness .bbp-topic-freshness-author a,
	#bbpress-forums li.bbp-body .bbp-topic-freshness .bbp-topic-freshness-author a.bbp-author-name,
	#bbpress-forums li.bbp-body .bbp-forum-freshness,
	#bbpress-forums #bbp-user-wrapper h2.entry-title,
	#bbpress-forums div.bbp-forum-author a.bbp-author-name,
	#bbpress-forums div.bbp-topic-author a.bbp-author-name, 
	#bbpress-forums div.bbp-reply-author a.bbp-author-name,
	#bbpress-forums #subscription-toggle a,
	#bbpress-forums #favorite-toggle a,
	#bbpress-forums .bbp-topic-content ul.bbp-topic-revision-log li a,
	#bbpress-forums .bbp-reply-content ul.bbp-topic-revision-log li a,
	#bbpress-forums .bbp-reply-content ul.bbp-reply-revision-log li a,
	#bbpress-forums div.bbp-reply-content .bbp-reply-id a.bbp-reply-permalink,
	span.bbp-admin-links a:hover,#bbpress-forums div.bbp-topic-tags p,
	#bbpress-forums div.bbp-reply-content a.bbp-topic-permalink,
	#bbp-user-profile #bbp-user-avatar p span.title,
	.widget_recent_comments_custom .wd_info_comment > span a,
	.wd_widget_bbpress_recent_posts .post_user_info > span.author a,
	#portfolio-galleries .portfolio-filter li a:hover,
	body h1.site-title,
	.wd_widget_product_categories .wd_product_categories > .dropdown_mode li a.current,
	.wd_widget_bbpress_forums .wd_bbpress_forums > ul li ul.forum_list li a.current,
	.bbp_widget_login .bbp-login-form label,
	#bbpress-forums ul.bbp-search-results .bbp-topic-title a,
	#bbpress-forums ul.bbp-search-results .bbp-forum-title a,
	#bbpress-forums ul.bbp-search-results .bbp-reply-title a,
	.banner_description_shortcode .banner_description_wrapper h3 a,
	.feature.shortcode .feature_content_wrapper.style-2 a.wd-feature-icon .feature_icon:before,
	.feature.shortcode .feature_content_wrapper.style-2 .feature_title a,
	#to-top a,
	#to-top a:after,
	body.wpb-js-composer .wd-big-title,
	body .vc_pie_chart .vc_pie_chart_value,
	.feature.shortcode .feature_title a,
	.wd_widget_product_categories .wd_product_categories > .dropdown_mode li a,
	.wd_widget_bbpress_forums .wd_bbpress_forums > ul li a,
	.wd_widget_product_categories .wd_product_categories > ul li a,
	.wd_widget_product_categories .wd_product_categories > ul.hover_mode > li.has_sub:after,
	.widget-container.widget_categories > ul li a,
	.widget-container.widget_categories > ul li,
	.wd_widget_product_categories .wd_product_categories > .dropdown_mode ul.sub_cat .icon_toggle:before,
	.wd_widget_bbpress_forums .wd_bbpress_forums > .dropdown_mode > li > span.cat_name,
	body .wd_widget_bbpress_forums .widget_title_wrapper h3,
	.widget_display_replies > ul li a.bbp-author-name,
	.widget-container.widget_display_topics > ul li .topic-author a,
	.portfolio_slider_shortcode .heading-title a,
	.wd_meet_team .name-role a,
	body.archive ul.products li.product.product-category h3,
	.wd_individual_product_wrapper h3 > a,
	.secondary-color,
	body.wpb-js-composer .secondary-color,
	.full_contact .wpcf7-form > p,
	.container .vc_toggle_title:hover h4:before,
	.container#content .vc_toggle_title:hover h4:before,
	.container .vc_toggle_title:hover h4,
	.container#content .vc_toggle_title:hover h4,
	.container .vc_toggle_active .vc_toggle_title h4:before,
	.container#content .vc_toggle_active .vc_toggle_title h4:before,
	.container .vc_toggle_active .vc_toggle_title h4,
	.container#content .vc_toggle_active .vc_toggle_title h4,
	.wpb_tour_next_prev_nav a,
	#nav-below > span a,
	#bbpress-forums fieldset.bbp-form legend,
	li.product-category .min-price,
	li.product-category .category-description,
	.body-wrapper .woocommerce .product_categories_2_wrapper ul.products li.product.product-category h3, 
	.woocommerce-page .product_categories_2_wrapper ul.products li.product.product-category h3
	{
		color:<?php echo $wd_theme_color_secondary; ?>;
	}
	#footer .widget_subscriptions button.button{
		background-color:<?php echo wd_calc_color($wd_theme_color_secondary,'#333333',false); ?>;
	}
	.feature.shortcode .feature_content_wrapper.style-2:before,
	.feature.shortcode .feature_content_wrapper.style-2.has_icon a.wd-feature-icon:after,
	.four_box_feature:before,
	.four_box_feature:after,
	.four_box_feature .four_box_wrapper:after,
	.four_box_feature .four_box_wrapper:before,
	.four_box_feature .feature.shortcode .feature_content_wrapper.style-2:before,
	#to-top a:before,
	a.wd-effect-border:hover img,
	.feature.shortcode .feature_content_wrapper.style-3.has_icon a.wd-feature-icon:after,
	.container .vc_toggle_title:hover h4,
	.container#content .vc_toggle_title:hover h4,
	.container .vc_toggle_active .vc_toggle_title h4,
	.container#content .vc_toggle_active .vc_toggle_title h4,
	.container .vc_toggle_active .vc_toggle_content{
		border-color:<?php echo $wd_theme_color_secondary; ?>;
	}
	/* LABEL USERNAME EMAIL,.. */
	.woocommerce-page #customer_login.col2-set .col-1 label,
	.woocommerce-page form .form-row label,
	.woocommerce-page #content .cart-collaterals .shipping_calculator p label,
	.woocommerce-page #content .cart-collaterals .cart_totals > table th
	{
		color:<?php echo $wd_theme_color_secondary; ?>;
	}
	.shopping-cart .cart_dropdown ul.cart_list li a.remove:hover,
	.woocommerce .widget-container.widget_price_filter .price_slider_wrapper .ui-widget-content,
	.woocommerce-page .widget-container.widget_price_filter .price_slider_wrapper .ui-widget-content,
	body div.pp_woocommerce .pp_close,
	body div.pp_woocommerce a.pp_expand:hover,
	body div.pp_woocommerce a.pp_contract:hover,
	#feedback a.feedback-button,
	.widget_recent_post_slider .entry-title > a.read-more:after,
	.yith-woocompare-widget ul.products-list a.remove:hover,
	#cboxClose:hover,
	table.compare-list tr.remove td > a .remove:hover,
	#wp-calendar caption,
	.body-wrapper .woocommerce ul.products li.product.product-category a img,
	ul.archive-product-subcategories > .product.product-category img,
	.woocommerce-page .body-wrapper ul.products li.product.product-category a img,
	.widget-container.wd_widget_popular_product_by_categories .cat_title img{
		background-color:<?php echo $wd_theme_color_secondary; ?>;
	}
	.widget_flickr a.see-more,
	.wd_widget_instagram a.see-more,
	.page-template-blog-personal-template .list-posts .read-more:hover,
	ul.xoxo form[id^="searchform-"] .bg_search input[id^="searchsubmit-"]:hover,
	ul.xoxo .widget_product_search input[type="submit"]:hover{
		background-color:<?php echo $wd_theme_color_secondary; ?> !important;
		color:#fff !important
	}
	/* GRID LIST SHOP PAGE ICON */
	#container .gridlist-toggle a#grid.active,
	#container .gridlist-toggle a#list.active,
	#container .gridlist-toggle a#list:hover,
	#container .gridlist-toggle a#grid:hover,
	/* square ON TOP RIGHT TITLE SLIDER */
	.woocommerce .featured_product_slider_wrapper .featured_product_slider_wrapper_meta h3:after,
	.woocommerce-page .featured_product_slider_wrapper .featured_product_slider_wrapper_meta h3:after,
	.woocommerce .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta h3:after,
	.woocommerce-page .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta h3:after,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wp_title_shortcode_products h3:after,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta h3:after,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta h3.heading-title:after,
	.woocommerce .featured_product_slider_wrapper .featured_product_slider_wrapper_meta div.wp_title_shortcode_products:after,
	.woocommerce-page .featured_product_slider_wrapper .featured_product_slider_wrapper_meta div.wp_title_shortcode_products:after,
	.woocommerce .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta div.wp_title_shortcode_products:after,
	.woocommerce-page .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta div.wp_title_shortcode_products:after,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta div.wp_title_shortcode_products:after,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta div.wp_title_shortcode_products:after,
	.wd_custom_category_shortcode .wp_title_shortcode_products:after,.wd_custom_category_shortcode .wp_title_shortcode_products h3:after,
	/* END square ON TOP */
	#comments .heading-title:after,
	#respond .heading-title:after,
	.related .wd_title_related .heading-title:after,
	.wd_title_myaccount .heading-title:after,
	body .owl-theme .owl-controls .owl-page span,
	.heading-title-block h1:before,
	.heading-title-block h2:before,
	body div.pp_woocommerce .pp_close:hover,
	body div.pp_woocommerce a.pp_expand,
	body div.pp_woocommerce a.pp_contract,
	.yith-woocompare-widget ul.products-list a.remove,
	table.compare-list tr.remove td > a .remove,
	body.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a:after,
	body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a:after,
	.wd_custom_category_shortcode .wd-custom-category-left-wrapper span.product_label,
	.wd_custom_category_shortcode .wd-custom-category-right-wrapper span.product_label.best_label,
	body.wpb-js-composer h1:after,
	#feedback a.feedback-button:hover,
	.body-wrapper .woocommerce ul.products li.product a:hover img,
	.woocommerce-page .body-wrapper ul.products li.product a:hover img,
	.feature.shortcode .feature_content_wrapper.style-2.has_icon:hover a.wd-feature-icon:before,
	.feature.shortcode .feature_content_wrapper.style-3.has_icon:hover a.wd-feature-icon:before,
	#header .v1 .shopping-cart .cart_item,
	#header .v3 .shopping-cart .cart_item,
	#header .v4 .shopping-cart .cart_item,
	#to-top a:hover,
	ul.archive-product-subcategories > .product a:hover img,
	#control-panel-main #wd-control-close,
	.wd_myaccount_menu .title,
	body .wd_widget_product_categories .widget_title_wrapper,
	body .widget_categories .widget_title_wrapper,
	body .wd_widget_bbpress_forums .widget_title_wrapper,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories ul .link_cat.current,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories ul .link_cat.current,
	.wd_custom_category_shortcode .wp_title_shortcode_products .wd_list_categories ul li a.current,
	#footer .widget_subscriptions button.button,body.woocommerce #footer .widget_subscriptions button.button,
	.page-template-blog-personal-template .ts-sidebar .widget_categories .widget_title_wrapper,
	.page-template-blog-personal-template .ts-sidebar .wd_widget_bbpress_forums .widget_title_wrapper
	{
		background-color:<?php echo $wd_theme_color_primary; ?>;
	}
	
	/* CUSTOM MENU MAIN */
	#header .header-bottom,
	#header .header-middle.v1 .header_search form[id^="searchform-"],
	.sticky-wrapper.is-sticky #header .v1 .wd_tini_cart_wrapper,
	.sticky-wrapper.is-sticky #header .v1 .wd_tini_cart_wrapper{
		background-color:<?php echo $wd_menu_background; ?>;
	}
	
	#header .nav > .main-menu > ul.menu > li.menu-item.parent:hover:after,
	#header .wd_tini_cart_wrapper.loading-cart:before{
		color:<?php echo $wd_menu_background_hover; ?>;
	}
	#header .nav > .main-menu > ul.menu > li.menu-item.parent:after{
		color:<?php echo $wd_menu_background; ?>;
	}
	#header .nav > .main-menu > ul.menu > li > a,
	.sticky-wrapper.is-sticky #header .v3 .shopping-cart.wd-sticky-show,
	.sticky-wrapper.is-sticky #header .v1 .shopping-cart.wd-sticky-show{
		border-color:<?php echo $wd_menu_border; ?>;
		border-top-color:<?php echo $wd_menu_border_top; ?>;
		border-bottom-color:<?php echo $wd_menu_border_bottom; ?>;
	}
	body #header .wd_widget_product_categories h2.widgettitle{
		border-bottom-color:<?php echo $wd_menu_border_bottom; ?> !important;
	}
	#header .nav > .main-menu > ul.menu > li.current_page_item > a,
	#header .nav > .main-menu > ul.menu > li.current-menu-item > a,
	#header .nav > .main-menu > ul.menu > li:hover > a,
	#header .nav > div > ul > li:hover > a,
	#header .nav > .main-menu > ul.menu > li.current_page_item > a:after,
	#header .nav > .main-menu > ul.menu > li.current-menu-item > a:after,
	#header .nav > .main-menu > ul.menu > li:hover > a:after,
	#header .nav > div > ul > li:hover > a:after{
		background-color:<?php echo $wd_menu_background_hover; ?>;
	}
	#header .nav > .main-menu > ul.menu > li.current_page_item > a,
	#header .nav > .main-menu > ul.menu > li.current-menu-item > a,
	#header .nav > .main-menu > ul.menu > li:hover > a, 
	#header .nav > div > ul > li:hover > a{
		border-color:<?php echo $wd_menu_border_hover; ?>;
	}
	.menu .textwidget a:hover, 
	#header .nav > .main-menu > ul.menu > li.wd-mega-menu .wd-more:hover{
		color:<?php echo $wd_sub_menu_text_color_hover; ?>;
	}
	
	#header .nav > .main-menu > ul.menu > li > a > span,
	#header .nav > div.menu > ul > li > a,
	#header .nav > .main-menu > ul.menu > li.parent > a:after,
	#header .nav > div > ul > li.parent > a:after,
	#header .nav .main-menu > ul.menu > li > span.menu-drop-icon:before,
	.header-middle-content .loading-cart:before,
	body #header .wd_widget_product_categories h2.widgettitle,
	.sticky-wrapper.is-sticky #header .v1 .shopping-cart.wd-sticky-show .wd_tini_cart_wrapper:hover .cart_text,
	#header .nav .main-menu > ul.menu > li.parent > span.menu-drop-icon,
	#header .nav > .main-menu > ul.menu > li.menu-item:before,
	.sticky-wrapper.is-sticky .shopping-cart .cart_text .total .amount{
		color:<?php echo $wd_menu_text_color; ?>;
	}
	#header .v3 .header_search_categories .search_content input[type="submit"]{
		background-color:<?php echo $wd_text_weak_color; ?>;
	}
	#header .v3 .header_search_categories .select2-container .select2-choice,
	#header .v3 .header_search_categories .search_content input[type="text"],
	body #header .v3 .header_search_categories select,
	body #header .v3 .header_search_categories select{
		color:<?php echo $wd_text_weak_color; ?>;
	}
	#header .v3 .header_search_categories .search_content input[type="submit"]:hover{
		background-color:<?php echo $wd_theme_color_secondary; ?>;
	}
	#header .header-middle.v2 .shopping-cart .wd_tini_cart_wrapper{
		background-color:<?php echo $wd_theme_color_primary; ?>;
		border-color:<?php echo $wd_theme_color_primary; ?>;
	}
	.shopping-cart:hover .cart_item:before{
		color:<?php echo $wd_theme_color_primary; ?>;
	}
	#header .header-bottom.v1 form[id^="searchform-"] .bg_search input[id^="searchsubmit-"],
	#header .header-bottom.v5 form[id^="searchform-"] .bg_search input[id^="searchsubmit-"],
	#header .nav:before{
		background-color:<?php echo $wd_menu_border_bottom; ?>;
	}
	#header .header-bottom:before{
		background-color:<?php echo $wd_menu_border_top; ?>;
	}
	#header .v1 .header_search form[id^="searchform-"],
	#header .v5 .header_search form[id^="searchform-"],
	#header .header-category .wd_widget_product_categories .wd_product_categories > ul,
	#header .header-category .wd_widget_product_categories .wd_product_categories > ul > li ul.sub_cat,
	#header .header-category .wd_widget_product_categories .wd_product_categories > ul li:last-child,
	#header .header-bottom:after{
		border-color:<?php echo $wd_menu_border_bottom; ?>;
	}
	#header .header-bottom.v1 form[id^="searchform-"] .bg_search input[id^="searchsubmit-"]:hover,
	#header .header-bottom.v5 form[id^="searchform-"] .bg_search input[id^="searchsubmit-"]:hover{
		background-color:<?php echo $wd_menu_text_color; ?>;
	}
	#header .header-bottom.v1 .header_search span.bt_search:before,
	#header .header-bottom.v5 .header_search span.bt_search:before{
		color:<?php echo $wd_menu_border_bottom; ?>;
	}
	#header .header-bottom.v1 .header_search span.bt_search.search_open:before,
	#header .header-bottom.v5 .header_search span.bt_search.search_open:before{
		color:<?php echo $wd_menu_text_color; ?>;
	}
	#header .bg_search :-moz-placeholder,
	#header .bg_search ::-moz-placeholder,
	#header .bg_search ::-webkit-input-placeholder,
	#header .bg_search :-ms-input-placeholder{
		color:<?php echo $wd_menu_text_color; ?>;
	}
	#header .nav > .main-menu > ul.menu > li:hover > a > span,
	#header .nav > div.menu > ul > li:hover > a,
	#header .nav > .main-menu > ul.menu > li.current_page_item > a > span,
	#header .nav > .main-menu > ul.menu > li.current-menu-item > a > span,
	#header .nav > .main-menu > ul.menu > li:hover > a > span,
	#header .nav > div.menu > ul > li:hover > a,
	#header .nav .main-menu > ul.menu > li:hover > span.menu-drop-icon:before,
	#header .nav .main-menu > ul.menu > li.current-menu-item > span.menu-drop-icon:before,
	#header .nav .main-menu > ul.menu > li.current_page_item > span.menu-drop-icon:before,
	.header-middle-content .loading-cart:before,
	#header .nav .main-menu > ul.menu > li.parent.li_active > span.menu-drop-icon:before,
	#header .nav .main-menu > ul.menu > li.current_page_item > span.menu-drop-icon:before,
	#header .nav .main-menu > ul.menu > li.current-menu-item > span.menu-drop-icon:before,
	#header .nav > .main-menu > ul.menu > li.menu-item.current_page_item:before,
	#header .nav > .main-menu > ul.menu > li.menu-item.current-menu-item:before,
	#header .nav > .main-menu > ul.menu > li.menu-item:hover:before,
	#header .nav > .main-menu > ul.menu > li.menu-item:hover:before{
		color:<?php echo $wd_menu_text_color_hover; ?>;
	}
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu ul.sub-menu:after,
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu > ul.sub-menu:before,
	#header .nav > .main-menu > ul.menu > li.wd-mega-menu > ul.sub-menu:before,
	#header .header-middle.v2 .header_search{
		border-color:<?php echo $wd_sub_menu_border; ?>;
	}
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li a:after,
	#header .ul-menu li > a:after{
		background-color:<?php echo $wd_sub_menu_border; ?>;
	}
	body #header .wd_widget_product_categories h2.widgettitle,
	.sticky-wrapper.is-sticky #header .v3 .shopping-cart.wd-sticky-show .cart_item,
	.sticky-wrapper.is-sticky #header .v1 .shopping-cart.wd-sticky-show .cart_item{
		border-color:<?php echo $wd_menu_border; ?>;
	}
	.sticky-wrapper.is-sticky #header .v1 .shopping-cart:hover .cart_item:before,
	.sticky-wrapper.is-sticky #header .v3 .shopping-cart:hover .cart_item:before{
		color:<?php echo $wd_menu_border; ?>;
	}
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li a,
	#header .nav > .main-menu > ul.menu div.categories a,
	.menu .textwidget a,a.link-sub:hover,
	#header .nav .main-menu > ul.menu > li.parent li > span.menu-drop-icon:before{
		color:<?php echo $wd_sub_menu_text_color; ?>;
	}
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li a:hover,
	#header .nav > .main-menu > ul.menu div.categories a:hover,
	.menu .wd-categories a:hover,
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li > a:hover > span,
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li.current-menu-item > a > span,
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li.current_page_item > a > span,
	a.link-sub,.menu .textwidget a:hover,
	#header .nav > .main-menu > ul.menu > li.wd-mega-menu .wd-more{
		color:<?php echo $wd_sub_menu_text_color_hover; ?>;
	}
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu ul.sub-menu:after,
	#header .nav > .main-menu > ul.menu > li.wd-mega-menu > ul.sub-menu:before{
		background-color:<?php echo $wd_sub_menu_background; ?>;
	}
	button.button:hover,
	a.button:hover,
	input[type^=submit]:hover,
	.woocommerce a.button:hover,
	.woocommerce button.button:hover,
	.woocommerce input.button:hover,
	.woocommerce #respond input#submit:hover,
	.woocommerce #content input.button:hover,
	.woocommerce-page a.button:hover,
	.pp_woocommerce a.button:hover,
	.woocommerce-page button.button:hover,
	.woocommerce-page input.button:hover,
	.woocommerce-page #respond input#submit:hover,
	.woocommerce-page #content input.button:hover,
	input.button:hover,
	body form.checkout #payment #place_order:hover,
	.active_price .price_in_table,
	.woocommerce .wd_individual_product_wrapper .add_to_cart_wrapper a,
	.woocommerce-page .wd_individual_product_wrapper .add_to_cart_wrapper a,
	.full_contact input[type="submit"]{
		background-color:<?php echo $wd_theme_color_primary; ?>;
		color:#fff;
		border-color:<?php echo $wd_theme_color_primary; ?>;
	}
	.widget_flickr a.see-more:hover,
	.wd_widget_instagram a.see-more:hover,
	.page-template-blog-personal-template .list-posts .read-more,
	ul.xoxo form[id^="searchform-"] .bg_search input[id^="searchsubmit-"],
	ul.xoxo .widget_product_search input[type="submit"]{
		background-color:<?php echo $wd_theme_color_primary; ?> !important;
		color:#fff !important
	}
	/* PAGER */
	body.woocommerce nav.woocommerce-pagination ul li a.next,
	body.woocommerce-page nav.woocommerce-pagination ul li a.next,
	body.woocommerce #content nav.woocommerce-pagination ul li a.next,
	.page_navi > .nav-content a.next span span,
	.page_navi > .nav-content a.previous span span,
	body.woocommerce nav.woocommerce-pagination ul li a.prev,
	body.woocommerce-page nav.woocommerce-pagination ul li a.prev,
	body.woocommerce #content nav.woocommerce-pagination ul li a.prev,
	/* BUTTON SLIDER */
	.woocommerce > .featured_product_slider_wrapper .slider_control .prev,
	.featured_product_slider_wrapper .slider_control .prev,
	.woocommerce > .featured_categories_slider_wrapper .slider_control .prev,
	.featured_categories_slider_wrapper .slider_control .prev,
	.woocommerce > .featured_product_slider_wrapper .slider_control .next,
	.featured_product_slider_wrapper .slider_control .next,
	.woocommerce > .featured_categories_slider_wrapper .slider_control .next,
	.featured_categories_slider_wrapper .slider_control .next,
	.wd_testimonial_wrapper.is_slider .slider_control .next,
	.wd_testimonial_wrapper.is_slider .slider_control .prev,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.prev,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.prev,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.next,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.next,
	.widget-container.widget_wd_recent_post_widget .slider_control .next,
	.widget-container.widget_wd_recent_post_widget .slider_control .prev,
	.related .related_post_slider a.prev,
	.related .related_portfolio_slider a.prev,
	.related .related_post_slider a.next,
	.related .related_portfolio_slider a.next,
	.woocommerce .related.products #product_related_next,
	.woocommerce .upsells.products #product_upsell_next,
	.woocommerce .related.products #product_related_prev,
	.woocommerce .upsells.products #product_upsell_prev,
	/* BUTTON SLIDER THUMB PRODUCT DETAIL */
	div.list_carousel .slider_control > a.next,
	div.list_carousel .slider_control > a.prev,
	/* BLOG NEXT PREV POST SLIDER*/
	.single-content .single-post .post-title .single-navigation a[rel^=next],
	.single .navi-next a,
	.single-content .single-post .post-title .single-navigation a[rel^=prev],
	.single .navi-prev a,
	/* END NEXT PREV POST SLIDER */
	.widget-container .slider_control .prev,
	.widget-container .slider_control .next,
	body .wd-content .wd_widget_testimonial .slider_control .next,
	body .wd-content .wd_widget_testimonial .slider_control .prev,
	.bbp-pagination-links a.next,
	.bbp-pagination-links a.prev{
		border-color:<?php echo $wd_button_slider_border; ?>;
		background-color:<?php echo $wd_button_slider_background; ?> !important;
	}
	body.woocommerce nav.woocommerce-pagination ul li a.next:before,
	body.woocommerce-page nav.woocommerce-pagination ul li a.next:before,
	body.woocommerce #content nav.woocommerce-pagination ul li a.next:before,
	.page_navi > .nav-content a.next span span:before,
	.page_navi > .nav-content a.previous span span:before,
	body.woocommerce nav.woocommerce-pagination ul li a.prev:before,
	body.woocommerce-page nav.woocommerce-pagination ul li a.prev:before,
	body.woocommerce #content nav.woocommerce-pagination ul li a.prev:before,
	/* BUTTON SLIDER */
	.woocommerce > .featured_product_slider_wrapper .slider_control .prev:before,
	.featured_product_slider_wrapper .slider_control .prev:before,
	.woocommerce > .featured_categories_slider_wrapper .slider_control .prev:before,
	.featured_categories_slider_wrapper .slider_control .prev:before,
	.woocommerce > .featured_product_slider_wrapper .slider_control .next:before,
	.featured_product_slider_wrapper .slider_control .next:before,
	.woocommerce > .featured_categories_slider_wrapper .slider_control .next:before,
	.featured_categories_slider_wrapper .slider_control .next:before,
	.wd_testimonial_wrapper.is_slider .slider_control .next:before,
	.wd_testimonial_wrapper.is_slider .slider_control .prev:before,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.prev:before,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.prev:before,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.next:before,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.next:before,
	.widget-container.widget_wd_recent_post_widget .slider_control .next:before,
	.widget-container.widget_wd_recent_post_widget .slider_control .prev:before,
	.related .related_post_slider a.prev:before,
	.related .related_portfolio_slider a.prev:before,
	.related .related_post_slider a.next:before,
	.related .related_portfolio_slider a.next:before,
	.woocommerce .related.products #product_related_next:before,
	.woocommerce .upsells.products #product_upsell_next:before,
	.woocommerce .related.products #product_related_prev:before,
	.woocommerce .upsells.products #product_upsell_prev:before,
	/* BUTTON SLIDER THUMB PRODUCT DETAIL */
	div.list_carousel .slider_control > a.next:before,
	div.list_carousel .slider_control > a.prev:before,
	/* BLOG NEXT PREV POST SLIDER*/
	.single-content .single-post .post-title .single-navigation a[rel^=next]:before,
	.single .navi-next a:before,
	.single-content .single-post .post-title .single-navigation a[rel^=prev]:before,
	.single .navi-prev a:before,
	/* END NEXT PREV POST SLIDER */
	.widget-container .slider_control .prev:before,
	.widget-container .slider_control .next:before,
	body .wd-content .wd_widget_testimonial .slider_control .next:before,
	body .wd-content .wd_widget_testimonial .slider_control .prev:before,
	.bbp-pagination-links a.next:before,
	.bbp-pagination-links a.prev:before{
		color:<?php echo $wd_button_slider_icon ?>;
	}
	.portfolio_slider_shortcode .slider_control a{
		border-color:<?php echo $wd_button_slider_border; ?>;
		color:<?php echo $wd_text_color; ?>;
		background:transparent;
	}
	.portfolio_slider_shortcode .slider_control a:hover,
	.portfolio_slider_shortcode .slider_control a:hover:after{
		border-color:<?php echo $wd_button_slider_background_hover; ?>;
		color:#fff;
		background:<?php echo $wd_button_slider_background_hover ?>;
	}
	#cboxClose{
		background-color:<?php echo $wd_button_slider_border; ?>;
	}
	#cboxClose:hover{
		background-color:<?php echo $wd_button_slider_background_hover; ?>;
	}
	/* PAGER */
	.page_navi > .nav-content a.previous span span:hover,
	body.woocommerce nav.woocommerce-pagination ul li a.prev:hover,
	body.woocommerce-page nav.woocommerce-pagination ul li a.prev:hover,
	body.woocommerce #content nav.woocommerce-pagination ul li a.prev:hover,
	body.woocommerce nav.woocommerce-pagination ul li a.next:hover,
	body.woocommerce-page nav.woocommerce-pagination ul li a.next:hover,
	body.woocommerce #content nav.woocommerce-pagination ul li a.next:hover,
	.page_navi > .nav-content a.next span span:hover,
	/* BUTTON WIDGET SLIDER */
	.widget-container .slider_control .prev:hover,
	.widget-container .slider_control .next:hover,
	.wd_testimonial_wrapper.is_slider .slider_control .next:hover,
	.wd_testimonial_wrapper.is_slider .slider_control .prev:hover,
	body .wd-content .wd_widget_testimonial .slider_control .next:hover,
	body .wd-content .wd_widget_testimonial .slider_control .prev:hover,
	.featured_product_slider_wrapper .slider_control .next:hover,
	.featured_categories_slider_wrapper .slider_control .next:hover,
	.featured_product_slider_wrapper .slider_control .prev:hover,
	.featured_categories_slider_wrapper .slider_control .prev:hover,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.next:hover,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.next:hover,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.prev:hover,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.prev:hover,
	.widget-container.widget_wd_recent_post_widget .slider_control .next:hover,
	.widget-container.widget_wd_recent_post_widget .slider_control .prev:hover,
	.related .related_post_slider a.prev:hover,.related .related_portfolio_slider a.prev:hover,
	.related .related_post_slider a.next:hover,.related .related_portfolio_slider a.next:hover,
	.related .related_post_slider a.prev:hover,.related .related_portfolio_slider a.prev:hover,
	.related .related_post_slider a.next:hover,.related .related_portfolio_slider a.next:hover,
	.woocommerce .related.products #product_related_next:hover,
	.woocommerce .upsells.products #product_upsell_next:hover,
	.woocommerce .related.products #product_related_prev:hover,
	.woocommerce .upsell.products #product_upsells_prev:hover,
	/* BUTTON SLIDER THUMB PRODUCT DETAIL */
	div.list_carousel .slider_control > a.next:hover,
	div.list_carousel .slider_control > a.prev:hover,
	/* BLOG NEXT PREV POST SLIDER*/
	.single-content .single-post .post-title .single-navigation a[rel^=next]:hover,
	.single .navi-next:hover a,
	.single-content .single-post .post-title .single-navigation a[rel^=prev]:hover,
	.single .navi-prev:hover a,
	/* END BLOG NEXT PREV POST SLIDER */
	div.pp_woocommerce .pp_fade:hover .pp_previous:before,
	div.pp_woocommerce .pp_fade:hover .pp_next:before,
	.bbp-pagination-links a.next:hover,
	.bbp-pagination-links a.prev:hover
	{
		border-color:<?php echo $wd_button_slider_border_hover; ?>;
		background-color:<?php echo $wd_button_slider_background_hover; ?> !important;
	}
	body.woocommerce nav.woocommerce-pagination ul li a.next:hover:before,
	body.woocommerce-page nav.woocommerce-pagination ul li a.next:hover:before,
	body.woocommerce #content nav.woocommerce-pagination ul li a.next:hover:before,
	.page_navi > .nav-content a.next span span:hover:before,
	.page_navi > .nav-content a.previous span span:hover:before,
	body.woocommerce nav.woocommerce-pagination ul li a.prev:hover:before,
	body.woocommerce-page nav.woocommerce-pagination ul li a.prev:hover:before,
	body.woocommerce #content nav.woocommerce-pagination ul li a.prev:hover:before,
	/* BUTTON SLIDER */
	.woocommerce > .featured_product_slider_wrapper .slider_control .prev:hover:before,
	.featured_product_slider_wrapper .slider_control .prev:hover:before,
	.woocommerce > .featured_categories_slider_wrapper .slider_control .prev:hover:before,
	.featured_categories_slider_wrapper .slider_control .prev:hover:before,
	.woocommerce > .featured_product_slider_wrapper .slider_control .next:hover:before,
	.featured_product_slider_wrapper .slider_control .next:hover:before,
	.woocommerce > .featured_categories_slider_wrapper .slider_control .next:hover:before,
	.featured_categories_slider_wrapper .slider_control .next:hover:before,
	.wd_testimonial_wrapper.is_slider .slider_control .next:hover:before,
	.wd_testimonial_wrapper.is_slider .slider_control .prev:hover:before,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.prev:hover:before,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.prev:hover:before,
	.woocommerce-page .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.next:hover:before,
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wd_list_categories .slider_control a.next:hover:before,
	.widget-container.widget_wd_recent_post_widget .slider_control .next:hover:before,
	.widget-container.widget_wd_recent_post_widget .slider_control .prev:hover:before,
	.related .related_post_slider a.prev:hover:before,
	.related .related_portfolio_slider a.prev:hover:before,
	.related .related_post_slider a.next:hover:before,
	.related .related_portfolio_slider a.next:hover:before,
	.woocommerce .related.products #product_related_next:hover:before,
	.woocommerce .upsells.products #product_upsell_next:hover:before,
	.woocommerce .related.products #product_related_prev:hover:before,
	.woocommerce .upsells.products #product_upsell_prev:hover:before,
	/* BUTTON SLIDER THUMB PRODUCT DETAIL */
	div.list_carousel .slider_control > a.next:hover:before,
	div.list_carousel .slider_control > a.prev:hover:before,
	/* BLOG NEXT PREV POST SLIDER*/
	.single-content .single-post .post-title .single-navigation a[rel^=next]:hover:before,
	.single .navi-next a:hover:before,
	.single-content .single-post .post-title .single-navigation a[rel^=prev]:hover:before,
	.single .navi-prev a:hover:before,
	/* END NEXT PREV POST SLIDER */
	.widget-container .slider_control .prev:hover:before,
	.widget-container .slider_control .next:hover:before,
	body .wd-content .wd_widget_testimonial .slider_control .next:hover:before,
	body .wd-content .wd_widget_testimonial .slider_control .prev:hover:before,
	.bbp-pagination-links a.next:hover:before,
	.bbp-pagination-links a.prev:hover:before{
		color:<?php echo $wd_button_slider_icon_hover ?>;
	}
	.bbp-pagination-links a{
		border-color:<?php echo $wd_button_slider_border; ?>;
		color:<?php echo $wd_button_slider_icon; ?>;
	}
	.bbp-pagination-links a:hover, 
	.bbp-pagination-links span.current{
		border-color:<?php echo $wd_button_slider_border_hover; ?> ;
		color:<?php echo $wd_button_slider_background_hover; ?>;
	}
	input[type="search"],
	input[type="color"], 
	input[type="email"], 
	input[type="number"], 
	input[type="password"], 
	input[type="tel"], 
	input[type="text"],select,textarea,
	.wd_tini_account_wrapper .form_drop_down:after,
	.woocommerce-page #content table.shop_table tbody tr.cart_item .quantity input.qty, 
	body .pp_woocommerce div.product form.cart .group_table td .quantity input.qty, 
	body.woocommerce #content div.product form.cart .group_table td .quantity input.qty,
	body.woocommerce-page #content div.product form.cart .group_table td .quantity input.qty,
	body .pp_woocommerce .quantity input.qty, 
	body.woocommerce #content .quantity input.qty,
	body.woocommerce-page #content .quantity input.qty,
	body.woocommerce #content div.product .quantity input.qty, 
	body.woocommerce-page #content div.product .quantity input.qty, 
	.single-content .single-post .post-title .single-navigation a[rel^=prev],
	.single-content .single-post .post-title .single-navigation a[rel^=next],
	.single .navi-prev a,.single .navi-next a,
	.wd_button_loadmore_wrapper input.btn_load_more,
	.woocommerce #content table.shop_table.wishlist_table tr td, 
	.woocommerce-page #content table.shop_table.wishlist_table tr td, 
	#content .woocommerce table.shop_table.wishlist_table tr td,
	.yith-woocompare-widget ul.products-list a.remove,
	table.compare-list th,
	table.compare-list td,
	.woocommerce .wd_custom_category_shortcode ul.products li.left-wrapper .product_thumbnails a:hover,
	.widget_subscriptions input.subscribe_email,
	#bbpress-forums li.bbp-body ul.forum, 
	#bbpress-forums li.bbp-body ul.topic,
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation{
		border-color:<?php echo $wd_input_border_color; ?>;
	}
	#header .v3 .header_search_categories .select2-container .select2-choice{
		border-color:<?php echo $wd_input_border_color; ?>;
	}
	input[type="search"]:hover,
	input[type="color"]:hover,
	input[type="email"]:hover,
	input[type="number"]:hover,
	input[type="password"]:hover,
	input[type="tel"]:hover,
	input[type="text"]:hover,
	select:hover,textarea:hover,
	input[type="color"]:focus,
	input[type="email"]:focus,
	input[type="number"]:focus,
	input[type="password"]:focus,
	input[type="tel"]:focus,
	input[type="text"]:focus,
	select:focus,textarea:focus,
	.woocommerce-page #content .cart-collaterals .coupon_wrapper input#coupon_code:hover,
	.woocommerce-page #content .cart-collaterals .coupon_wrapper input#coupon_code:focus,
	.quantity input.qty:hover, 
	body.woocommerce #content .quantity input.qty:hover,
	body.woocommerce-page #content .quantity input.qty:hover,
	body .pp_woocommerce .quantity input.qty:hover,
	.wd_button_loadmore_wrapper input.btn_load_more:hover,
	.yith-woocompare-widget ul.products-list a.remove:hover,
	#header .header-middle .middle-header-middle-content .header_search_categories:hover,
	.feature.shortcode .feature_content_wrapper.has_icon .feature_icon,
	.select2-container .select2-choice,
	.woocommerce form .form-row.woocommerce-validated .select2-container, 
	.woocommerce form .form-row.woocommerce-validated input.input-text, 
	.woocommerce form .form-row.woocommerce-validated select,
	.select2-drop
	{
		border-color:<?php echo $wd_input_border_color_hover; ?>;
	}
	/* TITLE PRODUCT SLIDER */
	
	.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .wp_title_shortcode_products,
	.woocommerce .featured_product_slider_wrapper .featured_product_slider_wrapper_meta div.wp_title_shortcode_products,
	.woocommerce-page .featured_product_slider_wrapper .featured_product_slider_wrapper_meta div.wp_title_shortcode_products,
	.woocommerce .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta div.wp_title_shortcode_products,
	.woocommerce-page .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta div.wp_title_shortcode_products,
	/* END TITLE */
	#comments .wd_title_comment,
	#respond .wd_title_respond,
	.related .wd_title_related,
	.woocommerce-page #content .cart-collaterals .cross-sells .wd_title_cross_sells,
	body.woocommerce #content div.product .woocommerce-tabs ul.tabs, 
	body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs, 
	body.woocommerce #content div.product .nav.nav-tabs, 
	body.woocommerce-page #content div.product .nav.nav-tabs,
	.wd_custom_category_shortcode .wp_title_shortcode_products,
	.portfolio-filter-wrapper,
	.heading-title-block.heading-1,
	.heading-title-block.heading-2
	{
		border-color:<?php echo $wd_title_border_color ?>;
	}
	/* END TITLE PRODUCT SLIDER */
	
	/* ============================================== FOOTER =============================================== */
	#footer .fifth-footer-widget-area,
	#footer .sixth-footer-widget-area{
		background-color:<?php echo $wd_footer_middle_background; ?>;
	}
	<?php if( isset( $data['wd_enable_bg_color_third_footer_widget_area'] ) && (int)$data['wd_enable_bg_color_third_footer_widget_area']== 1): ?>
		#footer .fourth-footer-widget-area{
			background:<?php echo $wd_bg_color_third_footer_widget_area; ?> !important;
		}
	<?php endif; ?>
	#footer .fredsel_slider_wrapper_inner.loading:before{
		background-color:<?php echo $wd_footer_background; ?> !important;
	}
	#footer .widget_tag_cloud .tagcloud a:hover,
	#footer .widget_product_tag_cloud .tagcloud a:hover,
	#footer .wd_tag_cloud .wd_widget_tag_cloud a:hover{
		background-color:<?php echo $wd_footer_tag_background_hover; ?>;
		color:<?php echo $wd_footer_tag_text_hover ?>;
		border-color:<?php echo $wd_footer_tag_border_hover; ?>;
	}
	#footer .widget_tag_cloud .tagcloud a,
	#footer .widget_product_tag_cloud .tagcloud a,
	#footer .wd_tag_cloud .wd_widget_tag_cloud a{
		background-color:<?php echo $wd_footer_tag_background; ?>;
		color:<?php echo $wd_footer_tag_text ?>;
		border-color:<?php echo $wd_footer_tag_border; ?>;
	}
	
	#footer .sixth-footer-widget-area .widget-title.heading-title,
	#footer .fifth-footer-widget-area h3.widget-title,
	#footer .fifth-footer-widget-area h1,
	#footer .fifth-footer-widget-area h2,
	#footer .fifth-footer-widget-area h3,
	#footer .fifth-footer-widget-area h4,
	#footer .fifth-footer-widget-area h5,
	#footer .fifth-footer-widget-area h6,
	#footer .widget_tag_cloud .tagcloud a:hover,
	#footer .widget_product_tag_cloud .tagcloud a:hover,
	#footer .footer-bg .widget-container ul li a:hover,
	#footer .widget_twitterupdate ul li.status-item,
	#footer a.block-control:before,
	#footer .widget-container.widget_wd_recent_post_widget .type-2 .entry-title > a,
	#footer .widget-container.widget_text ul.wd-list-info li a,
	#footer .widget_flickr a.see-more{
		color:<?php echo $wd_footer_middle_heading; ?>;
	}
	#footer .sixth-footer-widget-area > .container > div:before,
	#footer .sixth-footer-widget-area .widget_product_categories ul li a:before{
		background-color:<?php echo $wd_footer_middle_heading; ?>;
	}	
	#footer .wd_footer_end:before{
		background-color:<?php echo wd_calc_color($wd_footer_middle_background,'#1d1f24',false); ?>;
	}
	.wd_footer_end{
		background:<?php echo $wd_footer_end_background; ?>;
	}
	
	#footer .fifth-footer-widget-area,
	#footer .fifth-footer-widget-area .textwidget,
	#footer .footer-bg .widget-container ul li a,
	.widget_twitterupdate ul li.status-item .user span,
	#footer .widget-container.widget_wd_recent_post_widget .info-detail > span.author{
		color:<?php echo $wd_footer_middle_text; ?>;
	}
	
	.widget_twitterupdate ul li.status-item .date-time a:hover{
		color:<?php echo $wd_footer_middle_text; ?>;
	}
	
	/* ================= LINK ================== */
	a {
		color:<?php echo $wd_link_color; ?>;
	}
	a:hover,a:focus {
		color:<?php echo $wd_link_color_hover; ?>;
	}
	a.author:focus{
		color:<?php echo $wd_link_color_hover; ?> !important;
	}
	
	.woocommerce-message,
	.woocommerce-info,
	.woocommerce .woocommerce-message,
	.woocommerce .woocommerce-info,
	.woocommerce-page .woocommerce-message,
	.woocommerce-page .woocommerce-info,
	.woocommerce div.product .availability span,
	.pp_woocommerce div.product .availability span,
	body.woocommerce #content div.product .availability span,
	body.woocommerce-page #content div.product .availability span
	{
		color:<?php echo $wd_special_color; ?>;
	}
	
	.woocommerce-message,
	.woocommerce-info,
	.woocommerce .woocommerce-message,
	.woocommerce .woocommerce-info,
	.woocommerce-page .woocommerce-message,
	.woocommerce-page .woocommerce-info{
		border-color:<?php echo $wd_special_color; ?>;
	}
	
	body .woocommerce-message:after,
	.woocommerce .woocommerce-message:after,
	.woocommerce-page .woocommerce-message:after,
	body .woocommerce-info:after,
	.woocommerce .woocommerce-info:after,
	.woocommerce-page .woocommerce-info:after{
		background-color:<?php echo $wd_special_color; ?>;
	}
	
	body #content .woocommerce .cart-collaterals .cart_totals .checkout-button,
	body.woocommerce #content .cart-collaterals .cart_totals .checkout-button,
	body.woocommerce-page #content .cart-collaterals .cart_totals .checkout-button,
	body form.checkout #payment #place_order{
		background-color:<?php echo $wd_special_color; ?> !important;
	}
	
	input,textarea,.woocommerce #payment div.payment_box,
	.woocommerce-page #payment div.payment_box{
		color:<?php echo $wd_text_color; ?>;
	}
	
	/* ==================================================== PRICE ==========================================*/
	.widget-container .price > ins >.amount,
	.widget-container .price > ins ,
	.woocommerce ul.cart_list li > ins > span.amount,
	.woocommerce ul.product_list_widget li > ins > span.amount,
	.woocommerce ul.product_list_widget li > ins,
	.woocommerce-page ul.cart_list li > ins > span.amount,
	.woocommerce-page ul.cart_list li > ins,
	.woocommerce-page ul.product_list_widget li > ins > span.amount,
	.widget-container .price ins,
	.widget-container .price ins .amount,
	.widget-container ins,
	.widget-container .price ins .amount,
	.woocommerce ul.products li.product .price ins .amount,
	.woocommerce-page ul.products li.product .price ins .amount,
	.pp_woocommerce .price ins,
	.woocommerce ul.products li.product .price ins,
	.woocommerce-page ul.products li.product .price ins,
	.home ul.products li.product .price ins,
	table.compare-list tr.price td ins,
	.product_list_widget li span.price,
	ul.products li.product.sale .price,
	.body-wrapper .woocommerce ul.products li.product .price, 
	body.woocommerce-page .body-wrapper ul.products li.product .price,
	body.woocommerce #content div.product .summary.entry-summary span.price, 
	body.woocommerce #content div.product .summary.entry-summary p.price, 
	body.woocommerce-page #content div.product .summary.entry-summary span.price, 
	body.woocommerce-page #content div.product .summary.entry-summary p.price,
	body .pp_woocommerce div.product .summary.entry-summary .price,
	
	body div.product .summary.entry-summary p.price, 
	
	body.woocommerce #content div.product ul.products li.product span.price, 
	body.woocommerce #content div.product ul.products li.product p.price, 
	body.woocommerce-page #content div.product ul.products li.product span.price, 
	body.woocommerce-page #content div.product ul.products li.product p.price,
	
	ul.products li.product .price,.cart_dropdown .total span,
	.widget-container .price > .amount,
	.woocommerce ul.cart_list li > span.amount,
	.woocommerce ul.product_list_widget li > span.amount,
	.woocommerce-page ul.cart_list li > span.amount,
	.woocommerce-page ul.product_list_widget li > span.amount,
	.woocommerce ul.cart_list li .quantity span.amount,
	.woocommerce ul.product_list_widget li .quantity span.amount,
	body .pp_woocommerce div.product.wd_quickshop form.cart .group_table td.price,
	.shopping-cart .cart_dropdown ul.cart_list li .price > .amount,
	
	body .pp_woocommerce div.product form.cart .group_table td.price .amount,
	body.woocommerce-page #content div.product form.cart .group_table td.price .amount,
	body.woocommerce-page #content table.my_account_orders td.order-total .amount,
	.product_list_widget li,
	.widget_popular ul li,
	.widget_hot_product ul li,
	.widget-container.woocommerce ul.product_list_widget li,
	.woocommerce-page .widget-container ul.cart_list li,
	.woocommerce-page .widget-container ul.product_list_widget li,
	.widget-container .wd_widget_product_slider_wrapper .product_per_slide ul > li,
	.woocommerce ul.cart_list li,
	.woocommerce-page ul.cart_list li,table.compare-list tr.price td,
	body.woocommerce-page #content .order_details tfoot td .amount,
	.individual_mini .wd_individual_product_wrapper .price ins .amount
	{
		color:<?php echo $wd_text_price_color; ?>;
		font-weight:600;
	}
	
	.woocommerce-page #content div.product form.cart .group_table td.price del .amount,
	.shopping-cart .cart_dropdown ul.cart_list li .price del .amount,
	div.product .price del,
	.body-wrapper .woocommerce ul.products li.product .price del, 
	.woocommerce-page .body-wrapper ul.products li.product .price del,
	.woocommerce #content div.product span.price del, 
	.woocommerce #content div.product p.price del, 
	.woocommerce-page #content div.product span.price del, 
	.woocommerce-page #content div.product p.price del,
	body .pp_woocommerce div.product form.cart .group_table td.price del .amount,
	.widget-container .price del,
	.widget-container .price del .amount,
	.widget-container del,
	.widget-container .price del .amount,
	table.compare-list tr.price td del,
	.wd_individual_product_wrapper .price del .amount{
		color:<?php echo $wd_text_price_sale_color; ?>;
		font-weight:300;
	}
	/* RATING */
	div.product div.summary .star-rating:before,
	body.woocommerce #content div.product div.summary .star-rating:before,
	body.woocommerce #content div.product div.summary .star-rating:before,
	body.woocommerce-page #content div.product div.summary .star-rating:before,
	body .pp_woocommerce div.product div.summary .star-rating:before,
	.wd_quickshop .star-rating span:before,
	.woocommerce p.stars a:after,
	.woocommerce-page p.stars a:after{
		color:<?php echo $wd_rating_color; ?>;
	}
	
	.woocommerce ul.products li.product .star-rating:before,
	.pp_woocommerce .star-rating:before,
	.woocommerce .star-rating:before,
	.woocommerce ul.cart_list li .star-rating:before,
	.woocommerce-page ul.cart_list li .star-rating:before, 
	.woocommerce ul.product_list_widget li .star-rating:before,
	.woocommerce-page ul.product_list_widget li .star-rating:before,
	.widget-container .wd_widget_product_slider_wrapper .product_per_slide ul > li .star-rating:before{
		color:<?php echo $wd_rating_color; ?>;
	}
	
	.woocommerce .star-rating span:before, 
	.woocommerce-page .star-rating span:before,
	.pp_woocommerce .star-rating span:before{
		color:<?php echo $wd_rating_color_star; ?>;
	}
	
	/* PORTFOLIO */
	
	.item-portfolio .thumb-image-hover .background{
		background-color:<?php echo $wd_portfolio_background_hover; ?>;
	}
	.item-portfolio .thumb-image-hover .thumb-image.wd-pretty-image:before,
	.item-portfolio .thumb-image-hover .thumb-image.wd-pretty-video:before,
	.item-portfolio .thumb-image-hover .link-gallery:before,
	.item-portfolio .thumb-image-hover .thumb-image.wd-pretty-image,
	.item-portfolio .thumb-image-hover .thumb-image.wd-pretty-video,
	.item-portfolio .thumb-image-hover .link-gallery{
		color:<?php echo $wd_portfolio_button_icon; ?>;
		border-color:<?php echo $wd_portfolio_button_icon; ?>;
	}

	.item-portfolio .thumb-image-hover .thumb-image.wd-pretty-image:hover:before,
	.item-portfolio .thumb-image-hover .thumb-image.wd-pretty-video:hover:before,
	.item-portfolio .thumb-image-hover .link-gallery:hover:before,
	.item-portfolio .thumb-image-hover .thumb-image.wd-pretty-image:hover,
	.item-portfolio .thumb-image-hover .thumb-image.wd-pretty-video:hover,
	.item-portfolio .thumb-image-hover .link-gallery:hover{
		color:<?php echo $wd_portfolio_button_icon_hover; ?>;
		background-color:<?php echo $wd_portfolio_button_background_hover; ?>;
	}
	
	.item-portfolio .post-title a{
		color:<?php echo $wd_link_title_portfolio; ?>;
	}
	
	.item-portfolio .post-title a:hover
	{
		color:<?php echo $wd_link_title_portfolio_hover; ?>;
	}
	
	
/**************************************** RESPONSIVE *****************************************/	
@media 
only screen and (max-width: 360px){
	#bbpress-forums li.bbp-header li.bbp-forum-info,
	#bbpress-forums li.bbp-header li.bbp-topic-title{
		border-color:<?php  echo $wd_theme_color_primary ?>;
		color:<?php  echo $wd_theme_color_primary ?>;
	}
}
/* MENU */
	@media only screen and (max-device-width: 767px), only screen and (max-width: 767px){
		.phone-header .toggle-menu-wrapper,.phone-header{
			background-color:<?php echo $wd_phone_background; ?>;
		}
		.wd_mobile_account,.mobile_cart_container{
			border-color:<?php echo $wd_phone_background;?>;
			background-color:<?php echo $wd_main_content_background; ?>;
		}
		
		.mobile-main-menu .menu > li > ul > li > ul li a:hover,.mobile-main-menu .menu > li > ul > li > ul li.current-menu-item > a,.mobile-main-menu .menu > li > ul > li > ul li.current_page_item > a {
			color:<?php echo $wd_phone_text_color; ?>;
		}
		
		.mobile-main-menu .menu li a{
			color:<?php echo $wd_phone_text_color; ?>;
		}
		#header .header-container > .logo{
			background-color:<?php echo $wd_theme_color_primary; ?>;
		}
		.mobile-main-menu .menu li a:hover,.mobile-main-menu .menu li.current_page_item > a,.mobile-main-menu .menu li.current-menu-item > a{
			background-color:<?php echo $wd_phone_background_hover; ?>
		}
	}
<?php if( isset($data["wd_effect_product"]) && (int)$data["wd_effect_product"] == 0): ?>	
/* DISPLAY EFFECT OPACITY */	
@media 
only screen and (max-width: 4000px) and (min-width: 1025px) {
	#main-module-container ul.products li.product a .product-image-back{
		display:none !important;
	}
	#main-module-container ul.products li.product a:hover .product-image-front{
		opacity:1;
		filter:alpha(opacity=100);
	}
}
.ie body .woocommerce ul.products li.product a:hover .product-image-back ,
.ie body .woocommerce-page ul.products li.product a:hover .product-image-back,
.ie body.woocommerce ul.products li.product a:hover .product-image-back ,
.ie body.woocommerce-page ul.products li.product a:hover .product-image-back {
	display:none !important;z-index:0 !important
}
/* END */
<?php endif; ?>
<?php if( isset($data["wd_effect_product_hover"]) && (int)$data["wd_effect_product_hover"] == 0): ?>	
/* DISPLAY EFFECT BACKGROUND HOVER */	
.woocommerce ul.products li.product .product_thumbnail_wrapper > a:after,
.woocommerce-page ul.products li.product .product_thumbnail_wrapper > a:after{
	display:none !important;
}
/* END */
<?php endif; ?>		