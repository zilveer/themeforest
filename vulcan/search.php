<?php get_header();?>
  
        <?php global $post;?>
        <!-- BEGIN OF PAGE TITLE -->
        <div id="page-title">
        	<div id="page-title-inner">
                <div class="title">
                <h1><?php echo __('Search Results for ','vulcan');?>&quot;<?php echo $s;?>&quot;</h1>
                </div>
            </div>   	            
        </div>
        <!-- END OF PAGE TITLE --> 
        
        <!-- BEGIN OF CONTENT -->
        <div id="content">
        	<div id="content-left">          
                <div class="maincontent">
                    <?php
                    global $post;
                    
                    $blog_cats_include = get_option('vulcan_blog_cats_include');
                    if(is_array($blog_cats_include)) {
                      $blog_include = implode(",",$blog_cats_include);
                    } 
                    
                    $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $blog_num = (get_option('vulcan_blog_num')) ? get_option('vulcan_blog_num') : 4; 
                    $blogtext = (get_option('vulcan_blogtext')) ? get_option('vulcan_blogtext') : 60;
                    $readmoretext = (get_option('vulcan_readmoretext')) ? get_option('vulcan_readmoretext') : __("Read More",'vulcan');
                    
                    if (have_posts()) : 
                    
                    while ( have_posts() ) : the_post();
                    $thumb   = get_post_thumbnail_id();
                    $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
                    $image   = aq_resize( $img_url, 223, 129, true ); //resize & crop the image
                  	?>                
                    <!-- begin of blog post  -->
                    <div class="left-head">
                        <div class="date"><?php the_time('d');?></div>
                        <div class="month"><?php the_time('M');?></div>
                    </div>
                    <div class="right-head">
                       <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>                                              
                       <div class="post-info"><?php echo __('posted by','vulcan');?>: <?php the_author_posts_link();?> &nbsp; | &nbsp; <?php echo __('category ','vulcan');?>: <?php the_category(',');?> &nbsp; | &nbsp; <?php echo __('comments ','vulcan');?>: <?php comments_popup_link(__('0 Comment','vulcan'),__('1 Comment','vulcan'),__('% Comments','vulcan'));?></div>
                    </div>
                    <div class="blog-posted">
                      <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
                      <div class="blog-box">
                        <img src="<?php echo $image;?>" alt="" />
                      </div>
                      <?php } ?>
                      
                    <?php  if($post->post_excerpt) { 
                      the_excerpt(); 
                    } else { ?>
                    <p><?php echo excerpt($blogtext);?></p>
                    <?php } ?>
                    <div class="more-button"><a href="<?php the_permalink();?>"><?php echo $readmoretext;?></a></div>                                        
                    </div>
                    <?php endwhile;?>
                    <?php else : ?>
                    <h3><?php echo __('No Result found for','vulcan');?> <?php echo '"'.$s.'"';?></h3>
                    <div class="warning"><h5><?php echo __('Try different search?','vulcan');?></h5></div>
                    <?php get_search_form();?>
                    <?php endif;?>
                    <!-- end of blog post -->
                    <div class="clr"></div>
                    <div class="blog-pagination"><!-- page pagination -->                                       	     			
                    <?php pagination()?>      
                  </div>                          
                </div>
            </div>
            <?php wp_reset_query();?>
          <?php get_sidebar();?>             
                  
        </div>
        <!-- END OF CONTENT -->
        <?php get_footer();?>
