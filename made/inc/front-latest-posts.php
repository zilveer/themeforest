<?php //get theme options
global $oswc_front, $oswc_ads, $oswc_other, $oswcPostTypes;

//set theme options
$oswc_latestposts_header = $oswc_front['latestposts_header'];
$oswc_latestposts_num = $oswc_front['latestposts_num'];
$oswc_front_sidebar_show = $oswc_front['sidebar_show'];
$oswc_front_latest_layout = $oswc_front['latest_layout'];
$oswc_front_latest_excerpt_enabled = $oswc_front['latest_excerpt_enabled'];
$oswc_front_latest_more_enabled = $oswc_front['latest_more_enabled'];
$oswc_front_latest_category = $oswc_front['latest_category'];

//set theme options
$oswc_ad_shuffle=$oswc_ads['ad_shuffle'];
$oswc_ad1 = $oswc_ads['ad1'];
$oswc_ad2 = $oswc_ads['ad2'];
$oswc_ad3 = $oswc_ads['ad3'];
$oswc_ad4 = $oswc_ads['ad4'];
$oswc_ad5 = $oswc_ads['ad5'];
$oswc_ad6 = $oswc_ads['ad6'];
$oswc_ad7 = $oswc_ads['ad7'];
$oswc_ad8 = $oswc_ads['ad8'];
$oswc_ad9 = $oswc_ads['ad9'];
$oswc_ad10 = $oswc_ads['ad10'];

//get proper thumbnail size based on layout
switch ($oswc_front_latest_layout) {
	case "A":
		$thumbnailsize="spotlight";
		if($oswc_front_sidebar_show) {
			$cols=2;
		} else {
			$cols=3;
		}
		break;
	case "B":
		$thumbnailsize="loop-large";
		if(!$oswc_front_sidebar_show) {
			$thumbnailsize="loop-large-full";
		}
		$cols=1;
		break;
	case "C":
		$thumbnailsize="spotlight";
		$cols=1;
		break;
}

//setup ads array
$ads=array();
if($oswc_ad1!='') array_push($ads,$oswc_ad1);
if($oswc_ad2!='') array_push($ads,$oswc_ad2);
if($oswc_ad3!='') array_push($ads,$oswc_ad3);
if($oswc_ad4!='') array_push($ads,$oswc_ad4);
if($oswc_ad5!='') array_push($ads,$oswc_ad5);
if($oswc_ad6!='') array_push($ads,$oswc_ad6);
if($oswc_ad7!='') array_push($ads,$oswc_ad7);
if($oswc_ad8!='') array_push($ads,$oswc_ad8);
if($oswc_ad9!='') array_push($ads,$oswc_ad9);
if($oswc_ad10!='') array_push($ads,$oswc_ad10);
if($oswc_ad_shuffle) {
	shuffle($ads);
}
global $query_string;
$args=$query_string . '&posts_per_page='.$oswc_latestposts_num;
if($oswc_front_latest_category!='') { $args.='&cat='.get_category_id($oswc_front_latest_category); } //limit to a specific category
?>
   
