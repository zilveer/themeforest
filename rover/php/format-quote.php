<?php 
/**
 * Quote Content
 * @package by Theme Record
 * @auther: MattMao
 */

function theme_content_quote() 
{
	#Get meta
	$quote = get_meta_option('blog_type_quote');
	$quote_from = get_meta_option('blog_type_quote_from');

	if($quote)
	{
		echo '<div class="entry-quote">'."\n";
		echo '<h2 class="entry-title">'.$quote.'</h2>';
		if($quote_from){ echo '<span class="sub-title">&mdash; '.$quote_from.'</span>'."\n"; }
		echo '</div>'."\n";
	}
}
?>