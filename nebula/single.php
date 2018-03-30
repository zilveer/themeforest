<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

/**
*	Get current page id
**/

$current_page_id = $post->ID;

if($post->post_type=='attachment')
{
	get_template_part("single-attachment");
	exit;
}

if($post_type == 'galleries')
{
	//Get gallery template
	$gallery_template = get_post_meta($current_page_id, 'gallery_template', true);
	switch($gallery_template)
	{	
		case 'Gallery 2 Columns':
			get_template_part("template-gallery-2");
		break;
		
		case 'Gallery 3 Columns':
			get_template_part("template-gallery-3");
		break;
		
		case 'Gallery 4 Columns':
			get_template_part("template-gallery-4");
		break;
		
		case 'Masonry Fullwidth':
			get_template_part("template-gallery-masonry");
		break;
		
		case 'Gallery Fullscreen':
			get_template_part("template-gallery-f");
		break;
		
		case 'Gallery Carousel':
			get_template_part("template-gallery-carousel");
		break;
		
		case 'Gallery Image Flow':
			get_template_part("template-gallery-flow");
		break;
		
		case 'Gallery Flip':
			get_template_part("template-gallery-flip");
		break;
		
		case 'Gallery Kenburns':
			get_template_part("template-gallery-kenburns");
		break;
		
		case 'Masonry 4 Columns Right Sidebar':
			get_template_part("template-gallery-sidebar-4");
		break;
		
		case 'Masonry 3 Columns Right Sidebar':
			get_template_part("template-gallery-sidebar-3");
		break;
		
		case 'Masonry 2 Columns Right Sidebar':
			get_template_part("template-gallery-sidebar-2");
		break;
		
		case 'Masonry 2 Columns Left Sidebar':
			get_template_part("template-gallery-sidebar-2l");
		break;
		
		case 'Masonry 3 Columns Left Sidebar':
			get_template_part("template-gallery-sidebar-3l");
		break;
		
		case 'Masonry 4 Columns Left Sidebar':
			get_template_part("template-gallery-sidebar-4l");
		break;
	}

	exit;
}
elseif($post_type == 'portfolios')
{
	//Get portfolio content type
	$portfolio_type = get_post_meta($post->ID, 'portfolio_type', true);
	
	switch($portfolio_type)
	{
		case "Fullscreen Vimeo Video":
			get_template_part("single-portfolio-vimeo");
			exit;
		break;
		
		case "Fullscreen Youtube Video":
			get_template_part("single-portfolio-youtube");
			exit;
		break;
		
		case "Fullscreen Self-Hosted Video":
			get_template_part("single-portfolio-self-hosted");
			exit;
		break;
		
		case "Portfolio Content":
		default:
			//Get portfolio content template
			$portfolio_content_template = get_post_meta($post->ID, 'portfolio_content_template', true);
			
			if($portfolio_content_template == 'With Sidebar')
			{
				get_template_part("single-portfolio-r");
			}
			else
			{
				get_template_part("single-portfolio-f");
			}
			exit;
		break;
	}
	exit;
}
else
{
	$post_layout = get_post_meta($post->ID, 'post_layout', true);
	
	global $prev_post;
	$prev_post = get_previous_post();
	
	if($post_layout=='With Sidebar')
	{
		get_template_part("single-post-r");
		exit;
	}
	else
	{
		get_template_part("single-post-f");
		exit;
	}
}
?>