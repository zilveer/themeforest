<?php
/*
Template Name: Services Template
*/
?>
<?php get_header();?>
        <!-- BEGIN OF PAGE TITLE -->
        <?php if (have_posts()) : ?>      
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
          <div id="content-fullwidth">
               
                <div class="maincontent">
                <?php 
                  if (have_posts()) : while (have_posts()) : the_post();
                    the_content();
                  endwhile; endif;
                  
                  global $post;
                  $counter = 0;
                  $services_page = get_option('vulcan_services_pid');
                  $services_order = get_option('vulcan_services_order');
                  
                  $servicespid = get_page_by_title($services_page);
                  $spid = ($post->ID) ? ($post->ID)  : $servicespid->id;
                   
                  query_posts(array('post_type'=>'page','post_parent'=>$spid,'posts_per_page'=>-1,'orderby'=>$services_order,'order'=>'DESC'));                  
                  
                  while ( have_posts() ) : the_post();
                  $thumb   = get_post_thumbnail_id();
                  $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
                  $image   = aq_resize( $img_url, 107, 87, true ); //resize & crop the image
                  $counter++;
                 	?>
                	<div class="services-column">
                     <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
                        <img src="<?php echo $image;?>" alt="<?php the_title(); ?>" class="imgleft"/>
                      <?php } ?>
                    <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                    <?php
                    if($post->post_excerpt) { 
                      the_excerpt(); 
                    } else {
                      echo "<p>".excerpt(30)."</p>";
                    } 
                    ?>
                    <div class="more-button"><a href="<?php the_permalink();?>"><?php echo __('Learn More','vulcan');?></a></div>
                    <div class="clear"></div>
                    <br />
                    </div>
                    <?php if ($counter %2 != 0) {;?>
                      <div class="services-spacer">&nbsp;</div>
                    <?php }?>
        					<?php endwhile;?>                
                </div>
            <?php endif;?>
          </div>
        </div>
        <!-- END OF CONTENT -->
        <?php get_footer();?>
