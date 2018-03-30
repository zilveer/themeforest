<?php
global $post;
if(!isset($p_id))$p_id='';
if(isset($post->ID)) $p_id=$post->ID;

function cb_get_header_options($pid){
	$opt=array();
	$opt['cb_loader']=esc_attr(get_option('cb5_loader'));
	$opt['cb_loader_gif']=esc_attr(get_option('cb5_loader_gif'));
	$opt['cb_loader_bg']=esc_attr(get_option('cb5_loader_bg'));
	$opt['favi']=esc_attr(get_option('cb5_favi'));
	$opt['rev_slider_name']=esc_attr(get_option('cb5_rev_slider_name'));
	$opt['fb']=esc_attr(get_option('cb5_fb'));
	$opt['fixed_top']=esc_attr(get_option('cb5_fixed_top'));
	$opt['tw']=esc_attr(get_option('cb5_tw'));
	$opt['yt']=esc_attr(get_option('cb5_yt'));
	$opt['in']=esc_attr(get_option('cb5_in'));
	$opt['vi']=esc_attr(get_option('cb5_vi'));
	$opt['rss']=esc_attr(get_option('cb5_rss'));
	$opt['upload_logo']=esc_attr(get_option('cb5_upload_logo'));
	$opt['logo_slogan']=esc_attr(get_option('cb5_logo_slogan'));
	$opt['logo_text']=esc_attr(get_option('cb5_logo_text'));
	$opt['iconspos']=esc_attr(get_option('cb5_iconspos'));
	$opt['slide_type']=esc_attr(get_option('cb5_slide_type'));
	$opt['hide_top']=esc_attr(get_option('cb5_hide_top'));
	$opt['mheadertype']=esc_attr(get_option('cb5_mheadertype'));
	$opt['headings_icons']=esc_attr(get_option('cb5_headings_icons'));
	$opt['headings_icons_size']=esc_attr(get_option('cb5_headings_icons_size'));
	$opt['headings_icons']=html_entity_decode($opt['headings_icons']);
	if($opt['headings_icons']!='')$opt['headings_icons']=unserialize($opt['headings_icons']);
	$opt['headertransparent']=esc_attr(get_option('cb5_headertransparent'));
	$opt['show_logo']=esc_attr(get_option('cb5_show_logo'));
	$opt['full_slider']=esc_attr(get_option('cb5_full_slider'));
	$cb5_header=get_post_meta($pid, '_cb5_header', true);
	$opt['home_slider']=cb_get_value($cb5_header, 'home_slider');
	$opt['header_type']=cb_get_value($cb5_header, 'header_type');
	$opt['revo_type']=cb_get_value($cb5_header, 'revo_type');
	$opt['bg_image_url']=cb_get_value($cb5_header, 'bg_image_url');
	$opt['ht_bg_image_url']=cb_get_value($cb5_header, 'ht_bg_image_url');
	$opt['cb_type']=esc_attr(get_post_meta($pid, '_cb5_post_type', 'true'));
	$opt['show_bread']='yes';
	$cb5_gallery = get_post_meta($pid, '_cb5_gallery', true);
	$opt['fullscreen']=cb_get_value($cb5_gallery, 'fullscreen');
    $opt['lang_top']=esc_attr(get_option('cb5_lang_top'));
    $opt['logo_position']=esc_attr(get_option('cb5_logo_position'));
    $opt['header_min']=esc_attr(get_option('cb5_header_min'));
	return $opt;
}
function cb_get_post_options($pid){
	$opt=array();
	$cb5_post_options = get_post_meta($pid, '_cb5_post_options', true);
	$opt['title']=cb_get_value($cb5_post_options, 'show_title');
	$opt['grid_text']=cb_get_value($cb5_post_options, 'grid_text');
	$opt['grid_bg']=cb_get_value($cb5_post_options, 'grid_bg');
	$opt['show_bread']=cb_get_value($cb5_post_options, 'show_bread');
	if($opt['title']=='') $opt['title']='yes';
	return $opt;
}
function cb_get_css_options($pid){
	$opt=array();
	$opt['disable_pp']=esc_attr(get_option('cb5_disable_pp'));
	$opt['full_slider']=esc_attr(get_option('cb5_full_slider'));
	$opt['full_slider_where']=esc_attr(get_option('cb5_full_slider_where'));
	$opt['full_slider_style']=esc_attr(get_option('cb5_full_slider_style'));
	$opt['font_family_google']=esc_attr(get_option('cb5_font_family_google'));
	$opt['font_family_google_head']=esc_attr(get_option('cb5_font_family_google_head'));
	$opt['font_family_google_head_title']=esc_attr(get_option('cb5_font_family_google_head_title'));
	$opt['font_family_google_head_title2']=esc_attr(get_option('cb5_font_family_google_head_title2'));
	$opt['menu_f']=esc_attr(get_option('cb5_menu_f'));
	$opt['logo_f']=esc_attr(get_option('cb5_logo_f'));
	$cb5_header=get_post_meta($pid, '_cb5_header', true);
	$opt['home_slider']=cb_get_value($cb5_header, 'home_slider');
	$opt['header_type']=cb_get_value($cb5_header, 'header_type');
	
	if($opt['header_type']=='slider_head') $opt['slider_home']=get_post_meta($pid, 'cb5_home_slider', $single = true); else $opt['slider_home']='';

	$opt['cb_type']=esc_attr(get_post_meta($pid, '_cb5_post_type', 'true'));

	return $opt;
}
function cb_get_js_options($pid){
	$opt=array();
	$opt['usescroll']=esc_attr(get_option('cb5_usescroll'));
	
	$opt['wayp']=esc_attr(get_option('cb5_wayp'));
	$opt['global_fade']=esc_attr(get_option('cb5_global_fade'));
	$opt['global_buttons']=esc_attr(get_option('cb5_global_buttons'));
	
	$opt['usescroll']=esc_attr(get_option('cb5_usescroll'));
	$opt['disable_pp']=esc_attr(get_option('cb5_disable_pp'));
	$opt['full_slider']=esc_attr(get_option('cb5_full_slider'));
	$opt['full_slider_where']=esc_attr(get_option('cb5_full_slider_where'));
	$cb5_header=get_post_meta($pid, '_cb5_header', true);
	$opt['home_slider']=cb_get_value($cb5_header, 'home_slider');
	$opt['header_type']=cb_get_value($cb5_header, 'header_type');
	
	if($opt['header_type']=='slider_head') $opt['slider_home']=get_post_meta($pid, 'cb5_home_slider', $single = true); else $opt['slider_home']='';

	$opt['cb_type']=esc_attr(get_post_meta($pid, '_cb5_post_type', 'true'));

	return $opt;
}
function cb_get_footer_options($pid) {
	$opt=array();
	$opt['full_slider']=esc_attr(get_option('cb5_full_slider'));
	$opt['full_slider_where']=esc_attr(get_option('cb5_full_slider_where'));
	$opt['footer_background']=esc_attr(get_option('cb5_footer_background'));
	$opt['show_above_footer']=esc_attr(get_option('cb5_show_above_footer'));
	$opt['footer_logo']=esc_attr(get_option('cb5_footer_logo'));
	$opt['fc']=esc_attr(get_option('cb5_fc'));
	
	$cb5_header=get_post_meta($pid, '_cb5_header', true);
	$opt['home_slider']=cb_get_value($cb5_header, 'home_slider');
	$opt['ht_bg_image_url']=cb_get_value($cb5_header, 'ht_bg_image_url');
	$opt['upload_logo']=esc_attr(get_option('cb5_upload_logo'));
    $opt['footer_upload_logo']=esc_attr(get_option('cb5_footer_upload_logo'));

	$opt['hide_f']=cb_get_value($cb5_header, 'hide_f');
	return $opt;
}
function cb_get_blocks_options($pid) {
	$opt=array();
	$cb5_post_options = get_post_meta($pid, '_cb5_post_options', true);
	$opt['title']=cb_get_value($cb5_post_options, 'show_title');
	$opt['dtitle']=cb_get_value($cb5_post_options, 'show_dtitle');
	$opt['show_about']=cb_get_value($cb5_post_options, 'show_about');
	$opt['display_featured']=cb_get_value($cb5_post_options, 'display_featured');
	$opt['posts_style']=cb_get_value($cb5_post_options, 'posts_style');
	$cb5_blog = get_post_meta($pid, '_cb5_blog', true);
	$opt['show_cat_list']=cb_get_value($cb5_blog, 'show_cat_list');
	$opt['cb_type']=esc_attr(get_post_meta($pid, '_cb5_post_type', 'true'));
	return $opt;
}

