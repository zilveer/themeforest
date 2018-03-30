<?php //get theme options
global $oswc_front, $oswc_single, $oswc_misc, $oswcPostTypes;

//set theme options
$oswc_post_sidebar_hide = $oswc_single['post_sidebar_hide'];
$oswc_related_hide = $oswc_single['post_related_hide'];
$oswc_related_header_text = $oswc_single['post_related_header_text'];
$oswc_related_number = $oswc_single['post_related_number'];
$oswc_featured_tag = $oswc_front['featured_tag'];
$oswc_spotlight_tags = $oswc_front['spotlight_tags'];
$oswc_trending_tag = $oswc_front['trending_tags'];
$oswc_latest_tag = $oswc_misc['latest_tag'];
$oswc_dontmiss_tags = $oswc_misc['dontmiss_tag'];

if (!$oswc_post_sidebar_hide) { 
	$columns=3;
} else {
	$columns=5;
}
?>

<?php // use variables from page custom fields instead of made options page (if they exist)
$override = get_post_meta($post->ID, "Hide Related", $single = true);
if($override!="" && $override!="null") {
	$oswc_related_hide=$override;
	if($oswc_related_hide=="false") {
		$oswc_related_hide=false;	
	} else {
		$oswc_related_hide=true;
	}
}
?>

<?php // setup the query
$tags = wp_get_post_tags($post->ID); //get all tag objects for this post

$hiddentags = array('dummy_first_value'); //add this so a key of 0 cannot trigger an un-hidden tag
$args = array();
$count_tax=0;
foreach($tags as $tag){	
	//don't include template tags
	if(strtolower($tag->name)!=strtolower($oswc_featured_tag) && strtolower($tag->name)!=strtolower($oswc_spotlight_tags) && strtolower($tag->name)!=strtolower($oswc_trending_tag) && strtolower($tag->name)!=strtolower($oswc_latest_tag) && strtolower($tag->name)!=strtolower($oswc_dontmiss_tags)) {
		$names[$tag->term_id] = $tag->name;		
		$slugs[$tag->term_id] = $tag->slug;		
	
		$args[$tag->term_id] = array( // get other articles of same tag
			'paged' => $paged,
			'post__not_in' => array($post->ID),
			'posts_per_page' => $oswc_related_number,
			'tag_id' => $tag->term_id	
		);
	
		//check to see if this query generates results
		$test_loop = new WP_Query($args[$tag->term_id]);
	
		//if not...
		if(!$test_loop->have_posts()) {	
			//echo "hiding ".$tag->name."<br />";
			$hiddentags[] = $tag->name;//add this tag to the "hide" list
		} else {
			$count_tax++;		
		}
		wp_reset_query();
	}
}
//check category in case there aren't any posts in any of the same tags
if($count_tax==0) {	
	$hiddentags=array('dummy_first_value'); //add this so a key of 0 cannot trigger an un-hidden tag
	$names=array();
	$slugs=array();
	$args=array();
	$tags = wp_get_object_terms($post->ID,'category');
	foreach($tags as $tag){
		$names[$tag->term_id] = $tag->name;	
		$slugs[$tag->term_id] = $tag->slug;	
		//echo "term_name=".$names[$tag->term_id]."<br />";	
		
		$args[$tag->term_id] = array( // get other articles of same category	
			'paged' => $paged,
			'post__not_in' => array($post->ID),
			'posts_per_page' => $oswc_related_number,
			'category_name' => $slugs[$tag->term_id]		
		);
	
		//check to see if this query generates results
		$test_loop = new WP_Query($args[$tag->term_id]);
	
		//if not...
		if(!$test_loop->have_posts()) {
			//echo "hiding ".$tag->name."<br />";
			$hiddentags[] = $tag->name;//add this taxonomy to the "hide" list
		} else {
			$count_tax++;	
		}
		$count_cats++;
		wp_reset_query();	
	}
}

?>

<?php if(!$oswc_related_hide) { ?>

    <div id="related">
            
        <ul class="tabnav">
        
            <li class="title"><?php echo $oswc_related_header_text; ?></li>
            
            <li class="arrow">&nbsp;</li>
    
            <?php
            $count=0;
            foreach($tags as $tag){	
				if(strtolower($tag->name)!=strtolower($oswc_featured_tag) && strtolower($tag->name)!=strtolower($oswc_spotlight_tags) && strtolower($tag->name)!=strtolower($oswc_trending_tag) && strtolower($tag->name)!=strtolower($oswc_latest_tag) && strtolower($tag->name)!=strtolower($oswc_dontmiss_tags)) {			
					$key=array_search($tag->name, $hiddentags);
					if($key==false){ //must match value and type, incase the hidden tag is first in the array (0 position)
						$count++;			
						?>
						<li><a title="<?php _e( $names[$tag->term_id], 'made' ); ?>" href="#tab<?php echo $count; ?>"><?php _e( $names[$tag->term_id], 'made' ); ?></a></li>
						
					<?php        		
					}
				}
            }
            ?>
            
        </ul>
        
        <br class="clearer" />
        
        <div class="tabdiv-wrapper">
        
        	<?php
			$count=0;
			foreach($tags as $tag){	
				if(strtolower($tag->name)!=strtolower($oswc_featured_tag) && strtolower($tag->name)!=strtolower($oswc_spotlight_tags) && strtolower($tag->name)!=strtolower($oswc_trending_tag) && strtolower($tag->name)!=strtolower($oswc_latest_tag) && strtolower($tag->name)!=strtolower($oswc_dontmiss_tags)) {			
					$key=array_search($tag->name, $hiddentags);
					if($key==false){
						$count++;
						$postcount=0;	
						$related_loop = new WP_Query($args[$tag->term_id]);
						$related_exists = true;
						?>
						<div id="tab<?php echo $count; ?>" class="tabdiv">
							
							<?php if ($related_loop->have_posts()) : while ($related_loop->have_posts()) : $related_loop->the_post(); $postcount++;
								$thisPostType = get_post_type(); //get post type
								$thisReviewType = $oswcPostTypes->get_type_by_id($thisPostType); //get review type object	
								$isreview=false;
								if($thisPostType!='post') $isreview=true; //set review variable	
								//show rating?
								$rating_hide = get_post_meta($post->ID, "Hide Rating", $single = true); 			
								//check if this is a video post
								$isvideo=false;
								$video = get_post_meta($post->ID, "Video", $single = true);
								if($video!="") $isvideo=true;		
								?>	
							
								<div class="panel<?php if($postcount % $columns == 0) { ?> right<?php } ?>">
								
									<?php if($rating_hide!="true") { ?>
									
										<div class="rating-wrapper small"><?php if($isreview) { $oswcPostTypes->the_rating($thisReviewType); } // show the rating ?></div>
										
									<?php } ?> 
								
									<a class="darken small<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('related', array( 'title'=> '' )); ?></a>
									
									<a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
									
								</div>
								
								<?php if ($postcount % $columns == 0) { // new line every 3 panels ?>
								
									<br class="clearer hide-responsive" />
							
								<?php } ?> 
                                
                                 <?php if ($postcount % 2 == 0) { // responsive designs will only have one or two max panels, so clearing every 2 works for both cases  ?>
                                                            
                                    <div class="clear-responsive">&nbsp;</div>
                            
                                <?php } ?>
                                                    
							<?php endwhile; 
							endif; ?> 
							
							<br class="clearer" />
							
						</div>					
					<?php        		
					}
				}
			}
			?>
            
        </div>
    
    </div> 
    
<?php } wp_reset_query(); ?>