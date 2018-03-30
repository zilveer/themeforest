<?php
$width=MAX_CONTENT_WIDTH;
$single_height='';

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
	$type="blog-full",
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