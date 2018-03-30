<?php //get theme options
global $oswc_front, $oswc_misc, $oswcPostTypes;
//set theme options
$oswc_latest_tag = $oswc_misc['latest_tag'];
$oswc_latest_num = $oswc_misc['latest_num'];
$oswc_latest_type = $oswc_misc['latest_type'];
$oswc_skin = $oswc_misc['skin'];

//check to see if latest slider should be shown on this review type
$reviewPage = false;
$postTypeName = oswc_get_review_meta($post->ID);
$postTypeId = get_post_type( $wp_query->post->ID ); //setup the posttypeid object, which is used below to determine which post type we're on
//review listing page
if(!empty($postTypeName) && ($oswcPostTypes->has_type($postTypeName) || $oswcPostTypes->has_type(strtolower($postTypeName)))){
	$reviewPage = true;
	$reviewType = $oswcPostTypes->get_type_by_name($postTypeName); //get the review type object
	$reviewLatestEnabled = $reviewType->latest_enabled; //is the latest slider enabled for this review type?
	$reviewLatestSpecific = $reviewType->latest_specific; //is the latest slider review specific for this review type?
	$reviewslug = $reviewType->id;
	$reviewSkin = $reviewType->skin; //get the review skin
	if($reviewSkin=="dark") $oswc_skin="dark";
	if($reviewSkin=="light") $oswc_skin="";
}
//review taxonomy page
if(is_tax()) {
	$reviewPage = true;
	$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);
	$reviewLatestEnabled = $reviewType->tax_latest_enabled;
	$reviewLatestSpecific = $reviewType->latest_specific; 
	$reviewslug = $reviewType->id;
	$reviewSkin = $reviewType->skin; //get the review skin
	if($reviewSkin=="dark") $oswc_skin="dark";
	if($reviewSkin=="light") $oswc_skin="";
}
//single review page
if (is_single() && $oswcPostTypes->has_type($postTypeId, true)) {
	$reviewPage = true;
	$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);
	$reviewLatestEnabled = $reviewType->single_latest_enabled;
	$reviewLatestSpecific = $reviewType->latest_specific; 
	$reviewslug = $reviewType->id;
	$reviewSkin = $reviewType->skin; //get the review skin
	if($reviewSkin=="dark") $oswc_skin="dark";
	if($reviewSkin=="light") $oswc_skin="";
}
//setup wp_query args
$hidemore=false;
if($oswc_latest_type=="tag") {
	$latestargs = array('tag_id' => get_tag_id($oswc_latest_tag), 'posts_per_page' => $oswc_latest_num);
	if($reviewPage && $reviewLatestSpecific) { //if this is a review type and the latest slider is set to specific, include only posts from the current review type
		$latestargs = array('tag_id' => get_tag_id($oswc_latest_tag), 'posts_per_page' => $oswc_latest_num, 'post_type' => $reviewslug);
	}
	$terms = get_terms('post_tag', array('name' => $oswc_latest_tag)); //get term object for this tag
	if(empty($terms)) $slidererror = __("The tag you specified in the theme options for the Latest Slider does not match a tag slug in your database.","made");
} elseif($oswc_latest_type=="category") {
	$latestargs = array('cat' => get_category_id($oswc_latest_tag), 'posts_per_page' => $oswc_latest_num);
	if($reviewPage && $reviewLatestSpecific) { //if this is a review type and the latest slider is set to specific, include only posts from the current review type
		$latestargs = array('cat' => get_category_id($oswc_latest_tag), 'posts_per_page' => $oswc_latest_num, 'post_type' => $reviewslug);
	}
	$terms = get_terms('category', array('name' => $oswc_latest_tag)); //get term object for this category
	if(empty($terms)) $slidererror = __("The category you specified in the theme options for the Latest Slider does not match a category slug in your database.","made");
} elseif ($oswc_latest_type=="review") {
	$thisReviewType = $oswcPostTypes->get_type_by_name($oswc_latest_tag); //see if review type entered matches one in the system
	$thisReviewSlug = $thisReviewType->id; //get the slug for use in the query	
	$latestargs = array('post_type' => $thisReviewSlug, 'posts_per_page' => $oswc_latest_num);
	if($thisReviewSlug=='') $slidererror = __("The review type you specified in the theme options for one of the review types in your Latest Slider doesn't match a review type in your database.","made");
} else {
	$latestargs = array('posts_per_page' => $oswc_latest_num);
	if($reviewPage && $reviewLatestSpecific) { //if this is a review type and the latest slider is set to specific, include only posts from the current review type
		$latestargs = array('posts_per_page' => $oswc_latest_num, 'post_type' => $reviewslug);
	}
}
?>

