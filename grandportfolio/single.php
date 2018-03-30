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

if($post->post_type == 'galleries')
{
	//Get gallery template
	$gallery_template = get_post_meta($current_page_id, 'gallery_template', true);
	switch($gallery_template)
	{	
		case 'Gallery Fullscreen Cover':
	    default:
			get_template_part("gallery-fullscreen-cover");
		break;
		
		case 'Gallery Fullscreen':
			get_template_part("gallery-fullscreen");
		break;
		
		case 'Gallery Kenburns':
			get_template_part("gallery-kenburns");
		break;
		
		case 'Gallery Horizontal':
			get_template_part("gallery-horizontal");
		break;
		
		case 'Gallery Horizontal Contained':
			get_template_part("gallery-horizontal-contained");
		break;
		
		case 'Gallery Striped':
			get_template_part("gallery-striped");
		break;
		
		case 'Gallery Flow':
			get_template_part("gallery-flow");
		break;
		
		case 'Gallery Split Screen':
			get_template_part("gallery-split-screen");
		break;
		
		case 'Gallery Split Screen Wide':
			get_template_part("gallery-split-screen-wide");
		break;
		
		case 'Gallery 1 Column Contained':
			get_template_part("gallery-1-contained");
		break;
		
		case 'Gallery 2 Columns Contained':
			get_template_part("gallery-2-contained");
		break;
		
		case 'Gallery 3 Columns Contained':
			get_template_part("gallery-3-contained");
		break;
		
		case 'Gallery 4 Columns Contained':
			get_template_part("gallery-4-contained");
		break;
		
		case 'Gallery Mixed Masonry Contained':
			get_template_part("gallery-mixed-contained");
		break;
		
		case 'Gallery Masonry 2 Columns Contained':
			get_template_part("gallery-2-contained-masonry");
		break;
		
		case 'Gallery Masonry 3 Columns Contained':
			get_template_part("gallery-3-contained-masonry");
		break;
		
		case 'Gallery Masonry 4 Columns Contained':
			get_template_part("gallery-4-contained-masonry");
		break;
		
		case 'Gallery 2 Columns Wide':
			get_template_part("gallery-2-wide");
		break;
		
		case 'Gallery 3 Columns Wide':
			get_template_part("gallery-3-wide");
		break;
		
		case 'Gallery 4 Columns Wide':
			get_template_part("gallery-4-wide");
		break;
		
		case 'Gallery 5 Columns Wide':
			get_template_part("gallery-5-wide");
		break;
		
		case 'Gallery Mixed Masonry Wide':
			get_template_part("gallery-mixed-wide");
		break;
		
		case 'Gallery Masonry 2 Columns Wide':
			get_template_part("gallery-2-wide-masonry");
		break;
		
		case 'Gallery Masonry 3 Columns Wide':
			get_template_part("gallery-3-wide-masonry");
		break;
		
		case 'Gallery Masonry 4 Columns Wide':
			get_template_part("gallery-4-wide-masonry");
		break;
		
		case 'Gallery Masonry 5 Columns Wide':
			get_template_part("gallery-5-wide-masonry");
		break;
		
		case 'Gallery Photo Proofing':
			get_template_part("gallery-proofing");
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
		case "Vimeo Video":
			get_template_part("single-portfolio-vimeo");
			exit;
		break;
		
		case "Youtube Video":
			get_template_part("single-portfolio-youtube");
			exit;
		break;
		
		case "Self-Hosted Video":
			get_template_part("single-portfolio-self-hosted");
			exit;
		break;
		
		case "Portfolio Content":
		default:
			get_template_part("single-portfolio");
			exit;
		break;
	}
	exit;
}
elseif($post_type == 'events')
{
	get_template_part("single-event");
}
else
{
	$post_layout = get_post_meta($post->ID, 'post_layout', true);
	
	switch($post_layout)
	{
		case "With Right Sidebar":
		default:
			get_template_part("single-post-r");
			exit;
		break;
		
		case "With Left Sidebar":
			get_template_part("single-post-l");
			exit;
		break;
		
		case "Fullwidth":
			get_template_part("single-post-f");
			exit;
		break;
		
		case "Split Screen":
			get_template_part("single-post-split");
			exit;
		break;
	}
}
?>