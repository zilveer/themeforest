<?php get_header(); ?>

 <div class="pageInfo">
        
        <div class="container">
            
            <div class="sixteen columns pageTitle">
                
                      <?php if (ot_get_option('searchtitle')) {  ?>
                
                <h1><?php echo ot_get_option('searchtitle') ?></h1>
                
                    <?php } else { ?>
                
                <h1><?php _e('SEARCH RESULTS', 'localization'); ?></h1>
                
                    <?php } ?>
                
            </div>
            
         
            
        </div>
        
    </div>

   <div class="pageContentWrapper">
        
        <div class="container">
            
            <div class="sixteen columns">
                
                    <ul class="newsPostList">
                        
                      <?php
        if (have_posts ()) {

            while (have_posts ()) {

                (the_post());
        ?>

                        
                    <li class="singleInfo">
                    
                        
                        
                    <div class="singleMeta clearfix">
                        
                        <h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                          <span><?php _e('By', 'localization'); ?> <?php the_author(); ?> | <?php _e('In', 'localization'); ?> <?php the_category(', ');?> | on <?php the_time('F j, Y'); ?> </span>
                                   
                    </div>
                    
                    <div class="excerpt">
                        
                                <?php the_excerpt(); ?>
            
                        
                           <a class="button-small-theme rounded3 " href="<?php the_permalink(); ?>"><?php _e('CONTINUE READING', 'localization'); ?></a>
                                 
                        
                    </div>
                    
                </li>

             <?php }?>

  <?php } else { ?>
                    
                                 
                 <div class="pageContent">
                    
                       <h4 style="margin-top: 0; margin-bottom: 10px;"><?php _e('THERE IS NO POST AVAILABLE', 'localization'); ?></h4>
                       
                         <a href="<?php echo home_url(); ?>"><?php _e('Go Back To Homepage', 'localization'); ?> &rarr;</a>
                </div>
                
                
                             
                           
                        
                  


<?php } ?> 
                 </ul>

                
            </div>
            
            
                 
        <?php
                            kriesi_pagination();

?>                  
                 
            
     
        </div>
        
    </div>




<?php get_footer(); ?>

