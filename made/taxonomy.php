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
$oswc_review_sidebar_unique = $oswc_other['review_sidebar_unique'];
$oswc_review_num = $oswc_other['review_num'];
	
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

wp_reset_query(); // reset the query
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 

$current_term = get_term_by( 'slug', $wp_query->query_vars[$term->taxonomy], $term->taxonomy );
$headertext=ucfirst($current_term->name)." Reviews:";

global $query_string;
$args=$query_string . '&paged='.$paged.'&posts_per_page='.$oswc_review_num;

$postTypeId = get_post_type();
$postType = $oswcPostTypes->get_type_by_id($postTypeId);
if(isset($postType)) {
	$primaryTaxonomy = $postType->get_primary_taxonomy($postTypeId);
	
	echo '<!--';
	echo '$primaryTaxonomy->id: ' . $primaryTaxonomy->id;
	echo '; $primaryTaxonomy->name: ' . $primaryTaxonomy->name;
	echo '-->';
	
	$currentTaxonomy = $postType->get_taxonomy_by_id(get_query_var( 'taxonomy' ));
	$excerptTaxonomies = $postType->get_excerpt_taxonomies();
	
	//get review type taxonomy options
	$reviewLayout=$postType->tax_layout;
	$reviewMetaEnabled=$postType->tax_meta_enabled;
	$reviewSidebarEnabled=$postType->tax_sidebar_enabled;
	$reviewExcerptEnabled=$postType->tax_excerpt_enabled;
	$reviewTrendingEnabled=$postType->tax_trending_enabled;
	
	//set defaults
	if(empty($reviewLayout)) $reviewLayout='A';	
	
}

// user specified a unique review sidebar
if ($oswc_review_sidebar_unique) {
	$sidebar=$postType->name . " Sidebar";
} else {
	$sidebar="Default Sidebar";
}
//get proper thumbnail size based on layout
switch ($reviewLayout) {
	case "A":
		$thumbnailsize="spotlight";
		if($reviewSidebarEnabled) {
			$cols=2;
		} else {
			$cols=3;	
		}
		break;
	case "B":
		$thumbnailsize="loop-large";
		if(!$reviewSidebarEnabled) {
			$thumbnailsize="loop-large-full";
		}
		$cols=1;
		break;
	case "C":
		$thumbnailsize="spotlight";
		if(!$reviewSidebarEnabled) {
		}
		$cols=1;
}
?>

<?php $review_loop = new WP_Query($args); ?>

