<?php
/**
 * The main template file for display archive page.
 *
 * @package WordPress
*/

//Check if portfolio post type then go to another template
$post_type = get_post_type();

if($post_type == 'portfolios')
{
	//Get portfolio category page template
	$obj_term = get_term_by('slug', $term, 'portfoliosets');
	$term_meta = get_option( "taxonomy_term_$obj_term->term_id" );
	$tg_page_template = $term_meta['portfoliosets_template'];
	
	if(file_exists(get_template_directory() . "/".$tg_page_template.".php"))
	{
		get_template_part($tg_page_template);
	}
	else
	{
		get_template_part("portfolio-2-contained");
	}
	exit;
}
elseif($post_type == 'galleries')
{
	//Get gallery category page template
	$obj_term = get_term_by('slug', $term, 'gallerycat');
	$term_meta = get_option( "taxonomy_term_$obj_term->term_id" );
	$tg_page_template = $term_meta['gallerycat_template'];
	
	if(file_exists(get_template_directory() . "/".$tg_page_template.".php"))
	{
		get_template_part($tg_page_template);
	}
	else
	{
		get_template_part("gallery-archive-2-contained");
	}
	
	exit;
}
else
{
	//Get archive page layout setting
	$tg_blog_archive_layout = kirki_get_option('tg_blog_archive_layout');
	
	$located = locate_template($tg_blog_archive_layout.'.php');
	if (!empty($located))
	{
		get_template_part($tg_blog_archive_layout);
	}
	else
	{
		get_template_part('blog_r');
	}
}
?>