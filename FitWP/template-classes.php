<?php /*
  Template Name: Classes Template
 */ ?>

<?php get_header(); ?>

   <?php 

$wmodulepage = get_post_meta(get_the_ID(), 'wmodulepage', true);

?>


 <div class="pageInfo">
        
        <div class="container">
            
            <div class="eight columns pageTitle">
                
                <h1><?php the_title(); ?></h1>
                
            </div>
            
            <div class="eight columns breadcrumb">
               
               <?php my_breadcrumb(); ?>
                
            </div>
            
        </div>
        
    </div>

  <ul id="reset">
        
  <li><a class="reset" href="#" data-filter=".one-third">reset</a></li>


</ul>
    

   <div class="pageContentWrapper">
        
        <div class="container">
            
                  <ul class="classesPost dd_classes_widget widget clearfix ">
                        
                      
                                           
                    <?php
global $paged;


$arguments = array(
    'post_type' => 'post_classes',
    'post_status' => 'publish',
    'paged' => $paged
);

$classes_query = new WP_Query($arguments);

dd_set_query($classes_query);

?>
                     
                       <?php if ($classes_query->have_posts()) : while ($classes_query->have_posts()) : $classes_query->the_post(); ?>
                      
                        <li <?php post_class('one-third column'); ?>>
                            
                              <?php 

$thumbimg = get_post_meta(get_the_ID(), 'thumbimg', true);


?>
                            
                            <div class="wrapper">
                                
                                
                                <?php if( $thumbimg) { ?>
                                
                                  <div class="postThumb"><a href="<?php the_permalink(); ?>"><img src="<?php echo $thumbimg; ?>" alt="" /></a></div>
    
      <?php } ?>
                                
                                
                            
                            <div class="postDetails">
                                
                                <a href="<?php the_permalink(); ?>" class="postTitle"><h1><?php the_title(); ?></h1></a>
                                <?php the_excerpt(); ?>
                                 <a class="button-small-theme rounded3" href="<?php the_permalink(); ?>"><?php _e('MORE INFO', 'localization'); ?></a>
                                
                            </div>
                                
                            </div>
                            
                        </li>
                        
           
      <?php endwhile; ?>
                    
                

<?php endif; ?>
                     
                 </ul>

                 
     

                   <?php
                            kriesi_pagination();

                            dd_restore_query();
?>                  
                 


            
        </div>
        
    </div>

 <?php if ( $wmodulepage == 'yes') { ?>

<div class="widgetModuleWrapper">
        
    <ul class="widgetModule container clearfix">
        
          <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Widgetized Module")) ; ?>
        
    </ul>
    
</div>

        <?php } ?>

<?php get_footer(); ?>

    