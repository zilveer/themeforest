<?php
/**
 * @package by Theme Record
 * @auther: MattMao
*/

global $tr_config;

$page = 'settings';
$payment = 'payment';
$colors = 'colors';
$fonts = 'fonts';


//Get Options
$tr_config['blog_page_id'] = get_option( 'TR_theme_blog_page_id' );
$tr_config['portfolio_page_id'] = get_option( 'TR_theme_portfolio_page_id' );
$tr_config['gallery_page_id'] = get_option( 'TR_theme_gallery_page_id' );



//General
$tr_config['favicon'] = get_theme_option($page, 'TR_favicon');
$tr_config['enable_responsive'] = get_theme_option($page, 'enable_responsive');
$tr_config['pagination'] = get_theme_option($page, 'pagination');
$tr_config['enable_breadcrumb'] = get_theme_option($page, 'enable_breadcrumb');
$tr_config['enable_announcement'] = get_theme_option($page, 'enable_announcement');
$tr_config['announcement'] = stripslashes(get_theme_option($page, 'announcement'));
$tr_config['google_apis'] = stripslashes(get_theme_option($page, 'google_apis'));
$tr_config['custom_css'] = stripslashes(get_theme_option($page, 'custom_css'));
$tr_config['analytics'] = stripslashes(get_theme_option($page, 'analytics'));



//Header
$tr_config['header_height'] = get_theme_option($page, 'header_height');
$tr_config['depth'] = get_theme_option($page, 'menu_depth');
$tr_config['sub_menu_width'] = get_theme_option($page, 'sub_menu_width');
$tr_config['logo'] = get_theme_option($page, 'TR_logo');
$tr_config['logo_top'] = get_theme_option($page, 'logo_top');
$tr_config['site_desc'] = stripslashes(get_theme_option($page, 'site_desc'));
$tr_config['enable_site_name'] = get_theme_option($page, 'enable_site_name');
$tr_config['enable_site_desc'] = get_theme_option($page, 'enable_site_desc');
$tr_config['page_header_top'] = get_theme_option($page, 'page_header_top');
$tr_config['page_header_bottom'] = get_theme_option($page, 'page_header_bottom');



//Slideshow
$tr_config['rs_shortcode'] = get_theme_option($page, 'rs_shortcode');
$tr_config['enable_slideshow'] = get_theme_option($page, 'enable_slideshow');
$tr_config['slideshow_speed'] = get_theme_option($page, 'slideshow_speed');
$tr_config['slideshow_duration'] = get_theme_option($page, 'slideshow_duration');
$tr_config['slideshow_animation'] = get_theme_option($page, 'slideshow_animation');
$tr_config['enable_slideshow_auto'] = get_theme_option($page, 'enable_slideshow_auto');
$tr_config['enable_slideshow_directionnav'] = get_theme_option($page, 'enable_slideshow_directionnav');
$tr_config['enable_slideshow_controlnav'] = get_theme_option($page, 'enable_slideshow_controlnav');
$tr_config['enable_slideshow_pauseplay'] = get_theme_option($page, 'enable_slideshow_pauseplay');



//Portfolio
$tr_config['portfolio_display_mode'] = get_theme_option($page, 'portfolio_display_mode');
$tr_config['portfolio_column'] = get_theme_option($page, 'portfolio_column');
$tr_config['portfolio_posts_per_page'] = get_theme_option($page, 'portfolio_posts_per_page');
$tr_config['enable_portfolio_title'] = get_theme_option($page, 'enable_portfolio_title');
$tr_config['enable_portfolio_skills'] = get_theme_option($page, 'enable_portfolio_skills');
$tr_config['enable_portfolio_comments'] = get_theme_option($page, 'enable_portfolio_comments');
$tr_config['enable_portfolio_related_posts'] = get_theme_option($page, 'enable_portfolio_related_posts');
$tr_config['portfolio_related_posts_per_page'] = get_theme_option($page, 'portfolio_related_posts_per_page');



//Product
$tr_config['product_posts_per_page'] = get_theme_option($page, 'product_posts_per_page');
$tr_config['enable_product_comments'] = get_theme_option($page, 'enable_product_comments');
$tr_config['enable_product_related_posts'] = get_theme_option($page, 'enable_product_related_posts');
$tr_config['product_related_posts_per_page'] = get_theme_option($page, 'product_related_posts_per_page');



