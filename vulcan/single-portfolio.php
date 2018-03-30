<?php get_header();?>
      
    <?php 
      global $post;
      
      $portfolio_page = get_option('vulcan_portfolio_page');
      $portfolio_pid = get_page_by_title($portfolio_page);
      ?>
      <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/portfolio-video.js"></script>
        <!-- BEGIN OF PAGE TITLE -->
        <?php if (have_posts()) : ?>      
        <div id="page-title">
        	<div id="page-title-inner">
                <div class="title">
                <h1><?php echo __('Portfolio','vulcan');?></h1>
                </div>
                <div class="dot-separator-title"></div>
                <div class="description">
                  <?php global $post;?>
                  <?php $short_desc = get_post_meta($portfolio_pid->ID, '_short_desc', true ); ?>
                  <p><?php echo $short_desc;?></p>
                </div>                
            </div>   	            
        </div>
        <!-- END OF PAGE TITLE -->
         
        <!-- BEGIN OF CONTENT -->
        <div id="content">
        	<div id="content-fullwidth">          
                <div class="maincontent">
                 <?php if (have_posts()) : while (have_posts()) : the_post();?>
                 <?php
                  $pf_link = get_post_meta($post->ID, '_portfolio_link', true );
                  $pf_url = get_post_meta($post->ID, '_portfolio_url', true );     
                  $thumb   = get_post_thumbnail_id();
                  $get_attachments = get_children( array( 'post_parent' => $post->ID ) );
                  $attachments_count = count( $get_attachments );
                  $thumb   = get_post_thumbnail_id();
                  $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
                  $single_image = aq_resize( $img_url, 936, 340, true ); //resize & retain image proportions (soft crop)
                  $slideshowspeed = (get_option('vulcan_slideshow_speed')) ? get_option('vulcan_slideshow_speed') : 5000; 
                  $slide_transition = (get_option('vulcan_slide_transition')) ? get_option('vulcan_slide_transition') : "fade";    
                 ?>
                    <?php if ($attachments_count >1) { ?>   
                <?php
                    $args = array(
                    	'order'          => 'ASC',
                    	'post_type'      => 'attachment',
                    	'post_parent'    => $post->ID,
                    	'post_mime_type' => 'image',
                    	'post_status'    => null,
                    	'orderby'		 => 'menu_order',
                    	'numberposts'    => -1,
                      'exclude'     => get_post_thumbnail_id()
                    );
                    
                    $attachments = get_posts( $args );
                    if ($attachments) { ?>         
                    <div id="portfolio-slider">
                      <ul>
                       <?php
                      	foreach ($attachments as $attachment) {
                      		$attachment_url = wp_get_attachment_url( $attachment->ID , 'full' );
                      		$image = aq_resize( $attachment_url, 936, 340, true ); //resize & retain image proportions (soft crop)
                      		echo ' <li><image src="' . $image . '" alt=""/></li>';
                      	}
                      ?>  
                      </ul>
                      <div id="pager"></div>     
                    </div>
                    <script type="text/javascript">
                      jQuery(document).ready(function($) { 
                        $('#portfolio-slider ul').cycle({
                            timeout: <?php echo $slideshowspeed;?>,  // milliseconds between slide transitions (0 to disable auto advance)
                            fx:      '<?php echo $slide_transition;?>', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
                            pager:   '#pager',  // selector for element to use as pager container
                            pause:   0,	  // true to enable "pause on hover"
                            pauseOnPagerHover: 0 // true to pause when hovering over pager link
                        });
                      });
                      </script>
                     <?php } ?> 
                  <?php } else { ?>
                  
                    <?php if ($pf_link) { ?>
                    <div class="pf-video-wrapper">
                      <?php
                        if (is_youtube($pf_link)) { ?>
                          <div class="portfolio_movie_container"><a href="<?php echo $pf_link;?>"  rel="youtube"></a></div>
                        <?php
                        } else if (is_vimeo($pf_link)) { ?>
                          <div class="portfolio_movie_container"><a href="<?php echo $pf_link;?>"  rel="vimeo"></a></div>    
                        <?php  
                        } else if (is_quicktime($pf_link)) { 
                          ?>
                          <div class="portfolio_movie_container"><a href="<?php echo $pf_link;?>"  rel="quicktime"></a></div>
                          <?php
                        } else if (is_flash($pf_link)) { ?>
                          <div class="portfolio_movie_container"><a href="<?php echo $pf_link;?>"  rel="flash"></a></div>
                          <?php
                        } else { ?>
                              <img src="<?php echo $pf_link;?>" alt="" class="pf-image"/>
                          <?php } 
                        ?> 
                    </div> 
                <?php } else { ?>
                  <div class="pf-single-image">
                    <img src="<?php echo $single_image;?>" alt="" />
                  </div>
                <?php } 
                  }
                ?>
                <h3><?php the_title();?></h3>
                <div class="divider"></div>
                <?php the_content();?>
            
                <?php endwhile; endif;?>
                     
                </div>
            </div>   
            <?php endif;?>     
                  
        </div>
        <!-- END OF CONTENT -->
        <?php get_footer();?>
