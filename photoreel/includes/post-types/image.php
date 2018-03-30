<li <?php post_class(); ?>>
   
		<?php
        $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
        $large_image = $large_image[0]; 
        $another_image_1 = get_post_meta($post->ID, 'themnific_image_1_url', true);
        ?>


		<div class="imageformat">
        
            <a rel="prettyPhoto[gallery]"  href="<?php echo $large_image; ?>">  
                     <?php the_post_thumbnail('format-image'); ?>
            </a>
           
        </div>
    
   		<div style="clear: both;"></div> 
        
        <p class="special"><?php echo tmnf_icon() ?> <?php _e('Image','themnific');?>: <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>

                <p class="meta sserif">
                
                  	<i class="icon-time"></i> <?php _e('on','themnific');?>  <?php the_time(get_option('date_format')); ?><br/> 
                  	<i class="icon-copy"></i> <?php _e('in','themnific');?> <?php the_category(', ') ?><br/> 
                  	<i class="icon-edit"></i> <?php _e('by','themnific');?> <?php the_author_posts_link(); ?><br/> 
                  	<i class="icon-comments-alt"></i> <?php _e('with','themnific');?> <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><br/> 
                
                	<a class="tmnf-sc-button  custom xl fl" href="<?php the_permalink(); ?>"><?php _e('Read More','themnific');?> &#187;</a>
                
                </p>
            
</li>