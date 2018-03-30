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

echo '<a class="postsummaryimage" href="'. get_permalink() .'">';
// Show Image	
echo display_post_image (
	$post->ID,
	$have_image_url=false,
	$link=false,
	$type=$posthead_size,
	$post->post_title,
	$class="" 
);
echo '</a>';
?>

<div class="entry-post-wrapper">

<?php
	get_template_part( 'includes/postformats/post-contents' );
	get_template_part( 'includes/postformats/post-data' );
?>

</div>