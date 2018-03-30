<?php /*
  Template Name: Full Width Page
 */ ?>

  <?php 

$wmodulepage = get_post_meta(get_the_ID(), 'wmodulepage', true);

?>

<?php get_header(); ?>

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

   <div class="pageContentWrapper">
        
        <div class="container">
            
            <div class="sixteen columns">
                
                
                         <?php
        if (have_posts ()) {

            while (have_posts ()) {

                (the_post());
        ?>


                
                <div class="pageContent">
                    
                            <?php the_content(); ?>
                 
                </div>
                
                
<?php }
        } else { ?>

            <div class="post box">
                <h3><?php _e('There is not post available.', 'localization'); ?></h3>

            </div>

<?php } ?>
                

                
            </div>

            
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

