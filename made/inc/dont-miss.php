<?php //get theme options
global $oswc_front, $oswc_misc, $oswcPostTypes;

//set theme options
$oswc_front_sidebar_show = $oswc_front['sidebar_show'];
$oswc_rss_feed = $oswc_misc['rss_feed'];
$oswc_feedburner = $oswc_misc['feedburner'];
$oswc_facebook_url = $oswc_misc['facebook_url'];
$oswc_twitter_url = 'http://twitter.com/'.$oswc_misc['twitter_name'];
$oswc_dontmiss_header = $oswc_misc['dontmiss_header'];
$oswc_dontmiss_scroll = $oswc_misc['dontmiss_scroll'];
$oswc_dontmiss_tags = $oswc_misc['dontmiss_tag'];
$oswc_dontmiss_num = $oswc_misc['dontmiss_num'];
$oswc_dontmiss_type = $oswc_misc['dontmiss_type'];
$oswc_dontmiss_email_header = $oswc_misc['dontmiss_email_header'];
$oswc_dontmiss_widget_type = $oswc_misc['dontmiss_widget_type'];

$dontmisserror = "";
if($oswc_dontmiss_type=="tag") {
	$dontmissargs = array('tag_id' => get_tag_id($oswc_dontmiss_tags), 'posts_per_page' => $oswc_dontmiss_num);
	$terms = get_terms('post_tag', array('name' => $oswc_dontmiss_tags)); //get term object for this tag
	if(empty($terms)) $slidererror = __("The tag you specified in the theme options for the Don't Miss Slider does not match a tag slug in your database.","made");
	$termslug = $terms[0]->slug; //get the slug
	$morelink = get_term_link($termslug,'post_tag'); //get the permalink for this tag	
	$oswc_dontmiss_tags = get_term_by('slug', $oswc_dontmiss_tags, 'post_tag')->name;
} elseif($oswc_dontmiss_type=="category") {
	$dontmissargs = array('cat' => get_category_id($oswc_dontmiss_tags), 'posts_per_page' => $oswc_dontmiss_num);
	$terms = get_terms('category', array('name' => $oswc_dontmiss_tags)); //get term object for this category
	if(empty($terms)) $slidererror = __("The category you specified in the theme options for the Don't Miss Slider does not match a category slug in your database.","made");
	$termslug = $terms[0]->slug; //get the slug
	$morelink = get_term_link($termslug,'category'); //get the permalink for this category
	$oswc_dontmiss_tags = get_category_by_slug($oswc_dontmiss_tags)->name;
} elseif ($oswc_dontmiss_type=="review") {
	$thisReviewType = $oswcPostTypes->get_type_by_name($oswc_dontmiss_tags); //see if review type entered matches one in the system
	$thisReviewSlug = $thisReviewType->id; //get the slug for use in the query
	$dontmissargs = array('post_type' => $thisReviewSlug, 'posts_per_page' => $oswc_dontmiss_num);
	$morelink = oswc_review_permalink($oswc_dontmiss_tags); //get permalink for this review page
	if($thisReviewSlug=='') $slidererror = __("The review type you specified in the theme options for the Don't Miss Slider does not match a review type in your database.","made");
} else {
	$dontmissargs = array('posts_per_page' => $oswc_dontmiss_num);
}

//see if we're on a review page. if so, create the reviewtype object and set a boolean review variable to true
$reviewPage = false;
$postTypeName = oswc_get_review_meta($post->ID);
$postTypeId = get_post_type( $wp_query->post->ID ); //setup the posttypeid object, which is used below to determine which post type we're on
//review listing page
if(!empty($postTypeName) && ($oswcPostTypes->has_type($postTypeName) || $oswcPostTypes->has_type(strtolower($postTypeName)))){
	$reviewPage = true;	
	$reviewType = $oswcPostTypes->get_type_by_name($postTypeName); //get the review type object
	$reviewDontmissEnabled = $reviewType->dontmiss_enabled;
}
//review taxonomy page
if(is_tax()) {
	$reviewPage = true;
	$reviewType = $oswcPostTypes->get_type_by_id($postTypeId); //get the review type object
	$reviewDontmissEnabled=$reviewType->tax_dontmiss_enabled;
} elseif (is_single() && $oswcPostTypes->has_type($postTypeId, true)) {
	$reviewPage = true;
	$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);
	$reviewDontmissEnabled=$reviewType->single_dontmiss_enabled;
}

