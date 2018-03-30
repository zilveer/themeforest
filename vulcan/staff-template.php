<?php 
/*
Template Name: Staff
*/
?>
<?php get_header();?>
        
        <?php
        $blogtext = (get_option('vulcan_blogtext')) ? get_option('vulcan_blogtext') : 80;
        $readmoretext = (get_option('vulcan_readmoretext')) ? get_option('vulcan_readmoretext') : "Read More";
        ?>        
        <?php if (have_posts()) : ?>
        <!-- BEGIN OF PAGE TITLE -->      
         <div id="page-title">
          	<div id="page-title-inner">
                  <div class="title">
                  <h1><?php the_title();?></h1>
                  </div>
                  <div class="dot-separator-title"></div>
                  <div class="description">
                    <?php global $post;?>
                    <?php $short_desc = get_post_meta($post->ID, '_short_desc', true ); ?>
                    <p><?php echo $short_desc;?></p>
                  </div>
              </div>   	            
          </div>
        <!-- END OF PAGE TITLE --> 
        
        <!-- BEGIN OF CONTENT -->
        <div id="content">
        	<div id="content-left">          
                <div class="maincontent">            
                   <ul class="teamlist">
                   
                   <?php
                   
                    query_posts(array( 'post_type' => 'staff', 'posts_per_page' => -1,"orderby" => 'date','order'=> 'DESC'));
                    
                    $counter = 0;
                    while (have_posts()) : the_post();
                      $thumb   = get_post_thumbnail_id();
                      $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
                      $image   = aq_resize( $img_url, 60, 60, true ); //resize & crop the image
                      
                      $counter++;
                      ?>
                      <li <?php if ($counter%2 ==0) echo 'class="last"';?>>
                        <div class="about-team">
                        <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) { ?>
                          <img src="<?php echo $image;?>" alt="" class="imgleft border" />
                        <?php } ?>    
                        </div>
                        <strong><a href="<?php the_permalink();?>"><?php the_title();?></a></strong><p><?php echo get_the_excerpt();?></p>
                      </li>
                      <?php endwhile;?>
                      </ul>
                  </div>                          
                </div>
            </div>
            <?php endif;?>
            <?php wp_reset_query();?>
          <?php get_sidebar();?>             
                  
        </div>
        <!-- END OF CONTENT -->
        <?php get_footer();?>
