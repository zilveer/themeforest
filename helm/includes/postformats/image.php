<?php
global $pagelayout_type;
$width=MAX_CONTENT_WIDTH;
$single_height='';

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

$lightbox_status= get_post_meta($post->ID, MTHEME . '_meta_lightbox', true);
$image_link=featured_image_link($post->ID);

if ($lightbox_status=="Enable Lightbox") {
	echo '<a class="postformat-image-lightbox" rel="prettyPhoto" href="'. $image_link .'">';
} else {
	echo '<a href="'. get_permalink() .'">';
}
echo display_post_image (
	$post->ID,
	$have_image_url=false,
	$link=false,
	$type=$posthead_size,
	$post->post_title,
	$class="postformat-image" 
);
echo '</a>';
?>
<div class="entry-post-wrapper">

<?php
	get_template_part( 'includes/postformats/post-contents' );
	get_template_part( 'includes/postformats/post-data' );
?>

</div>