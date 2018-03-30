<?php 	
if($of_option['st_related_enabled']){
	global $of_option;
	$prefix = "st_"; 
	if(!$of_option[$prefix.'translate']){	
		$tr_related_work = $of_option[$prefix.'tr_related_work'];
		$tr_link = $of_option[$prefix.'tr_recent_work_link'];
	}else{			
		$tr_related_work = __('Related Work', 'spacing');	
		$tr_link = __('View Portfolio', 'spacing');	
	}
	$project_type = portfolio_post_class();
	$id = $of_option[$prefix.'recent_work_url'];
	$url = get_permalink($id);
?>
    
    <div id="related-work" class="main-container">
    
    	<div class="container">
    
    	<?php 
    		echo '<div class="sixteen columns">';
    		echo "<h3>".$tr_related_work."</h3>";
    		echo '<a class="recent-more" href="'.$url.'">'.$tr_link.' →</a>';
    		echo '</div>';			
    	 ?>
        
        <?php wp_reset_query(); query_posts('post_type=portfolio&project-type='.$project_type.'&posts_per_page=4'); if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="four columns">
                
            <div class="portfolio-item <?php portfolio_item_class(); ?>">
    
                <div class="portfolio-thumbnail-holder <?php portfolio_holder_class(); ?>">
    
                    <a <?php portfolio_post_href(1); ?>>
                    
                        <div class="portfolio-thumbnail">
                        <?php the_post_thumbnail('one-half'); ?>
                        </div>
                                            
                        <span class="overlay-content">                            
                            <span class="overlay-title"><?php the_title(); ?></span>
                            <span class="overlay-link"><span class="<?php portfolio_overlay_link(); ?>"></span></span>
                        </span>
                        
                    </a>                
                    <?php lightbox_gallery_images(); ?>
                           
                </div>
            </div>
                    
        </div>
        <?php endwhile; endif; wp_reset_query(); ?>
        
        </div>
    	
    </div>