<div class="post-loop<?php if(!$oswc_front_sidebar_show) { ?> full-width<?php } ?>">

    <div class="ribbon-shadow-left">&nbsp;</div>       
    
    <div class="section-wrapper">
    
        <div class="section">
        
            <?php echo $oswc_latestposts_header; ?>
        
        </div>        
    
    </div>
    
    <div class="ribbon-shadow-right">&nbsp;</div>   

    <div class="section-arrow">&nbsp;</div>
        
    <?php	
	query_posts ( $args );
    if (have_posts()) : while (have_posts()) : the_post(); $postcount++;
	//$latestposts_loop = new WP_Query($args);
    //if ($latestposts_loop->have_posts()) : while ($latestposts_loop->have_posts()) : $latestposts_loop->the_post(); $postcount++;      
        
        $counts = oswc_ad($ads, $cols, $postcount, $adcount, $oswc_front_latest_layout); //show ads in the loop
        $postcount = $counts[0]; //get updated post count
        $adcount = $counts[1]; //get updated ad count	
                                                            
        $thisPostType = get_post_type(); //get post type
        $thisReviewType = $oswcPostTypes->get_type_by_id($thisPostType); //get review type object	
        $isreview=false;
        if($thisPostType!='post') $isreview=true; //set review variable
        if($isreview) { 
            $icon = $thisReviewType->icon; 
			$icon_light = $thisReviewType->icon_light;
            $cat = $thisReviewType->name;
        } else {
            $cats = get_the_category();
            $cat = $cats[0]->cat_name;	
        }
        //show rating?
        $rating_hide = get_post_meta($post->ID, "Hide Rating", $single = true);
        //check if this is a video post
        $isvideo=false;
        $video = get_post_meta($post->ID, "Video", $single = true);
        if($video!="") $isvideo=true;	
        ?>
        
        <div class="post-panel<?php if($postcount % $cols == 0) { ?> right<?php } ?><?php if($oswc_front_latest_layout=="B") { ?> layout-b<?php } elseif($oswc_front_latest_layout=="C") { ?> layout-c<?php } ?><?php if(!$oswc_front_latest_more_enabled) { ?> no-more<?php } ?>">
            
            <div class="category"> 
            
                <div class="ribbon-shadow-left">&nbsp;</div>
            
                <?php if($isreview) { ?>
                        
                    <div class="icon" style="background:url(<?php echo $icon_light; ?>) no-repeat 0px 0px;">&nbsp;</div> 
                    
                <?php } ?> 
                
                <div class="catname">
                           
                    <?php echo $cat; ?> 
                    
                </div> 
                
                <div class="category-arrow">&nbsp;</div> 
                         
            </div>

			<div class="article-image">
            	<a class="thumbnail darken<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumbnailsize, array( 'title'=> '' )); ?></a>
            </div>
            
            <div class="article-image responsive-large">
            	<a class="thumbnail darken<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('loop-large', array( 'title'=> '' )); ?></a>
            </div>
            
            <div class="article-image responsive">
            	<a class="thumbnail darken<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('spotlight', array( 'title'=> '' )); ?></a>
            </div>
        
        	<?php if($oswc_front_latest_layout=="A" || $oswc_front_latest_layout=="B") { //layout A ?>
                
                <div class="inner">
                                           
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    
                    <?php if($oswc_front_latest_excerpt_enabled) { ?>
                    
                    	<div class="excerpt">
                        
                        	<?php if(!$oswc_front_sidebar_show && $oswc_front_latest_layout=="B") { ?>
						
								<?php oswc_long_excerpt(); ?>
                                
                            <?php } else { ?>
                            
                            	<?php oswc_standard_excerpt(); ?>
                            
                            <?php } ?>
                            
                        </div>
                        
                    <?php } ?>
              
                </div>
                
                <?php if($oswc_front_latest_more_enabled) { ?>
                
                    <div class="more-bar">
                            
                        <div class="arrow-catpanel-top">&nbsp;</div>
                        
                        <?php if($isreview && $rating_hide!="true") { ?>
                    
                            <div class="rating-wrapper small"><?php $oswcPostTypes->the_rating($thisReviewType); // show the rating ?></div>  
                            
                        <?php } ?> 
                        
                        <?php if(comments_open()) { ?>
                            
                            <div class="comments">
                            
                                <?php comments_popup_link(__('0 comments','made'), __('1 comment','made'), __('% comments','made'), '', '-'); ?>
                            
                            </div>
                            
                        <?php } ?>
                        
                        <?php if($oswc_front_latest_layout=="B") { ?>
                        
                        	<br class="clearer" />
                    
                    		<div class="date">
                            
                            	<?php echo get_the_date(); ?>
                                
                            </div>
                                                        
                            <div class="tags">
                            
                            	<div class="label"><?php _e('Tags:','made'); ?></div>
                            
                            	<?php echo oswc_get_tags($post->ID, '<br />'); //list tags excluding template tags ?> 
                            
                            </div>
                            
                        <?php } ?>
                        
                        <div class="more"><a href="<?php the_permalink(); ?>"><?php _e('More','made'); ?></a></div>
                        
                        <?php if($oswc_front_latest_layout=="B") { ?>
                    
                            <br class="clearer" />
                            
                        <?php } ?>
                    
                    </div> 
                    
                    <?php if($oswc_front_latest_layout=="B") { ?>
                    
                    	<br class="clearer" />
                        
                    <?php } ?>
                    
                <?php } ?> 
            
            <?php } else { //layout C ?>
            
				<?php if($oswc_front_latest_more_enabled) { ?>
                    
                    <div class="more-bar">
                            
                        <div class="arrow-catpanel-top">&nbsp;</div>
                        
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        
                        <?php if($isreview && $rating_hide!="true") { ?>
                    
                            <div class="rating-wrapper small"><?php $oswcPostTypes->the_rating($thisReviewType); // show the rating ?></div>  
                            
                        <?php } ?>
                        
                        <div class="clear-responsive">&nbsp;</div>
                        
                        <div class="date">
                        
                            <?php echo get_the_date(); ?>
                            
                        </div> 
                        
                        <?php if(comments_open()) { ?>
                        
                        	<div class="clear-responsive">&nbsp;</div>
                            
                            <div class="comments">
                            
                                <?php comments_popup_link(__('0 comments','made'), __('1 comment','made'), __('% comments','made'), '', '-'); ?>
                            
                            </div>
                            
                        <?php } ?>
                        
                        <br class="clearer" />                        
                                                    
                        <div class="tags">
                        
                            <?php echo oswc_get_tags($post->ID, ', '); //list tags excluding template tags ?> 
                        
                        </div>
                        
                        <br class="clearer" />
                    
                    </div> 
                    
                    <br class="clearer" />
                    
                <?php } ?> 
                
                <div class="inner">
                
              		<?php if(!$oswc_front_latest_more_enabled) { ?>
                
                		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        
                    <?php } ?>
                    
                    <?php if($oswc_front_latest_excerpt_enabled) { ?>
                    
                    	<div class="excerpt">
                        
							<?php if(!$oswc_front_sidebar_show) { ?>
                            
                                <?php oswc_long_excerpt(); ?>
                                
                            <?php } else { ?>
                            
                                <?php oswc_standard_excerpt(); ?>
                            
                            <?php } ?>
                            
                        </div>
                        
                    <?php } ?>
                    
                    <div class="more"><a href="<?php the_permalink(); ?>"><?php _e('More','made'); ?></a></div>                    
              
                </div>
            
            <?php } ?>
            
            <?php if(!$oswc_front_latest_more_enabled) { ?><div class="clear-responsive-small">&nbsp;</div><?php } ?>
        
        </div> 
        
        <?php if($postcount % $cols == 0) { ?> <br class="clearer non-responsive" /><?php } ?>
        
        <?php if ($postcount % 2 == 0) { // responsive designs will only have one or two max panels, so clearing every 2 works for both cases  ?>
                                    
            <div class="clear-responsive">&nbsp;</div>
    
        <?php } ?>
        
    <?php endwhile; 
    endif; ?> 
    
    <br class="clearer" /> 
        
    <?php // pagination
    pagination($wp_query->max_num_pages);
    ?> 
    
</div>

<br class="clearer" />

<?php wp_reset_query(); ?>