function cb_get_portfolio_options($pid) {
	$opt=array();
	$cb5_portfolio_options = get_post_meta($pid, '_cb5_portfolio', true);
	return $cb5_portfolio_options;
	/*$opt['title']=cb_get_value($cb5_post_options, 'show_title');
	$opt['display_featured']=cb_get_value($cb5_post_options, 'display_featured');
	$opt['posts_style']=cb_get_value($cb5_post_options, 'posts_style');
	$cb5_blog = get_post_meta($pid, '_cb5_blog', true);
	$opt['show_cat_list']=cb_get_value($cb5_blog, 'show_cat_list');
	$opt['cb_type']=esc_attr(get_post_meta($pid, '_cb5_post_type', 'true'));*/
	//return $opt;
}

function cb_get_sidebars($pid) {
	
	$opt=array();
	if(!isset($side))$side='';
	$cb_type=esc_attr(get_post_meta($pid, '_cb5_post_type', 'true'));
	$sideb_col=esc_attr(get_option('cb5_sideb_col'));
	$sideb_page=esc_attr(get_option('cb5_sideb_page'));
	$sideb_blog=esc_attr(get_option('cb5_sideb_blog'));
	$sideb_post=esc_attr(get_option('cb5_sideb_post'));
	$sidebar_shop=esc_attr(get_option('cb5_sidebar_shop'));

	$sidebar_position = get_post_meta($pid,'_cb5_sidebar_position',true);
	$sidebar = get_post_meta($pid,'_cb5_sidebar',true);
	if(($sidebar_position=='left'||$sidebar_position=='right')&&$sidebar_shop=='') $sidebar_shop=$sidebar_position;

	if($sidebar_position=='no'||$sidebar_position=='none') $sidebar='';
	if($sidebar=='0') $sidebar='sidebar';
	
    if ( in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        if($sidebar=='sidebar'&&is_woocommerce()) $sidebar='shop-sidebar';
        if($sidebar==''&&is_woocommerce()&&$sidebar_position=='shop-sidebar') $sidebar='shop-sidebar';
        if((is_page()||is_single())&&!is_woocommerce()){

            if($sidebar!=''&&$sidebar_position!='') $side='yes';

            if(is_page()) { if($sidebar_position==''&&$sideb_page=='yes') { $sidebar_position=$sideb_col;$sidebar='sidebar'; $side='yes'; } }
            else if(is_single()) { if($sidebar_position==''&&$sideb_post=='yes') { $sidebar_position=$sideb_col;$sidebar='sidebar'; $side='yes'; } }
            else { $side='no'; $sidebar=''; }
        } else if(is_woocommerce()){
            if($sidebar!=''&&$sidebar!='shop-sidebar'&&($sidebar_shop=='left'||$sidebar_shop=='right')) { $side='yes'; $sidebar_position=$sidebar_shop; }
            if($sidebar=='shop-sidebar'&&($sidebar_shop=='left'||$sidebar_shop=='right')) { $sidebar_position=$sidebar_shop;$sidebar='shop-sidebar'; $side='yes'; }
            
            if(is_product_category()) { if($sidebar_shop!='') {$sidebar_position=$sidebar_shop;$sidebar='shop-sidebar';$side='yes';} }
        }else {
            if($sideb_post=='yes') { $sidebar_position=$sideb_col; $sidebar='sidebar'; $side='yes'; }
            else { $side='no'; $sidebar=''; }
        }

    }
    else{

        if((is_page()||is_single())){

            if($sidebar!=''&&$sidebar_position!='') $side='yes';

            if(is_page()) { if($sidebar_position==''&&$sideb_page=='yes') { $sidebar_position=$sideb_col;$sidebar='sidebar'; $side='yes'; } }
            else if(is_single()) { if($sidebar_position==''&&$sideb_post=='yes') { $sidebar_position=$sideb_col;$sidebar='sidebar'; $side='yes'; } }
            else { $side='no'; $sidebar=''; }
        } else {
            if($sideb_post=='yes') { $sidebar_position=$sideb_col; $sidebar='sidebar'; $side='yes'; }
            else { $side='no'; $sidebar=''; }
        }
    }
	
	$opt['sidebar_position']=$sidebar_position;
	$opt['sidebar']=$sidebar;
	$opt['side']=$side;
	if(isset($cb_type)){if($cb_type=='portfolio_project'){$opt['sidebar']='';
	$opt['side']='';}}
	return $opt;
}
function cb_get_js_generate_options($pid) {
	$opt=array();

	$opt['cb_loader']=esc_attr(get_option('cb5_loader'));
	$opt['listy']=esc_attr(get_option('cb5_listy'));
	$opt['grid']=esc_attr(get_option('cb5_grid'));
	$opt['topw']=esc_attr(get_option('cb5_topw'));
	$opt['wayp']=esc_attr(get_option('cb5_wayp'));
	$opt['global_fade']=esc_attr(get_option('cb5_global_fade'));
	$opt['scroll']=esc_attr(get_option('cb5_scroll'));
	$opt['echo']=esc_attr(get_option('cb5_echo'));
	$opt['disable_pp']=esc_attr(get_option('cb5_disable_pp'));
	$opt['usescroll']=esc_attr(get_option('cb5_usescroll'));
	$opt['full_slider']=esc_attr(get_option('cb5_full_slider'));
	$opt['full_slider_where']=esc_attr(get_option('cb5_full_slider_where'));
	$opt['full_slider_page']=esc_attr(get_option('cb5_full_slider_page'));
	$opt['full_slider_interval']=esc_attr(get_option('cb5_full_slider_interval'));
	$opt['full_slider_effect']=esc_attr(get_option('cb5_full_slider_effect'));
	$opt['full_slider_t_speed']=esc_attr(get_option('cb5_full_slider_t_speed'));
	$opt['full_screen_images']=esc_attr(get_option('cb5_full_screen_images'));
	$opt['full_slider_bar']=esc_attr(get_option('cb5_full_slider_bar'));
	$opt['full_slider_thumbs']=esc_attr(get_option('cb5_full_slider_thumbs'));
	$opt['s_resize']=esc_attr(get_option('cb5_s_resize'));
	$opt['s_auto']=esc_attr(get_option('cb5_s_auto'));
	$opt['s_ani_time']=esc_attr(get_option('cb5_s_ani_time'));
	$opt['s_easing']=esc_attr(get_option('cb5_s_easing'));
	$opt['s_delay']=esc_attr(get_option('cb5_s_delay'));
	$opt['color_style']=esc_attr(get_option('cb5_color_style'));
	$opt['color_master']=esc_attr(get_option('cb5_color_master'));
	$cb5_header=get_post_meta($pid, '_cb5_header', true);
	$opt['home_slider']=cb_get_value($cb5_header, 'home_slider');
	$opt['bg_image_url']=cb_get_value($cb5_header, 'bg_image_url');
	$opt['header_type']=cb_get_value($cb5_header, 'header_type');
	$opt['sloganp']=cb_get_value($cb5_header, 'sloganp');
	$opt['cb_type']=esc_attr(get_post_meta($pid, '_cb5_post_type', 'true'));
	$opt['mheadertype']=esc_attr(get_option('cb5_mheadertype'));
	$opt['fixed_top']=esc_attr(get_option('cb5_fixed_top'));
	$opt['slide_type']=esc_attr(get_option('cb5_slide_type'));
	$opt['slidertoptint']=esc_attr(get_option('cb5_slidertoptint'));
	$opt['slide_home']=esc_attr(get_option('cb5_slide_home')); 

	$cb5_post_options = get_post_meta($pid, '_cb5_header', true);
	$opt['slide_header']=cb_get_value($cb5_post_options, 'slide_header');
	$opt['header_tint']=cb_get_value($cb5_post_options, 'header_tint');
	
	return $opt;
}
function cb_get_css_generate_options($pid) {
	$opt=array();

	$opt['fhfs']=esc_attr(get_option('cb5_fhfs'));
	$opt['hidereca']=esc_attr(get_option('cb5_hidereca'));
	$opt['disca']=esc_attr(get_option('cb5_disca'));
	$opt['hidegr']=esc_attr(get_option('cb5_hidegr'));
	$opt['remhov']=esc_attr(get_option('cb5_remhov'));
	$opt['header_line']=esc_attr(get_option('cb5_header_line'));
	$opt['blogs']=esc_attr(get_option('cb5_blogs'));
	$opt['footer_h_color']=esc_attr(get_option('cb5_footer_h_color'));
	$opt['footer_text_color']=esc_attr(get_option('cb5_footer_text_color'));
	$opt['bg_fixed']=esc_attr(get_option('cb5_bg_fixed'));
	$opt['cap_bg']=esc_attr(get_option('cb5_cap_bg'));
	$opt['grid']=esc_attr(get_option('cb5_grid'));
	$opt['skinimp']=esc_attr(get_option('cb5_skinimp'));
	$opt['flat']=esc_attr(get_option('cb5_flat'));
	$opt['bg_str']=esc_attr(get_option('cb5_bg_str'));
	$opt['bgf_str']=esc_attr(get_option('cb5_bgf_str'));
	$opt['fixed_top']=esc_attr(get_option('cb5_fixed_top'));
	$opt['disable_pp']=esc_attr(get_option('cb5_disable_pp'));
	$opt['middle_background']=esc_attr(get_option('cb5_middle_background'));
	$opt['middle_backgroundi']=esc_attr(get_option('cb5_middle_backgroundi'));
	$opt['middle_backgroundc']=esc_attr(get_option('cb5_middle_backgroundc'));
	$opt['ht_background']=esc_attr(get_option('cb5_ht_background'));
	$opt['mheadertype']=esc_attr(get_option('cb5_mheadertype'));
	$opt['htb_background']=esc_attr(get_option('cb5_htb_background'));
	$opt['menu_color']=esc_attr(get_option('cb5_menu_color'));
	$opt['menu_color_active']=esc_attr(get_option('cb5_menu_color_active'));
	$opt['menu_color_hover']=esc_attr(get_option('cb5_menu_color_hover'));
	$opt['menu_color_a']=esc_attr(get_option('cb5_menu_color_a'));
	$opt['menu_color_ac']=esc_attr(get_option('cb5_menu_color_ac'));
	$opt['menu_color_h']=esc_attr(get_option('cb5_menu_color_h'));
	$opt['menu_up']=esc_attr(get_option('cb5_menu_up'));
	$opt['menu_upw']=esc_attr(get_option('cb5_menu_upw'));
	$opt['text_color']=esc_attr(get_option('cb5_text_color'));
	$opt['logo_color']=esc_attr(get_option('cb5_logo_color'));
	$opt['logo_shad']=esc_attr(get_option('cb5_logo_shad'));
	$opt['slogan_color']=esc_attr(get_option('cb5_slogan_color'));
	$opt['background_color']=esc_attr(get_option('cb5_background_color'));
	$opt['c_name']=esc_attr(get_option('cb5_c_name'));
	$opt['logo_font']=esc_attr(get_option('cb5_logo_font'));
	$opt['headh']=esc_attr(get_option('cb5_headh'));
	$opt['headhc']=esc_attr(get_option('cb5_headhc'));
	$opt['upload_bg']=esc_attr(get_option('cb5_upload_bg'));
	$opt['headertransparent']=esc_attr(get_option('cb5_headertransparent'));
	
	$opt['bodyfs']=esc_attr(get_option('cb5_bodyfs'));
	$opt['h1fs']=esc_attr(get_option('cb5_h1fs'));
	$opt['h1fts']=esc_attr(get_option('cb5_h1fts'));
	$opt['h2fs']=esc_attr(get_option('cb5_h2fs'));
	$opt['h3fs']=esc_attr(get_option('cb5_h3fs'));
	$opt['h4fs']=esc_attr(get_option('cb5_h4fs'));
	$opt['h5fs']=esc_attr(get_option('cb5_h5fs'));
	$opt['h6fs']=esc_attr(get_option('cb5_h6fs'));
	$opt['h1fc']=esc_attr(get_option('cb5_h1fc'));
	$opt['h1sc']=esc_attr(get_option('cb5_h1sc'));
	
	$opt['color_schema']=esc_attr(get_option('cb5_color_schema'));
	$opt['color_style']=esc_attr(get_option('cb5_color_style'));
	$opt['stripes_bg_schema']=esc_attr(get_option('cb5_stripes_bg_schema'));
	
	$opt['background']=esc_attr(get_option('cb5_background'));
	$opt['slidertoptint']=esc_attr(get_option('cb5_slidertoptint'));
	$opt['icons_bottom_margin']=esc_attr(get_option('cb5_icons_bottom_margin'));
	
	$opt['font_family']=esc_attr(get_option('cb5_font_family'));
	$opt['font_family_google']=esc_attr(get_option('cb5_font_family_google'));
	$opt['font_family_head']=esc_attr(get_option('cb5_font_family_head'));
	$opt['font_family_google_head']=esc_attr(get_option('cb5_font_family_google_head'));
	$opt['font_family_google_head_title']=esc_attr(get_option('cb5_font_family_google_head_title'));
	$opt['font_family_google_head_title2']=esc_attr(get_option('cb5_font_family_google_head_title2'));
	
	$opt['menu_font_size']=esc_attr(get_option('cb5_menu_font_size'));
	$opt['color_master']=esc_attr(get_option('cb5_color_master'));
	$opt['mwid']=esc_attr(get_option('cb5_mwid'));
	$opt['headings_color']=esc_attr(get_option('cb5_headings_color'));
	$opt['links_color']=esc_attr(get_option('cb5_links_color'));
	$opt['links_hover_color']=esc_attr(get_option('cb5_links_hover_color'));
	$opt['pfilter_color']=esc_attr(get_option('cb5_pfilter_color'));
	$opt['pfilter_bgcolor']=esc_attr(get_option('cb5_pfilter_bgcolor'));
	$opt['menu_color']=esc_attr(get_option('cb5_menu_color'));
	$opt['menu_color_a']=esc_attr(get_option('cb5_menu_color_a'));
	$opt['menu_color_h']=esc_attr(get_option('cb5_menu_color_h'));
	$opt['menu_up']=esc_attr(get_option('cb5_menu_up'));
	$opt['menu_upw']=esc_attr(get_option('cb5_menu_upw'));
	$opt['menu_font_color']=esc_attr(get_option('cb5_menu_font_color'));
	$opt['menu_hover_color']=esc_attr(get_option('cb5_menu_hover_color'));
	
	$opt['h_title']=esc_attr(get_option('cb5_h_title'));
	$opt['h_more']=esc_attr(get_option('cb5_h_more'));
	$opt['wid']=esc_attr(get_option('cb5_wid'));
	$opt['o_head']=esc_attr(get_option('cb5_o_head'));
	$opt['mw']=esc_attr(get_option('cb5_mw'));
	$opt['mwh']=esc_attr(get_option('cb5_mwh'));
	$opt['m_color']=esc_attr(get_option('cb5_m_color'));
	$opt['bors']=esc_attr(get_option('cb5_bors'));
	$opt['bors_h']=esc_attr(get_option('cb5_bors_h'));
	$opt['bors_f']=esc_attr(get_option('cb5_bors_f'));
	$opt['logo_f']=esc_attr(get_option('cb5_logo_f'));
	$opt['menu_f']=esc_attr(get_option('cb5_menu_f'));
	$opt['showtopwidget']=esc_attr(get_option('cb5_showtopwidget'));
	$opt['hide_top']=esc_attr(get_option('cb5_hide_top'));
	$opt['iconspos']=esc_attr(get_option('cb5_iconspos'));
	$opt['full_slider']=esc_attr(get_option('cb5_full_slider'));
	
	$opt['h_sid']=esc_attr(get_option('cb5_h_sid'));
	
	$opt['add_css']=esc_attr(get_option('cb5_add_css'));
	$opt['headings_up']=esc_attr(get_option('cb5_headings_up'));
	$opt['headings_upw']=esc_attr(get_option('cb5_headings_upw'));
	$opt['headings_upwt']=esc_attr(get_option('cb5_headings_upwt'));
	$opt['pfilter_color']=esc_attr(get_option('cb5_pfilter_color'));
	$opt['dfixed']=esc_attr(get_option('cb5_dfixed'));

	$cb5_header=get_post_meta($pid, '_cb5_header', true);
	$opt['header_type']=cb_get_value($cb5_header, 'header_type');
	$opt['home_slider']=cb_get_value($cb5_header, 'home_slider');
	$opt['header_bg_color']=cb_get_value($cb5_header, 'header_bg_color');
	$opt['bread_color']=cb_get_value($cb5_header, 'bread_color');
	$opt['sloganpc']=cb_get_value($cb5_header, 'slogan_color');
	$opt['sloganph']=cb_get_value($cb5_header, 'slogan_margin');
	$opt['header_color']=cb_get_value($cb5_header, 'header_color');
	$opt['header_shadow_color']=cb_get_value($cb5_header, 'header_shadow_color');
	$opt['ht_backgroundp']=cb_get_value($cb5_header, 'ht_backgroundp');
	$opt['ht_backgroundpm']=cb_get_value($cb5_header, 'ht_backgroundpm');
	$opt['top_padding']=cb_get_value($cb5_header, 'top_padding');
	$opt['hide_h']=cb_get_value($cb5_header, 'hide_h');
	$opt['hide_f']=cb_get_value($cb5_header, 'hide_f');
	$opt['ccss']=cb_get_value($cb5_header, 'css');
	$opt['cb_type']=esc_attr(get_post_meta($pid, '_cb5_post_type', 'true'));

	$opt['cb_loader']=esc_attr(get_option('cb5_loader'));
	$opt['cb_loader_bg']=esc_attr(get_option('cb5_loader_bg'));
	
	
	return $opt;
}

