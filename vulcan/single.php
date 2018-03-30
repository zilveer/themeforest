<?php get_header();?>

<?php
  global $post;
  $blog_pid = get_option('vulcan_blog_pid');
  $blog_page = get_page_by_title($blog_pid);
  $short_desc = get_post_meta($blog_page->ID, '_short_desc', true );
  ?>
        <!-- BEGIN OF PAGE TITLE -->
        <?php if (have_posts()) : ?>      
        <div id="page-title">
        	<div id="page-title-inner">
                <div class="title">
                <h1><?php echo ucfirst($blog_pid);?></h1>
                </div>
                <div class="dot-separator-title"></div>
                <div class="description">
                  <p><?php echo $short_desc;?></p>
                </div>
                <div class="clear"></div>                
            </div>   	            
        </div>
        <!-- END OF PAGE TITLE --> 
        
        <!-- BEGIN OF CONTENT -->
        <div id="content">
        	<div id="content-left">          
                <div class="maincontent">
                <?php 
                  while (have_posts()) : the_post();
                  $thumb   = get_post_thumbnail_id();
                  $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
                  $image   = aq_resize( $img_url, 223, 129, true ); //resize & crop the image
                  
                ?>
                    <!-- begin of blog post  -->
                    <div class="left-head">
                        <div class="post-date"><?php the_time('d');?></div>
                        <div class="post-month"><?php the_time('M');?></div>
                    </div>
                    
                    <div class="right-head">
                       <h3><?php the_title();?></h3>                                        
                       <div class="post-info"><?php echo __('posted by ','vulcan');?>: <?php the_author_posts_link();?> &nbsp; | &nbsp; category : <?php the_category(',');?> &nbsp; | &nbsp; <?php echo __('comments ','vulcan');?>: <?php comments_popup_link(__('0 Comment','vulcan'),__('1 Comment','vulcan'),__('% Comments','vulcan'));?></div>
                    </div>
                    
                    <div class="blog-posted">
                        
                      <?php the_content();?>
                      
                      <div class="clr"></div>
                      <div class="divider"></div>
                      
                      <?php 
                      $disable_authorbox = get_option('vulcan_disable_authorbox');
                      if ($disable_authorbox == "false") : 
                      ?>                                          
                        <div class="author">
                          <div class="author-avatar">
                          <?php if (function_exists('get_avatar')) { 
                            echo get_avatar(get_the_author_meta('user_email'), '70'); 
                          } ?>
                          </div>
                        <h5>About <?php the_author();?></h5>
                        <?php the_author_meta('description'); ?>
                        </div>
                      <?php endif; ?>
                      <div class="clr"></div><br />
                      <?php comments_template('', true);?>                                         
                    </div>                
                <?php endwhile;?>                     
                </div>
            </div>
            <?php endif;?>
          <?php get_sidebar();?>             
                  
        </div>
        <!-- END OF CONTENT -->
        <?php get_footer();?>
