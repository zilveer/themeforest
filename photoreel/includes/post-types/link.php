<li <?php post_class(); ?>>
            
	<h2 class="heading"><a href="<?php echo get_post_meta($post->ID, 'tmnf_linkss', true); ?>"><?php echo tmnf_icon() ?> <?php _e('[Link]','themnific');?> <?php the_title(); ?></a></h2>
    
    		<div class="entry">  
            
				<p><?php echo themnific_excerpt( get_the_excerpt(), '350'); ?></p>
                  
           	</div>
    
                <p class="meta sserif">
                
                  	<i class="icon-time"></i> <?php _e('on','themnific');?>  <?php the_time(get_option('date_format')); ?><br/> 
                  	<i class="icon-copy"></i> <?php _e('in','themnific');?> <?php the_category(', ') ?><br/> 
                  	<i class="icon-edit"></i> <?php _e('by','themnific');?> <?php the_author_posts_link(); ?><br/> 
                  	<i class="icon-comments-alt"></i> <?php _e('with','themnific');?> <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><br/> 
                
                	<a class="tmnf-sc-button  custom xl fl" href="<?php echo get_post_meta($post->ID, 'tmnf_linkss', true); ?>"><?php _e('Read More','themnific');?> &#187;</a>
                
                </p>
        
        
            
</li>