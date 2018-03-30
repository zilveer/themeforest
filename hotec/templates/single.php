 <?php
 global $post, $page;
  the_post(); 
 $st_page_options =  $st_page_builder = get_page_builder_options($post->ID);
 $builder_content = get_page_builder_content($post->ID); 
 $date_format = get_option('date_format');
 ?>
    <div class="post-heading">
            <h2 class="blog-title">
               <?php the_title(); ?>
            </h2>
            
            <?php  if(st_get_setting('s_show_post_meta','y')!='n'){ ?>
            <div class="blog-meta">
                <span class="blog-date"><i class="icon-time"></i><?php the_time($date_format); ?></span>
                <span class="blog-author"><i class="icon-user"></i><span><?php echo  _e('By','smooththemes'); ?></span>
                <?php the_author_posts_link(); ?>
                </span>
                <span class="blog-comment"><i class="icon-comments-alt"></i><span></span> <?php comments_number(__('0 Comment','smooththemes'),__('1 Comment','smooththemes'),__('% Comments','smooththemes') )?> </span>
                <span class="blog-category">
                    <i class="icon-file"></i> <?php the_category(', '); ?>
                </span>
            </div>
            <?php } ?>
            
        </div>

    <div class="page-content">
    
     <?php 
     if(st_get_setting('s_show_featured_img','y')!='n'){
     $thumb_html = st_post_thumbnail($post->ID,'st_medium',false, true);
        if($page<2 && $thumb_html!=''): 
        ?>
        <div class="page-featured-image cpt-thumb-wrapper">
            <?php  echo $thumb_html;?>
        </div>
      <?php endif; 
      }
      
       ?>
                                              
        <?php 
        do_action('st_before_the_content',$post);
         echo '<div class="text-content">';
            the_content(); 
         echo '</div>';
        do_action('st_after_the_content',$post);
        do_action('st_after_page_content');
        
            $args = array(
              'before'           => '<p class="single-pagination">' . __('Pages:','smooththemes'),
              'after'            => '</p>',
              'link_before'      => '',
              'link_after'       => '',
              'next_or_number'   => 'number',
              'nextpagelink'     => __('Next page','smooththemes'),
              'previouspagelink' => __('Previous page','smooththemes'),
              'pagelink'         => '%',
              'echo'             => 1
            );
            
            wp_link_pages( $args ); 
                    
         ?> 
        
        
        <div class="clear"></div>
    </div><!-- END page-content-->
    
    <div class="page-single-element">
    
    <?php  if(st_get_setting('s_show_post_tag','y')!='n'){ ?>
        <p class="page-tags">
            <?php the_tags('<b>'.__('Tags:','smooththemes').'</b> ','',''); ?>
        </p>
        <div class="clear"></div>
    <?php } ?>

     <?php  if(st_get_setting('s_show_comments','y')!='n'){ ?>
      <?php comments_template('', true ); ?>
      <?php } ?>
      
      
    </div><!-- Single Page Element -->