function cb_get_woo_options($pid){
	$opt=array();

	$opt['sidebar_shop']=esc_attr(get_option('cb5_sidebar_shop'));
	$opt['woo_menu']=esc_attr(get_option('cb5_woo_menu'));
	$opt['woo_pagi']=esc_attr(get_option('cb5_woo_pagi'));
	$opt['woo_cols']=esc_attr(get_option('cb5_woo_cols'));
	$opt['woo_per_page']=esc_attr(get_option('cb5_woo_per_page'));
	$opt['woo_related_c']=esc_attr(get_option('cb5_woo_related_c'));
	$opt['woo_related_n']=esc_attr(get_option('cb5_woo_related_n'));
	$opt['woo_catalog']=esc_attr(get_option('cb5_woo_catalog'));
	$opt['woo_previews']=esc_attr(get_option('cb5_woo_previews'));
	

	return $opt;
}

function cb_get_foot_options(){
	$opt=array();
	$opt['fstyle']=esc_attr(get_option('cb5_fstyle'));
	$opt['fcols']=esc_attr(get_option('cb5_fcols'));
	return $opt;
}


function cb_get_image_options($pid) {
	$opt=array();
	$opt['global_fade']=esc_attr(get_option('cb5_global_fade'));
	$opt['echo']=esc_attr(get_option('cb5_echo'));
	$opt['global_fade_effect']=esc_attr(get_option('cb5_global_fade_effect'));
	return $opt;
}
?>