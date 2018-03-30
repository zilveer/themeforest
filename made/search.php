<?php
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
$oswc_search_sidebar_unique = $oswc_other['search_sidebar_unique'];
$oswc_search_meta_enabled = $oswc_other['search_meta_enabled'];
$oswc_search_excerpt_enabled = $oswc_other['search_excerpt_enabled'];
$oswc_search_more_enabled = $oswc_other['search_more_enabled'];
$oswc_trending_show = $oswc_other['search_trending_enabled'];
$oswc_skin = $oswc_misc['skin'];

//setup ad array
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
?>

<?php
get_header(); // show header

// user specified a unique search sidebar
if ($oswc_search_sidebar_unique) {
	$sidebar="Search Sidebar";
} else {
	$sidebar="Default Sidebar";
}
?>

<div class="main-content-left"> 
		
	<div class="post-loop search-loop">

        <div class="ribbon-shadow-left">&nbsp;</div>       
        
        <div class="section-wrapper">
        
            <div class="section">
            
                <?php _e( 'Search Results', 'made' ); ?>
            
            </div>        
        
        </div>
        
        <div class="ribbon-shadow-right">&nbsp;</div>   
    
        <div class="section-arrow">&nbsp;</div>
			
		<?php if (have_posts()) : while (have_posts()) : the_post(); $postcount++;
										                    	
			$thisPostType = get_post_type(); //get post type
			$thisReviewType = $oswcPostTypes->get_type_by_id($thisPostType); //get review type object	
			$isreview=false;
			if($thisPostType!='post' && $thisPostType!='page' && $thisPostType!='attachment') $isreview=true; //set review variable	
			if($isreview) { 
                $icon = $thisReviewType->icon; 
				$icon_light = $thisReviewType->icon_light;	
				if($oswc_skin=="dark") $icon=$icon_light;	
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
			
			<div class="post-panel<?php if(!$oswc_search_more_enabled) { ?> no-more<?php } ?>">
            
            	<div class="post-thumbnail">
	
					<a class="darken small<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('widget-thumbnail', array( 'title'=> '' )); ?></a>
                    
                </div>
                
                <div class="inner">
										   
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    
                    <?php if($oswc_search_meta_enabled) { ?>
                    
                        <div class="category">
                        
                            <?php if($isreview) { ?>
                                    
                                <div class="icon" style="background:url(<?php echo $icon; ?>) no-repeat 0px 0px;">&nbsp;</div> 
                                
                            <?php } ?> 
                            
                            <div class="catname">
                                       
                                <?php echo $cat; ?> 
                                
                            </div> 
                                                             
                        </div>
                        
                        <?php if($rating_hide!="true" && $isreview) { ?>
                     
                            <div class="rating-wrapper small"><?php $oswcPostTypes->the_rating($thisReviewType); // show the rating ?></div> 
                            
                        <?php } ?> 
                        
                        <?php if(comments_open()) { ?>
                                    
                            <div class="comments">
                            
                                <?php comments_popup_link(__('0 comments','made'), __('1 comment','made'), __('% comments','made'), '', '-'); ?>
                            
                            </div>
                            
                        <?php } ?>
                        
                        <div class="date">
                                    
                            <?php echo get_the_date(); ?>
                            
                        </div>
                    
                    <?php } ?>
                    
                    <?php if($oswc_search_more_enabled) { ?>
                    
                        <div class="more"><a href="<?php the_permalink(); ?>"><?php _e('More','made'); ?></a></div>
                        
                    <?php } ?>
                    
                    <?php if($oswc_search_excerpt_enabled) { ?>
                    
                        <div class="excerpt"><?php oswc_search_excerpt(); ?></div>
                        
                    <?php } ?>
                    
                </div> 
                
                <br class="clearer" />                     
				
			</div>
			
			<br class="clearer" />
			
		<?php endwhile; 
		else: ?>
			
            <div class="page-content">
            
            	<h2><?php _e('No search results found. Please try your search again.','made'); ?></h2>
                
                <br />
                
                <div class="searchform">
            
                    <!-- SEARCH -->  
                    <form method="get" id="search404" action="<?php echo home_url(); ?>/">                             
                        <input type="text" value="<?php _e( 'search', 'made' ); ?>" onfocus="if (this.value == '<?php _e( 'search', 'made' ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'search', 'made' ); ?>';}" name="s" id="s" />          
                    </form>
                    
                </div> 
                
                <div class="note">
                
                    <?php _e( 'Enter keyword(s) and press enter', 'made' ); ?>
                    
                </div>
                
            </div>
		
		<?php endif; ?>  
			
		<br class="clearer" />
			
		<?php // pagination
		pagination($wp_query->max_num_pages);
		?> 
        
        <br class="clearer" />
		
	</div>
    
    <br class="clearer" />
    
    <?php if($oswc_trending_show) { ?>
    
    	<?php oswc_get_template_part('trending'); // show trending ?>
        
    <?php } ?>

</div>

<div class="sidebar">

    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar) ) : else : ?>
    
        <div class="widget-wrapper">
    
            <div class="widget">
    
                <div class="section-wrapper"><div class="section">
                
                    <?php _e(' Made Magazine ', 'made' ); ?>
                
                </div></div> 
                
                <div class="textwidget">  
                                              
                    <p><?php _e( 'This is a widget panel. To remove this text, login to your WordPress admin panel and go to Appearance >> Widgets, and drag &amp; drop a widget into the corresponding widget panel.', 'made' ); ?></p>
                    
                </div>
                            
            </div>
        
        </div>
    
    <?php endif; ?>

</div>

<br class="clearer" />

<?php get_footer(); // show footer ?>