//Blog
$tr_config['blog_posts_per_page'] = get_theme_option($page, 'blog_posts_per_page');
$tr_config['enable_blog_date'] = get_theme_option($page, 'enable_blog_date');
$tr_config['enable_blog_categories'] = get_theme_option($page, 'enable_blog_categories');
$tr_config['enable_blog_author'] = get_theme_option($page, 'enable_blog_author');
$tr_config['enable_blog_comments'] = get_theme_option($page, 'enable_blog_comments');



//Contact
$tr_config['contact_email'] = get_theme_option($page, 'contact_email');
$tr_config['enable_google_map'] = get_theme_option($page, 'enable_google_map');
$tr_config['map_address'] = get_theme_option($page, 'map_address');
$tr_config['map_zoom'] = get_theme_option($page, 'map_zoom');
$tr_config['map_height'] = get_theme_option($page, 'map_height');
$tr_config['enable_recaptcha'] = get_theme_option($page, 'enable_recaptcha');
$tr_config['recaptcha_publickey'] = get_theme_option($page, 'recaptcha_publickey');
$tr_config['recaptcha_privatekey'] = get_theme_option($page, 'recaptcha_privatekey');




//Footer
$tr_config['copyright'] = stripslashes(get_theme_option($page, 'copyright_message'));
$tr_config['widgets_column'] = get_theme_option($page, 'footer_widgets_column');
$tr_config['enable_widgets'] = get_theme_option($page, 'enable_footer_widgets');
$tr_config['enable_footer_contact_info'] = get_theme_option($page, 'enable_footer_contact_info');
$tr_config['footer_address'] = stripslashes(get_theme_option($page, 'footer_address'));
$tr_config['footer_phone'] = get_theme_option($page, 'footer_phone');
$tr_config['footer_email'] = get_theme_option($page, 'footer_email');
$tr_config['twitter'] = get_theme_option($page, 'twitter');
$tr_config['facebook'] = get_theme_option($page, 'facebook');
$tr_config['dribbble'] = get_theme_option($page, 'dribbble');
$tr_config['flickr'] = get_theme_option($page, 'flickr');
$tr_config['linkedin'] = get_theme_option($page, 'linkedin');
$tr_config['google'] = get_theme_option($page, 'google');
$tr_config['vimeo'] = get_theme_option($page, 'vimeo');
$tr_config['picasa'] = get_theme_option($page, 'picasa');
$tr_config['feed'] = get_theme_option($page, 'feed');



//Payment
$tr_config['paypal_email'] = get_theme_option($payment, 'paypal_email');
$tr_config['currency'] = get_theme_option($payment, 'currency');
$tr_config['paypal_sandbox'] = get_theme_option($payment, 'paypal_sandbox');
$tr_config['shopping_methods'] = get_theme_option($payment, 'shopping_methods');
$tr_config['shopping_fee'] = get_theme_option($payment, 'shopping_fee');
$tr_config['add_to_cart_text'] = get_theme_option($payment, 'add_to_cart_text');
$tr_config['cart_empty_text'] = get_theme_option($payment, 'cart_empty_text');
$tr_config['thank_you_page_text'] = get_theme_option($payment, 'thank_you_page_text');
$tr_config['shop_page_id'] = get_theme_option($payment, 'shopping_base_page');
$tr_config['shop_cart_page_id'] = get_theme_option($payment, 'shopping_cart_page');
$tr_config['shop_thank_you_page_id'] = get_theme_option($payment, 'shopping_thank_you');
$tr_config['saler_send_email'] = get_theme_option($payment, 'saler_send_email');
$tr_config['saler_subject'] = get_theme_option($payment, 'saler_subject');
$tr_config['saler_message'] = get_theme_option($payment, 'saler_message');
$tr_config['buyer_subject'] = get_theme_option($payment, 'buyer_subject');
$tr_config['buyer_message'] = get_theme_option($payment, 'buyer_message');



