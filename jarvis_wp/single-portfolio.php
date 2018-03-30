<?php get_header(); ?> 

<?php  get_template_part('menu_section');  ?>

    <div class="section post-single"><!-- SECTION -->


 <?php if (have_posts()) : while (have_posts()) : the_post();     ?>   
		<div class="container">	
           <div class="row">	
			<div class="sixteen columns">            
	            <!-- START TITLE -->	            
				<div class="title">
				  <h1 class="header-text"><?php if(get_post_meta( get_the_ID(), 'rnr_alt_title', true )){ echo get_post_meta( get_the_ID(), 'rnr_alt_title', true ); } else { the_title(); } ?></h1>
                </div><!-- END TITLE -->  	                           
			</div><!-- END SIXTEEN COLUMNS -->  
           </div><!-- END ROW -->         
          </div><!-- END CONTAINER -->    
<?php endwhile;
endif; 

wp_reset_query();  
?> 

    
    <div class="container">
     <div class="row">
  	
     <div id="ajaxpage">	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="<?php if($smof_data['rnr_portfolio_single_type']=="Side By Side") { echo 'eleven columns';} else { echo 'sixteen columns'; } ?> project-media">	
                          
                <?php
				
				 $slider_meta = get_post_meta( get_the_ID( ), 'rnr_project_item_slides', false );	
				 
				 if(!empty($slider_meta)) { ?>           
                   <div class="flexslider">
                            <ul class="slides">
                            <?php global $wpdb, $post;
                            if ( !is_array( $slider_meta ) )
                                $slider_meta = ( array ) $slider_meta;
                            if ( !empty( $slider_meta ) ) {
                                      foreach ( $slider_meta as $att ) {
                                    // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
                                    $image_src = wp_get_attachment_image_src( $att, 'full' );
                                    $image_src2= wp_get_attachment_image_src( $att, '');
                                    $image_src = $image_src[0];
                                    $image_src2 = $image_src2[0];
									$slide = get_attachment_caption($att);
									
                                    // Show image
                                    echo '<li><img src="'.$image_src.'" /><div class="flex-caption">';
									
									if(!empty($slide['caption'])) echo '<h4>'.$slide['caption'].'</h2>';
									if(!empty($slide['description'])) echo '<p>'.$slide['description'].'</p>';
									echo '</div></li>';
                                }
                            } ?>
                            </ul>
                        </div><!-- end of portfolio slider -->

			
				<?php 
					 } else if(get_post_meta(get_the_ID(), 'rnr_project_video_embed', true)!='') { 
					  
							  if (get_post_meta( get_the_ID(), 'rnr_project_video_type', true ) == 'vimeo') {  
								  echo '<div id="portfolio-video"><iframe src="http://player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'rnr_project_video_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="960" height="540" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';  
							  }  
							  else if (get_post_meta( get_the_ID(), 'rnr_project_video_type', true ) == 'youtube') {  
								  echo '<div id="portfolio-video"><iframe width="960" height="540" src="http://www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'rnr_project_video_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe></div>';  
							  } 
					 } else if(get_post_meta(get_the_ID(), 'rnr_projectaudiourl', true)!='') { 
                              echo '<div id="portfolio-video">'.get_post_meta(get_the_ID(), 'rnr_projectaudiourl', true).'</div>';
                    } else { 
							 $att=get_post_thumbnail_id();
							 $image_src = wp_get_attachment_image_src( $att, 'full' );
							 $image_src = $image_src[0];
							 ?>
                        
                            <span><?php the_post_thumbnail('full'); ?></span>            
             <?php }  ?>  
                                
                
                
                </div><!-- end of span -->
                
                <div class="<?php if($smof_data['rnr_portfolio_single_type']=="Side By Side") { echo 'five columns';} else { echo 'sixteen columns'; } ?>">
                
                <!-- START PROJECT INFO --> 
                 <div class="project-info">                    
                    <div class="portfolio-description">
                        <h3><span><?php _e($smof_data['rnr_portfolio_description_title'],'rocknrolla'); ?></span></h3>
                        <div class="portfolio-detail-description-text"><?php the_content(); ?></div>
                    </div>
                   
                    
                    <?php if( get_post_meta( get_the_ID(), 'rnr_project_details', true ) == true) { ?>
                    <div class="project-details">
                        <h3><span><?php echo _e($smof_data['rnr_portfolio_details_title'],'rocknrolla'); ?></span></h3>
                                                            <?php if( get_post_meta( get_the_ID(), 'rnr_project_client_name', true ) != "") { ?>
                                <p><strong><?php _e('Client: ', 'rocknrolla'); ?></strong> <?php echo get_post_meta( get_the_ID(), 'rnr_project_client_name', true ); ?></p>
                                <?php } ?>	
                                <p><strong><?php _e('Tags: ', 'rocknrolla'); ?></strong> <?php $taxonomy = strip_tags( get_the_term_list($post->ID, 'portfolio_filter', '', ', ', '') ); echo $taxonomy; ?></p>
                            
                                <?php if( get_post_meta( get_the_ID(), 'rnr_project_link', true ) != "") { ?>
                                <a href="<?php echo get_post_meta( get_the_ID(), 'rnr_project_link', true ); ?>" target="_blank" class="button"><?php _e('View Project', 'rocknrolla'); ?></a>
                                <?php } ?>				
                    </div><!-- end of portfolio detail -->
                    </div><!-- end of span -->
                    <?php } ?>                    
            </div>
          </div>

	<div class="clear"></div>

	
		<?php endwhile; endif;
		      wp_reset_query(); ?>
        </div> <!-- end of ajaxpage -->
        </div><!--END CONTAINER -->
 
              <div class="container">
               <div class="row">  
                <div class="span12">     
                <div class="posts-nav">
                <?php next_post_link( '<span class="next right">%link</span>', '%title <i class="fa fa-arrow-right"></i>', FALSE); ?>
                <?php previous_post_link( '<span class="prev left">%link</span>', '<i class="fa fa-arrow-left"></i> %title', FALSE); ?>
                 <div class="clear"></div>
                </div>
                </div>
              </div>
             </div>   
      </div>

    </div><!--END SECTION -->
<?php get_footer(); ?>