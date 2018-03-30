<?php //get theme options
global $oswc_front, $oswc_misc, $oswcPostTypes;
//set theme options
$oswc_trending_tag = $oswc_front['trending_tags'];
$oswc_trending_header = $oswc_front['trending_header'];
$oswc_trending_num = $oswc_front['trending_num'];
$oswc_trending_type = $oswc_front['trending_type'];
$oswc_skin = $oswc_misc['skin'];
$oswc_trending_num_responsive = 4
?>

<?php //setup wp_query args
$hidemore=false;
if($oswc_trending_type=="tag") {
	$trendingargs = array('tag_id' => get_tag_id($oswc_trending_tag), 'posts_per_page' => $oswc_trending_num);
	$trendingargsresponsive = array('tag_id' => get_tag_id($oswc_trending_tag), 'posts_per_page' => $oswc_trending_num_responsive);
	$terms = get_terms('post_tag', array('name' => $oswc_trending_tag)); //get term object for this tag
	if(empty($terms)) $slidererror = __("The tag you specified in the theme options for the Trending Slider does not match a tag in your database.","made");
	$termslug = $terms[0]->slug; //get the slug
	$morelink = get_term_link($termslug,'post_tag'); //get the permalink for this tag	
	$oswc_trending_tag = get_term_by('slug', $oswc_trending_tag, 'post_tag')->name;
	$moretitle = "All articles in " . $oswc_trending_tag . " &raquo;"; //link title
} elseif($oswc_trending_type=="category") {
	$trendingargs = array('cat' => get_category_id($oswc_trending_tag), 'posts_per_page' => $oswc_trending_num);
	$trendingargsresponsive = array('cat' => get_category_id($oswc_trending_tag), 'posts_per_page' => $oswc_trending_num_responsive);
	$terms = get_terms('category', array('name' => $oswc_trending_tag)); //get term object for this category
	if(empty($terms)) $slidererror = __("The category you specified in the theme options for the Trending Slider does not match a category in your database.","made");
	$termslug = $terms[0]->slug; //get the slug
	$morelink = get_term_link($termslug,'category'); //get the permalink for this category
	$oswc_trending_tag = get_category_by_slug($oswc_trending_tag)->name;
	$moretitle = "All articles in " . $oswc_trending_tag . " &raquo;"; //link title
} elseif ($oswc_trending_type=="review") {
	$thisReviewType = $oswcPostTypes->get_type_by_name($oswc_trending_tag); //see if review type entered matches one in the system
	$reviewSlug = $thisReviewType->id; //get the slug for use in the query
	$trendingargs = array('post_type' => $reviewSlug, 'posts_per_page' => $oswc_trending_num);
	$trendingargsresponsive = array('post_type' => $reviewSlug, 'posts_per_page' => $oswc_trending_num_responsive);
	$morelink = oswc_review_permalink($oswc_trending_tag); //get permalink for this review page 	
	$moretitle = "All articles in " . $oswc_trending_tag . " &raquo;"; //link title
} else {
	$trendingargs = array('posts_per_page' => $oswc_trending_num);
	$trendingargsresponsive = array('posts_per_page' => $oswc_trending_num_responsive);
	$hidemore = true; //there is no latest articles page to link to
}
?>

<?php //determine skin of the current review type
wp_reset_query();
$reviewPage = false;
$postTypeName = oswc_get_review_meta($post->ID);
$postTypeId = get_post_type( $wp_query->post->ID ); //setup the posttypeid object, which is used below to determine which post type we're on
//review listing page
if(!empty($postTypeName) && ($oswcPostTypes->has_type($postTypeName) || $oswcPostTypes->has_type(strtolower($postTypeName)))){
	$reviewPage = true;
	$reviewType = $oswcPostTypes->get_type_by_name($postTypeName); //get the review type object
	$reviewSkin = $reviewType->skin; //get the review skin
	if($reviewSkin=="dark") $oswc_skin="dark";
	if($reviewSkin=="light") $oswc_skin="";
}
//review taxonomy page
if(is_tax()) {
	$reviewPage = true;
	$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);
	$reviewSkin = $reviewType->skin; //get the review skin
	if($reviewSkin=="dark") $oswc_skin="dark";
	if($reviewSkin=="light") $oswc_skin="";
}
//single review page
if (is_single() && $oswcPostTypes->has_type($postTypeId, true)) {
	$reviewPage = true;
	$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);
	$reviewSkin = $reviewType->skin; //get the review skin
	if($reviewSkin=="dark") $oswc_skin="dark";
	if($reviewSkin=="light") $oswc_skin="";
}
?>

<div id="trending-wrapper">

	<div class="ribbon-shadow-left">&nbsp;</div>

	<div class="section-wrapper"> <!-- spotlight section header -->
    
    	<div class="section">
        
        	<?php echo $oswc_trending_header; ?>
        
        </div>        
    
    </div>
    
    <div class="ribbon-shadow-right">&nbsp;</div>   
    
    <div class="section-arrow">&nbsp;</div>
    
    <div id="trending-scroller">
    
    	<?php if($slidererror!="") { ?>
        
        	<div style="font-style:italic;width:500px;margin:20px 0px;"><?php echo $slidererror; ?></div>
            
        <?php } else { ?>
    
            <a href="#" class="trending-prev">&nbsp;</a>
        
            <div id="trending" class="trending"> <!-- begin trending -->
            
                <ul> 	
        
                    <?php query_posts ( $trendingargs );
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
                        
                            <a class="darken small<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('trending', array( 'title'=> '' )); ?></a>                           
                            <a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
                                
							<?php if($isreview) { ?>
                            
                                <div class="icon">
                                                
                                    <img alt="icon" src="<?php echo $icon; ?>" />
                                
                                </div> 
                                
                            <?php } ?> 
                             
                        </li>
                        
                    <?php endwhile; endif; ?>
                    
                </ul>
        
            </div> <!-- end trending -->
            
            <a href="#" class="trending-next">&nbsp;</a>
            
            <?php wp_reset_query(); ?>            
            
            <!-- responsive version -->
            
            <div id="trending-responsive" class="trending"> <!-- begin trending -->
            
                <ul> 	
        
                    <?php query_posts ( $trendingargsresponsive );
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
                        
                            <a class="darken small<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('trending', array( 'title'=> '' )); ?></a>                           
                            <a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
                                
							<?php if($isreview) { ?>
                            
                                <div class="icon">
                                                
                                    <img alt="icon" src="<?php echo $icon; ?>" />
                                
                                </div> 
                                
                            <?php } ?> 
                             
                        </li>
                        
                    <?php endwhile; endif; ?>
                    
                </ul>
        
            </div> <!-- end trending -->
            
            <!-- end resonsive version -->
            
        <?php } ?>
        
    </div>
    
    <br class="clearer ie9fix" />
    
</div>

<?php wp_reset_query(); ?>