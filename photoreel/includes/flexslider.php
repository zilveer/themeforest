<div class="mainflex_holder">
<div class="mainflex_wrap">
      
            <div class="mainflex flexslider">
            
                <ul class="slides">
                	
					<?php $loop = new WP_Query( array( 'post_type' => 'myslidertype', 'posts_per_page' => '99'  ) ); ?>
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <?php 
		
					$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
					$large_image = $large_image[0]; 
					$another_image_1 = get_post_meta($post->ID, 'themnific_image_1_url', true);
					$size = get_post_meta($post->ID, 'themnific_size', true);
					$slider_url = get_post_meta($post->ID, 'themnific_slider_url', true);
					$slider_content = get_post_meta($post->ID, 'themnific_slider_inside', true);
					$video_input = get_post_meta($post->ID, 'themnific_slider_video', true);
					?>  
                    
                        <li>
                        
                            
                            <?php if($video_input) {?>
                            
                                    <?php echo ($video_input); ?>
                                    
                            <?php } else {?>
                            
                        
                            <a href="<?php echo $slider_url; ?>">
                            
                            	<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full' ); } ?>
                                
                            </a>
                            
                            <?php }?> 
                            
                            <div style="clear: both;"></div>
                            
                            <?php if($slider_content == 'Yes')  {?>
                            
                                <div class="stuff">
                                
                                    <div class="flexhead">
                                
                                        <h2><a href="<?php echo $slider_url; ?>"><?php echo short_title('...', 9); ?></a></h2>
                                    
                                    </div>
                                    
                                    <div class="teaser">
                                        
                                    <?php the_content(); ?>
                                    
                                    </div>
                                    
                                </div>
                                
                           	<?php } else ?>
                                <div style="clear: both;"></div>
                        </li>
                        
                    <?php endwhile; ?>
                    
                </ul>
                
            </div>
            
        <?php wp_reset_query(); ?>
</div>
</div>