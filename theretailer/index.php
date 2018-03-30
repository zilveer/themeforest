<?php get_header(); ?>
   
    <div class="global_content_wrapper">
    
    <div class="container_12">
    
    	<div class="grid_8">

            <div id="primary" class="content-area page-blog">
                <div id="content" class="site-content" role="main">
    
                    <?php
                    
                    $args = array(
                        'posts_per_page'    => get_option('posts_per_page'),
                        'paged'             => $paged,
                    );

                    $the_query = new WP_Query($args);				
                    
                    if ( $the_query->have_posts() ) :

                        while ( $the_query->have_posts() ) : $the_query->the_post();
                       
                            get_template_part( 'content', get_post_format() );			
                        
                        endwhile;

                        if (function_exists("emm_paginate")) {
                            emm_paginate();
                        }

                        wp_reset_postdata();

                    endif;              
                    
                    ?>
    
                </div><!-- #content .site-content -->
            </div><!-- #primary .content-area -->
            
            
            
        </div>
    
        <div class="grid_4">
        
            <div class="gbtr_aside_column">
                <?php 
                get_sidebar();
                ?>
            </div>
            
        </div>
        
	</div>
    
    </div>

<?php get_template_part("light_footer"); ?>

<?php get_template_part("dark_footer"); ?>

<?php get_footer(); ?>