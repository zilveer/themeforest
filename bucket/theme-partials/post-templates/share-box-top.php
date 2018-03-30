<?php
//deal with the excerpt
$excerpt = apply_filters( 'the_excerpt', get_the_excerpt() );

// Enable formatting in excerpts - Add HTML tags that you want to be parsed in excerpts
$allowed_tags = '<a><strong><i>';
$excerpt = htmlentities(strip_tags($excerpt, $allowed_tags));
?>

<div id="share-box-top" class="share-box-top">
	<?php
	if ( function_exists( 'display_pixlikes' ) ) {
		display_pixlikes();
	}

	get_template_part('theme-partials/wpgrade-partials/addthis-social-buttons');
	?>
</div>