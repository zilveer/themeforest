<?php
global $post;
if($post->ID):

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
 

$link = get_permalink($post->ID);

 $address = get_post_meta($post->ID,'_st_event_meta_address',true);
 $price = get_post_meta($post->ID,'_st_event_meta_price',true);;

?>
<div <?php post_class('blog-post-item event-post-item b30'); ?>  id="post-<?php the_ID(); ?>">
        
        <?php if($start_date): ?>

        <div class="event-single-date">
            <p class="small-event-data">
                <strong><?php echo date_i18n('d',$start_date); ?></strong><a href="<?php echo $link; ?>"></a><span><?php echo date_i18n('M',$start_date); ?></span>
            </p>
        </div>
        <?php  endif; ?>
        
        <div class="post-heading">
            <h2 class="blog-title"><a href="<?php echo $link; ?>"><?php  the_title(); ?></a> </h2>
            <div class="blog-meta">
                <?php if($start_date!=''){ ?>
                <span class="event-time"><i class="icon-time"></i> <?php echo date_i18n('H:iA',$start_date); ?></span>
                <?php } ?>
                  <?php if($address!=''){ ?>
                <span class="event-address"><i class="icon-map-marker"></i><span> <?php echo $address; ?></span></span>
                 <?php } ?>
                  <?php if($price!=''){ ?>
                <span class="event-cost"><i class="icon-key"></i><span> <?php echo $price; ?></span></span>
                 <?php } ?>
            </div>
        </div>
        <div class="clear"></div>
        
        <?php
          $thumb =  st_post_thumbnail($post->ID,'st_medium');
          
          if($thumb){
         ?>
        <div class="blog-thumb-wrapper cpt-thumb-wrapper">
            <?php echo $thumb;  ?>
        </div>
        <?php } ?>
        
        <div class="blog-excerpt">
            <?php  the_excerpt(); ?>
        </div>
        <a href="<?php echo $link; ?>" class="blog-more"><i class="icon-plus"></i> <?php _e('View Event Detail','smooththemes'); ?></a>
    </div>

<?php endif; ?>