<?php if(!$reviewPage || ($reviewPage && $reviewLatestEnabled)) { //show the latest slider on this review listing page? ?>

    <div id="latest-wrapper">
        
        <div class="latest-scroller-wrapper">
        
            <?php if($slidererror!="") { ?>
            
                <div style="font-style:italic;width:600px;margin:20px 0px;"><?php echo $slidererror; ?></div>
                
            <?php } else { ?>
        
                <a href="#" class="latest-prev">&nbsp;</a>
            
                <div class="latest"> <!-- begin latest slider -->
                
                    <ul> 	
            
                        <?php query_posts ( $latestargs );
                        if (have_posts()) : while (have_posts()) : the_post();					
                            $postType = get_post_type(); //get post type
                            $reviewType = $oswcPostTypes->get_type_by_id($postType); //get review type object		
                            $isreview=false;
                            $icon = $reviewType->icon;
							$icon_light = $reviewType->icon_light;	
							if($oswc_skin=="dark") $icon=$icon_light;						
                            if($postType!='post') $isreview=true; //set review variable
                            //show rating?
                            $rating_hide = get_post_meta($post->ID, "Hide Rating", $single = true); 	
                            //check if this is a video post
                            $isvideo=false;
                            $video = get_post_meta($post->ID, "Video", $single = true);
                            if($video!="") $isvideo=true;	
                            ?>	
                                    
                            <li>
                            
                                <?php if($rating_hide!="true") { ?>
                            
                                    <div class="rating-wrapper small"><?php if($isreview) { $oswcPostTypes->the_rating($reviewType); } // show the rating ?></div> 
                                    
                                <?php } ?>
                            
                                <a class="darken small<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('latest', array( 'title'=> '' )); ?></a>
                                
                                <a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
                                
                                <?php if($isreview) { ?>
                                
                                    <div class="icon">
                                                    
                                        <img alt="icon" src="<?php echo $icon; ?>" />
                                    
                                    </div> 
                                    
                                <?php } ?>                       
                            
                            </li>
                            
                        <?php endwhile; endif; ?>
                        
                    </ul>
            
                </div> <!-- end latest -->
                
                <a href="#" class="latest-next">&nbsp;</a>
                
                <br class="clearer" />
                
            <?php } ?>
            
        </div>
        
    </div> 
    
    <!-- begin responsive version -->
    
    <div id="latest-wrapper-responsive">
        
        <div class="latest-scroller-wrapper">
        
            <?php if($slidererror!="") { ?>
            
                <div style="font-style:italic;width:400px;margin:20px 0px;"><?php echo $slidererror; ?></div>
                
            <?php } else { ?>
            
                <div class="latest"> <!-- begin latest slider -->
                
                    <ul> 	
            
                        <?php query_posts ( $latestargs );
                        if (have_posts()) : while (have_posts()) : the_post();					
                            $postType = get_post_type(); //get post type
                            $reviewType = $oswcPostTypes->get_type_by_id($postType); //get review type object		
                            $isreview=false;
                            $icon = $reviewType->icon;
							$icon_light = $reviewType->icon_light;	
							if($oswc_skin=="dark") $icon=$icon_light;						
                            if($postType!='post') $isreview=true; //set review variable
                            //show rating?
                            $rating_hide = get_post_meta($post->ID, "Hide Rating", $single = true); 	
                            //check if this is a video post
                            $isvideo=false;
                            $video = get_post_meta($post->ID, "Video", $single = true);
                            if($video!="") $isvideo=true;	
                            ?>	
                                    
                            <li>
                            
                                <?php if($rating_hide!="true") { ?>
                            
                                    <div class="rating-wrapper small"><?php if($isreview) { $oswcPostTypes->the_rating($reviewType); } // show the rating ?></div> 
                                    
                                <?php } ?>
                            
                                <a class="darken small<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('latest', array( 'title'=> '' )); ?></a>
                                
                                <a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
                                
                                <?php if($isreview) { ?>
                                
                                    <div class="icon">
                                                    
                                        <img alt="icon" src="<?php echo $icon; ?>" />
                                    
                                    </div> 
                                    
                                <?php } ?>                       
                            
                            </li>
                            
                        <?php endwhile; endif; ?>
                        
                    </ul>
            
                </div> <!-- end latest -->
                
                <br class="clearer" />
                
            <?php } ?>
            
        </div>
        
    </div> 
    
    <!-- end responsive version -->
    
    <div class="clearer hide-responsive">&nbsp;</div><br class="hide-responsive" />   
    
<?php } ?>

<?php wp_reset_query(); ?>