<?php
/* this file gets every option from cosmetico page */
if(isset($post->ID)&&!is_404()){

	$cb_type=esc_attr(get_post_meta($post->ID, 'cb5_cb_type', $single = true));
	$header_bg_image=esc_attr(get_post_meta($post->ID, 'cb5_header_bg_image', $single = true));
	$header_bg_color=esc_attr(get_post_meta($post->ID, 'cb5_header_bg_color', $single = true));
	$header_type=esc_attr(get_post_meta($post->ID, 'cb5_header_type', $single = true));
	if($header_type=='slider_head') $slider_home=esc_attr(get_post_meta($post->ID, 'cb5_home_slider', $single = true)); else $slider_home='';

    $revo_type=esc_attr(get_post_meta($post->ID, 'cb5_revo_type', $single = true));
	$cb_type=esc_attr(get_post_meta($post->ID, 'cb5_cb_type', $single = true));
	$pfilter=esc_attr(get_post_meta($post->ID, 'cb5_pfilter', $single = true));
	$pajax=esc_attr(get_post_meta($post->ID, 'cb5_pajax', $single = true));

	$prod_slogan=esc_attr(get_post_meta($post->ID, 'cb5_prod_slogan', $single = true));

	$sidebar=esc_attr(get_post_meta($post->ID, 'cb5_sidebar', $single = true));
	$showbreads=esc_attr(get_post_meta($post->ID, 'cb5_breads', $single = true));
	$sidebar_name=esc_attr(get_post_meta($post->ID, 'cb5_sidebar_name', $single = true));
	$line=esc_attr(get_post_meta($post->ID, 'cb5_line', $single = true));
	$columns=esc_attr(get_post_meta($post->ID, 'cb5_columns', $single = true));
	$per_page=esc_attr(get_post_meta($post->ID, 'cb5_per_page', $single = true));
	$cats=esc_attr(get_post_meta($post->ID, 'cb5_cats', $single = true));
	$plink=esc_attr(get_post_meta($post->ID, 'cb5_plink', $single = true));
	$pshape=esc_attr(get_post_meta($post->ID, 'cb5_pshape', $single = true));
	$title=esc_attr(get_post_meta($post->ID, 'cb5_title', $single = true));
	$hfoot=esc_attr(get_post_meta($post->ID, 'cb5_hfoot', $single = true));
	$show_cat_list=esc_attr(get_post_meta($post->ID, 'cb5_show_cat_list', $single = true));
	$slidertoptintp=esc_attr(get_post_meta($post->ID, 'cb5_slidertoptintp', $single = true));
	$sloganp=esc_attr(get_post_meta($post->ID, 'cb5_sloganp', $single = true));
	$sloganpc=esc_attr(get_post_meta($post->ID, 'cb5_sloganpc', $single = true));
	$sloganph=esc_attr(get_post_meta($post->ID, 'cb5_sloganph', $single = true));
	$ht_backgroundp=esc_attr(get_post_meta($post->ID, 'cb5_ht_backgroundp', $single = true));
	$alig=esc_attr(get_post_meta($post->ID, 'cb5_alig', $single = true));

	$map_z=esc_attr(get_post_meta($post->ID, 'cb5_map_z', $single = true));
	$map_a=esc_attr(get_post_meta($post->ID, 'cb5_map_a', $single = true));
	$map_t=esc_attr(get_post_meta($post->ID, 'cb5_map_t', $single = true));

	$mediumblog=esc_attr(get_post_meta($post->ID, 'cb5_mediumblog', $single = true));

	$aurl=esc_attr(get_post_meta($post->ID, 'cb5_aurl', $single = true));
	$vurl=esc_attr(get_post_meta($post->ID, 'cb5_vurl', $single = true));

	$s_auto=esc_attr(get_post_meta($post->ID, 'cb5_s_auto', $single = true));
	$s_delay=esc_attr(get_post_meta($post->ID, 'cb5_s_delay', true));
	$s_ani_time=esc_attr(get_post_meta($post->ID, 'cb5_s_ani_time', $single = true));
	$s_easing=esc_attr(get_post_meta($post->ID, 'cb5_s_easing', $single = true));
	$s_beh=esc_attr(get_post_meta($post->ID, 'cb5_s_beh', $single = true));
	$s_frame=esc_attr(get_post_meta($post->ID, 'cb5_s_frame', $single = true));

	$my_email=esc_attr(get_post_meta($post->ID, 'cb5_my-email', $single = true));
	$my_subject=esc_attr(get_post_meta($post->ID, 'cb5_my-subject', $single = true));
	$my_name=esc_attr(get_post_meta($post->ID, 'cb5_my-name', $single = true));
	$my_question=esc_attr(get_post_meta($post->ID, 'cb5_my-question', $single = true));
	$ok_h=esc_attr(get_post_meta($post->ID, 'cb5_ok_h', $single = true));
	$ok=esc_attr(get_post_meta($post->ID, 'cb5_ok', $single = true));
	$err_h=esc_attr(get_post_meta($post->ID, 'cb5_err_h', $single = true));
	$err=esc_attr(get_post_meta($post->ID, 'cb5_err', $single = true));

	$grid=esc_attr(get_post_meta($post->ID, 'cb5_grid', $single = true));
	$gcap=esc_attr(get_post_meta($post->ID, 'cb5_gcap', $single = true));
	$fullg=esc_attr(get_post_meta($post->ID, 'cb5_fullg', $single = true));
	$bnw=esc_attr(get_post_meta($post->ID, 'cb5_bnw', $single = true));
	$zoom=esc_attr(get_post_meta($post->ID, 'cb5_zoom', $single = true));

	$header_type=esc_attr(get_post_meta($post->ID, 'cb5_header_type', $single = true));
	$header_color=esc_attr(get_post_meta($post->ID, 'cb5_header_color', $single = true));
	$header_shadow_color=esc_attr(get_post_meta($post->ID, 'cb5_header_shadow_color', $single = true));
	$header_bg_image=esc_attr(get_post_meta($post->ID, 'cb5_header_bg_image', $single = true));
	$header_height=esc_attr(get_post_meta($post->ID, 'cb5_header_height', $single = true));

	$headtfc=esc_attr(get_post_meta($post->ID,'cb5_header_color', $single = true));
	$headtsc=esc_attr(get_post_meta($post->ID,'cb5_header_shadow_color', $single = true));
	$header_bg_image=esc_attr(get_post_meta($post->ID, 'cb5_header_bg_image', $single = true));
	$header_bg_color=esc_attr(get_post_meta($post->ID, 'cb5_header_bg_color', $single = true));
	$si=esc_attr(get_post_meta($post->ID, 'cb5_si', $single = true));
	$sf=esc_attr(get_post_meta($post->ID, 'cb5_sf', $single = true));
	$pcap=esc_attr(get_post_meta($post->ID, 'cb5_pcap', $single = true));
	if(!isset($columns))$columns='';
	if($columns=='') $columns='1';

	$cb_type=esc_attr(get_post_meta($post->ID, 'cb5_cb_type', $single = true));
	$header_type=esc_attr(get_post_meta($post->ID, 'cb5_header_type', $single = true));
	$header_bg_color=esc_attr(get_post_meta($post->ID, 'cb5_header_bg_color', $single = true));
	$bread_color=esc_attr(get_post_meta($post->ID, 'cb5_bread_color', $single = true));

	$header_height=esc_attr(get_post_meta($post->ID, 'cb5_header_height', $single = true));
} else {
	$slider_home='';
	$header_type='';
	$cb_type='';
	$header_bg_image ='';
}
?>
