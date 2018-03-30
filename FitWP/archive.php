<?php get_header(); ?>

 <div class="pageInfo">
        
        <div class="container">
            
            <div class="sixteen columns pageTitle">
                
                <h1><?php wp_title("",true); ?><?php _e("'S ARCHIVE", 'localization'); ?></h1>
                
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
                    
                               <?php if( $bigimg) { ?>
                        
                        <div class="singleThumb"><a href="<?php the_permalink(); ?>"><img src="<?php echo $bigimg; ?>" alt="" /></a></div>
                    
                                <?php } ?>
                        
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
                    
                                 
                                <h4 style="margin-top: 0;"><?php _e('There is not post available', 'localization'); ?></h4>
                                 
                          
                          <div class="article-content clearfix">
                                
                                <div class="article-text">

                                
                                        
                                  <a href="<?php echo home_url(); ?>"><?php _e('Go Back To Homepage', 'localization'); ?> &rarr;</a>
                                       
                                  
                                 
                                    
                                </div>
                                    
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

