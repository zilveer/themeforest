<?php

/**
 *  These functions shows a number of posts related to the currently displayed post.
 *  Relations are defined by tags: if post tags match, the post will be displayed as related
 */


$columns = 3;
$reladed_posts = false;
$this_id = $post->ID;
$slidecount = 0;
$postcount = ($columns * 3) + 1;

$tags = wp_get_post_tags($post->ID);
if ($tags) {
 
     $tag_ids = "";
     foreach ($tags as $tag ) $tag_ids .= $tag->name.",";
     $tag_ids = substr_replace($tag_ids ,"",-1);
     $tag_ids = str_replace(" ", "-",$tag_ids);

     if($tag_ids) 
     {
     	$my_query = new WP_Query("tag=$tag_ids&showposts=$postcount&ignore_sticky_posts=1&orderby=rand");
     
  		if ($my_query->have_posts()) 
  		{ 
  			$count = 1;
  			$output = "";
  			
  			$output .= "<div class='hr hr_related_posts'></div>";
  			$output .= "<div class='related-meta'>";
  			$output .= "<h3 class='miniheading'>".__('Related Posts','avia_framework')."</h3>";
	 		$output .= "<span class='minitext'>".__('Did you like this entry? <br/>Here are a few more posts that might be interesting for you.','avia_framework')."</span>";
  			$output .= "</div>";
  			
     		$output .= "<div class ='related_posts'>";
     		$output .= "<strong class='related_single_heading'>Related Posts</strong>";
     		$output .= "<div class='content_slider autoslide_false'>";
 	 	
     		while ($my_query->have_posts()) : $my_query->the_post(); 
     		if($post->ID != $this_id)
     		{	
     			$reladed_posts = true;
     			$slidecount ++;
     			
     			if($count == 1)
     			{
     				$output .= "<div class='single_slide single_slide_nr_$slidecount'>";
     			}
     			
     			
     			$image = "<span class='related_posts_default_image'></span>";
	 			$slides = avia_post_meta(get_the_ID(), 'slideshow', true);
	 			
	 			//check if a preview image is set
	 			if( $slides != "" && !empty( $slides[0]['slideshow_image']) )
	 			{	
	 				//check for image or video
	 				if(is_numeric($slides[0]['slideshow_image']))
	 				{
	 					$image = avia_image_by_id($slides[0]['slideshow_image'], 'related', 'image');
	 				}
	 				else
	 				{
	 					$image = "<span class='related_posts_default_image related_posts_video'></span>";
	 				}
	 			   
	 			}
     			
     			
     			$output .= "<div class='relThumb relThumb".$count."'>\n";
	 			$output .= "<a href='".get_permalink()."' class='relThumWrap noLightbox'>\n";
     			$output .= "<span class='related_image_wrap'>";
	 			$output .= "<span class='rounded_corner rctl'></span>";
				$output .= "<span class='rounded_corner rctr'></span>";
				$output .= "<span class='rounded_corner rcbl'></span>";
				$output .= "<span class='rounded_corner rcbr'></span>";
	 			$output .= $image;
	 			$output .= "</span>\n";
	 			$output .= "<span class='relThumbTitle'>\n";
	 			$output .= "<strong class='relThumbHeading'>".avia_backend_truncate(get_the_title(), 50)."</strong>\n";
	 			$output .= "</span>\n</a>";
	 			$output .= "</div><!-- end .relThumb -->\n";
     			
     			$count++;
     			
     			if($count == $columns+1)
     			{
     				$output .= "</div>";
     				$count = 1;
     			}
     		} 
     		endwhile; 
 	 		
 	 		if($count != 1) $output .= "</div>";
 	 		
     		$output .= "</div></div>";
     		if($reladed_posts) echo $output;
     		
     	}
     	
     	wp_reset_query();
    }
}