//General Colors
$tr_config['body_bg_color'] = strtoupper(get_theme_option($colors, 'body_bg_color'));
$tr_config['text_color'] = strtoupper(get_theme_option($colors, 'text_color'));
$tr_config['link_color'] = strtoupper(get_theme_option($colors, 'link_color'));
$tr_config['hover_color'] = strtoupper(get_theme_option($colors, 'hover_color'));
$tr_config['hgroup_color'] = strtoupper(get_theme_option($colors, 'hgroup_color'));


//Announcement Colors
$tr_config['ac_text_color'] = strtoupper(get_theme_option($colors, 'ac_text_color'));
$tr_config['ac_link_color'] = strtoupper(get_theme_option($colors, 'ac_link_color'));
$tr_config['ac_hover_color'] = strtoupper(get_theme_option($colors, 'ac_hover_color'));
$tr_config['ac_bg_color'] = strtoupper(get_theme_option($colors, 'ac_bg_color'));
$tr_config['TR_ac_bg_image'] = get_theme_option($colors, 'TR_ac_bg_image');
$tr_config['ac_bg_repeat'] = get_theme_option($colors, 'ac_bg_repeat');
$tr_config['ac_bg_horizontal'] = get_theme_option($colors, 'ac_bg_horizontal');
$tr_config['ac_bg_vertical'] = get_theme_option($colors, 'ac_bg_vertical');


//Header Colors
$tr_config['header_top_line_color'] = strtoupper(get_theme_option($colors, 'header_top_line_color'));
$tr_config['header_text_color'] = strtoupper(get_theme_option($colors, 'header_text_color'));
$tr_config['header_menu_link_color'] = strtoupper(get_theme_option($colors, 'header_menu_link_color'));
$tr_config['header_menu_hover_color'] = strtoupper(get_theme_option($colors, 'header_menu_hover_color'));
$tr_config['header_menu_bg_color'] = strtoupper(get_theme_option($colors, 'header_menu_bg_color'));
$tr_config['header_sub_menu_bg_color'] = strtoupper(get_theme_option($colors, 'header_sub_menu_bg_color'));
$tr_config['header_bg_color'] = strtoupper(get_theme_option($colors, 'header_bg_color'));
$tr_config['TR_header_bg_image'] = get_theme_option($colors, 'TR_header_bg_image');
$tr_config['header_bg_repeat'] = get_theme_option($colors, 'header_bg_repeat');
$tr_config['header_bg_horizontal'] = get_theme_option($colors, 'header_bg_horizontal');
$tr_config['header_bg_vertical'] = get_theme_option($colors, 'header_bg_vertical');


//Slideshow
$tr_config['slideshow_title_color'] = strtoupper(get_theme_option($colors, 'slideshow_title_color'));
$tr_config['slideshow_text_color'] = strtoupper(get_theme_option($colors, 'slideshow_text_color'));
$tr_config['slideshow_link_color'] = strtoupper(get_theme_option($colors, 'slideshow_link_color'));
$tr_config['slideshow_hover_color'] = strtoupper(get_theme_option($colors, 'slideshow_hover_color'));
$tr_config['slideshow_bg_color'] = strtoupper(get_theme_option($colors, 'slideshow_bg_color'));
$tr_config['TR_slideshow_bg_image'] = get_theme_option($colors, 'TR_slideshow_bg_image');
$tr_config['slideshow_bg_repeat'] = get_theme_option($colors, 'slideshow_bg_repeat');
$tr_config['slideshow_bg_horizontal'] = get_theme_option($colors, 'slideshow_bg_horizontal');
$tr_config['slideshow_bg_vertical'] = get_theme_option($colors, 'slideshow_bg_vertical');


//Page Header
$tr_config['page_header_title_color'] = strtoupper(get_theme_option($colors, 'page_header_title_color'));
$tr_config['page_header_text_color'] = strtoupper(get_theme_option($colors, 'page_header_text_color'));
$tr_config['page_header_link_color'] = strtoupper(get_theme_option($colors, 'page_header_link_color'));
$tr_config['page_header_hover_color'] = strtoupper(get_theme_option($colors, 'page_header_hover_color'));
$tr_config['page_header_bg_color'] = strtoupper(get_theme_option($colors, 'page_header_bg_color'));
$tr_config['TR_page_header_bg_image'] = get_theme_option($colors, 'TR_page_header_bg_image');
$tr_config['page_header_bg_repeat'] = get_theme_option($colors, 'page_header_bg_repeat');
$tr_config['page_header_bg_horizontal'] = get_theme_option($colors, 'page_header_bg_horizontal');
$tr_config['page_header_bg_vertical'] = get_theme_option($colors, 'page_header_bg_vertical');


