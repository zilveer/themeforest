<?php
/* this file gets every option from cosmetico single post */
$cb_type=esc_attr(get_post_meta($post->ID, 'cb5_cb_type', $single = true));
$header_bg_image=esc_attr(get_post_meta($post->ID, 'cb5_header_bg_image', $single = true));
$header_bg_color=esc_attr(get_post_meta($post->ID, 'cb5_header_bg_color', $single = true));
$header_type=esc_attr(get_post_meta($post->ID, 'cb5_header_type', $single = true));
if($header_type=='slider_head') $slider_home=esc_attr(get_post_meta($post->ID, 'cb5_home_slider', $single = true)); else $slider_home='';

$cats=esc_attr(get_post_meta($post->ID, 'cb5_cats', $single = true));
$sidebar_post=esc_attr(get_post_meta($post->ID, 'cb5_sidebar', $single = true));
$sidebar_post_name=esc_attr(get_post_meta($post->ID, 'cb5_sidebar_name', $single = true));
$columns=esc_attr(get_post_meta($post->ID, 'cb5_columns', $single = true));
$per_page=esc_attr(get_post_meta($post->ID, 'cb5_per_page', $single = true));
$plink=esc_attr(get_post_meta($post->ID, 'cb5_plink', $single = true));
$title=esc_attr(get_post_meta($post->ID, 'cb5_title', $single = true));
$slidertoptintp=esc_attr(get_post_meta($post->ID, 'cb5_slidertoptintp', $single = true));
$sloganp=esc_attr(get_post_meta($post->ID, 'cb5_sloganp', $single = true));
$sloganpc=esc_attr(get_post_meta($post->ID, 'cb5_sloganpc', $single = true));
$sloganph=esc_attr(get_post_meta($post->ID, 'cb5_sloganph', $single = true));
$ht_backgroundp=esc_attr(get_post_meta($post->ID, 'cb5_ht_backgroundp', $single = true));
$aligp=esc_attr(get_post_meta($post->ID, 'cb5_alig', $single = true));
$aligbc=esc_attr(get_post_meta($post->ID, 'cb5_aligbc', $single = true));
$aligtc=esc_attr(get_post_meta($post->ID, 'cb5_aligtc', $single = true));
$aligh=esc_attr(get_post_meta($post->ID, 'cb5_aligh', $single = true));

$aurl=esc_attr(get_post_meta($post->ID, 'cb5_aurl', $single = true));
$vurl=esc_attr(get_post_meta($post->ID, 'cb5_vurl', $single = true));

$map_z=esc_attr(get_post_meta($post->ID, 'cb5_map_z', $single = true));
$map_a=esc_attr(get_post_meta($post->ID, 'cb5_map_a', $single = true));
$map_t=esc_attr(get_post_meta($post->ID, 'cb5_map_t', $single = true));

$s_auto=esc_attr(get_post_meta($post->ID, 'cb5_s_auto', $single = true));
$s_delay=esc_attr(get_post_meta($post->ID, 'cb5_s_delay', $single = true));
$s_ani_time=esc_attr(get_post_meta($post->ID, 'cb5_s_ani_time', $single = true));
$s_easing=esc_attr(get_post_meta($post->ID, 'cb5_s_easing', $single = true));
$s_beh=esc_attr(get_post_meta($post->ID, 'cb5_s_beh', $single = true));
$s_frame=esc_attr(get_post_meta($post->ID, 'cb5_s_frame', $single = true));

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
$sfc=esc_attr(get_post_meta($post->ID, 'cb5_sfc', $single = true));

$cb_type=esc_attr(get_post_meta($post->ID, 'cb5_cb_type', $single = true));
$header_type=esc_attr(get_post_meta($post->ID, 'cb5_header_type', $single = true));
$header_bg_color=esc_attr(get_post_meta($post->ID, 'cb5_header_bg_color', $single = true));
$bread_color=esc_attr(get_post_meta($post->ID, 'cb5_bread_color', $single = true));
?>
