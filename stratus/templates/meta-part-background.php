<?php
//-----------------------------------------------------
// BACKGROUND & PADDING OPTIONS out OUTPUT Inline Style Sheet
//-----------------------------------------------------
$parallax_classes="";
$parallax_data="";

$themo_page_ID = $post->ID;

// Support for Woo Pages.
// Sometimes the page id isn't explicit so we have to go and look for it.
$themo_woo_page_ID = themo_return_woo_page_ID();
if($themo_woo_page_ID){
    $themo_page_ID = $themo_woo_page_ID;
}

/* We can also use arrays if present */
if(isset($options_array) && !empty( $options_array )){
	$background_show = $options_array[$key.'_show_background'];
	$background =  $options_array[$key.'_background'];
	$background_parallax_show =  $options_array[$key.'_parallax'];
	$text_contrast =  $options_array[$key.'_text_contrast'];
	$padding_show = $options_array[$key.'_padding'];
	$top_padding = $options_array[$key.'_top_padding'];
	$bottom_padding = $options_array[$key.'_bottom_padding'];
}elseif (isset($themo_custom_post_type_meta) && $themo_custom_post_type_meta){
    $background_show = get_post_meta($themo_page_ID , '__show_background', true );
	$background = array(); //get_post_meta($themo_page_ID , $key.'_background', true );
	$background['background-image'] = get_post_meta($themo_page_ID , '__background_image', true );
	$background['background-color'] = get_post_meta($themo_page_ID , '__background_color', true );
	$background['background-repeat'] = get_post_meta($themo_page_ID , '__background_repeat', true );
	$background['background-position'] = get_post_meta($themo_page_ID , '__background_position', true );
	$background['background-attachment'] = get_post_meta($themo_page_ID , '__background_attachment', true );
	$background['background-size'] = get_post_meta($themo_page_ID , '__background_size', true );

	$background_parallax_show = get_post_meta($themo_page_ID , '__parallax', true );
	$text_contrast = get_post_meta($themo_page_ID , '__text_contrast', true );
	$padding_show = get_post_meta($themo_page_ID , '__padding', true );
	$top_padding = get_post_meta($themo_page_ID , '__top_padding', true );
	$bottom_padding = get_post_meta($themo_page_ID , '__bottom_padding', true );
}else{
    $background_show = get_post_meta($themo_page_ID , $key.'_show_background', true );
	$background = array(); //get_post_meta($themo_page_ID , $key.'_background', true );
	$background['background-image'] = get_post_meta($themo_page_ID , $key.'_background_image', true );
	$background['background-color'] = get_post_meta($themo_page_ID , $key.'_background_color', true );
	$background['background-repeat'] = get_post_meta($themo_page_ID , $key.'_background_repeat', true );
	$background['background-position'] = get_post_meta($themo_page_ID , $key.'_background_position', true );
	$background['background-attachment'] = get_post_meta($themo_page_ID , $key.'_background_attachment', true );
	$background['background-size'] = get_post_meta($themo_page_ID , $key.'_background_size', true );

	$background_parallax_show = get_post_meta($themo_page_ID , $key.'_parallax', true );
	$text_contrast = get_post_meta($themo_page_ID , $key.'_text_contrast', true );
	$padding_show = get_post_meta($themo_page_ID , $key.'_padding', true );
	$top_padding = get_post_meta($themo_page_ID , $key.'_top_padding', true );
	$bottom_padding = get_post_meta($themo_page_ID , $key.'_bottom_padding', true );
}

// If there is a unique ID specified, use it, else use the key.
if(isset($section_uid) && $section_uid > ''){
	$section_key = $section_uid;
}else{
	$section_key = $key;
}

// If the page has a sidebar, hide background options, except for Page Header.
if (isset($page_layout) && (isset($key))){
	if(($page_layout == 'right' || $page_layout == 'left') && ($key != 'themo_page_header_1')) {
		$background_show = 'off';
	}
}

themo_return_meta_box_background_markup($background_show,$background,$background_parallax_show,$parallax_classes,$parallax_data,$background_css,$background_js,$section_key,$text_contrast);
themo_return_meta_box_padding_markup($padding_show,$top_padding,$bottom_padding,$padding_css,$section_key);

if ($background_css > "" || $padding_css > ""){ ?>
<style scoped>
<?php echo sanitize_text_field($background_css);  // PARALLAX INLINE CSS ?>
<?php echo sanitize_text_field($padding_css);  // PADDING CSS ?>
</style>
<?php }