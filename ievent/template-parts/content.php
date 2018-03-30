<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package iEVENT
 */
 
 $ievent_data['checkbox_slideshow']=true;
 $ievent_data['text_slideshow_count']=2;
 $image_size ='blog';
 
 	switch(get_post_format()) {
		case 'link':
			$format_post_class = 'link';
			break;
		case 'image':
			$format_post_class = 'photo';
			break;
		case 'quote':
			$format_post_class = 'quote-left';
			break;
		case 'video':
			$format_post_class = 'video-camera';
			break;
		case 'audio':
			$format_post_class = 'volume-up';
			break;
		case 'Aside':
			$format_post_class = 'comments';
			break;
		default:
			$format_post_class = 'file-text-o';
			break;
	}

?>

    <div id="post-<?php the_ID(); ?>" <?php post_class('jx-ievent-blog'); ?>>
         <div class="jx-ievent-blog-item">
         
         	<!-- Blog Image -->
             <?php  if(get_post_meta( get_the_ID(), 'jx_ievent_video_code', true ) or (has_post_thumbnail())): // Video Post ?>             
             	<div class="jx-ievent-image-container">	                        
                
                 <div class="jx-ievent-blog-image flexslider">
                    <ul class="slides"> 
               
                           <?php  if(get_post_meta( get_the_ID(), 'jx_ievent_video_code', true )): // Video Post ?>
                                <li>
                                    <div class="image jx-ievent-image-wrapper">
                                    <div class="full-video">
                                        <div class="full-widthvideo">
                                        <?php 
                                        global $wp_embed;
                                        $post_embed = $wp_embed->run_shortcode('[embed height="330"]'.get_post_meta(get_the_ID(), 'jx_ievent_video_code', true).'[/embed]');											echo $post_embed;
                                         ?>                                           						
                                        </div><!-- EOF full-widthvideo-->
                                    </div><!-- EOF full-video-->
                                    
                                    <div class="jx-ievent-image-overlay"></div>
                                    
                                     <div class="jx-ievent-image-hover">
                                        <a href="<?php echo get_post_meta(get_the_ID(), 'jx_ievent_video_code', true); ?>" class="jx-ievent-blog-more" data-rel="prettyPhoto"><i class="line-icon vc_li vc_li-videocam"></i></a>                            
                                    </div>
                                    <!-- Image Hover -->
                                    </div>
                                </li>
                           <?php endif;?>                                     
                           <?php if(has_post_thumbnail()): // Start of featuered image ?>
                          
                                 <li>
                                    <div class="image jx-ievent-image-wrapper">
                                 <?php 
                                      $post_image_id = get_post_thumbnail_id(get_the_id());
                                      $image_url = wp_get_attachment_image_src($post_image_id, 'large');
                                      $image_small = wp_get_attachment_image_src($post_image_id, $image_size);
                                      $image_data = wp_get_attachment_metadata($post_image_id);
                                      the_post_thumbnail($image_size); ?>
                                      
                                      <div class="jx-ievent-image-overlay"></div>										  
                                      
                                      <div class="jx-ievent-image-hover">
                                        <a href="<?php esc_url(the_permalink()) ?>" class="jx-ievent-blog-more"><i class="line-icon vc_li vc_li-news"></i></a>
                                      </div>
                                     </div>
                                </li> 
                           
                           <?php endif;?>                                     
                           <?php if(kd_mfi_get_featured_image_id('featured-image-2', 'post')): ?>
                           <?php
                                                                    
                                $i = 2;
                                while($i <= $ievent_data['text_slideshow_count'] ):
                                $attachment_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
                                
                                echo'<li><div class="image jx-ievent-image-wrapper">';
                                
                                if($attachment_id):
                                $image_url = wp_get_attachment_image_src($attachment_id, 'large');
                                $image_small = wp_get_attachment_image_src($attachment_id, $image_size);
                                $image_data = wp_get_attachment_metadata($attachment_id);
                               // the_post_thumbnail($image_size);
                                ?>									
                            
                                <img src="<?php echo esc_url($image_small[0]); ?>" alt="<?php echo esc_attr($image_data['image_meta']['title']); ?>" />									
                                <div class="jx-ievent-image-overlay"></div>
                                <div class="jx-ievent-image-hover">
                                    <a href="<?php esc_url(the_permalink()) ?>" class="jx-ievent-blog-more"><i class="line-icon vc_li vc_li-news"></i></a>
                                </div>										
                            <?php
                                echo'</div></li>';
                            
                                endif; $i++;
                            endwhile;
                                
                            ?>
                            
                            
                           <?php endif; // End of slideshow ?> 
                
                                    
                    </ul><!-- end #slider -->
                 </div><!-- end of Flexslider -->
			 </div>
             <?php endif; ?>
            <!-- EOF Blog image -->
         	<div class="jx-ievent-content clearfix">
                <div class="jx-ievent-blog-head">
                    <div class="jx-ievent-post-format"><i class="fa fa-<?php echo $format_post_class; ?>"></i></div>
                    <div class="jx-ievent-blog-meta">
                        <div class="jx-ievent-event-date"><?php echo get_the_date(); ?></div>
                    </div>
                    <div class="title"><a href="<?php echo esc_url( get_permalink()); ?>"><?php echo the_title(); ?></a></div>
                </div>
                <div class="jx-ievent-blog-metabox jx-ievent-single">
                        <span class="meta_comments"><i class="fa fa-comments"></i><a href="<?php esc_url(comments_link()); ?>"><?php comments_number(esc_html__( 'No Comments', 'ievent' ),esc_html__( '1 Comment', 'ievent' ),esc_html__( '% Comments', 'ievent' )); ?></a></span>
                        <span class="meta_categories"><i class="fa fa-tag"></i><?php echo esc_html_e('in','ievent'); ?> <?php the_category(' , ') ?></span>
                        <span class="meta_author"><i class="fa fa-user"></i><?php echo esc_html_e('By','ievent'); ?> <?php the_author_posts_link(); ?></span>
                    </div>         	
                <div class="jx-ievent-blog-content">
                    
                    <div class="description">
                        <?php echo excerpt('60'); ?>
                    </div>
                    
                    <div class="jx-ievent-readmore">
                        <a href="<?php esc_url(the_permalink()); ?>"><?php esc_html_e( 'Read More', 'ievent' )?></a>
                    </div>
                             
                </div>
            </div>
            <!-- Content -->
        </div>
    </div><!-- #post-## -->
