 <?php
 global $post, $page;
  the_post(); 
 $st_page_options =  $st_page_builder = get_page_builder_options($post->ID);
 $builder_content = get_page_builder_content($post->ID); 
 
   $start_date = get_post_meta($post->ID,'_st_event_start_date',true);
    
    if($start_date!=''){
        $start_date = strtotime($start_date);
    }
    
    $end_date = get_post_meta($post->ID,'_st_event_end_date',true);
    if($end_date!=''){
        $end_date = strtotime($end_date);
    }
    
    $address = get_post_meta($post->ID,'_st_event_meta_address',true);
    $price = get_post_meta($post->ID,'_st_event_meta_price',true);;
 
 ?>
   
    <div class="single-event-meta">
       <?php if($start_date!=''): ?>
        <span class="event-time"><i class="icon-time"></i> <?php echo date_i18n('H:iA',$start_date); ?></span>
        <?php endif; ?>
         <?php if($address!=''): ?>
        <span class="event-address"><i class="icon-map-marker"></i><span> <?php echo $address; ?></span></span>
          <?php endif; ?>
            <?php if($price!=''): ?>
        <span class="event-cost"><i class="icon-key"></i><span> <?php echo $price; ; ?></span></span>
         <?php endif; ?>
    </div>
       
    <div class="page-content">
    
     <?php 
     $thumb_html = st_post_thumbnail($post->ID,'st_medium',false, true);
       if($page<2 && $thumb_html!=''): 
        ?>
        <div class="page-featured-image cpt-thumb-wrapper">
        <?php echo $thumb_html; ?>
        </div>
      <?php endif;  ?>
                                              
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
        <p class="page-tags">
            <?php the_tags('<b>'.__('Tags:','smooththemes').'</b> ','',''); ?>
        </p>
        <div class="clear"></div>
       
    </div><!-- Single Page Element -->