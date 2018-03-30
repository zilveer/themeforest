<?php
$prefix = "st_"; 
if($of_option[$prefix.'translate']){	
	$tr_title = $of_option[$prefix.'tr_recent_work'];
	$tr_excerpt = $of_option[$prefix.'tr_recent_work_excerpt'];
	$tr_link = $of_option[$prefix.'tr_recent_work_link'];
}else{			
	$tr_title = __('Recent Work', 'spacing');	
	$tr_excerpt = __('This is an example text of the Homepage Recent Work section.', 'spacing');
	$tr_link = __('View Portfolio', 'spacing');	
}
$id = $of_option[$prefix.'recent_work_url'];
$url = get_permalink($id);
?>
    
    <!-- Recent Work Begin-->
    <?php
	if($of_option['st_recent_work_layout'] == 4){
			$posts_layout = 4;
			echo '<div class="divider title divider-homepage"><a href='.$url.'>'.$tr_title.'</a></div>';
	}
	
	?>
	<div id="recent-work" class="container">
    
    	<?php if($of_option['st_recent_work_layout'] == 3){ $posts_layout = 3; ?>
    	<div class="four columns">
        	<h3><?php echo $tr_title ?></h3>
            <p><?php echo $tr_excerpt ?></p>
            <a class="homepage-more" href="<?php echo $url ?>"><?php echo $tr_link ?> →</a>
        </div>
        <?php } ?>
        <div class="thumbnails-holder">
        <?php wp_reset_query(); query_posts('post_type=portfolio&orderby=menu_order&order=ASC&posts_per_page='.$of_option['st_recent_work_nr']); if (have_posts()) : while (have_posts()) : the_post(); ?>
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
	<!-- Recent Work End-->