<?php

/**
 *  These functions shows a number of posts related to the currently displayed post.
 *  Relations are defined by tags: if post tags match, the post will be displayed as related
 */


$columns = 3;
$reladed_posts = false;
$this_id = $post->ID;
$slidecount = 0;
$postcount = 3;

$tags = wp_get_post_tags($post->ID);
if ($tags) {
 
     $tag_ids = "";
     foreach ($tags as $tag ) $tag_ids .= $tag->name.",";
     $tag_ids = substr_replace($tag_ids ,"",-1);
     $tag_ids = str_replace(" ", "-",$tag_ids);

     if($tag_ids) 
     {
     	
     	$my_query = new WP_Query(array(	'tag'=>$tag_ids, 
     									'showposts'=>$postcount, 
     									'ignore_sticky_posts'=>1, 
     									'orderby'=>'rand', 
     									'post__not_in' => array( $this_id ) 
     									) 
     								);
     
  		if ($my_query->have_posts()) 
  		{ 
  			$count = 1;
  			$output = "";
  			
  			$output .= "<div class='related-meta'>";
  			$output .= "<h3 class='miniheading'>".__('Related Posts','avia_framework')."</h3>";
	 		$output .= "<span class='minitext minitext_related'>".__('Did you like this entry? <br/>Here are a few more posts that might be interesting for you.','avia_framework')."</span>";
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
     			
     			
 				$image = get_the_post_thumbnail( $post->ID, 'related' );
 			
 				//check for image or video
 				if(!$image)
 				{
     			$image = "<span class='related_posts_default_image'></span>";
 				}
	 			   
	 			
     			
     			
     			$output .= "<div class='relThumb relThumb".$count."'>\n";
	 			$output .= "<a href='".get_permalink()."' class='relThumWrap noLightbox'>\n";
	 			$output .= $image;
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
 	 		
     		$output .= "</div></div><div class='hr'></div>";
     		if($reladed_posts)  echo $output;
     		
     	}
     	
     	wp_reset_query();
    }
}


