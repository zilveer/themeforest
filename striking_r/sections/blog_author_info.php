<?php
if(!function_exists('theme_section_blog_author_info')){
/**
 * The default template for displaying blog author info in the pages
 */
function theme_section_blog_author_info(){
	switch(theme_get_option('blog','author_link_to_website')){
		case 'website':
			$author = get_the_author_link();
			break;
		case 'archive':
			$author = get_the_author_posts_link();
			break;
		case 'none':
		default:
			$author = get_the_author();
	}
	$output = '<section id="about_the_author">'.
	'<h3>'.__('About the author','striking-r').'</h3>'.
	'<div class="author_content">'.
	'<div class="gravatar">'.get_avatar( get_the_author_meta('user_email'), '60' ).'</div>'.
	'<div class="author_info">'.
		'<div class="author_name author vcard"><span class="fn">'.$author.'</span></div>'.
		'<p class="author_desc">'.get_the_author_meta('description').'</p>'.
	'</div>'.
	'<div class="clearboth"></div>'.
	'</div>'.
	'</section>';
	return $output;
}
}