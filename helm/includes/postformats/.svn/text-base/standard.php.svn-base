<?php
$width=MAX_CONTENT_WIDTH;
$single_height='';

echo '<a class="postsummaryimage" href="'. get_permalink() .'">';
// Show Image	
echo display_post_image (
	$post->ID,
	$have_image_url=false,
	$link=false,
	$type="blog-full",
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