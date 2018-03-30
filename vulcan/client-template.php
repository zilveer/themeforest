<?php 
/*
Template Name: Client
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
                    <?php
                    query_posts(array( 'post_type' => 'client', 'posts_per_page' => -1,"orderby" => 'date','order'=> 'DESC'));
    
              			while (have_posts()) : the_post();
                    $thumb   = get_post_thumbnail_id();
                    $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
                    $image   = aq_resize( $img_url, 64, 64, true ); //resize & crop the image
                    $custom_url = get_post_meta( $post->ID,'_custom_url',true );
                  	?>                
                    <!-- begin of blog post  -->
                    <div class="blog-posted">
                      <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
                      <div class="blog-box" style="background: none !important;padding:0; ">
                        <a href="<?php echo $custom_url;?>"><img src="<?php echo $image;?>" alt="" /></a>
                      </div>
                      <?php } ?>
                    <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                    <?php the_content();?> 
                    </div>
                    <div class="clr"></div>
                    <div class="line-divider"></div>
                    <?php endwhile;?>
                    <!-- end of blog post -->
                    <div class="clr"></div>
                                          
                </div>
            </div>
            <?php endif;?>
            <?php wp_reset_query();?>
          <?php get_sidebar();?>             
                  
        </div>
        <!-- END OF CONTENT -->
        <?php get_footer();?>
