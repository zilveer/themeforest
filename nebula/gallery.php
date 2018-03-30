<?php
/**
 * Template Name: Gallery
 * The main template file for display gallery page
 *
 * @package WordPress
*/

$page_gallery_id = get_post_meta($post->ID, 'page_gallery_id', true);
$gallery_template = get_post_meta($page_gallery_id, 'gallery_template', true);
global $page_gallery_id;

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
    
    case 'Gallery 4 Columns Left Sidebar':
    	get_template_part("template-gallery-sidebar-4l");
    break;
}

exit;
?>