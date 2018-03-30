<?php

/**
 *  These functions shows a number of posts related to the currently displayed post.
 *  Relations are defined by tags: if post tags match, the post will be displayed as related
 */
global $avia_config;

$columns = 4;
$post_class = "one_fourth";
$reladed_posts = false;
$this_id = $post->ID;
$slidecount = 0;
$postcount = ($columns * 1);
$invisible_image = "";

$tags = wp_get_post_tags($post->ID);
if ($tags) {
 	
     $tag_ids = "";
     foreach ($tags as $tag ) $tag_ids .= $tag->slug.",";
     
     $tag_ids = substr_replace($tag_ids ,"",-1);
     $tag_ids = str_replace(" ", "-",$tag_ids);

     if($tag_ids) 
     {
     
     	$my_query = new WP_Query(array('tag'=>$tag_ids, 'showposts'=>$postcount, 'ignore_sticky_posts'=>1, 'orderby'=>'rand', 'post__not_in' => array( $this_id ) ) );
     
  		if ($my_query->have_posts()) 
  		{ 
  			$count = 1;
  			$output = "";
  			
  			//create seperator

     		$output .= "<div class ='related_posts '>";
     		$output .= "<span class='entry-border-overflow entry-border-overflow-bottom extralight-border'></span>";
     		$output .= "<h5 class='related_title'>".__('Related Posts', 'avia_framework')."</h5>";
     		$output .= "<div class='content_slider autoslide_false'>";
 	 	
     		while ($my_query->have_posts()) : $my_query->the_post(); 
     		if($post->ID != $this_id)
     		{	
     			$reladed_posts = true;
     			$slidecount ++;
     			$format = get_post_format();
     			if(!$format) $format = 'standard';
     			
     			
     			if($count == 1)
     			{
     				$output .= "<div class='single_slide single_slide_nr_$slidecount'>";
     			}
     			
     			
     			
     			$image = "<span class='related_posts_default_image'>{image}</span>";
	 			$slides = avia_post_meta(get_the_ID(), 'slideshow', true);
	 			
	 			//check if a preview image is set
	 			if( $slides != "" && !empty( $slides[0]['slideshow_image']) )
	 			{	
	 				//check for image or video
	 				if(is_numeric($slides[0]['slideshow_image']))
	 				{
	 					$invisible_image = $image = avia_image_by_id($slides[0]['slideshow_image'], 'portfolio_fixed', 'image');
	 				}
	 				else
	 				{
	 					$invisible_image = $image = "<span class='related_posts_default_image related_posts_video'></span>";
	 				}
	 			}
     			
     			
     			$output .= "<div class='$post_class relThumb relThumb".$count." post-format-".$format."'>\n";
	 			$output .= "<a href='".get_permalink()."' class='relThumWrap noLightbox'>\n";
     			$output .= "<span class='related_image_wrap'>";
	 			$output .= $image;
	 			$output .= "</span>\n";
	 			$output .= "<span class='relThumbTitle'>\n";
	 			$output .= "<strong class='relThumbHeading'>".avia_backend_truncate(get_the_title(), 50, " ")."</strong>\n";
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
     		$output = str_replace("{image}",$invisible_image,$output);
     		
     		if($reladed_posts) echo $output;
     		
     	}
     	
     	wp_reset_query();
    }
}


