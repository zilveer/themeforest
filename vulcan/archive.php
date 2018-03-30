<?php get_header();?>
  
        <?php global $post;?>
        <!-- BEGIN OF PAGE TITLE -->
        <?php if (have_posts()) : ?>      
        <div id="page-title">
        	<div id="page-title-inner">
                <div class="title">
             	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
             	  <?php /* If this is a category archive */ if (is_category()) { ?>
            		<h1><?php single_cat_title(); ?></h1>
             	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
            		<h1><?php echo __('Posts Tagged ','vulcan');?>&#8216;<?php single_tag_title(); ?>&#8217;</h1>
             	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
            		<h1><?php echo __('Archive for ','vulcan');?><?php the_time('F jS, Y'); ?></h1>
             	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
            		<h1><?php echo __('Archive for ','vulcan');?><?php the_time('F, Y'); ?></h1>
             	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
            		<h1><?php echo __('Archive for ','vulcan');?><?php the_time('Y'); ?></h1>
            	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
            		<h1><?php echo __('Author Archive','vulcan');?></h1>
             	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
            		<h1><?php echo __('Blog Archives','vulcan');?></h1>
             	  <?php } ?>
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
                    
                    $blogtext = (get_option('vulcan_blogtext')) ? get_option('vulcan_blogtext') : 60;
                    $readmoretext = (get_option('vulcan_readmoretext')) ? get_option('vulcan_readmoretext') : __("Read More",'vulcan');
                    
                    while ( have_posts() ) : the_post();
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
                       <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>                                              
                       <div class="post-info"><?php echo __('posted by','vulcan');?>: <?php the_author_posts_link();?> &nbsp; | &nbsp; <?php echo __('category ','vulcan');?>: <?php the_category(',');?> &nbsp; | &nbsp; <?php echo __('comments ','vulcan');?>: <?php comments_popup_link(__('0 Comment','vulcan'),__('1 Comment','vulcan'),__('% Comments','vulcan'));?></div>
                    </div>
                    <div id="post-<?php the_ID(); ?>" <?php post_class('blog-posted'); ?>>
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
