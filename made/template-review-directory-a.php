<?php
// Template Name: Review Directory Layout A
?>

<?php
//get theme options
global $oswc_other, $oswc_misc, $oswcPostTypes;
$oswc_skin = $oswc_misc['skin'];
$oswc_directory_sidebar_enabled = $oswc_other['directory_sidebar_enabled'];
$oswc_directory_exclude_type = $oswc_other['directory_exclude_type'];
		
//need to know which custom post type sidebars to enable
$typecount=0;//find out if we have any review types active
foreach($oswcPostTypes->postTypes as $postType){	
	if($postType->enabled){
		$typecount++;
	}
}

get_header(); // show header

//set sidebar options
if($oswc_directory_sidebar_enabled) {
	$cols=2;
} else {
	$cols=3;	
}
$sidebar="Default Sidebar";
?>

<div class="main-content<?php if($oswc_directory_sidebar_enabled) { ?>-left<?php } ?>"> 
		
    <div class="post-loop directory">

        <div class="ribbon-shadow-left">&nbsp;</div>       
        
        <div class="section-wrapper">
        
            <div class="section">
            
                <?php echo _e('Review Directory','made'); ?>
            
            </div>        
        
        </div>
        
        <div class="ribbon-shadow-right">&nbsp;</div>   
    
        <div class="section-arrow">&nbsp;</div>
			
		<?php 
		$typecount=0;
		foreach($oswcPostTypes->postTypes as $postType){	
			if($postType->enabled && strpos($oswc_directory_exclude_type,$postType->name)===false){				
				$args='&post_type=' . $postType->id . '&posts_per_page=' . -1;
				$review_loop = new WP_Query($args); 
				$typecount++;  //counter for the review types
				$postcount=0; //reset for each review type
				$icon = $postType->icon;
				$icon_light = $postType->icon_light;	
				if($oswc_skin=="dark") $icon=$icon_light;	
				$color = $postType->color;
				if($color=='') $color='#666'; //if no color specified, default to #666
				?>
                
                <div class="post-panel<?php if($typecount % $cols == 0) { ?> right<?php } ?>">
                
                	<div class="header">
                    
                    	<div class="more"><a href="<?php echo $postType->more_link ?>"><?php _e('More','made'); ?></a></div>
                    
						<h2 style="background:url(<?php echo $icon; ?>) no-repeat 0px 0px;"><?php echo $postType->name; ?></h2>
                        
                        <div class="arrow-catpanel-bottom">&nbsp;</div> 
                        
                    </div>
                    
                    
                    <?php if ($review_loop->have_posts()) : while ($review_loop->have_posts()) : $review_loop->the_post(); $postcount++;
            
                        //show rating?
                        $rating_hide = get_post_meta($post->ID, "Hide Rating", $single = true); 	
                        ?>
                        
                        <?php if($rating_hide!="true") { ?>
                        
                            <div class="rating-wrapper small<?php if($postcount==1) { ?> first<?php } ?>"><?php $oswcPostTypes->the_rating($postType); // show the rating ?></div>  
                            
                        <?php } ?> 
                            
                        <a style="color:#<?php echo $color; ?>" class="title<?php if($postcount % 2 == 0) { ?> alt<?php } if($postcount==1) { ?> first<?php } if($postcount==$review_loop->post_count) { ?> last<?php } ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>         
                        
                        
                    <?php endwhile; //review type post loop
                    endif; //end if review type has posts ?> 
                
                </div> 
                
                <?php if($typecount % $cols == 0) { ?> <br class="clearer" /><?php } ?>
                
        	<?php } //end if review type is enabled ?>
            
        <?php } //end for each review type ?>
		
	</div>
    
    <br class="clearer" />
    
    <?php if($reviewTrendingEnabled) { ?>
    
    	<?php oswc_get_template_part('trending'); // show trending ?>
        
    <?php } ?>

</div>

<?php if($oswc_directory_sidebar_enabled) { ?>

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