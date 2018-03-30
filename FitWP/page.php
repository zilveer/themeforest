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

   <div class="pageContentWrapper">
        
        <div class="container">
            
            <div class="two-thirds column">
                
                
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
            
            <ul class="sidebar one-third column clearfix">
               
                   <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Pages")) ; ?>
                
            </ul>
            
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

