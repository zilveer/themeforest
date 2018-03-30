			<?php
				$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
				$large_image = $large_image[0]; 
				$another_image_1 = get_post_meta($post->ID, 'themnific_image_1_url', true);
				$video_input = get_post_meta($post->ID, 'themnific_video_url', true);
            ?>
            
            <div class="item_full">
        
                <div class="imgwrap">
                        
                        <a href="<?php the_permalink(); ?>">
                                
                            <?php the_post_thumbnail('folio-2col',array('title' => "")); ?>
                        
                        </a>
                        
                </div>	
                
                <div class="inn">
    
                    <h3><a href="<?php the_permalink(); ?>"><?php echo short_title('...', 8); ?></a></h3>
                    
                    <a href="<?php the_permalink(); ?>"><i class="icon-circle-arrow-right"></i> <?php _e('Read More','themnific');?></a>
                
                </div>
                
                <span class="cats">
                	<?php 
						$terms_as_text = get_the_term_list( $post->ID, 'categories', '', ' &bull; ', '' ) ;
						echo strip_tags($terms_as_text);
					?>   
              	</span>
        
            </div>