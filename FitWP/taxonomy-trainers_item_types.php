<?php get_header(); ?>

   <?php 

$wmodulepage = get_post_meta(get_the_ID(), 'wmodulepage', true);

?>


<div class="pageInfo">
        
        <div class="container">
            
            <div class="sixteen columns pageTitle">
                
                <h1><?php single_cat_title(); ?></h1>
                
            </div>

        </div>
        
    </div>

  <ul id="reset">
        
  <li><a class="reset" href="#" data-filter=".one-third">reset</a></li>


</ul>
    

   <div class="pageContentWrapper">
        
        <div class="container">
            
                 <ul class="trainersPost dd_trainers_widget widget clearfix">
                        
                      
               <?php
        if (have_posts ()) {

            while (have_posts ()) {

                (the_post());
        ?>

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
                        
    
             
   <?php }?>

  <?php } else { ?>
                    
                                 
                                <h4 style="margin-top: 0;"><?php _e('There is not post available', 'localization'); ?></h4>
                                 
                          
                          <div class="article-content clearfix">
                                
                                <div class="article-text">

                                
                                        
                                  <a href="<?php echo home_url(); ?>"><?php _e('Go Back To Homepage', 'localization'); ?> &rarr;</a>
                                       
                                  
                                 
                                    
                                </div>
                                    
                            </div>
                             
                           
                        
                  


<?php } ?> 
                 

    </ul>
            
             
         <?php
                            kriesi_pagination();

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