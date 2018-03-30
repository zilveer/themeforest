<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        	<div <?php post_class('twinsbox'); ?>> 
            
			<?php if (get_option('themnific_post_bread_dis') == 'true' );
            else { ?>
            
            <div class="postinfo body2">
            
                  <span class="fl">
                      <p><?php the_breadcrumb(); ?></p>
                  </span>
                  
                  <span class="fr">
                      <?php the_tags( '<p><i class="icon-tags"></i>  ',', ',  '</p>'); ?>
                  </span>
                
            </div>
            <?php }?>
 
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
						if (get_option('themnific_post_image_dis') == 'true' );
						else
                           the_post_thumbnail('format-image', array('class' => 'main-single'));  
                                
            }?>
			
            <div style="clear: both;"></div>
            
            <h2 class="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            

                <p class="meta sserif">
                
                  	<i class="icon-time"></i> <?php _e('on','themnific');?>  <?php the_time(get_option('date_format')); ?><br/> 
                  	<i class="icon-copy"></i> <?php _e('in','themnific');?> <?php the_category(', ') ?><br/> 
                  	<i class="icon-edit"></i> <?php _e('by','themnific');?> <?php the_author_posts_link(); ?><br/> 
                  	<i class="icon-comments-alt"></i> <?php _e('with','themnific');?> <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><br/> 
                
                </p>
         
            
            <div class="entry">
            
            	<?php the_content(); ?>
            
            	<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','themnific') . '</span>', 'after' => '</div>' ) ); ?>
            
            	<?php 
					if (get_option('themnific_post_social_dis') == 'true' );
					else
					get_template_part('/includes/mag-buttons');
				?>
            
            	<div style="clear: both;"></div>
                
            	<?php 
					if (get_option('themnific_post_related_dis') == 'true' );
					else 
					get_template_part('/includes/mag-relatedposts');
				?>
                            
            	<?php 
					if (get_option('themnific_post_author_dis') == 'true' );
					else
					get_template_part('/includes/mag-authorinfo');
				?>
            
            	<div style="clear: both;"></div>
            
            	<?php comments_template(); ?>
            
                <p>
                <?php previous_post_link('<span class="fl" style="width:45%;">&laquo; %link</span>'); ?>
                <?php next_post_link('<span class="fr" style="width:45%; text-align:right">%link &raquo;</span>'); ?>
                </p>
            
            </div>
            
            </div>

	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria','themnific');?>.</p>

	<?php endif; ?>

    <div style="clear: both;"></div>

