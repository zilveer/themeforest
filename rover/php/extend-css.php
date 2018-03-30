<?php
/**
 * Extend CSS
 * @package by Theme Record
 * @auther: MattMao
*/

if ( !function_exists( 'theme_extend_styles' ) )
{

	function theme_extend_styles() 
	{
		global $tr_config, $font_faces, $is_IE, $is_opera, $is_safari, $is_chrome;

		//Settings
		$enable_responsive = $tr_config['enable_responsive'];
		$header_height_value = $tr_config['header_height'];
		$rs_shortcode = $tr_config['rs_shortcode'];

		if($is_IE || $is_opera || $is_chrome) 
		{ 
			$header_height = $header_height_value+1;
		}
		else
		{
			$header_height = $header_height_value;
		}

		if($header_height_value<136) {
			$height_value = (136-$header_height_value)/2;
			$menu_top = 55-$height_value;
		}elseif($header_height_value>136){
			$height_value = ($header_height_value-136)/2;
			$menu_top = 55+$height_value;
		}else{
			$menu_top = 55;
		}

		//Position
		$menu_bottom = $menu_top-5;
		$nocurrent_menu_bottom = $menu_top-6;
		if($is_IE || $is_opera || $is_safari || $is_chrome) { $menu_bottom = $menu_top-5; $nocurrent_menu_bottom = $menu_top-5; }

		$logo_top = $tr_config['logo_top'];
		$sub_menu_width = $tr_config['sub_menu_width'];
		$slideshow_count = count(get_posts(array('post_type' => 'slideshow', 'post_status' => 'publish')));
		$slideshow_width = $slideshow_count*26/2;
		$custom_css = $tr_config['custom_css'];
		$page_header_top = $tr_config['page_header_top'];
		$page_header_bottom = $tr_config['page_header_bottom'];


		//Colors
		$body_bg_color = $tr_config['body_bg_color'];
		$text_color = $tr_config['text_color'];
		$link_color = $tr_config['link_color'];
		$hover_color = $tr_config['hover_color'];
		$hgroup_color = $tr_config['hgroup_color'];

		$ac_text_color = $tr_config['ac_text_color'];
		$ac_link_color = $tr_config['ac_link_color'];
		$ac_hover_color = $tr_config['ac_hover_color'];
		$ac_bg_color = $tr_config['ac_bg_color'];
		$ac_bg_image = $tr_config['TR_ac_bg_image'];
		$ac_bg_r = $tr_config['ac_bg_repeat'];
		$ac_bg_h = $tr_config['ac_bg_horizontal'];
		$ac_bg_v = $tr_config['ac_bg_vertical'];

		$header_top_line_color = $tr_config['header_top_line_color'];
		$header_text_color = $tr_config['header_text_color'];
		$header_menu_link_color = $tr_config['header_menu_link_color'];
		$header_menu_hover_color = $tr_config['header_menu_hover_color'];
		$header_menu_bg_color = $tr_config['header_menu_bg_color'];
		$header_sub_menu_bg_color = $tr_config['header_sub_menu_bg_color'];
		$header_bg_color = $tr_config['header_bg_color'];
		$header_bg_image = $tr_config['TR_header_bg_image'];
		$header_bg_r = $tr_config['header_bg_repeat'];
		$header_bg_h = $tr_config['header_bg_horizontal'];
		$header_bg_v = $tr_config['header_bg_vertical'];

		$slideshow_title_color = $tr_config['slideshow_title_color'];
		$slideshow_text_color = $tr_config['slideshow_text_color'];
		$slideshow_link_color = $tr_config['slideshow_link_color'];
		$slideshow_hover_color = $tr_config['slideshow_hover_color'];
		$slideshow_bg_color = $tr_config['slideshow_bg_color'];
		$slideshow_bg_image = $tr_config['TR_slideshow_bg_image'];
		$slideshow_bg_r = $tr_config['slideshow_bg_repeat'];
		$slideshow_bg_h = $tr_config['slideshow_bg_horizontal'];
		$slideshow_bg_v = $tr_config['slideshow_bg_vertical'];

		$page_header_title_color = $tr_config['page_header_title_color'];
		$page_header_text_color = $tr_config['page_header_text_color'];
		$page_header_link_color = $tr_config['page_header_link_color'];
		$page_header_hover_color = $tr_config['page_header_hover_color'];
		$page_header_bg_color = $tr_config['page_header_bg_color'];
		$page_header_bg_image = $tr_config['TR_page_header_bg_image'];
		$page_header_bg_r = $tr_config['page_header_bg_repeat'];
		$page_header_bg_h = $tr_config['page_header_bg_horizontal'];
		$page_header_bg_v = $tr_config['page_header_bg_vertical'];

		$button_ac_bg_color = $tr_config['button_ac_bg_color'];
		$button_ac_hover_bg_color = $tr_config['button_ac_hover_bg_color'];
		$button_slideshow_bg_color = $tr_config['button_slideshow_bg_color'];
		$button_slideshow_hover_bg_color = $tr_config['button_slideshow_hover_bg_color'];
		$button_carousel_bg_color = $tr_config['button_carousel_bg_color'];
		$button_carousel_hover_bg_color = $tr_config['button_carousel_hover_bg_color'];
		$button_format_bg_color = $tr_config['button_format_bg_color'];
		$button_read_more_bg_color = $tr_config['button_read_more_bg_color'];
		$button_read_more_hover_bg_color = $tr_config['button_read_more_hover_bg_color'];
		$button_pagenation_bg_color = $tr_config['button_pagenation_bg_color'];
		$button_pagenation_hover_bg_color = $tr_config['button_pagenation_hover_bg_color'];
		$button_submit_bg_color = $tr_config['button_submit_bg_color'];
		$button_submit_hover_bg_color = $tr_config['button_submit_hover_bg_color'];

		$footer_widgets_title_color = $tr_config['footer_widgets_title_color'];
		$footer_widgets_text_color = $tr_config['footer_widgets_text_color'];
		$footer_widgets_link_color = $tr_config['footer_widgets_link_color'];
		$footer_widgets_hover_color = $tr_config['footer_widgets_hover_color'];
		$footer_widgets_bg_color = $tr_config['footer_widgets_bg_color'];
		$footer_widgets_bg_image = $tr_config['TR_footer_widgets_bg_image'];
		$footer_widgets_bg_r = $tr_config['footer_widgets_bg_repeat'];
		$footer_widgets_bg_h = $tr_config['footer_widgets_bg_horizontal'];
		$footer_widgets_bg_v = $tr_config['footer_widgets_bg_vertical'];

		$footer_contact_text_color = $tr_config['footer_contact_text_color'];
		$footer_contact_link_color = $tr_config['footer_contact_link_color'];
		$footer_contact_hover_color = $tr_config['footer_contact_hover_color'];
		$footer_contact_bg_color = $tr_config['footer_contact_bg_color'];
		$footer_contact_bg_image = $tr_config['TR_footer_contact_bg_image'];
		$footer_contact_bg_r = $tr_config['footer_contact_bg_repeat'];
		$footer_contact_bg_h = $tr_config['footer_contact_bg_horizontal'];
		$footer_contact_bg_v = $tr_config['footer_contact_bg_vertical'];

		$footer_copyright_text_color = $tr_config['footer_copyright_text_color'];
		$footer_copyright_link_color = $tr_config['footer_copyright_link_color'];
		$footer_copyright_hover_color = $tr_config['footer_copyright_hover_color'];
		$footer_copyright_icon_bg_color = $tr_config['footer_copyright_icon_bg_color'];
		$footer_copyright_bg_color = $tr_config['footer_copyright_bg_color'];
		$footer_copyright_bg_image = $tr_config['TR_footer_copyright_bg_image'];
		$footer_copyright_bg_r = $tr_config['footer_copyright_bg_repeat'];
		$footer_copyright_bg_h = $tr_config['footer_copyright_bg_horizontal'];
		$footer_copyright_bg_v = $tr_config['footer_copyright_bg_vertical'];

		//Fonts
		$body_family = $tr_config['body_family'];
		$site_name_family = $tr_config['site_name_family'];
		$menu_family = $tr_config['menu_family'];
		$hgroup_family = $tr_config['hgroup_family'];
		$breadcrumbs_family = $tr_config['breadcrumbs_family'];
		$page_header_family = $tr_config['page_header_family'];
		$meta_family = $tr_config['meta_family'];
		$slogan_family = $tr_config['slogan_family'];
		$price_family = $tr_config['price_family'];
		$read_more_family = $tr_config['read_more_family'];
		$pagination_family = $tr_config['pagination_family'];
		$form_family = $tr_config['form_family'];
		$copyright_family = $tr_config['copyright_family'];
		$body_size = $tr_config['body_size'];
		$site_name_size = $tr_config['site_name_size'];
		$main_menu_size = $tr_config['main_menu_size'];
		$sub_menu_size = $tr_config['sub_menu_size'];
		$h1_size = $tr_config['h1_size'];
		$h2_size = $tr_config['h2_size'];
		$h3_size = $tr_config['h3_size'];
		$h4_size = $tr_config['h4_size'];
		$h5_size = $tr_config['h5_size'];
		$h6_size = $tr_config['h6_size'];
		$slogan_size = $tr_config['slogan_size'];
		$footer_menu_size = $tr_config['footer_menu_size'];
		$copyright_size = $tr_config['copyright_size'];


		//Echo Css
		$output = '';
		$output .= '#top-menu ul li ul { width: '.$sub_menu_width.'px; }'."\n";
		$output .= '.site-name, .site-logo { margin-top: '.$logo_top.'px; }'."\n";
		$output .= '.flex-container-home .flex-control-nav { margin-left: -'.$slideshow_width.'px;}'."\n";
		$output .= 'body { background-color: #'.$body_bg_color.'; color: #'.$text_color.'; }'."\n";
		$output .= 'a { color: #'.$link_color.'; }'."\n";
		$output .= 'a:hover, 
.page-header-breadcrumbs a:hover, 
.portfolio-list li .cats a:hover, 
.product-list li .price, 
.post-product-single .product-form .price, 
.related-product-lists li .price, 
.post-blog .post .entry-header-meta a:hover, 
.post-slide-list li .cats a:hover, 
.commentlist li .fn a:hover, 
.commentlist li .reply:hover, 
.commentlist li .edit-link a:hover, 
.product-slide-list li .price,
.widget-product li .price,
.widget-post li .meta a:hover,
.widget-tweets li .meta a:hover,
.widget-portfolio li .cats a:hover { color: #'.$hover_color.'; }'."\n";
		$output .= 'h1, h2, h3, h4, h5, h6, b, strong { color: #'.$hgroup_color.'; }'."\n";
		$output .= '#announcement-content { color: #'.$ac_text_color.'; }'."\n";
		$output .= '#announcement-content a { color: #'.$ac_link_color.'; }'."\n";
		$output .= '#announcement-content a:hover { color: #'.$ac_hover_color.'; }'."\n";
		$output .= '.close-announcement { background-color: #'.$button_ac_bg_color.'; }'."\n";
		$output .= '.close-announcement:hover { background-color: #'.$button_ac_hover_bg_color.'; }'."\n";
		$output .= '#topborder { background: #'.$header_top_line_color.'; }'."\n";
		$output .= '#site-head, .site-name p, .site-logo p, #top-menu ul li a:after { color: #'.$header_text_color.'; }'."\n";
		$output .= '#site-head { height: '.$header_height.'px; }'."\n";
		$output .= '.site-page-header { padding-top: '.$page_header_top.'px; padding-bottom: '.$page_header_bottom.'px; }'."\n";
		$output .= '#top-menu ul li.backLava { border-top: 5px solid #'.$header_menu_hover_color.'; background: #'.$header_menu_bg_color.'; }'."\n";
		$output .= '#top-menu ul li a strong, body.nocurrent #top-menu ul li.selectedLava a strong { color: #'.$header_menu_link_color.'; }'."\n";
		$output .= '#top-menu ul li.selectedLava a strong, 
#top-menu ul li a.selected strong, 
#top-menu ul li a:hover strong, 
body.nocurrent #top-menu ul li.selectedLava a:hover strong { color: #'.$header_menu_hover_color.'; }'."\n";
		$output .= 'body.nocurrent #top-menu ul li.backLava { border-top: none; background: none; }'."\n";
		$output .= 'body.nocurrent #top-menu ul li a:hover { border-top: 5px solid #'.$header_menu_hover_color.'; background: #'.$header_menu_bg_color.'; }'."\n";
		$output .= '#top-menu ul li ul li a:hover, body.nocurrent #top-menu ul li ul li a:hover { background: #'.$header_sub_menu_bg_color.'; border-top: 1px solid #'.$header_sub_menu_bg_color.'; }'."\n";
		$output .= '.post-item .overlay-icon, .widget_tag_cloud a:hover, .footer-widgets-area .widget_tag_cloud a:hover { background-color: #'.$hover_color.'; }'."\n";
		$output .= '.flex-container-gallery .flex-direction-nav li a, 
.flex-container-gallery .flex-pauseplay span, 
.flex-container-gallery .flex-control-nav li a, 
.flex-container-home .flex-direction-nav li a, 
.flex-container-home .flex-pauseplay span, 
.flex-container-home .flex-control-nav li a, 
.homepage-slideshow-warp .link a { background-color: #'.$button_slideshow_bg_color.'; }'."\n";
		$output .= '.flex-direction-nav li a:hover, 
.flex-pauseplay span:hover, 
.flex-control-nav li a:hover, 
.flex-control-nav li a.active, 
.homepage-slideshow-warp .link a:hover, 
.homepage-slideshow-warp .flex-item-full .flex-caption { background-color: #'.$button_slideshow_hover_bg_color.'; }'."\n";
		$output .= '.jcarousel-next,
.jcarousel-prev,
.jcarousel-next-disabled, 
.jcarousel-next-disabled:hover,
.jcarousel-next-disabled:focus, 
.jcarousel-next-disabled:active,
.jcarousel-prev-disabled, 
.jcarousel-prev-disabled:hover,
.jcarousel-prev-disabled:focus, 
.jcarousel-prev-disabled:active { background-color: #'.$button_carousel_bg_color.'; }'."\n";
		$output .= '.jcarousel-next:hover, 
.jcarousel-next:focus, 
.jcarousel-next:active,
.jcarousel-prev:hover, 
.jcarousel-prev:focus, 
.jcarousel-prev:active { background-color: #'.$button_carousel_hover_bg_color.'; }'."\n";
		$output .= '.post-blog .post .post-meta .link a { background-color: #'.$button_format_bg_color.'; }'."\n";
		$output .= '.blog-list .post-entry .more-link, 
.shortcode-iconbox .iconbox-button a, 
.post-portfolio-single .post-meta .client-url a  { background-color: #'.$button_read_more_bg_color.'; }'."\n";
		$output .= '.shortcode-iconbox .iconbox-button a:hover, 
.post-portfolio-single .post-meta .client-url a:hover { background-color: #'.$button_read_more_hover_bg_color.'; }'."\n";
		$output .= '.pagination a, 
.pagination span,
.normal-pagination a,
.comment-pagination a, 
.comment-pagination span,
.sortable-menu li a,
.single-post-pagenation li a { background-color: #'.$button_pagenation_bg_color.'; }'."\n";
		$output .= '.pagination a:hover,
.pagination span.current,
.normal-pagination a:hover,
.comment-pagination a:hover, 
.comment-pagination span.current,
.sortable-menu li.current-cat a,
.sortable-menu li.active a,
.sortable-menu li a:hover { background: #'.$button_pagenation_hover_bg_color.'; }'."\n";
		$output .= '.shopping-cart-list .button,
.shopping-cart-return a,
#commentform input[type="submit"],
.contact-page input[type="submit"] { background: #'.$button_submit_bg_color.'; }'."\n";
		$output .= '.shopping-cart-list .button:hover,
.shopping-cart-return a:hover { background: #'.$button_submit_hover_bg_color.'; }'."\n";
		$output .= '.side-widget-area .widget h3.title span { background: #'.$body_bg_color.'; }'."\n";
		$output .= '.footer-widgets-area { color: #'.$footer_widgets_text_color.'; }'."\n";
		$output .= '.footer-widgets-area a { color: #'.$footer_widgets_link_color.'; }'."\n";
		$output .= '.footer-widgets-area a:hover { color: #'.$footer_widgets_hover_color.'; }'."\n";
		$output .= '.footer-widgets-area .widget h3.title { color: #'.$footer_widgets_title_color.'; }'."\n";
		$output .= '.footer-widgets-area .widget h3.title span { background: #'.$footer_widgets_bg_color.'; }'."\n";
		$output .= '.footer-contact-info { color: #'.$footer_contact_text_color.'; }'."\n";
		$output .= '.footer-contact-info a { color: #'.$footer_contact_link_color.'; }'."\n";
		$output .= '.footer-contact-info a:hover { color: #'.$footer_contact_hover_color.'; }'."\n";
		$output .= '.footer-message { color: #'.$footer_copyright_text_color.'; }'."\n";
		$output .= '.footer-message a { color: #'.$footer_copyright_link_color.'; }'."\n";
		$output .= '.footer-message a:hover { color: #'.$footer_copyright_hover_color.'; }'."\n";
		$output .= 'body { font-size:'.$body_size.'px; }'."\n";
		$output .= '.site-name h1 { font-size:'.$site_name_size.'px; }'."\n";
		$output .= '#top-menu ul li a strong { font-size:'.$main_menu_size.'px; }'."\n";
		$output .= '#top-menu ul li ul.sub-menu li a,
#top-menu ul li.selectedLava ul.sub-menu li a,
#top-menu ul li ul.children li a strong,
#top-menu ul li.selectedLava ul.children li a strong { font-size:'.$sub_menu_size.'px; }'."\n";
		$output .= '.post-format h1 { font-size:'.$h1_size.'px; }'."\n";
		$output .= '.post-format h2 { font-size:'.$h2_size.'px; }'."\n";
		$output .= '.post-format h3 { font-size:'.$h3_size.'px; }'."\n";
		$output .= '.post-format h4 { font-size:'.$h4_size.'px; }'."\n";
		$output .= '.post-format h5 { font-size:'.$h5_size.'px; }'."\n";
		$output .= '.post-format h6 { font-size:'.$h6_size.'px; }'."\n";
		$output .= '.site-slogan p { font-size:'.$slogan_size.'px; }'."\n";
		$output .= '.footer-message #bottom-menu li { font-size:'.$footer_menu_size.'px; }'."\n";
		$output .= '.footer-message p { font-size:'.$copyright_size.'px; }'."\n";
		$output .= '.homepage-slideshow-warp .flex-item-text .title { color: #'.$slideshow_title_color.'; }'."\n";
		$output .= '.homepage-slideshow-warp .flex-item-text .desc { color: #'.$slideshow_text_color.'; }'."\n";
		$output .= '.homepage-slideshow-warp .flex-item-text .desc a { color: #'.$slideshow_link_color.'; }'."\n";
		$output .= '.homepage-slideshow-warp .flex-item-text .desc a:hover { color: #'.$slideshow_hover_color.'; }'."\n";

		$output .= '.site-page-header h3 { color: #'.$page_header_title_color.'; }'."\n";
		$output .= '.page-header-breadcrumbs .sep,
.page-header-breadcrumbs .breadcrumb-title,
.page-header-breadcrumbs .trail-end { color: #'.$page_header_text_color.'; }'."\n";
		$output .= '.page-header-breadcrumbs a { color: #'.$page_header_link_color.'; }'."\n";
		$output .= '.page-header-breadcrumbs a:hover { color: #'.$page_header_hover_color.'; }'."\n";

		
		if($body_family != 'disabled'){ $output .= 'body, .product-list li .price span, .post-product-single .product-form .price span { font-family: "'.$font_faces[$body_family].'", serif, sans-serif; }'."\n"; }
		if($site_name_family != 'disabled'){ $output .= '.site-name h1 { font-family: "'.$font_faces[$site_name_family].'", serif, sans-serif; }'."\n"; }
		if($menu_family != 'disabled'){ $output .= '#top-menu, #bottom-menu { font-family: "'.$font_faces[$menu_family].'", serif, sans-serif; }'."\n"; }
		if($hgroup_family != 'disabled'){ $output .= 'h1, h2, h3, h4, h5, h6 { font-family: "'.$font_faces[$hgroup_family].'", serif, sans-serif; }'."\n"; }
		if($breadcrumbs_family != 'disabled'){ $output .= '.page-header-breadcrumbs { font-family: "'.$font_faces[$breadcrumbs_family].'", serif, sans-serif; }'."\n"; }
		if($page_header_family != 'disabled'){ $output .= '.site-page-header h3 { font-family: "'.$font_faces[$page_header_family].'", serif, sans-serif; }'."\n"; }
		if($meta_family != 'disabled'){ $output .= '.meta { font-family: "'.$font_faces[$meta_family].'", serif, sans-serif; }'."\n"; }
		if($slogan_family != 'disabled'){ $output .= '.site-slogan p { font-family: "'.$font_faces[$slogan_family].'", serif, sans-serif; }'."\n"; }
		if($price_family != 'disabled')
		{ 
		$output .= '.product-list li .price, 
.post-product-single .product-form .price, 
.related-product-lists li .price, 
.product-slide-list li .price, 
.widget-product li .price { font-family: "'.$font_faces[$price_family].'", serif, sans-serif; }'."\n"; 
		}
		if($read_more_family != 'disabled')
		{ 
		$output .= '.blog-list .post-entry .more-link, 
.shortcode-iconbox .iconbox-button a,
.post-portfolio-single .post-meta .client-url a,
.homepage-slideshow-warp .link a { font-family: "'.$font_faces[$read_more_family].'", serif, sans-serif; }'."\n"; 
		}
		if($pagination_family != 'disabled')
		{ 
		$output .= '.pagination,
.normal-pagination,
.comment-pagination { font-family: "'.$font_faces[$pagination_family].'", serif, sans-serif; }'."\n"; 
		}
		if($form_family != 'disabled'){ $output .= 'input, textarea { font-family: "'.$font_faces[$form_family].'", serif, sans-serif; }'."\n"; }
		if($copyright_family != 'disabled'){ $output .= '.footer-message { font-family: "'.$font_faces[$copyright_family].'", serif, sans-serif; }'."\n"; }


		if($ac_bg_image){
			$output .= '#announcement { background: url('.$ac_bg_image.') '.$ac_bg_r.' '.$ac_bg_h.' '.$ac_bg_v.' #'.$ac_bg_color.'; }'."\n";
		}else{
			$output .= '#announcement { background: #'.$ac_bg_color.'; }'."\n";
		}

		if($header_bg_image){
			$output .= '#site-head { background: url('.$header_bg_image.') '.$header_bg_r.' '.$header_bg_h.' '.$header_bg_v.' #'.$header_bg_color.'; border: none; }'."\n";
		}elseif($header_bg_color == 'FFFFFF'){
			$output .= '#site-head { background: #'.$header_bg_color.'; }'."\n";
		}else{
			$output .= '#site-head { background: #'.$header_bg_color.'; border: none; }'."\n";
		}

		if($slideshow_bg_image){
			$output .= '.homepage-slideshow-warp { background: url('.$slideshow_bg_image.') '.$slideshow_bg_r.' '.$slideshow_bg_h.' '.$slideshow_bg_v.' #'.$slideshow_bg_color.'; border: none; }'."\n";
		}elseif($slideshow_bg_color == 'F9F9F9'){
			$output .= '.homepage-slideshow-warp { background: #'.$slideshow_bg_color.'; }'."\n";
		}else{
			$output .= '.homepage-slideshow-warp { background: #'.$slideshow_bg_color.'; border: none; }'."\n";
		}

		if($page_header_bg_image){
			$output .= '.site-page-header { background: url('.$page_header_bg_image.') '.$page_header_bg_r.' '.$page_header_bg_h.' '.$page_header_bg_v.' #'.$page_header_bg_color.'; border: none; }'."\n";
		}elseif($page_header_bg_color == 'F9F9F9'){
			$output .= '.site-page-header { background: #'.$page_header_bg_color.'; }'."\n";
		}else{
			$output .= '.site-page-header { background: #'.$page_header_bg_color.'; border: none; }'."\n";
		}

		if($footer_widgets_bg_image){
			$output .= '.footer-widgets-area { background: url('.$footer_widgets_bg_image.') '.$footer_widgets_bg_r.' '.$footer_widgets_bg_h.' '.$footer_widgets_bg_v.' #'.$footer_widgets_bg_color.'; }'."\n";
		}else{
			$output .= '.footer-widgets-area { background: #'.$footer_widgets_bg_color.'; }'."\n";
		}

		if($footer_contact_bg_image){
			$output .= '.footer-contact-info { background: url('.$footer_contact_bg_image.') '.$footer_contact_bg_r.' '.$footer_contact_bg_h.' '.$footer_contact_bg_v.' #'.$footer_contact_bg_color.'; }'."\n";
		}else{
			$output .= '.footer-contact-info { background: #'.$footer_contact_bg_color.'; }'."\n";
		}

		if($footer_copyright_bg_image){
			$output .= '.footer-message { background: url('.$footer_copyright_bg_image.') '.$footer_copyright_bg_r.' '.$footer_copyright_bg_h.' '.$footer_copyright_bg_v.' #'.$footer_copyright_bg_color.'; }'."\n";
		}else{
			$output .= '.footer-message { background: #'.$footer_copyright_bg_color.'; }'."\n";
		}

		if (has_nav_menu('top menu')) {
			$output .= '#top-menu ul li a { padding-top: '.$menu_top.'px; padding-bottom: '.$menu_bottom.'px; }'."\n";
			$output .= 'body.nocurrent #top-menu ul li a:hover { padding-top: '.($menu_top-5).'px; padding-bottom: '.$nocurrent_menu_bottom.'px; }'."\n";
		} else {
			if($is_IE || $is_opera || $is_safari || $is_chrome) 
			{ 
				$output .= '#top-menu ul li a { padding-top: '.($menu_top+8).'px; padding-bottom: '.($menu_bottom+8).'px; }'."\n";
			}
			else
			{
				$output .= '#top-menu ul li a { padding-top: '.($menu_top+8).'px; padding-bottom: '.($menu_bottom+6).'px; }'."\n";
			}
			$output .= 'body.nocurrent #top-menu ul li a:hover { padding-top: '.($menu_top+5).'px; padding-bottom: '.($nocurrent_menu_bottom+6).'px; }'."\n";
		}

		if($is_safari) {
			$output .= '#top-menu ul li a strong { font-weight: 500; }'."\n";
		}

		if (has_nav_menu('bottom menu')) {
			$output .= '#social-networking { margin-top: 10px; }'."\n";
		}

		if($custom_css) {
			$output .= $custom_css."\n";
		}

		if($enable_responsive == 'yes') 
		{ 
			$output .= '@media only screen and (max-width: 768px) {'."\n";
			$output .= '#site-head { height: auto; }'."\n";
			$output .= '}'."\n";
			$output .= '@media only screen and (min-width: 480px) and (max-width: 767px) {'."\n";
			$output .= '#top-menu ul li a { padding: 20px 15px; }'."\n";
			$output .= 'body.nocurrent #top-menu ul li a:hover { padding: 18px 15px; }'."\n";
			$output .= '}'."\n";
		}

		if(is_front_page()) 
		{
			if ( function_exists('putRevSlider') && $rs_shortcode != '')
			{
				$output .= '#site-head { border-bottom: none; }'."\n";
			}
		}

		echo "\n";
		echo '<!--Extend CSS-->'."\n";
		echo '<style type="text/css">'."\n";
		echo $output;
		echo '</style>'."\n";
		echo "\n";
	}

	add_action('wp_head', 'theme_extend_styles');

}

?>