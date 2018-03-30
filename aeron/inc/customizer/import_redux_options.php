<?php 
//redux framework legacy - import options in theme customizer
$aeron_options = get_option('aeron_options');
if(is_array($aeron_options)){
	$options_direct = array('disable_responsiveness','hide_title_bar','hide_comments','custom_css','show_announcement_bar','announcement_bar_style','announcement_notice','show_announcement_menu','announcement_bar_menu_position','icon_font_info','sidebars','body_text_color','lighter_text_color','main_color','highlight_color','secondary_color','header_background','footer_background','borders_color','title_bar_background','pullquote_text','footer_borders','main_menu_items','footer_links','copyright','social_links_label','pullquote_text','facebook_url','twitter_url','linkedin_url','googleplus_url','skype_url','social_links_target');
	foreach ($options_direct as $option_direct) {
		set_theme_mod( $option_direct, $aeron_options[$option_direct] );
	}
	$options_url = array('favicon','header_logo','custom_bg_image','footer_logo');
	foreach ($options_url as $option_url) {
		set_theme_mod( $option_url, $aeron_options[$option_url]['url'] );
	}
	delete_option( 'aeron_options' );
}