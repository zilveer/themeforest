<?php get_header(); ?>




 <div class="pageInfo">
        
        <div class="container">
            
            <div class="eight columns pageTitle">
                
                <h1><?php _e('Error 404', 'localization'); ?></h1>
                
            </div>
            
        
            
        </div>
        
    </div>

   <div class="pageContentWrapper">
        
        <div class="container">
            
            <div class="sixteen columns">
                
                
         

                
                <div class="pageContent">
                    
                    <h4><?php _e('PAGE NOT FOUND', 'localization'); ?></h4>
                  <p><?php _e("Looks like something went completely wrong! But don't worry - it can happen to the best of us, - and it just happened to you.", 'localization'); ?></p>
                     <a href="<?php echo home_url(); ?>"><?php _e('Go Back To Homepage', 'localization'); ?> &rarr;</a>
                     
                </div>
                

                

                
            </div>
      
            
        </div>
        
    </div>




<?php get_footer(); ?>