?>

<?php if(!$reviewPage || ($reviewPage && $reviewDontmissEnabled)) { //show the dontmiss slider on this review listing page? ?>
    
    <div id="dontmiss-bar">
    
    	<div class="ribbon-shadow-left">&nbsp;</div>
    
    	<div id="dontmiss-header"><?php echo $oswc_dontmiss_header; ?></div>
        
        <div id="dontmiss-arrow">&nbsp;</div>
            
        <div class="dontmiss"<?php if($oswc_dontmiss_scroll) { ?> id="dontmiss"<?php } ?>>    
                    
			<?php 					
            query_posts ( $dontmissargs );
            if (have_posts()) : while (have_posts()) : the_post();					
                ?>	
        
                <div class="panel">                    
                    
                    <div class="image">
                    	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('footer-thumbnail', array( 'title'=> '' )); ?></a> 
                    </div>
                    <div class="title">                           
                        <a href="<?php the_permalink(); ?>">                                
                            <?php the_title(); ?>                                
                        </a> 
                    </div>                  
                    
                </div>
                
            <?php endwhile; endif; ?>
        
        </div>
        
        <div id="dontmiss-email" class="signup">
        
        	<?php if($oswc_dontmiss_widget_type=="Signup") { ?>
            
            	<h3><?php echo $oswc_dontmiss_email_header; ?></h3>
                
                <form id="feedburner_subscribe" class="subscribe" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $oswc_feedburner; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
                    
                    <div class="email-wrapper">
                        <input type="text" name="email"/>
                        <input type="hidden" value="<?php echo $oswc_feedburner; ?>" name="uri"/>
                        <input type="hidden" name="loc" value="en_US"/>
                    </div>
                        
                    <input type="image" src="<?php echo get_template_directory_uri(); ?>/images/signup.png" class="btn" title="<?php _e('You will receive a daily email with new content from our website.','made'); ?>" onclick="document.feedburner_subscribe.submit();" />
                    
                </form>
                
                <br class="clearer" />
            
            <?php }elseif($oswc_dontmiss_widget_type=="Social") { ?>
            
            	<div class="dontmiss-social">
                        
                    <a href="<?php echo $oswc_rss_feed; ?>" class="rss">&nbsp;</a>
                    
                    <a href="<?php echo $oswc_facebook_url; ?>" class="facebook">&nbsp;</a>
                    
                    <a href="<?php echo $oswc_twitter_url; ?>" class="twitter">&nbsp;</a>
                
                </div>
            
            <?php }else{ ?>
        
				<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Signup Widget') ) : else : ?>
            
                    <h3><?php echo $oswc_dontmiss_email_header; ?></h3>
                    
                    <form id="feedburner_subscribe" class="subscribe" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $oswc_feedburner; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
                        
                        <div class="email-wrapper">
                            <input type="text" name="email"/>
                            <input type="hidden" value="<?php echo $oswc_feedburner; ?>" name="uri"/>
                            <input type="hidden" name="loc" value="en_US"/>
                        </div>
                            
                        <input type="image" src="<?php echo get_template_directory_uri(); ?>/images/signup.png" class="btn" title="<?php _e('You will receive a daily email with new content from our website.','made'); ?>" onclick="document.feedburner_subscribe.submit();" />
                        
                    </form>
                    
                    <br class="clearer" />
                    
                <?php endif; ?>
                
            <?php } ?>
        
        </div>
        
        <br class="clearer" />
    
    </div> <!-- end don't miss posts -->
    
<?php } ?>

<?php wp_reset_query(); ?>