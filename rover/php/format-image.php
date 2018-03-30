<?php 
/**
 * Image Content
 * @package by Theme Record
 * @auther: MattMao
 */

function theme_content_image() 
{
	#Get meta
	$size = 'blog';
	$title = get_the_title();
	$url_file = get_image_url();

	if(has_post_thumbnail())
	{
		echo '<div class="entry-image">'."\n";
		echo '<div class="post-thumb post-thumb-hover post-thumb-preload">'."\n";
		echo '<a href="'.$url_file.'" title="'.$title.'" class="loader-icon fancybox">';
		echo get_featured_image($post_id=NULL, $size, 'wp-preload-image', $title);
		echo '</a>';
		echo '</div>'."\n";
		echo '</div>'."\n";		
	}
}
?>