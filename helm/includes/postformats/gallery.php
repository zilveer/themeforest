<?php
global $pagelayout_type;
$width=MAX_CONTENT_WIDTH;

$posthead_size="blog-full";

$blogpost_style= get_post_meta($post->ID, MTHEME . '_blogpost_style', true);
if ($blogpost_style == "Fullwidth without sidebar") {
	$posthead_size="fullwidth";
}

if ( $pagelayout_type=="fullwidth" ) {
	$posthead_size="fullwidth";
}

if ( $pagelayout_type=="two-column" ) {
	$posthead_size="blog-full";
}

$height= get_post_meta($post->ID, MTHEME . '_meta_gallery_height', true);

$flexi_slideshow = do_shortcode('[flexislideshow imagesize='.$posthead_size.']');
echo $flexi_slideshow;
?>