<?php
$post = $wp_query->post;
get_header();

$portfolio_post_img = "portfolio-img-sidebar";
$thumb_size = "content-size";

$layout = get_post_meta($post->ID, 'portfolio_page_layout', true);
?>	
    
    <div id="page-content" class="portfolio-container main-container" style="position:relative;">
  
    	<div class="container <?php echo $layout; ?>">    
        
        <!-- Media Begin --> 
        
        <div class="portfolio-post-media <?php if($layout == "fullwidth"){echo "sixteen";}else{ echo "twelve"; } ?> columns">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
            <?php 
            				
            // If not a Video Post:		
            if(!get_post_meta($post->ID, 'video_post_enable', true)){
                
                post_gallery($layout);
                
            // If Video Post:
            }else {
                
                $player_type = get_post_meta($post->ID, 'video_player_type', true);
                $video_id = get_post_meta($post->ID, 'portfolio_video_id', true);					
                            
                // If YouTube video
                if($player_type == "youtube"){
                    
                    echo '<div class="video-container"><iframe src="http://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe></div>';
                
                    
                // If Vimeo video
                }elseif($player_type == "vimeo"){
                    
                    echo '<div class="video-container"><iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe></div>';	
                    
                // If a HTML5 player
                }else{
                    
                    echo '<div class="video-container"><video controls="controls">';
                    echo '<source src="'.$video_id.'" type="video/mp4" />';
                    echo 'Your browser does not support the video tag.';
                    echo '</video></div>';
                    
                }			
            }?>
            <?php endwhile; endif; ?>  
        </div>
        
        <!-- Media End -->        
        
        <!-- Content Begin -->       
        
        <div class="portfolio-post-content <?php if($layout == "fullwidth"){echo "sixteen";}else{ echo "four"; } ?> columns">        	
        	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>            	
            	<?php the_content(); ?>
            <?php endwhile; endif; ?>
        </div>
        
        <!-- Content End --> 
    
    </div>
    
    </div>
    
    <!-- Related Work Begin-->
    
	<?php 	
	if($of_option['st_related_enabled']){
		global $of_option;
		$prefix = "st_"; 
		if($of_option[$prefix.'translate']){	
			$tr_related_work = $of_option[$prefix.'tr_related_work'];
			$tr_link = $of_option[$prefix.'tr_related_work_link'];
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
	
	<!-- Related Work End-->
    
    <?php } ?>

<?php get_footer(); ?>