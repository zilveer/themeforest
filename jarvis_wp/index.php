<?php get_header(); ?> 

<?php  get_template_part('menu_section');   ?>

  <div class="section post-single"><!-- SECTION -->

           <?php   

       
       
       if (!is_front_page()) {
           
           $current_blog_page_id = get_option('page_for_posts'); 
      if((get_post_meta( $current_blog_page_id, 'rnr_disable_title', true )!= true) ){ ?>  
        <div class="container"> 
               <div class="row">  
          <div class="sixteen columns">            
                  <!-- START TITLE -->              
            <div class="title">
              <h1 class="header-text"><?php if(get_post_meta( $current_blog_page_id, 'rnr_alt_title', true )){ echo get_post_meta( $current_blog_page_id, 'rnr_alt_title', true ); } else { echo get_the_title($current_blog_page_id); } ?></h1>
                       <?php if(get_post_meta( $current_blog_page_id, 'rnr_subtitle', true )){ echo '<div class="subtitle"><p>'.get_post_meta( $current_blog_page_id, 'rnr_subtitle', true ).'</p></div><!-- END SUBTITLE -->'; } ?>
                    </div><!-- END TITLE -->                               
          </div><!-- END SIXTEEN COLUMNS -->  
               </div><!-- END ROW -->         
              </div><!-- END CONTAINER -->       
      <?php  } 
	     }
	   ?>  



      <div class="container">   
            <div class="row">        
                <div class="twelve columns">                


                   <?php if (have_posts()) : while (have_posts()) : the_post();  

                        get_template_part( 'post-format/content', get_post_format() ); 

                    endwhile; 

                     get_template_part( 'post-format/pagination' ); 

                     else : ?>

                    <h2><?php _e('No Posts Found', 'rocknrolla') ?></h2>

                    <?php

                    endif; 

                    wp_reset_query();


                    ?>

                </div><!-- END SPAN8 -->
                <?php get_sidebar(); ?>
             </div>   
      </div>	
		

    </div><!--END SECTION -->





<?php get_footer(); ?>