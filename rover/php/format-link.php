<?php 
/**
 * Link Content
 * @package by Theme Record
 * @auther: MattMao
 */

function theme_content_link() 
{
	#Get meta
	$url = get_meta_option('blog_type_url');

	if($url)
	{
		echo '<div class="entry-link">'."\n";
		echo '<h2 class="entry-title">Link &mdash; <a href="'.$url .'">'.$url.'</a></h2>';
		echo '</div>'."\n";
	}
}
?>