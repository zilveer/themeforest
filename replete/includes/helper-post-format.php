<?php

/*
 * 	The loop-index.php file is responsible to display wordpress blog posts
 *	Since this theme supports post formats (different styling and behaviour of certain posts, for example galleries, tweets etc)
 *	the output of the  loop-index.php file is filtered before it is passed to the users browser.
 *	
 *	The filtering takes place in the functions defined in this file
 */
 
 
 
// ========================= default post format ============================

add_filter( 'post-format-standard', 'avia_default_title_filter', 10, 1 ); 

// ========================= gallery post format ============================

add_filter( 'post-format-gallery', 	 'avia_gallery_slideshow_filter', 10, 1 ); 
 
// ========================= video post format ==============================

add_filter( 'post-format-video', 'avia_video_slideshow_filter', 10, 1 ); 

// ========================= image post format ==============================

add_filter( 'post-format-image', 'avia_image_slideshow_filter', 10, 1 ); 

// ========================= link post format ===============================

add_filter( 'post-format-link', 'avia_link_content_filter', 10, 1 ); 

// ========================= blockquote post format =========================

add_filter( 'post-format-quote', 'avia_quote_content_filter', 10, 1 ); 



// =============================================================================================================================




/**
 *   The avia_default_title_filter creates the default title for your posts. 
 *   This function is used by most post types
 */
function avia_default_title_filter($current_post)
{
	$output  = "";
	$output .= "<h2 class='post-title ". avia_offset_class('meta', false). "'>";
	//$output .= "<h2 class='post-title'>";
	$output .= "	<a href='".get_permalink()."' rel='bookmark' title='". __('Permanent Link:','avia_framework')." ".$current_post['title']."'>".$current_post['title'];
	$output .= "			<span class='post-format-icon minor-meta'></span>";
	$output .= "	</a>";
	$output .= "</h2>";
	
	$current_post['title'] = $output;
	
	
	return $current_post;
}


/**
 *  The avia_gallery_slideshow_filter checks if a slideshow is set for an entry with post type gallery
 *  If no slideshow is set, it trys to fetch all images attached to this single post
 *
 *  The filter also sets the height of the slideshow to fullsize, and even on overview posts all slides are displayed
 */
function avia_gallery_slideshow_filter($current_post)
{
	$current_post['slider']->setImageSize('fullsize');
	$current_post['slider']->modify_slide_poster("default");

	if(!$current_post['slider']->slidecount) 
	{
		$attachments = get_children(array('post_parent' => get_the_ID(),
		            'post_status' => 'inherit',
		            'post_type' => 'attachment',
		            'post_mime_type' => 'image',
		            'order' => 'ASC',
		            'orderby' => 'menu_order ID'));
		            
		if(is_array($attachments) && !empty($attachments))
		{
			$current_post['slider']->set_image_ids($attachments);
		}
	}
	
	return avia_default_title_filter($current_post);
}



/**
 *  The avia_video_slideshow_filter checks if a video slideshow is set for an entry with post type gallery
 *  If no slideshow is set, it checks if the content holds a video url, removes it and uses it for the slideshow
 *  The filter also sets the height of the slideshow to fullsize, and even on overview posts all slides are displayed
 */
 
function avia_video_slideshow_filter($current_post)
{

	$current_post['slider']->setImageSize('fullsize');
	$current_post['slider']->modify_slide_poster("default");
	
	if(!$current_post['slider']->slidecount) 
	{
		$video		= avia_regex($current_post['content'],'url');
		if(is_array($video)) 
		{
			$video = $video[0];
			$current_post['slider']->set_image_ids(array('slideshow_video' => $video));
		}
		
		if(is_string($video))
		{
			$current_post['content'] = str_replace($video, "", $current_post['content']);
		}
		
	}
	
	return avia_default_title_filter($current_post);
}


/**
 *  The avia_image_slideshow_filter checks if an image is set for an entry with post type image
 *  If no image is set, it checks if the content holds an image, removes it and uses it for the slideshow
 *  The filter also sets the height of the slideshow to fullsize, and even on overview posts all slides are displayed
 */

function avia_image_slideshow_filter($current_post)
{
	$current_post['slider']->setImageSize('fullsize');
	$current_post['slider']->modify_slide_poster("default");
	
	if(!$current_post['slider']->slidecount) 
	{
		$image		= avia_regex($current_post['content'],'image');
		if(is_array($image)) 
		{
			$image = $image[0];
			$current_post['slider']->set_image_ids(array('<img src="'.$image.'" alt="" title ="" />'));
		}
		else
		{
			$image		= avia_regex($current_post['content'],'<img />',"");
			if(is_array($image)) 
			{
				$image = $image[0];
				$current_post['slider']->set_image_ids(array($image));
			}
		}
		
		if(is_string($image))
		{
			$current_post['content'] = str_replace($image, "", $current_post['content']);
		}
		
	}
		
	return avia_default_title_filter($current_post);
}



/**
 *  The avia_link_content_filter checks if the beginning of the post is a url. If thats the case this url will be aplied to the title.
 *  Otherwise the theme will search for the first URL within the content and apply this URL
 */
 
function avia_link_content_filter($current_post)
{
	//retrieve the link for the post
	$link 		= "";
	
	$pattern1 	= '!^(https?|ftp)://(-\.)?([^\s/?\.#-]+\.?)+(/[^\s]*)?!';
	$pattern2 	= "!^\<a.+?<\/a>!";
	$pattern3 	= "!\<a.+?<\/a>!";
	
	//if the url is at the begnning of the content extract it
	preg_match($pattern1, $current_post['content'] , $link);
	if(!empty($link[0])) 
	{
		$link = $link[0];
		$current_post['title'] = "<a href='$link' rel='bookmark' title='".__('Link to: ','avia_framework').the_title_attribute('echo=0')."' >".get_the_title()."</a>";
		$current_post['content'] = str_replace($link, "", $current_post['content']);
	}
	else
	{
		preg_match($pattern2, $current_post['content'] , $link);
		if(!empty($link[0])) 
		{
			$current_post['title'] = $link[0];
			$current_post['content'] = str_replace($link, "", $current_post['content']);
		}
		else
		{
			preg_match($pattern3,  $current_post['content'] , $link);
			if(!empty($link[0])) 
			{
				$current_post['title'] = $link[0];
			}
		}
	}
	
	if($link)
	{
		$current_post['title'] = "<h1 class='post-title ". avia_offset_class('meta', false). "'>".$current_post['title']."</h1>";
		//$current_post['title'] = "<h1 class='post-title'>".$current_post['title']."</h1>";
	}
	else
	{
		$current_post = avia_default_title_filter($current_post);
	}
	
	return $current_post;
}




/**
 *  Function for posts of type quote: title is wrapped in blockquote tags instead of h1
 */
function avia_quote_content_filter($current_post)
{
	$current_post['title'] 		= "<div class='". avia_offset_class('meta', false). "'><blockquote class='first-quote'>".$current_post['title']."</blockquote></div>";
	//$current_post['title'] 		= "<blockquote class='first-quote'>".$current_post['title']."</blockquote>";
	
	return $current_post;
}

