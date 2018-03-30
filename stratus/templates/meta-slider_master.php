<?php
/*****************************
	Master Slider Template
*****************************/

if(isset($post->ID)){
	$postID = $post->ID;
}else{
	$postID = get_the_ID();
}

$metadata = get_post_meta($postID);
$key = 'themo_slider_master';
$show = get_post_meta($postID, $key.'_show', true );
$shortcode = get_post_meta($postID, $key.'_shortcode', true );

if($show && $shortcode){
	echo do_shortcode(sanitize_text_field($shortcode));
}