//Button
$tr_config['button_ac_bg_color'] = strtoupper(get_theme_option($colors, 'button_ac_bg_color'));
$tr_config['button_ac_hover_bg_color'] = strtoupper(get_theme_option($colors, 'button_ac_hover_bg_color'));
$tr_config['button_slideshow_bg_color'] = strtoupper(get_theme_option($colors, 'button_slideshow_bg_color'));
$tr_config['button_slideshow_hover_bg_color'] = strtoupper(get_theme_option($colors, 'button_slideshow_hover_bg_color'));
$tr_config['button_carousel_bg_color'] = strtoupper(get_theme_option($colors, 'button_carousel_bg_color'));
$tr_config['button_carousel_hover_bg_color'] = strtoupper(get_theme_option($colors, 'button_carousel_hover_bg_color'));
$tr_config['button_format_bg_color'] = strtoupper(get_theme_option($colors, 'button_format_bg_color'));
$tr_config['button_format_hover_bg_color'] = strtoupper(get_theme_option($colors, 'button_format_hover_bg_color'));
$tr_config['button_read_more_bg_color'] = strtoupper(get_theme_option($colors, 'button_read_more_bg_color'));
$tr_config['button_read_more_hover_bg_color'] = strtoupper(get_theme_option($colors, 'button_read_more_hover_bg_color'));
$tr_config['button_pagenation_bg_color'] = strtoupper(get_theme_option($colors, 'button_pagenation_bg_color'));
$tr_config['button_pagenation_hover_bg_color'] = strtoupper(get_theme_option($colors, 'button_pagenation_hover_bg_color'));
$tr_config['button_submit_bg_color'] = strtoupper(get_theme_option($colors, 'button_submit_bg_color'));
$tr_config['button_submit_hover_bg_color'] = strtoupper(get_theme_option($colors, 'button_submit_hover_bg_color'));


//Footer Widgets
$tr_config['footer_widgets_title_color'] = strtoupper(get_theme_option($colors, 'footer_widgets_title_color'));
$tr_config['footer_widgets_text_color'] = strtoupper(get_theme_option($colors, 'footer_widgets_text_color'));
$tr_config['footer_widgets_link_color'] = strtoupper(get_theme_option($colors, 'footer_widgets_link_color'));
$tr_config['footer_widgets_hover_color'] = strtoupper(get_theme_option($colors, 'footer_widgets_hover_color'));
$tr_config['footer_widgets_bg_color'] = strtoupper(get_theme_option($colors, 'footer_widgets_bg_color'));
$tr_config['TR_footer_widgets_bg_image'] = get_theme_option($colors, 'TR_footer_widgets_bg_image');
$tr_config['footer_widgets_bg_repeat'] = get_theme_option($colors, 'footer_widgets_bg_repeat');
$tr_config['footer_widgets_bg_horizontal'] = get_theme_option($colors, 'footer_widgets_bg_horizontal');
$tr_config['footer_widgets_bg_vertical'] = get_theme_option($colors, 'footer_widgets_bg_vertical');


//Footer Contact
$tr_config['footer_contact_text_color'] = strtoupper(get_theme_option($colors, 'footer_contact_text_color'));
$tr_config['footer_contact_link_color'] = strtoupper(get_theme_option($colors, 'footer_contact_link_color'));
$tr_config['footer_contact_hover_color'] = strtoupper(get_theme_option($colors, 'footer_contact_hover_color'));
$tr_config['footer_contact_bg_color'] = strtoupper(get_theme_option($colors, 'footer_contact_bg_color'));
$tr_config['TR_footer_contact_bg_image'] = get_theme_option($colors, 'TR_footer_contact_bg_image');
$tr_config['footer_contact_bg_repeat'] = get_theme_option($colors, 'footer_contact_bg_repeat');
$tr_config['footer_contact_bg_horizontal'] = get_theme_option($colors, 'footer_contact_bg_horizontal');
$tr_config['footer_contact_bg_vertical'] = get_theme_option($colors, 'footer_contact_bg_vertical');


