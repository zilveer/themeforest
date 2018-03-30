           <?php
				$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
				$large_image = $large_image[0]; 
				$another_image_1 = get_post_meta($post->ID, 'themnific_image_1_url', true);
				$video_input = get_post_meta($post->ID, 'themnific_video_url', true);
            ?>
            
            <div class="">
        
                <div class="imgwrap">
                
                        <span class="cats">
                        
                        	<?php the_category(', ') ?><br/> 
							<?php the_time(get_option('date_format')); ?>
                            
                        </span>
                        
                        <a href="<?php the_permalink(); ?>">
                                
                            <?php the_post_thumbnail('item_blog',array('title' => "")); ?>
                        
                        </a>
                        
                </div>	
    
                <h3><a href="<?php the_permalink(); ?>"><?php echo short_title('...', 14); ?></a></h3>
                
                <p><?php echo themnific_excerpt( get_the_excerpt(), '100'); ?></p>
        
            </div>