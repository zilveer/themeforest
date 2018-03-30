<li <?php post_class(); ?>>

			<?php 
			$video_input = get_post_meta($post->ID, 'tmnf_video', true);
			$audio_input = get_post_meta($post->ID, 'tmnf_audio', true);
			?>

			<?php 	if(has_post_format('video')){
                            echo ($video_input);
                    }elseif(has_post_format('audio')){
                            echo ($audio_input);
                    }elseif(has_post_format('gallery')){
						if (get_option('themnific_post_gallery_dis') == 'true' );
						else
                            echo get_template_part( '/includes/post-types/gallery-slider' );
                    } else {
                           the_post_thumbnail('main-single', array('class' => 'main-single'));  
                                
            }?>
            
			<div style="clear: both;"></div>
            
            <h2 class="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

    		<div class="entry">  

				<?php global $more; $more = 0; ?>
                
                <?php the_content('Continue Reading'); ?> 
                  
           	</div>

                <p class="meta sserif">
                
                  	<i class="icon-time"></i> <?php _e('on','themnific');?>  <?php the_time(get_option('date_format')); ?><br/> 
                  	<i class="icon-copy"></i> <?php _e('in','themnific');?> <?php the_category(', ') ?><br/> 
                  	<i class="icon-edit"></i> <?php _e('by','themnific');?> <?php the_author_posts_link(); ?><br/> 
                  	<i class="icon-comments-alt"></i> <?php _e('with','themnific');?> <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><br/> 
                
                	<a class="tmnf-sc-button  custom xl fl" href="<?php the_permalink(); ?>"><?php _e('Read More','themnific');?> &#187;</a>
                
                </p>
                  
</li>