<?php
/**
 * Template part for displaying single posts.
 *
 * @package ievent
 */

global $post;
global $ievent_data;

?>

<div class="jx-ievent-speaker">

    
    <div class="speaker-details">
    
        <div class="speaker-photo"><?php the_post_thumbnail('speaker-bigimage'); ?></div>
        <!-- Speaker Photo -->
        
        <div class="speaker-content" data-mcs-theme="dark">
            <div class="speaker-name"><?php the_title(); ?> / <span><?php echo get_post_meta(get_the_id(),'jx_ievent_speaker_position','ievent'); ?></span>
            </div>
            
            
            <div class="speaker-social">
                <ul>
                    <?php if (get_post_meta(get_the_id(),'jx_ievent_speaker_fb','ievent')): ?>
                    <li><a href="http://www.facebook.com/<?php echo get_post_meta(get_the_id(),'jx_ievent_speaker_fb','ievent'); ?>"><i class="fa fa-facebook"></i></a></li>
                    <?php endif; ?>
                    
                    <?php if (get_post_meta(get_the_id(),'jx_ievent_speaker_twitter','ievent')): ?>
                    <li><a href="http://www.twitter.com/<?php echo get_post_meta(get_the_id(),'jx_ievent_speaker_twitter','ievent'); ?>"><i class="fa fa-twitter"></i></a></li>
                    <?php endif; ?>
                    
					<?php if (get_post_meta(get_the_id(),'jx_ievent_speaker_linkedin','ievent')): ?>
                    <li><a href="http://www.linkedin.com/<?php echo get_post_meta(get_the_id(),'jx_ievent_speaker_linkedin','ievent'); ?>"><i class="fa fa-linkedin"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- EOF Social -->	           
			<?php the_content(); ?>
        </div>
        
        <div class="clear"></div>
    </div>
   		<?php if ($ievent_data['speaker_view']=='single-page'): ?> 
        
        <?php if (get_post_meta($post->ID, 'jx_ievent_speaker_skillpercentage_1', true) ||
				get_post_meta($post->ID, 'jx_ievent_speaker_skillpercentage_2', true) ||
				get_post_meta($post->ID, 'jx_ievent_speaker_skillpercentage_3', true)||
				get_post_meta($post->ID, 'jx_ievent_speaker_skillpercentage_4', true)||
				get_post_meta($post->ID, 'jx_ievent_speaker_skillpercentage_5', true)): ?>  
                      
        	<div class="jx-ievent-container jx-ievent-padding-small">
           
           <div class="jx-ievent-title-2">
           		<div class="jx-ievent-title jx-ievent-uppercase"><?php echo 'Speakers'; ?><span> <?php echo 'Skills'; ?></span></div>
				<div class="jx-ievent-hr-title"></div>
           </div>
           
           <div class="jx-skillsbar-3 jx-bar-border jx-light">
                    <div class="skillsbar-head">
                        <div class="left"></div>
                            <div class="item-position"> 
                
                <?php 
                
                    for ($i=1; $i<5;$i++):
                    
                    if(get_post_meta($post->ID, 'jx_ievent_speaker_skillpercentage_'.$i, true)):	
                    
                     echo do_shortcode('[progress_bar percentage="'.get_post_meta($post->ID, 'jx_ievent_speaker_skillpercentage_'.$i, true).'" title="'.get_post_meta($post->ID, 'jx_ievent_speaker_skilllabel_'.$i, true).'"]');
                    
                    endif;
                    endfor; 
                
                ?>
                
                            </div>
                        </div>
                    </div>  
        </div>  
        <?php endif; ?>
        
        <?php endif; ?>        
    </div>
    

</div>