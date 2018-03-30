<?php
$prefix = "st_"; 
if($of_option[$prefix.'translate']){	
	$tr_title = $of_option[$prefix.'tr_recent_posts'];
	$tr_excerpt = $of_option[$prefix.'tr_recent_posts_excerpt'];
	$tr_link = $of_option[$prefix.'tr_recent_posts_link'];
}else{			
	$tr_title = __('Recent Work', 'spacing');	
	$tr_excerpt = __('This is an example text of the Homepage Recent Posts section.', 'spacing');
	$tr_link = __('View Portfolio', 'spacing');	
}
$id = $of_option[$prefix.'recent_posts_url'];
$url = get_permalink($id);
?>

	<!-- Recent Posts Begin-->
    <?php
	if($of_option['st_recent_posts_layout'] == 4){
			$posts_nr = 4;
			echo '<div class="divider title divider-homepage"><a href='.$url.'>'.$tr_title.'</a></div>';
	}
	
	?>
	<div id="recent-posts" class="container <?php echo $layout; ?>">    
            
            <?php if($of_option['st_recent_posts_layout'] == 3){ $posts_nr = 3; ?>
            <div class="four columns">
                <h3><?php echo $tr_title ?></h3>
                <p><?php echo $tr_excerpt ?></p>
                <a class="homepage-more" href="<?php echo $url ?>"><?php echo $tr_link ?> →</a>
            </div>
            <?php } ?>            
			<?php wp_reset_query(); query_posts('post_type=post&posts_per_page='.$posts_nr); if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="four columns">
            
                <div class="homepage-post-thumbnail">
                    <a class="opacity-hover" href="<?php the_permalink() ?>"><?php the_post_thumbnail('one-half'); ?></a>
                </div>                	
                <h4 class="homepage-post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4> 
                  
                <div class="homepage-post-meta classic-meta-section"><?php the_time('M d, Y'); ?></div> 
                              
                <?php the_excerpt(); ?>                
                
            </div>
            <?php endwhile; endif; wp_reset_query(); ?>
    	
    </div>
	<!-- Recent Posts End-->