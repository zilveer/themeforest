 <?php
 global $post;
 the_post(); 
 $st_page_options =  $st_page_builder = get_page_builder_options($post->ID);
 $builder_content  = get_page_builder_content($post->ID);
 $p_layout =  strtolower($st_page_options['portfolio_layout']);
 if($p_layout!='full'){
    $p_layout ='half';
 }
 ?>
    <div class="page-content single-portfolio-wrapper single-portfolio-<?php echo $p_layout; ?> row clearfix">
    
    <?php if($p_layout=='half'){ ?>
  
        <div class="content-wrapper eight columns">
             <?php 
              $thumb_html = st_post_thumbnail($post->ID,'st_medium',false, true);
                if($page<2 && $thumb_html!=''): 
                ?>
             <div class="page-featured-image cpt-thumb-wrapper">
                <?php echo $thumb_html; ?>
                </div>
              <?php endif;  ?>
        </div>
        <div class="project-right-detail four columns">
            <div class="p-desc">
                <h3 class="spd-heading"><?php _e('Project Short Decscription','smooththemes'); ?></h3>
                <?php  echo apply_filters('the_content',$post->post_excerpt);  ?>
            </div>
             <div class="single-portfolio-details">
                  <?php include(dirname(__FILE__).'/portfolio-details.php'); ?>
            </div>
        </div>
        <div class="clear"></div>
   
    
    <?php } ?>
                       
        <div class="twelve columns b20 text-content">
            <h3 class="spd-heading"><?php _e('Project Decscription','smooththemes'); ?></h3>
            <?php the_content(); ?>
        </div>
        
        <div class="twelve columns b20">
        <?php
        // recent portfolio 
        $term_list = wp_get_post_terms($post->ID, 'portfolio_tag', array("fields" => "term_id"));
        $ids=array();
        foreach($term_list as $term){
            $ids[]= $term->term_id;
        }
        echo do_shortcode('[portfolio numpost="3" title="'.__('Related Projects','smooththemes').'"  filter_type="custom" exclude="'.$post->ID.'" num_col="3" cats="'.join(',',$ids).'" ]');
        ?>
        </div>
    </div><!-- END page-content-->
    