//Footer Copyright
$tr_config['footer_copyright_text_color'] = strtoupper(get_theme_option($colors, 'footer_copyright_text_color'));
$tr_config['footer_copyright_link_color'] = strtoupper(get_theme_option($colors, 'footer_copyright_link_color'));
$tr_config['footer_copyright_hover_color'] = strtoupper(get_theme_option($colors, 'footer_copyright_hover_color'));
$tr_config['footer_copyright_icon_bg_color'] = strtoupper(get_theme_option($colors, 'footer_copyright_icon_bg_color'));
$tr_config['footer_copyright_bg_color'] = strtoupper(get_theme_option($colors, 'footer_copyright_bg_color'));
$tr_config['TR_footer_copyright_bg_image'] = get_theme_option($colors, 'TR_footer_copyright_bg_image');
$tr_config['footer_copyright_bg_repeat'] = get_theme_option($colors, 'footer_copyright_bg_repeat');
$tr_config['footer_copyright_bg_horizontal'] = get_theme_option($colors, 'footer_copyright_bg_horizontal');
$tr_config['footer_copyright_bg_vertical'] = get_theme_option($colors, 'footer_copyright_bg_vertical');


//Fonts
$tr_config['body_family'] = stripslashes(get_theme_option($fonts, 'body_font_family'));
$tr_config['site_name_family'] = stripslashes(get_theme_option($fonts, 'site_name_font_family'));
$tr_config['menu_family'] = stripslashes(get_theme_option($fonts, 'menu_font_family'));
$tr_config['hgroup_family'] = stripslashes(get_theme_option($fonts, 'hgroup_font_family'));
$tr_config['breadcrumbs_family'] = stripslashes(get_theme_option($fonts, 'breadcrumbs_font_family'));
$tr_config['page_header_family'] = stripslashes(get_theme_option($fonts, 'page_header_font_family'));
$tr_config['meta_family'] = stripslashes(get_theme_option($fonts, 'meta_font_family'));
$tr_config['slogan_family'] = stripslashes(get_theme_option($fonts, 'slogan_font_family'));
$tr_config['price_family'] = stripslashes(get_theme_option($fonts, 'price_font_family'));
$tr_config['read_more_family'] = stripslashes(get_theme_option($fonts, 'read_more_font_family'));
$tr_config['pagination_family'] = stripslashes(get_theme_option($fonts, 'pagination_font_family'));
$tr_config['form_family'] = stripslashes(get_theme_option($fonts, 'form_font_family'));
$tr_config['copyright_family'] = stripslashes(get_theme_option($fonts, 'copyright_font_family'));
$tr_config['body_size'] = get_theme_option($fonts, 'body_font_size');
$tr_config['site_name_size'] = get_theme_option($fonts, 'site_name_font_size');
$tr_config['main_menu_size'] = get_theme_option($fonts, 'main_menu_font_size');
$tr_config['sub_menu_size'] = get_theme_option($fonts, 'sub_menu_font_size');
$tr_config['h1_size'] = get_theme_option($fonts, 'h1_font_size');
$tr_config['h2_size'] = get_theme_option($fonts, 'h2_font_size');
$tr_config['h3_size'] = get_theme_option($fonts, 'h3_font_size');
$tr_config['h4_size'] = get_theme_option($fonts, 'h4_font_size');
$tr_config['h5_size'] = get_theme_option($fonts, 'h5_font_size');
$tr_config['h6_size'] = get_theme_option($fonts, 'h6_font_size');
$tr_config['slogan_size'] = get_theme_option($fonts, 'slogan_font_size');
$tr_config['footer_menu_size'] = get_theme_option($fonts, 'footer_menu_font_size');
$tr_config['copyright_size'] = get_theme_option($fonts, 'copyright_font_size');



//Twitter OAuth
$tr_config['consumer_key'] = get_theme_option($page, 'twitter_consumer_key');
$tr_config['consumer_secret'] = get_theme_option($page, 'twitter_consumer_secret');
$tr_config['access_token'] = get_theme_option($page, 'twitter_access_token');
$tr_config['access_token_secret'] = get_theme_option($page, 'twitter_access_token_secret');
?>