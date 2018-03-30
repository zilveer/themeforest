<?php

/**
 * These shortcodes are deprecated and they are left in the theme for backward compatibility
 *
 *
 * Please do not use
 *
 *
 */

/* ----- RELATED POSTS FOR CONTENT AREA -----
* This shortcode is almost identical to related_posts shortcode defined above.
* due to the fact that both exists in Karma theme for a very long time..
* @since version 4.1 - for backward compatibility, we remove it's code and map this shortcode to run related_posts shortcode.
*/
function related_posts_content_shortcode( $atts ) {
	extract(shortcode_atts(array(
		'title' => '',
		'limit' => '5',
	), $atts)); 
	return do_shortcode("[related_posts title='$title' limit='$limit']");
}
add_shortcode('related_posts_content', 'related_posts_content_shortcode');


function truethemes_lightbox_frame_constructor($style,$frame_class,$image_path,$width,$height,$framesize,$popup,$link_to_page,$image_zoom_number,$target,$description,$prettyphotogroup){
//Allow plugins/themes to override this layout.
//refer to http://codex.wordpress.org/Function_Reference/add_filter for usage
$output = apply_filters('truethemes_lightbox_frame_filter','',$style,$frame_class,$image_path,$width,$height,$framesize,$popup,$link_to_page,$image_zoom_number,$target,$description);
if ( $output != '' ){
return $output;
}
//crop image function from framework/theme-functions.php
$image_src = truethemes_crop_image($thumb=null,$image_path,$width,$height);// see above.
$output .= '[raw]<div class="'.$style.'_img_frame '.$framesize.'">';
$output .=' <div class="img-preload lightbox-img">'; //@since 4.0
//if there is a link url we display it.
if(!empty($link_to_page)){ $output.='<a href="'.$link_to_page.'" class="attachment-fadeIn" title="'.$description.'" target="'.$target.'">';
} else {
//we display popup
$output.='<a href="'.$popup.'" class="attachment-fadeIn" data-gal="prettyPhoto['.$prettyphotogroup.']" title="'.$description.'">';
}
if(!empty($link_to_page)){
$output.='<div class="lightbox-zoom zoom-'.$image_zoom_number.' zoom-link" style="position:absolute;display:none">&nbsp;</div>';
}{
$output.='<div class="lightbox-zoom zoom-'.$image_zoom_number.'" style="position:absolute;display:none">&nbsp;</div>';
}
$output .= "<img src='".$image_src."' alt='".$description."' />";
$output .='</a></div></div>[/raw]';
return $output;
}
function truethemes_lightbox_frame($atts, $content = null) {
extract(shortcode_atts(array(
'style' => '',
'image_path' => '',
'popup' => '',
'link_to_page' => '',
'description' => '',
'target' => '',
'size' => '',
'group'=>'pg_1'
), $atts));
$framesize = $style.'_'.$size;
$output = null;
/* --- FULL WIDTH - ONE_HALF (2 Column) --- */
if ($size == 'two_col_large'){
$output .= truethemes_lightbox_frame_constructor($style,'_preload_two_col_large',$image_path,437,234,$framesize,$popup,$link_to_page,'2',$target,$description,$group);
}
/* --- FULL WIDTH - ONE_THIRD (3 Column) --- */
if ($size == 'three_col_large'){
$output .= truethemes_lightbox_frame_constructor($style,'_preload_three_col_large',$image_path,275,145,$framesize,$popup,$link_to_page,'3',$target,$description,$group);
}
/* --- FULL WIDTH - ONE_FOURTH (4 Column) */
if ($size == 'four_col_large'){
$output .= truethemes_lightbox_frame_constructor($style,'_preload_four_col_large',$image_path,190,111,$framesize,$popup,$link_to_page,'4',$target,$description,$group);
}
/* --- SIDE NAV - ONE_HALF (2 Column) --- */
if ($size == 'two_col_small'){
$output .= truethemes_lightbox_frame_constructor($style,'_preload_two_col_small',$image_path,324,180,$framesize,$popup,$link_to_page,'2-small',$target,$description,$group);
}
/* --- SIDE NAV - ONE_THIRD (3 Column) --- */
if ($size == 'three_col_small'){
$output .= truethemes_lightbox_frame_constructor($style,'_preload_three_col_small',$image_path,202,113,$framesize,$popup,$link_to_page,'3-small',$target,$description,$group);
}
/* --- SIDE NAV - ONE_FOURTH (4 Column) --- */
if ($size == 'four_col_small'){
$output .= truethemes_lightbox_frame_constructor($style,'_preload_four_col_small',$image_path,135,76,$framesize,$popup,$link_to_page,'4-small',$target,$description,$group);
}
/* --- PORTRAIT STYLE - THUMBNAIL --- */
if ($size == 'portrait_thumb'){
$output .= truethemes_lightbox_frame_constructor($style,'_preload_portrait_thumb',$image_path,275,355,$framesize,$popup,$link_to_page,'portrait-small',$target,$description,$group);
}
/* --- PORTRAIT STYLE - FULL --- */
if ($size == 'portrait_full'){
$output .= truethemes_lightbox_frame_constructor($style,'_preload_portrait_full',$image_path,612,792,$framesize,$popup,$link_to_page,'portrait-full',$target,$description,$group);
}
return $output;
}
add_shortcode('lightbox', 'truethemes_lightbox_frame');
/* ----- SHADOW IMAGE FRAME ----- */
function karma_shadow_frame($atts, $content = null) {
extract(shortcode_atts(array(
'size' => 'shadow_',
'image_path' => '',
'description' => '',
'link_to_page' => '',
'target' => '',
), $atts));
/* fullsize banner */
if ($size == 'shadow_banner_full' && $link_to_page != ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='banner_full']");
}
elseif ($size == 'shadow_banner_full' && $link_to_page == ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' target='$target' description='$description' size='banner_full']");
}
/* regular banner */
if ($size == 'shadow_banner_regular' && $link_to_page != ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='banner_regular']");
}
elseif ($size == 'shadow_banner_regular' && $link_to_page == ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' target='$target' description='$description' size='banner_regular']");
}
/* half banner */
if ($size == 'shadow_banner_small' && $link_to_page != ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='banner_small']");
}
elseif ($size == 'shadow_banner_small' && $link_to_page == ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' target='$target' description='$description' size='banner_small']");
}
/* two_col_large */
elseif ($size == 'shadow_two_col_large' && $link_to_page != ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='two_col_large']");
}
elseif ($size == 'shadow_two_col_large' && $link_to_page == ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' target='$target' description='$description' size='two_col_large']");
}
/* two_col_small */
elseif ($size == 'shadow_two_col_small' && $link_to_page != ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='two_col_small']");
}
elseif ($size == 'shadow_two_col_small' && $link_to_page == ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' target='$target' description='$description' size='two_col_small']");
}
/* three_col_large */
elseif ($size == 'shadow_three_col_large' && $link_to_page != ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='three_col_large']");
}
elseif ($size == 'shadow_three_col_large' && $link_to_page == ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' target='$target' description='$description' size='three_col_large']");
}
/* three_col_small */
elseif ($size == 'shadow_three_col_small' && $link_to_page != ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='three_col_small']");
}
elseif ($size == 'shadow_three_col_small' && $link_to_page == ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' target='$target' description='$description' size='three_col_small']");
}
/* four_col_large */
elseif ($size == 'shadow_four_col_large' && $link_to_page != ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='four_col_large']");
}
elseif ($size == 'shadow_four_col_large' && $link_to_page == ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' target='$target' description='$description' size='four_col_large']");
}
/* four_col_small */
elseif ($size == 'shadow_four_col_small' && $link_to_page != ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='four_col_small']");
}
elseif ($size == 'shadow_four_col_small' && $link_to_page == ''){
$output = do_shortcode("[frame style='shadow' image_path='$image_path' target='$target' description='$description' size='four_col_small']");
}
return $output;
}
add_shortcode('shadowframe', 'karma_shadow_frame');
/* ----- MODERN IMAGE FRAME ----- */
function karma_modern_frame($atts, $content = null) {
extract(shortcode_atts(array(
'size' => '',
'image_path' => '',
'description' => '',
'link_to_page' => '',
'target' => '',
), $atts));
/* fullsize banner */
if ($size == 'modern_banner_full' && $link_to_page != ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='banner_full']");
}
elseif ($size == 'modern_banner_full' && $link_to_page == ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' target='$target' description='$description' size='banner_full']");
}
/* regular banner */
if ($size == 'modern_banner_regular' && $link_to_page != ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='banner_regular']");
}
elseif ($size == 'modern_banner_regular' && $link_to_page == ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' target='$target' description='$description' size='banner_regular']");
}
/* half banner */
if ($size == 'modern_banner_small' && $link_to_page != ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='banner_small']");
}
elseif ($size == 'modern_banner_small' && $link_to_page == ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' target='$target' description='$description' size='banner_small']");
}
/* two_col_large */
elseif ($size == 'modern_two_col_large' && $link_to_page != ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='two_col_large']");
}
elseif ($size == 'modern_two_col_large' && $link_to_page == ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' target='$target' description='$description' size='two_col_large']");
}
/* two_col_small */
elseif ($size == 'modern_two_col_small' && $link_to_page != ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='two_col_small']");
}
elseif ($size == 'modern_two_col_small' && $link_to_page == ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' target='$target' description='$description' size='two_col_small']");
}
/* three_col_large */
elseif ($size == 'modern_three_col_large' && $link_to_page != ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='three_col_large']");
}
elseif ($size == 'modern_three_col_large' && $link_to_page == ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' target='$target' description='$description' size='three_col_large']");
}
/* three_col_small */
elseif ($size == 'modern_three_col_small' && $link_to_page != ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='three_col_small']");
}
elseif ($size == 'modern_three_col_small' && $link_to_page == ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' target='$target' description='$description' size='three_col_small']");
}
/* four_col_large */
elseif ($size == 'modern_four_col_large' && $link_to_page != ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='four_col_large']");
}
elseif ($size == 'modern_four_col_large' && $link_to_page == ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' target='$target' description='$description' size='four_col_large']");
}
/* four_col_small */
elseif ($size == 'modern_four_col_small' && $link_to_page != ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' link_to_page='$link_to_page' target='$target' description='$description' size='four_col_small']");
}
elseif ($size == 'modern_four_col_small' && $link_to_page == ''){
$output = do_shortcode("[frame style='modern' image_path='$image_path' target='$target' description='$description' size='four_col_small']");
}
return $output;
}
add_shortcode('modernframe', 'karma_modern_frame');
/* callout boxes */
function karma_green_callout( $atts, $content = null ) {
return '[raw]<p class="message_green">' . do_shortcode($content) . '</p><br class="clear" />[/raw]';
}
add_shortcode('green_callout', 'karma_green_callout');
function karma_blue_callout( $atts, $content = null ) {
return '[raw]<p class="message_blue">' . do_shortcode($content) . '</p><br class="clear" />[/raw]';
}
add_shortcode('blue_callout', 'karma_blue_callout');
function karma_red_callout( $atts, $content = null ) {
return '[raw]<p class="message_red">' . do_shortcode($content) . '</p><br class="clear" />[/raw]';
}
add_shortcode('red_callout', 'karma_red_callout');
function karma_yellow_callout( $atts, $content = null ) {
return '[raw]<p class="message_yellow">' . do_shortcode($content) . '</p><br class="clear" />[/raw]';
}
add_shortcode('yellow_callout', 'karma_yellow_callout');
?>