<div class="main-content<?php if($reviewSidebarEnabled) { ?>-left<?php } ?>"> 
		
    <div class="post-loop">

        <div class="ribbon-shadow-left">&nbsp;</div>       
        
        <div class="section-wrapper">
        
            <div class="section">
            
                <?php echo $term->name; ?>
            
            </div>        
        
        </div>
        
        <div class="ribbon-shadow-right">&nbsp;</div>   
    
        <div class="section-arrow">&nbsp;</div>
			
		<?php if ($review_loop->have_posts()) : while ($review_loop->have_posts()) : $review_loop->the_post(); $postcount++;
		
			$counts = oswc_ad($ads, $cols, $postcount, $adcount, $reviewLayout); //show ads in the loop
            $postcount = $counts[0]; //get updated post count
			$adcount = $counts[1]; //get updated ad count	
			//show rating?
			$rating_hide = get_post_meta($post->ID, "Hide Rating", $single = true); 	
			//check if this is a video post
			$isvideo=false;
			$video = get_post_meta($post->ID, "Video", $single = true);
			if($video!="") $isvideo=true;	
			?>
			
			<div class="post-panel<?php if($postcount % $cols == 0) { ?> right<?php } ?><?php if($reviewLayout=="B") { ?> layout-b<?php } elseif($reviewLayout=="C") { ?> layout-c<?php } ?><?php if(!$reviewMetaEnabled) { ?> no-more<?php } ?>">				
                
                <div class="article-image">
                    <a class="thumbnail darken<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumbnailsize, array( 'title'=> '' )); ?></a>
                </div>
                
                <div class="article-image responsive-large">
                    <a class="thumbnail darken<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('loop-large', array( 'title'=> '' )); ?></a>
                </div>
                
                <div class="article-image responsive">
                    <a class="thumbnail darken<?php if($isvideo) { ?> video<?php } ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('spotlight', array( 'title'=> '' )); ?></a>
                </div>
    
                <?php if($reviewLayout=="A" || $reviewLayout=="B") { //layout A ?>
                    
                    <div class="inner">
                                               
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        
                        <?php if($reviewExcerptEnabled) { ?>
                        
                            <div class="excerpt">
                            
                                <?php if(!$reviewSidebarEnabled && $reviewLayout=="B") { ?>
                            
                                    <?php oswc_long_excerpt(); ?>
                                    
                                <?php } else { ?>
                                
                                    <?php oswc_standard_excerpt(); ?>
                                
                                <?php } ?>
                                
                            </div>
                            
                        <?php } ?>
                  
                    </div>
                    
                    <?php if($reviewMetaEnabled) { ?>
                    
                        <div class="more-bar">
                                
                            <div class="arrow-catpanel-top">&nbsp;</div>
                            
                            <?php if($rating_hide!="true") { ?>
                        
                                <div class="rating-wrapper small"><?php $oswcPostTypes->the_rating($postType); // show the rating ?></div>  
                                
                            <?php } ?> 
                            
                            <?php if(comments_open()) { ?>
                                
                                <div class="comments">
                                
                                    <?php comments_popup_link(__('0 comments','made'), __('1 comment','made'), __('% comments','made'), '', '-'); ?>
                                
                                </div>
                                
                            <?php } ?>
                            
                            <?php if($reviewLayout=="B") { ?>
                            
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
                            
                            <?php if($reviewLayout=="B") { ?>
                        
                                <br class="clearer" />
                                
                            <?php } ?>
                        
                        </div> 
                        
                        <?php if($reviewLayout=="B") { ?>
                        
                            <br class="clearer" />
                            
                        <?php } ?>
                        
                    <?php } ?> 
                
                <?php } else { //layout C ?>
                
                    <?php if($reviewMetaEnabled) { ?>
                        
                        <div class="more-bar">
                                
                            <div class="arrow-catpanel-top">&nbsp;</div>
                            
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            
                            <?php if($rating_hide!="true") { ?>
                        
                                <div class="rating-wrapper small"><?php $oswcPostTypes->the_rating($postType); // show the rating ?></div>  
                                
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
                    
                        <?php if(!$reviewMetaEnabled) { ?>
                    
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            
                        <?php } ?>
                        
                        <?php if($reviewExcerptEnabled) { ?>
                        
                            <div class="excerpt">
                            
                                <?php if(!$reviewSidebarEnabled) { ?>
                                
                                    <?php oswc_long_excerpt(); ?>
                                    
                                <?php } else { ?>
                                
                                    <?php oswc_standard_excerpt(); ?>
                                
                                <?php } ?>
                                
                            </div>
                            
                        <?php } ?>
                        
                        <div class="more"><a href="<?php the_permalink(); ?>"><?php _e('More','made'); ?></a></div>
                  
                    </div>
                
                <?php } ?>                       
				
			</div>
			
			<?php if($postcount % $cols == 0) { ?> <br class="clearer" /><?php } ?>
			
		<?php endwhile;		
		endif; ?>  
        
        <br class="clearer" />
			
		<?php // pagination
		pagination($review_loop->max_num_pages);
		?> 
        
        <?php if(!$review_loop->have_posts()) { //no posts in this taxonomy ?>
        
        	<div style="padding:50px;">
			
            	<h2><?php _e( 'There are no posts in the selected taxonomy.','made' ); ?></h2>
                
            </div>
            
		<?php } ?>
		
	</div>
    
    <br class="clearer" />
    
    <?php if($reviewTrendingEnabled) { ?>
    
    	<?php oswc_get_template_part('trending'); // show trending ?>
        
    <?php } ?>

</div>

<?php if($reviewSidebarEnabled) { ?>

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
	
<?php } ?>		

<br class="clearer" />

<?php get_footer(); // show footer ?>