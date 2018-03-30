<?php

/**
 *  These functions shows a number of posts related to the currently displayed post.
 *  Relations are defined by tags: if post tags match, the post will be displayed as related
 */
global $avia_config;

$is_portfolio 		= avia_is_portfolio_single();
$columns 			= 4;
$post_class 		= "one_fourth no_margin";
$container_class	= "";
$image_size 		= 'portfolio_small';
$related_posts 		= false;
$this_id 			= $post->ID;
$slidecount 		= 0;
$postcount 			= ($columns * 1);
$format 			= "";
$invisible_image	= "";
$subtitle 			= "";

if($is_portfolio) // its a portfolio post
{
	$columns 			= 4;
	$container_class 	= 'stretch_full';
	$post_class 		= "one_fourth no_margin";
	$format 			= 'portfolio';
	$postcount 			= ($columns * 2);
	$tags 				= wp_get_object_terms( $post->ID, 'portfolio_entries');
}
else // its a blog post
{
	$tags 		= wp_get_post_tags($post->ID);
}




if ($tags) {
 	
     $tag_ids = "";
     foreach ($tags as $tag ) $tag_ids .= $tag->slug.",";
     
     $tag_ids = substr_replace($tag_ids ,"",-1);
     $tag_ids = str_replace(" ", "-",$tag_ids);

     if($tag_ids) 
     {
     	if($is_portfolio)
		{
			$my_query = new WP_Query(array('portfolio_entries'=>$tag_ids, 'showposts'=>$postcount, 'ignore_sticky_posts'=>1, 'orderby'=>'rand', 'post__not_in' => array( $this_id ) ) );
		}
		else
		{     	
     		$my_query = new WP_Query(array('tag'=>$tag_ids, 'showposts'=>$postcount, 'ignore_sticky_posts'=>1, 'orderby'=>'rand', 'post__not_in' => array( $this_id ) ) );
     	}
     	
  		if ($my_query->have_posts()) 
  		{ 
  			$extra = 'alpha';
  			$count = 1;
  			$output = "";
  			
  			//create seperator
			
     		$output .= "<div class ='related_posts $container_class'>";
     		$output .= "<h5 class='related_title'>".__('Related Entries', 'avia_framework')."</h5>";
     		$output .= "<div class='related_entries_container '>";
 	 	
     		while ($my_query->have_posts()) : $my_query->the_post(); 
     		if($post->ID != $this_id)
     		{	
     			$related_posts = true;
     			$slidecount ++;
     			$format = "";
     			if($is_portfolio) $format = "portfolio";
     			if(!$format) $format = get_post_format();
     			if(!$format) $format = 'standard';
     			
     			
     			
     			$image = "<span class='related_posts_default_image'>{image}</span>";
	 			$slides = avia_post_meta(get_the_ID(), 'slideshow', true);
	 			
	 			//check if a preview image is set
	 			if( $slides != "" && !empty( $slides[0]['slideshow_image']) )
	 			{	
	 				//check for image or video
	 				if(is_numeric($slides[0]['slideshow_image']))
	 				{
	 					$invisible_image = $image = avia_image_by_id($slides[0]['slideshow_image'], $image_size, 'image');
	 				}
	 				else
	 				{
	 					$invisible_image = $image = "<span class='related_posts_default_image related_posts_video'></span>";
	 				}
	 			}
     			
     			
     			$output .= "<div class='$post_class $extra relThumb relThumb".$count." post-format-".$format." flex_column'>\n";
	 			$output .= "<a href='".get_permalink()."' class='relThumWrap noLightbox'>\n";
     			$output .= "<span class='related_image_wrap'>";
	 			$output .= $image;
	 			$output .= "</span>\n";
	 			$output .= avia_title(array('title'=>avia_backend_truncate(get_the_title(), 40, " "), 'class'=>'portfolio-title', 'html' => "<div class='{class} title_container'><h1 class='main-title'>{title}</h1></div>"), $post->ID);
	 			$output .= "\n</a>";
	 			$output .= "</div><!-- end .relThumb -->\n";
     			
     			$count++;
     			$extra = "";
     			
     			if($count == $my_query->post_count) $extra = 'omega';
     		
     		} 
     		endwhile; 
 	 		
 	 		
     		$output .= "</div></div>";
     		$output = str_replace("{image}",$invisible_image,$output);
     		
     		if($related_posts) echo $output;
     		
     	}
     	
     	wp_reset_query();
    }
}


